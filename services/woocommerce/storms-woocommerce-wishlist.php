<?php
/**
 * Storms Websolutions (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2020, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   4.0.0
 *
 * Storms WooCommerce YITH Wishlist file
 * This code customize the YITH Wishlist
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( \StormsFramework\Helper::is_woocommerce_activated() ) {

	// Required plugin: YITH Wishlist
	if( defined( 'YITH_WCWL' ) ) {

		if( ! function_exists( 'storms_define_wishlist_options' ) ) {

			// Define WordPress options
			function storms_define_wishlist_options() {

				// YITH Wishlist configuration
				update_option('yith_wcwl_ajax_enable', 'no');

				update_option('yith_wcwl_after_add_to_wishlist_behaviour', 'view');
				update_option('yith_wcwl_show_on_loop', 'yes');
				update_option('yith_wcwl_loop_position', 'shortcode');
				update_option('yith_wcwl_button_position', 'shortcode');
				update_option('yith_wcwl_add_to_wishlist_text', __('Adicionar aos meus favoritos', 'storms'));
				update_option('yith_wcwl_product_added_text', __('Produto adicionado!', 'storms'));
				update_option('yith_wcwl_browse_wishlist_text', __('Ver favoritos', 'storms'));
				update_option('yith_wcwl_already_in_wishlist_text', __('Este produto já é favorito!', 'storms'));
				update_option('yith_wcwl_add_to_wishlist_style', 'link');
				update_option('yith_wcwl_add_to_wishlist_icon', 'fa-heart-o');
				update_option('yith_wcwl_added_to_wishlist_icon', 'fa-heart');

				update_option('yith_wcwl_variation_show', 'yes');
				update_option('yith_wcwl_price_show', 'yes');
				update_option('yith_wcwl_stock_show', 'yes');
				update_option('yith_wcwl_show_dateadded', 'yes');
				update_option('yith_wcwl_add_to_cart_show', 'yes');
				update_option('yith_wcwl_show_remove', 'yes');
				update_option('yith_wcwl_repeat_remove_button', 'no');

				update_option('yith_wcwl_redirect_cart', 'no');
				update_option('yith_wcwl_remove_after_add_to_cart', 'yes');
				update_option('yith_wcwl_enable_share', 'yes');

				update_option('yith_wcwl_share_fb', 'yes');
				update_option('yith_wcwl_share_twitter', 'yes');
				update_option('yith_wcwl_share_pinterest', 'yes');
				update_option('yith_wcwl_share_email', 'no');
				update_option('yith_wcwl_share_whatsapp', 'yes');
				update_option('yith_wcwl_share_url', 'no');

				update_option('yith_wcwl_socials_title', __('Meu produtos favoritos em ' . get_bloginfo('name'), 'storms'));
				update_option('yith_wcwl_wishlist_title', __('Meu produtos favoritos em ' . get_bloginfo('name'), 'storms'));
				update_option('yith_wcwl_add_to_cart_text', __('Adicionar ao carrinho', 'storms'));

				update_option('yith_wcwl_add_to_cart_style', 'link');
			}
			add_action( 'admin_init', 'storms_define_wishlist_options' );

		}

		function storms_wc_yith_wishlist_remove_default_scripts() {

			// Remove all YITH Wishlist scripts
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'jquery-yith-wcwl-user' );
			//wp_dequeue_script( 'jquery-selectBox' ); // 'jquery-yith-wcwl' depends on 'jquery-selectBox'
			//wp_dequeue_script( 'jquery-yith-wcwl' ); // This script is responsible for add to wishlist using ajax


			// Remove jquery-selectBox as dependency for jquery-yith-wcwl
			$YITH_WCWL_Frontend = YITH_WCWL_Frontend::get_instance();
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			$prefix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'unminified/' : '';

			wp_deregister_script( 'jquery-selectBox' );
			wp_deregister_script( 'jquery-yith-wcwl' );

			wp_register_script( 'jquery-yith-wcwl', YITH_WCWL_URL . 'assets/js/' . $prefix . 'jquery.yith-wcwl' . $suffix . '.js', array( 'jquery' ), $YITH_WCWL_Frontend->version, true );
			wp_localize_script( 'jquery-yith-wcwl', 'yith_wcwl_l10n', $YITH_WCWL_Frontend->get_localize() );

			// Remove all YITH Wishlist styles
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_style( 'jquery-selectBox' );
			wp_dequeue_style( 'yith-wcwl-font-awesome' );
			wp_dequeue_style( 'yith-wcwl-main' );
			wp_dequeue_style( 'yith-wcwl-theme' );
		}

		add_action( 'wp_enqueue_scripts', 'storms_wc_yith_wishlist_remove_default_scripts', 100 );

		// Incluindo os scripts de manipulaçao do YITH Wishlist
		function storms_wc_yith_wishlist_scripts() {

			// Remove all YITH Wishlist scripts
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'jquery-selectBox' );
			wp_dequeue_script( 'jquery-yith-wcwl-user' );
			//wp_dequeue_script( 'jquery-yith-wcwl' ); // This script is responsible for add to wishlist using ajax

			// Remove all YITH Wishlist styles
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_style( 'jquery-selectBox' );
			wp_dequeue_style( 'yith-wcwl-font-awesome' );
			wp_dequeue_style( 'yith-wcwl-main' );
			wp_dequeue_style( 'yith-wcwl-theme' );

			wp_enqueue_script('storms-wc-yith-wishlist-script',
				\StormsFramework\Helper::get_asset_url( '/js/storms-wc-yith-wishlist' . ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min' ) . '.js' ),
				array( 'jquery' ), STORMS_FRAMEWORK_VERSION, true );

			// Add WordPress data to a Javascript file
			wp_localize_script( 'storms-wc-yith-wishlist-script', 'storms_wc_yith_wishlist_vars', [
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'wc_ajax_url' => WC_AJAX::get_endpoint( "%%endpoint%%" ),
				'debug_mode' => defined( 'WP_DEBUG' ) && WP_DEBUG,
			] );
		}

		add_action( 'wp_enqueue_scripts', 'storms_wc_yith_wishlist_scripts' );

		function storms_wc_wishlist_link() {
			echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
		}
		add_action( 'woocommerce_after_add_to_cart_button', 'storms_wc_wishlist_link' );
		add_action( 'storms_wc_after_add_to_cart_btn', 'storms_wc_wishlist_link' );

		function storms_wc_yith_wcwl_ajax_update_count() {
			wp_send_json( array(
				'count' => yith_wcwl_count_all_products()
			) );
		}
		add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'storms_wc_yith_wcwl_ajax_update_count' );
		add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'storms_wc_yith_wcwl_ajax_update_count' );

		function storms_wc_yith_wcwl_wishlist_shortcode( $atts ) {

			$atts = shortcode_atts( array(
				'extra_classes' => '',
			), $atts );

			$wishlist  = '<div class="storms-wishlist ' . $atts['extra_classes'] . '">';
			$wishlist .= '	<a href="' . esc_url( YITH_WCWL()->get_wishlist_url() ) . '">';
			$wishlist .= '		<i class="fa st-ic-heart-o" aria-hidden="true"></i>';
			$wishlist .= '		<span class="wishlist-counter">' . yith_wcwl_count_all_products() .'</span>';
			$wishlist .= '		<span class="wishlist-text">Minha Lista</span>';
			$wishlist .= '	</a>';
			$wishlist .= '</div>';

			return $wishlist;
		}
		add_shortcode( 'storms_wc_wishlist', 'storms_wc_yith_wcwl_wishlist_shortcode' );

		/**
		 * Wishlist for WooCommerce
		 *
		 * Class Storms_WC_Wishlist
		 */
		class Storms_WC_Wishlist extends WC_Widget {

			function __construct() {
				$this->widget_cssclass    = 'Storms_WC_Wishlist storms_wc_wishlist storms-wc-wishlist';
				$this->widget_id          = 'storms_wc_wishlist';
				$this->widget_name        = __( 'Storms WC Wishlist', 'storms' );
				$this->widget_description = __( 'Shows a button to access WC Wishlist', 'storms' );

				$this->settings = array(
					'extra_classes' => array(
						'type'  => 'text',
						'std'   => '',
						'label' => __( 'Extra class', 'storms' ),
					),
				);

				parent::__construct();
			}

			public function widget( $args, $instance ) {

				$atts = array(
					'extra_classes' => esc_attr( $instance['extra_classes'] ?? '' ),
				);

				$this->widget_start( $args, $instance );

				echo storms_wc_yith_wcwl_wishlist_shortcode( $atts );

				$this->widget_end( $args );
			}

		}

		function storms_wc_yith_wcwl_wishlist_register_widget() {
			register_widget( 'storms_wc_wishlist' );
		}
		add_action( 'widgets_init', 'storms_wc_yith_wcwl_wishlist_register_widget' );

	}

}
