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
 * Theme Customization Options file
 * Here we load all the theme customization options
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! function_exists( 'storms_additional_customizer_settings' ) ) {

	/**
	 * Add a new section to WP Customization page, adding a field for the menu image/logo
	 * @see https://codex.wordpress.org/Theme_Customization_API
	 * @see https://developer.wordpress.org/reference/classes/wp_customize_media_control/
	 * @param \WP_Customize_Manager $wp_customize
	 */
	function storms_additional_customizer_settings( $wp_customize ) {
		$wp_customize->add_section( 'storms_menu_image_section' , array(
			'title'      => __( 'Menu Bar Image', 'storms' ),
			'priority'   => 70,
		) );

		$wp_customize->add_setting( 'storms_menu_image', array(
			'type' 				=> 'theme_mod',
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control( new \WP_Customize_Media_Control(
			$wp_customize,
			'storms_menu_image_ctrl',
			array(
				'priority'    => 10,
				'mime_type'   => 'image',
				'settings'    => 'storms_menu_image',
				'label'       => __( 'Image on menu bar', 'storms' ),
				'description' => __( 'Configure the image or icon displyed on the menu bar', 'storms' ),
				'section'     => 'storms_menu_image_section',
			)
		) );

	}
	add_action( 'customize_register', 'storms_additional_customizer_settings' );

}
