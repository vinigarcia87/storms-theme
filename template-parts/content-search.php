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

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>


		<div class="entry-meta">

			<?php \StormsFramework\Helper::posted_on(); ?>

			<?php \StormsFramework\Helper::posted_by(); ?>
		</div><!-- .entry-meta -->

	</header>

	<?php \StormsFramework\Helper::post_thumbnail(); ?>

	<div class="entry-summary">

		<?php the_excerpt(); ?>

	</div><!-- .entry-summary -->

	<footer class="entry-footer">

		<?php \StormsFramework\Helper::entry_footer(); ?>

	</footer>

</article><!-- #post-<?php the_ID(); ?> -->
