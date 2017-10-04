<?php
/**
 * Storms Framework (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2016, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   3.0.0
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

use \StormsFramework\Storms\Front\Layout,
    \StormsFramework\Storms\Bootstrap\Functions,
    \StormsFramework\Storms\Bootstrap\Breadcrumb,
    \StormsFramework\Storms\Bootstrap\Pagination;
    
get_header(); ?>

    <div class="row">

        <!-- Website content -->
        <main id="content" class="main <?php echo Layout::main_layout(); ?>" role="main">

            <!-- Breadcrumbs -->
            <?php //echo Breadcrumb::breadcrumb(); ?>

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

                the_posts_navigation(); // @TODO Verificar no Helper so SF, se nao ha uma solucao para isso

                // Posts navigation
                //echo Pagination::loop_pagination( array( 'type' => 'list', 'before' => '', 'after' => '', ) );

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif; ?>

        </main><!-- /.main -->

        <!-- Sidebar -->
        <?php get_sidebar(); ?>

    </div>
<?php
get_footer();
