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
 * Assets file
 * Here we load all the theme assets
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register widgets area
 * Header Sidebar widget area
 */
function storms_register_widgets_area_header() {

	// Define what title tag will be use on widgets - h1, h2, h3, ...
	$widget_title_tag = \StormsFramework\Helper::get_option( 'storms_widget_title_tag', 'span' );

	// Header Sidebar
	if( \StormsFramework\Helper::get_option( 'storms_add_header_sidebar', 'yes' ) ) {

		register_sidebar(array(
			'name' => __( 'Header Sidebar', 'storms' ),
			'id' => 'header-sidebar',
			'description' => __( 'Add widgets here to appear in your header region.', 'storms' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<' . $widget_title_tag . ' class="widgettitle widget-title">',
			'after_title' => '</' . $widget_title_tag . '>',
		));

	}

	if( \StormsFramework\Helper::get_option( 'storms_add_header_menu_item_sidebar', 'yes' ) ) {

		/**
		 * Register a new widget area on the menu as a menu item
		 * @source https://wordpress.org/support/topic/insert-a-plugin-or-a-widget-in-the-top-menu/
		 */
		register_sidebar(array(
			'name' => __( 'Header Menu Item Sidebar', 'storms' ),
			'id' => 'header-menu-item-sidebar',
			'description' => __('Add widgets here to appear in your menu item region.', 'storms'),
			'before_widget' => '<li id="%1$s" class="widget %2$s menu-item nav-item dropdown has-megamenu">',
			'after_widget' => '</li>',
			'before_title' => '<' . $widget_title_tag . ' class="widgettitle widget-title">',
			'after_title' => '</' . $widget_title_tag . '>',
		));

	}

	// Header Menu Right Sidebar
	if( \StormsFramework\Helper::get_option( 'storms_add_header_menu_right_sidebar', 'yes' ) ) {

		register_sidebar(array(
			'name' => __( 'Header Menu Right Sidebar', 'storms' ),
			'id' => 'header-menu-sidebar-right',
			'description' => __( 'Add widgets here to appear in your header region.', 'storms' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<' . $widget_title_tag . ' class="widgettitle widget-title">',
			'after_title' => '</' . $widget_title_tag . '>',
		));

	}

	// Header Bottom Sidebar
	if( \StormsFramework\Helper::get_option( 'storms_add_header_bottom_sidebar', 'yes' ) ) {

		register_sidebar(array(
			'name' => __( 'Header Bottom Sidebar', 'storms' ),
			'id' => 'header-bottom-sidebar',
			'description' => __( 'Add widgets here to appear in your header region.', 'storms' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<' . $widget_title_tag . ' class="widgettitle widget-title">',
			'after_title' => '</' . $widget_title_tag . '>',
		));

	}

}

/**
 * Add a sidebar on menu to act as a menu item
 * Allows to choose which menus will have the sidebar - defaults to 'all' menus
 *
 * @param $items
 * @param $args
 * @return string
 */
function storms_add_widget_area_on_menu_item( $items, $args ) {
	if( \StormsFramework\Helper::get_option( 'storms_add_header_menu_item_sidebar', 'yes' ) ) {
		$menu_slug = ( $args && $args->menu ) ? $args->menu->slug : '';
		$menu_list = \StormsFramework\Helper::get_option( 'storms_header_menu_item_sidebar_menu_slug_list', 'all' );

		if( empty( $menu_slug ) || 'all' === $menu_list || in_array( $menu_slug, explode( ',', $menu_list ) ) ) {
			$menu_widget_area = \StormsFramework\Helper::get_dynamic_sidebar( 'header-menu-item-sidebar' );
			return $menu_widget_area . $items;
		}

	}
	return $items;
}

/**
 * Register widgets area
 * Main Sidebar widget area
 */
function storms_register_widgets_area_main() {

	// Define what title tag will be use on widgets - h1, h2, h3, ...
	$widget_title_tag = \StormsFramework\Helper::get_option( 'storms_widget_title_tag', 'span' );

	// Main Sidebar
	if( \StormsFramework\Helper::get_option( 'storms_add_main_sidebar', 'yes' ) ) {

		register_sidebar(array(
			'name' => __( 'Main Sidebar', 'storms' ),
			'id' => 'main-sidebar',
			'description' => __( 'Add widgets here to appear in your sidebar.', 'storms' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<' . $widget_title_tag . ' class="widgettitle widget-title">',
			'after_title' => '</' . $widget_title_tag . '>',
		));

	}

}

/**
 * Register widgets area
 * Footer 1 Sidebar widget area
 */
function storms_register_widgets_area_footer_1() {

	// Define what title tag will be use on widgets - h1, h2, h3, ...
	$widget_title_tag = \StormsFramework\Helper::get_option( 'storms_widget_title_tag', 'span' );

	register_sidebar(array(
			'name' => __('Footer 1 Sidebar Top', 'storms'),
			'id' => 'footer-1-sidebar-top',
			'description' => __('Add widgets here to appear in your footer 1 top side.', 'storms'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<' . $widget_title_tag . ' class="widgettitle widget-title">',
			'after_title' => '</' . $widget_title_tag . '>',
		)
	);
	register_sidebar(array(
			'name' => __('Footer 1 Sidebar Left', 'storms'),
			'id' => 'footer-1-sidebar-left',
			'description' => __('Add widgets here to appear in your footer 1 left side.', 'storms'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<' . $widget_title_tag . ' class="widgettitle widget-title">',
			'after_title' => '</' . $widget_title_tag . '>',
		)
	);
	register_sidebar(array(
			'name' => __('Footer 1 Sidebar Middle 1', 'storms'),
			'id' => 'footer-1-sidebar-middle-1',
			'description' => __('Add widgets here to appear in your footer 1 middle 1 side.', 'storms'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<' . $widget_title_tag . ' class="widget-title">',
			'after_title' => '</' . $widget_title_tag . '>',
		)
	);
	register_sidebar(array(
			'name' => __('Footer 1 Sidebar Middle 2', 'storms'),
			'id' => 'footer-1-sidebar-middle-2',
			'description' => __('Add widgets here to appear in your footer 1 middle 2 side.', 'storms'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<' . $widget_title_tag . ' class="widget-title">',
			'after_title' => '</' . $widget_title_tag . '>',
		)
	);
	register_sidebar(array(
			'name' => __('Footer 1 Sidebar Right', 'storms'),
			'id' => 'footer-1-sidebar-right',
			'description' => __('Add widgets here to appear in your footer 1 right side.', 'storms'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<' . $widget_title_tag . ' class="widget-title">',
			'after_title' => '</' . $widget_title_tag . '>',
		)
	);
	register_sidebar(array(
			'name' => __('Footer 1 Sidebar Bottom', 'storms'),
			'id' => 'footer-1-sidebar-bottom',
			'description' => __('Add widgets here to appear in your footer 1 bottom side.', 'storms'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<' . $widget_title_tag . ' class="widget-title">',
			'after_title' => '</' . $widget_title_tag . '>',
		)
	);
}

/**
 * Register widgets area
 * Footer 2 Sidebar widget area
 */
function storms_register_widgets_area_footer_2() {

	// Define what title tag will be use on widgets - h1, h2, h3, ...
	$widget_title_tag = \StormsFramework\Helper::get_option( 'storms_widget_title_tag', 'span' );

	// Footer Sidebars
	if( \StormsFramework\Helper::get_option( 'storms_add_footer_sidebar', 'yes' ) ) {

		$numFooterSidebars = \StormsFramework\Helper::get_option( 'storms_number_of_footer_sidebars', 4 );
		for ($i = 1; $i <= intval($numFooterSidebars); $i++) {
			register_sidebar(array(
					'name' => sprintf( __( 'Footer Sidebar %d', 'storms' ), $i ),
					'id' => sprintf( 'footer-sidebar-%d', $i ),
					'description' => sprintf( __( 'Add widgets here to appear in your footer region %d.', 'storms' ), $i ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<' . $widget_title_tag . ' class="widgettitle widget-title">',
					'after_title' => '</' . $widget_title_tag . '>',
				)
			);
		}

	}
}
add_action( 'widgets_init', 'storms_register_widgets_area_header', 1 );
add_action( 'widgets_init', 'storms_register_widgets_area_main', 10 );
add_action( 'widgets_init', 'storms_register_widgets_area_footer_1', 15 );
add_action( 'widgets_init', 'storms_register_widgets_area_footer_2', 20 );
add_filter( 'wp_nav_menu_items', 'storms_add_widget_area_on_menu_item', 10, 2 );
