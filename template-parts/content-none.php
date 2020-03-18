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
 * Content None Template
 * Template part for displaying a message that posts cannot be found
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'storms' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'storms' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
			?></p>

		<?php elseif ( is_search() ) :

			/**
			* Hook: storms_before_search_empty_content.
			*
			* @hooked storms_{{ Shortcodes para produtos relacionados etc }} - 10
			*/
			do_action('storms_before_search_empty_content');
			?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'storms' ); ?></p>
			<?php
				\StormsFramework\Helper::get_search_form();


			/**
			 * Hook: storms_after_search_empty_content.
			 */
			do_action('storms_after_search_empty_content');

		else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'storms' ); ?></p>
			<?php
			\StormsFramework\Helper::get_search_form();

		endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
