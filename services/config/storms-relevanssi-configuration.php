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
 * Storms relevanssi Configuration file
 * General customizations for Relevanssi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_plugin_activated( 'relevanssi/relevanssi.php' ) ) {

	if( ! function_exists( 'storms_define_relevanssi_options' ) ) {

		// Define Relevanssi options
		function storms_define_relevanssi_options() {

			// Only setup if user is an admin
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			update_option( 'relevanssi_index_post_types', array( 'product', 'product_variation', /* 'post', 'page' */ ) );
			update_option( 'relevanssi_index_taxonomies_list', array( 'product_cat', 'product_tag' ) );
			update_option( 'relevanssi_index_fields', '_sku, _product_attributes' );
			update_option( 'relevanssi_index_author', 'off' );
			update_option( 'relevanssi_index_excerpt', 'on' );
			update_option( 'relevanssi_punctuation', array( 'quotes' => 'replace', 'hyphens' => 'replace', 'ampersands' => 'replace', 'decimals' => 'remove', ) );
			update_option( 'relevanssi_post_type_weights', array( 'post_tag' => 1, 'category' => 1, ) );
			update_option( 'relevanssi_log_queries', 'on' );
			update_option( 'relevanssi_log_queries_with_ip', 'on' );
			update_option( 'relevanssi_trim_logs', 90 );
			update_option( 'relevanssi_excerpts', 'off' );
			update_option( 'relevanssi_expand_shortcodes', 'off' );
			update_option( 'relevanssi_log_queries_with_ip', 'off' );
		}
		add_action( 'admin_init', 'storms_define_relevanssi_options' );

	}

}
