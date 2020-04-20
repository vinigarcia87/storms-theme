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
 * The header for our theme
 * This is the template that displays the head, menu and layout open tag
 * Includes all the scripts and page definitions
 */

use \StormsFramework\Template;

defined( 'ABSPATH' ) || exit;

get_template_part( 'template-parts/head' ); ?>

<header id="header" role="banner">

    <div class="<?php echo Template::header_container(); ?>">
        <!-- Header content -->
        <?php get_template_part('template-parts/header', 'content'); ?>
    </div>

	<!-- Page navigation -->
	<?php get_template_part('template-parts/menu'); ?>

</header>

<!-- Wrap all page content here -->
<div id="wrap" class="wrap" role="document">
    <div class="<?php echo Template::wrap_container(); ?>">

        <?php
        if ( is_front_page() && is_home() ) : ?>
            <div class="st-grid-row row">
                <div class="col-12">
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                </div>
            </div>
        <?php
        endif; ?>
