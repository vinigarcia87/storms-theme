<?php
/**
 * 8KDesign (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | storms@storms.com.br
 * @copyright (c) Copyright 2012-2018, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   1.0.0
 *
 * storms-checkout-changes.php
 * {{ Why this file is here? }}
 */

// Remove CSS and/or JS for Select2 (SelectWoo) used by WooCommerce
// @see https://gist.github.com/Willem-Siebe/c6d798ccba249d5bf080
function storms_dequeue_stylesandscripts_select2() {
	if ( class_exists( 'woocommerce' ) ) {
		wp_dequeue_style( 'selectWoo' );
		wp_deregister_style( 'selectWoo' );

		wp_dequeue_script( 'selectWoo');
		wp_deregister_script('selectWoo');
	}
}
add_action( 'wp_enqueue_scripts', 'storms_dequeue_stylesandscripts_select2', 100 );

// Remove CSS e JS para o plugin yith wc wishlist
function storms_dequeue_stylesandscripts_yith_wc_wishlist() {
	wp_dequeue_style('yith-wcwl-main');
	wp_deregister_style('yith-wcwl-main');

	wp_dequeue_style('yith-wcwl-font-awesome');
	wp_dequeue_style('yith-wcwl-font-awesome');

	wp_dequeue_style('woocommerce_prettyPhoto_css');
	wp_dequeue_style('woocommerce_prettyPhoto_css');

	wp_dequeue_script('jquery-selectBox');
	wp_deregister_script('jquery-selectBox');
}
add_action( 'wp_enqueue_scripts', 'storms_dequeue_stylesandscripts_yith_wc_wishlist', 100 );

// Modificando o script do autofill dos correios para incluir melhorias
// Este script somente eh sobrescrito para incluir suporte para o Select2 (SelectWoo)
// Sem esse suporte, o Autofill nao consegue preencher o campo Estado do formulario de checkout
// A unica modificacao eh a inclusao do codigo `$( '#' + field + '_state' ).val( data.state ).trigger('change'); // Select2 support` no final do metodo `fillFields`
function storms_autofill_correios_frontend_scripts() {
	if ( is_checkout() || is_account_page() ) {
		wp_dequeue_script('woocommerce-correios-autofill-addresses');
		wp_enqueue_script( 'storms-woocommerce-correios-autofill-addresses', \StormsFramework\Storms\Helper::get_asset_url( '/js/storms-autofill-address.js' ), array( 'jquery', 'jquery-blockui' ), '3.5.1'/*WC_Correios::VERSION*/, true );

		$ajax_endpoint = 'correios_autofill_address';

		wp_localize_script(
			'storms-woocommerce-correios-autofill-addresses',
			'WCCorreiosAutofillAddressParams',
			array(
				'url'   => WC_AJAX::get_endpoint( $ajax_endpoint ),
				'force' => apply_filters( 'woocommerce_correios_autofill_addresses_force_autofill', 'no' ),
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'storms_autofill_correios_frontend_scripts', 100 );

/**
 * Sort Shipping Methods By Cost
 * @see https://www.speakinginbytes.com/2016/06/woocommerce-sort-shipping-methods-cost/
 * @see ChromeOrange - https://gist.github.com/ChromeOrange/10013862
 *
 * @param $rates
 * @param $package
 */
function storms_sort_woocommerce_available_shipping_methods( $rates, $package ) {
    //  if there are no rates don't do anything
    if ( ! $rates ) {
        return;
    }

    // get an array of prices
    $prices = array();
    foreach( $rates as $rate ) {
        $prices[] = $rate->cost;
    }

    // use the prices to sort the rates
    array_multisort( $prices, $rates );

    // return the rates
    return $rates;
}
add_filter( 'woocommerce_package_rates' , 'storms_sort_woocommerce_available_shipping_methods', 10, 2 );

/**
 * Exibe o label de free shipping para métodos de entrega com preço igual a zero
 * @see https://stackoverflow.com/a/46267597/1003020
 *
 * @param $label
 * @param $method
 * @return string
 */
function storms_add_free_shipping_label( $label, $method ) {
    if ( $method->cost == 0 ) {
        $label .= ': <span class="storms-free-shipping">' . __( 'Entrega grátis', 'storms' ) . '</span>';
    }
    return $label;
}
add_filter( 'woocommerce_cart_shipping_method_full_label', 'storms_add_free_shipping_label', 10, 2 );

/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 * @see https://docs.woocommerce.com/document/hide-other-shipping-methods-when-free-shipping-is-available/
 * @see http://jeroensormani.com/only-show-freecheapestmost-expensive-shipping-in-woocommerce/
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
function storms_hide_shipping_when_free_is_available( $rates ) {
    $free = array();
    if( empty( $rates ) ) {
        return $rates;
    }
    foreach ( $rates as $rate_id => $rate ) {
        if ( 'free_shipping' === $rate->method_id ) {
            $free[ $rate_id ] = $rate;
            break;
        }
    }
    return ! empty( $free ) ? $free : $rates;
}
//add_filter( 'woocommerce_package_rates', 'storms_hide_shipping_when_free_is_available', 100 );

/**
 * Woocommerce hide empty categories in woocommerce widget "product categories"
 * Source: https://gist.github.com/goliver79/11091523
 */
function storms_hide_product_categories_widget( $list_args ){
    $list_args[ 'hide_empty' ] = 1;

    return $list_args;
}
add_filter( 'woocommerce_product_categories_widget_args', 'storms_hide_product_categories_widget' );

/**
 * Hook into pre_get_posts to do the main product query.
 * Modificaçao para trazer as categorias ordenadas hierarquicamente e sem as categorias vazias *
 * @param mixed $q query object
 */
function storms_product_cat_query( $query ) {
    if ( is_product_category() ) {
        $query->set( 'hierarchical', true );
        $query->set( 'hide_empty', true );
    }
}
add_action( 'pre_get_posts', 'storms_product_cat_query' );

/**
 * Rename WooCommerce Endpoints in My Accounts Page
 * @see https://wpbeaches.com/change-rename-woocommerce-endpoints-accounts-page/
 */
function storms_woocommerce_my_account_order() {
    $myorder = array(
        'dashboard'       => __( 'Início', 'woocommerce' ),
        'orders'          => __( 'Orders', 'woocommerce' ),
        'downloads'       => __( 'Downloads', 'woocommerce' ),
        'edit-address'    => __( 'Dados do cliente', 'woocommerce' ),
        'payment-methods' => __( 'Payment methods', 'woocommerce' ),
        'edit-account'    => __( 'Alterar senha', 'woocommerce' ),
        'customer-logout' => __( 'Logout', 'woocommerce' ),
    );
    return $myorder;
}
add_filter ( 'woocommerce_account_menu_items', 'storms_woocommerce_my_account_order' );

/*
 * Change the entry title of the endpoints that appear in My Account Page
 * @see https://wpbeaches.com/change-rename-woocommerce-endpoints-accounts-page/
 */
function storms_woocommerce_endpoint_title( $title, $id ) {
    if ( is_wc_endpoint_url( 'dashboard' ) && in_the_loop() ) {
        $title = 'Início';
    }
    elseif ( is_wc_endpoint_url( 'edit-address' ) && in_the_loop() ) {
        $title = 'Dados do cliente';
    }
    elseif ( is_wc_endpoint_url( 'edit-account' ) && in_the_loop() ) {
        $title = 'Alterar senha';
    }
    return $title;
}
add_filter( 'the_title', 'storms_woocommerce_endpoint_title', 10, 2 );

/**
 * Reduce the strength requirement on the woocommerce password.
 * @see https://gist.github.com/BurlesonBrad/c89a825a64732a46b87c
 *
 * Strength Settings
 * 3 = Strong (default)
 * 2 = Medium
 * 1 = Weak
 * 0 = Very Weak / Anything
 */
function storms_reduce_woocommerce_min_strength_requirement( $strength ) {
    return 2;
}
add_filter( 'woocommerce_min_password_strength', 'storms_reduce_woocommerce_min_strength_requirement' );

/**
 * Changes the messaging that comes up when the password doesn't meet minimum requirements
 */
function storms_password_hint( $hint ) {
    return 'Dica: A senha deve ter pelo menos oito caracteres. Para torná-la mais forte, use letras maiúsculas e minúsculas, números e símbolos como ! \" ? $ % ^ &amp; ).';
}
add_filter( 'password_hint', 'storms_password_hint' );
