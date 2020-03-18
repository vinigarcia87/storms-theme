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
 * Single Template
 * The template for displaying all single posts
 */

use \StormsFramework\Template;

defined( 'ABSPATH' ) || exit;

get_header(); ?>

	<div class="st-grid-row row">

		<!-- Website content -->
		<main id="content" class="main <?php echo Template::main_layout(); ?>" role="main">

			<?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile; // End of the loop.

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</main><!-- /.main -->

		<!-- Sidebar -->
		<?php get_sidebar(); ?>

	</div>

<?php
get_footer();
