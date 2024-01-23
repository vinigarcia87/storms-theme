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

	<?php \StormsFramework\Helper::post_thumbnail(); ?>

	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</header>

	<?php if ( 'post' == get_post_type() ) : ?>

		<div class="entry-meta">

			<?php \StormsFramework\Helper::posted_on(); ?>

			<?php \StormsFramework\Helper::posted_by(); ?>

		</div><!-- .entry-meta -->

	<?php endif; ?>

	<div class="entry-excerpt">
		<?php the_excerpt(); ?>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
