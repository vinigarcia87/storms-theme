<?php
/**
 * Storms Websolutions (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2020, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   1.0.0
 *
 * Storms Slide Anything file
 * Here we make all custom changes this theme needs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_plugin_activated( 'slide-anything/slide-anything.php' ) ) {

	/**
	 * Wrap the slide-anything shortcode in a cached function
	 * so it will not be regenerated everytime the slide is accessed
	 *
	 * @param $atts
	 * @return bool|mixed|string|string[]|null
	 */
	function storms_slide_anything_shortcode_cached( $atts ) {
		if( ! isset( $atts['id'] ) ) {
			return false;
		}

		/**
		 * Print the return of the slide_anything_shortcode function
		 * @param $atts
		 */
		if( ! function_exists( 'storms_execute_slide_anything_shortcode' ) ) {
			function storms_execute_slide_anything_shortcode( $atts ) {
				echo slide_anything_shortcode( $atts );
			}
		}

		// We queue again the necessary JS and CSS scripts, cause when we get the shortcode from cache they will not be enqueued
		if( \StormsFramework\Helper::is_fragment_cache( "slide_anything_cached_{$atts['id']}" ) ) {
			wp_enqueue_script('jquery');
			wp_register_script('owl_carousel_js', SA_PLUGIN_PATH.'owl-carousel/owl.carousel.min.js', array('jquery'), '2.2.1', true);
			wp_enqueue_script('owl_carousel_js');
			wp_register_style('owl_carousel_css', SA_PLUGIN_PATH.'owl-carousel/owl.carousel.css', array(), '2.2.1.1', 'all');
			wp_enqueue_style('owl_carousel_css');
			wp_register_style('owl_theme_css', SA_PLUGIN_PATH.'owl-carousel/sa-owl-theme.css', array(), '2.0', 'all');
			wp_enqueue_style('owl_theme_css');
			wp_register_style('owl_animate_css', SA_PLUGIN_PATH.'owl-carousel/animate.min.css', array(), '2.0', 'all');
			wp_enqueue_style('owl_animate_css');
		}

		return \StormsFramework\Helper::get_fragment_cache( "slide_anything_cached_{$atts['id']}", 'storms_execute_slide_anything_shortcode', [ $atts ] );
	}
	add_shortcode( 'slide-anything-cached', 'storms_slide_anything_shortcode_cached' );

	/**
	 * When a slider is changed, we clean the cached fragments so the slider can be recreated
	 *
	 * @param int $post_ID
	 * @param WP_Post $post
	 * @param bool $update
	 */
	function storms_save_sa_slider_cache_cleanner( int $post_ID, WP_Post $post, bool $update ) {
		\StormsFramework\Helper::remove_fragment_cache( "slide_anything_cached_{$post_ID}" );
	}
	add_action( 'save_post_sa_slider', 'storms_save_sa_slider_cache_cleanner', 10, 3 );

}
