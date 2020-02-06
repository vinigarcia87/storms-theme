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
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

use \StormsFramework\Template;

get_header(); ?>

    <div class="st-grid-row row">

        <!-- Website content -->
        <main id="content" class="main <?php echo Template::main_layout(); ?>" role="main">

            <?php

            if ( have_posts() ) :

                if ( is_home() && ! is_front_page() ) : ?>

                    <header>
                        <h1 class="page-title sr-only"><?php single_post_title(); ?></h1>
                    </header>

                <?php
                endif;

                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part( 'template-parts/content', get_post_format() );

                endwhile;

                the_posts_navigation();

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif; ?>

        </main><!-- /.main -->

        <!-- Sidebar -->
        <?php get_sidebar(); ?>

    </div>
<?php
get_footer();
