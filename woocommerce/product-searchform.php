<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form id="searchform" role="search" class="woocommerce-product-search form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">

	<div class="input-group">
		<label for="s" class="sr-only"><?php echo __( 'Search' ); ?></label>
		<input  id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"
				type="search" class="search-field form-control" name="s" placeholder="<?php esc_attr_e( 'Search products', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" />

		<input type="hidden" name="post_type" value="product" />

		<button class="btn" type="submit"><span class="fa fa-search" aria-hidden="true"></span></button>
	</div>

</form>
