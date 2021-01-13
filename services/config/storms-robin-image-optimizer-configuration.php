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
 * Storms Robin Image Optimizer Configuration file
 * General customizations for Robin Image Optimizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_plugin_activated( 'robin-image-optimizer/robin-image-optimizer.php' ) ) {

	if( ! function_exists( 'storms_define_robin_image_optimizer_options' ) ) {

		function storms_define_robin_image_optimizer_options() {

			// Only setup if user is an admin
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			update_option( 'wbcr_io_image_optimization_server', 'server_1' );
			update_option( 'wbcr_io_backup_origin_images', '1' );
			update_option( 'wbcr_io_save_exif_data', '0' );
			update_option( 'wbcr_io_image_optimize_all_usage', '0' );
			update_option( 'wbcr_io_image_optimization_level', 'normal' );
			update_option( 'wbcr_io_image_optimization_level_custom', '70' );
			update_option( 'wbcr_io_auto_optimize_when_upload', '1' );
			update_option( 'wbcr_io_convert_webp_format', '0' );
			update_option( 'wbcr_io_use_lazy_load', '0' );
			update_option( 'wbcr_io_image_optimization_order', 'asc' );
			update_option( 'wbcr_io_resize_larger', '1' );
			update_option( 'wbcr_io_resize_larger_w', '1600' );
			update_option( 'wbcr_io_resize_larger_h', '1600' );
			update_option( 'wbcr_io_allowed_formats', 'image/jpeg,image/png,image/gif' );
			update_option( 'wbcr_io_allowed_sizes_thumbnail', implode( ',', array_keys( \StormsFramework\Helper::get_image_sizes() ) ) );
			update_option( 'wbcr_io_image_autooptimize_shedule_time', 'wio_5_min' );
			update_option( 'wbcr_io_image_autooptimize_items_number_per_interation', '5' );
		}
		add_action( 'admin_init', 'storms_define_robin_image_optimizer_options' );

	}

}
