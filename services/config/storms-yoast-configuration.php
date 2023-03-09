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
 * Theme Setup file
 * Here we setup all configurations for the theme
 */

use StormsFramework\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_plugin_activated( 'wordpress-seo/wp-seo.php' ) ) {

	/**
	 * Filter the output of Yoast breadcrumbs so each item is an <li> with schema markup
	 * @see https://gist.github.com/doubleedesign/7224a5e990b8506ddb8ec66de8348b2b
	 *
	 * @param $link_output
	 * @param $link
	 * @return string
	 */
	function storms_filter_yoast_breadcrumb_items( $link_output, $link ) {

		$link_text = $link['text'];
		if( array_key_exists('id', $link) ) {
			$page = get_post( $link['id'] );
			if( $page ) {
				$link_text = $page->post_title;
			}
		}

		$new_link_output = '<li class="breadcrumb-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
		if( ! str_contains( $link_output, 'breadcrumb_last' ) ) {
			$new_link_output .= '<a href="' . $link['url'] . '" itemprop="url">' . $link_text . '</a>';
		} else {
			$new_link_output .= $link['text'];
		}
		$new_link_output .= '</li>';

		return $new_link_output;
	}
	add_filter( 'wpseo_breadcrumb_single_link', 'storms_filter_yoast_breadcrumb_items', 10, 2 );

	/**
	 * Filter the output of Yoast breadcrumbs to remove <span> tags added by the plugin
	 * @see https://gist.github.com/doubleedesign/7224a5e990b8506ddb8ec66de8348b2b
	 *
	 * @param $output
	 * @return mixed
	 */
	function storms_filter_yoast_breadcrumb_output( $output ) {

		$from = '<span>';
		$to = '</span>';
		$output = str_replace( $from, $to, $output );

		return $output;
	}
	add_filter( 'wpseo_breadcrumb_output', 'storms_filter_yoast_breadcrumb_output' );

	/**
	 * Shortcut function to output Yoast breadcrumbs
	 * wrapped in the appropriate markup
	 */
	function storms_yoast_breadcrumbs() {
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb( storms_yoast_breadcrumb_start_tag(), storms_yoast_breadcrumb_end_tag() );
		}
	}

	function storms_yoast_breadcrumb_start_tag() {
		return '<div class="' . esc_attr( Helper::get_option( 'storms_woo_breadcrumb_container_class' , '' ) ) . ' st-container-breadcrumb">
					<div class="st-grid-row row">
						<div class="col-12">
							<ol class="breadcrumb storms-breadcrumb" itemprop="breadcrumb">';
	}

	function storms_yoast_breadcrumb_end_tag() {
		return '			</ol>
						</div>
					</div>
				</div>';
	}

	// yoast breadcrumb page separator
	function storms_filter_wpseo_breadcrumb_separator( $this_options_breadcrumbs_sep ) {
		return '';
	};
	add_filter( 'wpseo_breadcrumb_separator', 'storms_filter_wpseo_breadcrumb_separator' );

}
