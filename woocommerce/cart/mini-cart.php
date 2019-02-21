<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

    <ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
        <?php
        do_action( 'woocommerce_before_mini_cart_contents' );

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                ?>
                <li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3 product-image">
                                <?php if ( ! $_product->is_visible() ) : ?>
                                    <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
                                <?php else : ?>
                                    <a href="<?php echo esc_url( $product_permalink ); ?>">
                                        <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-7 product-description">
                                <?php if ( ! $_product->is_visible() ) : ?>
                                    <?php echo $product_name; ?>
                                <?php else : ?>
                                    <a href="<?php echo esc_url( $product_permalink ); ?>">
                                        <?php echo $product_name; ?>
                                    </a>
                                <?php endif; ?>
                                <?php echo wc_get_formatted_cart_item_data( $cart_item, false ); ?>
                                <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
                            </div>
                            <div class="col-md-2 product-actions">
                                <?php
                                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                    '<a href="%s" class="remove storms_remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="fa fa-times" aria-hidden="true"></i></a>',
                                    esc_url(  wc_get_cart_remove_url( $cart_item_key ) ),
                                    __( 'Remove this item', 'woocommerce' ),
                                    esc_attr( $product_id ),
                                    esc_attr( $cart_item_key ),
                                    esc_attr( $_product->get_sku() )
                                ), $cart_item_key );
                                ?>
                            </div>
                        </div>
                    </div>
                </li>
                <?php
            }
        }

        do_action( 'woocommerce_mini_cart_contents' );
        ?>
    </ul>

    <div class="cart-footer container-fluid">
        <div class="woocommerce-mini-cart__total total row">
            <div class="col-md-6 total-title">
                <strong><?php _e( 'Subtotal', 'woocommerce' ); ?>:</strong>
            </div>
            <div class="col-md-6 total-value">
                <?php echo WC()->cart->get_cart_subtotal(); ?>
            </div>
        </div>

        <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

        <div class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></div>
    </div>

<?php else : ?>

    <p class="woocommerce-mini-cart__empty-message cart-empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>