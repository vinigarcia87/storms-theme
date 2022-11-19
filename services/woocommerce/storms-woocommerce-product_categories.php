<?php
/**
 * Storms Websolutions (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2019, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   4.0.0
 *
 * WC_SearchBar
 * This code creates the shop searchbar as a widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * List all (or limited) product categories.
 *
 * @param array $atts Attributes.
 * @return string
 */
function storms_wc_product_categories( $atts ) {
	if ( isset( $atts['number'] ) ) {
		$atts['limit'] = $atts['number'];
	}

	$atts = shortcode_atts(
		array(
			'limit'      => '-1',
			'orderby'    => 'name',
			'order'      => 'ASC',
			'columns'    => '4',
			'hide_empty' => 1,
			'parent'     => '',
			'ids'        => '',
			'show_count' => 1,
		),
		$atts,
		'storms_wc_product_categories'
	);

	$ids        = array_filter( array_map( 'trim', explode( ',', $atts['ids'] ) ) );
	$hide_empty = ( true === $atts['hide_empty'] || 'true' === $atts['hide_empty'] || 1 === $atts['hide_empty'] || '1' === $atts['hide_empty'] ) ? 1 : 0;
	$show_count = ( true === $atts['show_count'] || 'true' === $atts['show_count'] || 1 === $atts['show_count'] || '1' === $atts['show_count'] ) ? 1 : 0;

	// Get terms and workaround WP bug with parents/pad counts.
	$args = array(
		'orderby'    => $atts['orderby'],
		'order'      => $atts['order'],
		'hide_empty' => $hide_empty,
		'include'    => $ids,
		'pad_counts' => true,
		'child_of'   => $atts['parent'],
	);

	$product_categories = apply_filters(
		'woocommerce_product_categories',
		get_terms( 'product_cat', $args )
	);

	if ( '' !== $atts['parent'] ) {
		$product_categories = wp_list_filter(
			$product_categories,
			array(
				'parent' => $atts['parent'],
			)
		);
	}

	if ( $hide_empty ) {
		foreach ( $product_categories as $key => $category ) {
			if ( 0 === $category->count ) {
				unset( $product_categories[ $key ] );
			}
		}
	}

	$atts['limit'] = '-1' === $atts['limit'] ? null : intval( $atts['limit'] );
	if ( $atts['limit'] ) {
		$product_categories = array_slice( $product_categories, 0, $atts['limit'] );
	}

	if( ! $show_count ) {
		add_filter( 'woocommerce_subcategory_count_html', '__return_empty_string' );
	}

	$columns = absint( $atts['columns'] );

	wc_set_loop_prop( 'name', 'product_categories' );
	wc_set_loop_prop( 'columns', $columns );
	wc_set_loop_prop( 'is_shortcode', true );

	ob_start();

	if ( $product_categories ) {
		woocommerce_product_loop_start();

		foreach ( $product_categories as $category ) {
			wc_get_template(
				'content-product_cat.php',
				array(
					'category' => $category,
				)
			);
		}

		woocommerce_product_loop_end();
	}

	wc_reset_loop();

	return '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';
}
add_shortcode( 'storms_wc_product_categories', 'storms_wc_product_categories' );
