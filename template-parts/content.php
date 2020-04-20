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
 * Content Template
 * The template part for displaying a content of a post
 */

defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_singular() ) :
				if ( ! is_home() && is_front_page() ) :
					the_title( '<h1 class="entry-title sr-only">', '</h1>' );
				else :
					the_title( '<h1 class="entry-title">', '</h1>' );
				endif;
			else :
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>

		<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta">

				<?php \StormsFramework\Helper::posted_on(); ?>

			</div><!-- .entry-meta -->

		<?php endif; ?>
	</header>

	<?php if ( is_search() ) : ?>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	<?php else : ?>

		<div class="entry-content">
			<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'storms' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'storms' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
			?>
		</div><!-- .entry-content -->

	<?php endif; ?>

	<footer class="entry-footer">

		<?php \StormsFramework\Helper::entry_footer(); ?>

	</footer>

</article><!-- #post-<?php the_ID(); ?> -->
