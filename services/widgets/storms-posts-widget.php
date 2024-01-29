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
 * storms-posts-widget.php
 * {{ Why this file is here? }}
 */

function storms_posts_widget( $atts ) {

	$atts = shortcode_atts( array( 'extra_classes' => '' ), $atts );

	ob_start(); ?>
	<?php

	// Show only sticky posts
	$args = array(
		'post__in' => get_option( 'sticky_posts' )
	);

	// Don’t show sticky posts
	$args  = array( 'post__not_in' => get_option( 'sticky_posts' ) );

	$args = array( 'posts_per_page' => 1, 'offset' => 0, 'order' => 'DESC', 'orderby' => 'date', 'post__in' => get_option( 'sticky_posts' ) );

	$query = new WP_Query( $args );
	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) : $query->the_post();
			?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
				<h2>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>

				<!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->
				<small><?php the_time('F jS, Y'); ?> by <?php the_author_posts_link(); ?></small>

				<div class="entry">
					<?php the_content(); ?>
				</div>

				<p class="postmetadata"><?php _e( 'Posted in' ); ?> <?php the_category( ', ' ); ?></p>
			</div>

		<?php endwhile;
		wp_reset_postdata(); // reset the query

	else : ?>

		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>

	<?php endif;

	return ob_get_clean();
}

add_shortcode( 'storms_posts_widget', 'storms_posts_widget' );
