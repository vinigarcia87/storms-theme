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
 * Wordpress Configuration file
 * Here we setup the configurations for Wordpress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! function_exists( 'storms_define_wordpress_options' ) ) {

    // Define WordPress options
    function storms_define_wordpress_options() {

		// Comments configuration
		update_option('default_pingback_flag', 'no');
		update_option('default_ping_status', 'no');
		update_option('default_comment_status', 'no');
		update_option('comment_registration', 'no');
		update_option('page_comments', '1');
		update_option('comments_per_page', 5);
    }
    add_action( 'admin_init', 'storms_define_wordpress_options' );

}

