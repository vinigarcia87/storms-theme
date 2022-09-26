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
 * Theme Activation file
 * Here we create all basic info that the website needs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function storms_create_main_page() {

	$page_slug = 'principal';
	$new_page = array(
		'post_type'     => 'page',
		'post_title'    => 'Principal',
		'post_content'  => '',
		'post_status'   => 'publish',
		'post_author'   => 1,
		'post_name'     => $page_slug
	);

	if ( ! get_page_by_path( $page_slug, OBJECT, 'page' ) ) {
		$new_page_id = wp_insert_post( $new_page );
	}
}

function storms_delete_initial_wp_posts() {
	// Se a "Página de exemplo" nao existe, entao vamos considerar que os dados iniciais nao estao mais presentes
	if( ! get_page_by_path( __( 'sample-page' ) ) ) {
		return false;
	}

	$wc_pages_ids = \StormsFramework\Helper::get_woocommerce_pages_ids();

	// Removing pages
	foreach( get_all_page_ids() as $page_id ) {

		// Don't delete WooCommerce pages
		if( ! in_array( $page_id, $wc_pages_ids ) ) {

			// Removing comments
			if ( $comments = get_comments( array( 'post_id' => $page_id ) ) ) {
				foreach ( $comments as $comment ) {
					wp_delete_comment( $comment->comment_ID, true );
				}
			}

			wp_delete_post( $page_id, true );
		}
	}

	// Removing posts
	foreach( get_posts() as $post ) {

		// Removing comments
		if ( $comments = get_comments( array( 'post_id' => $post->ID ) ) ) {
			foreach ( $comments as $comment ) {
				wp_delete_comment( $comment->comment_ID, true );
			}
		}

		wp_delete_post( $post->ID, true );
	}

	// Removing sample sliders from Slide Anything
	$sa_sliders = get_posts( array( 'post_type' => 'sa_slider', 'numberposts' => -1 ) );
	foreach ( $sa_sliders as $post ) {
		wp_delete_post( $post->ID, true );
	}
}

function storms_delete_initial_wp_widgets() {

	$sidebars_widgets = get_option( 'sidebars_widgets' );
	foreach( $sidebars_widgets as $sidebar => $widgets ) {
		if( ! empty( $widgets ) && is_array( $widgets ) ) {
			foreach( $widgets as $widget_key => $widget ) {
				list( $widget_id, $widget_type ) = array_map( 'strrev', explode( '-', strrev( $widget ), 2 ) );

				$widget_config = get_option( 'widget_' . $widget_type );
				unset( $widget_config[$widget_id] );
				update_option( 'widget_' . $widget_type, $widget_config );

				unset( $sidebars_widgets[$sidebar][$widget_key] );
			}
		}
	}
	update_option( 'sidebars_widgets', $sidebars_widgets );
}

function storms_after_switch_theme() {

	if( empty( get_option( 'storms_activation', '' ) ) ) {

		// Remove initial WP data
		storms_delete_initial_wp_posts();

		// Add default pages for the theme
		storms_create_main_page();

		// Remove initial WP widgets
		storms_delete_initial_wp_widgets();

		update_option( 'storms_activation', date("Y-m-d H:i:s") );
	}
}
add_action( 'after_switch_theme', 'storms_after_switch_theme' );
