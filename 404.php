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
 * 404 Template
 * The template for displaying the 404 page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package storms
 */

use \StormsFramework\Template;

defined( 'ABSPATH' ) || exit;

get_header(); ?>

	<div class="st-grid-row row">

		<!-- Website content -->
		<main id="content" class="main <?php echo Template::main_layout(); ?>" role="main">

			<div class="st-grid-row row">
				<div class="page404-image col-sm-6">
					<p class="display-1 font-weight-bold">404!</p>
				</div>
				<div class="page404-message col-sm-6">
					<h1 class="entry-title"><?php _e( 'Página não Encontrada', 'storms' ); ?></h1>

					<p class="text-justify"><?php _e( 'Não foi possível encontrar a página que você estava procurando. Ela pode ter sido removida, renomeada ou até mesmo nunca ter existido.', 'storms' ); ?></p>

					<?php if( \StormsFramework\Helper::is_woocommerce_activated() ): ?>
						<a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="btn btn-outline-dark"><?php _e( 'Voltar para Produtos', 'storms' ); ?></a>
					<?php else: ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-outline-dark"><?php _e( 'Ir para a página Principal', 'storms' ); ?></a>
					<?php endif; ?>
				</div>
			</div>

			<div class="page404-search">
				<?php
				if( ! \StormsFramework\Helper::is_woocommerce_activated() ):
					\StormsFramework\Helper::get_search_form();
				else:
					\StormsFramework\Helper::get_product_search_form();
				endif;
				?>
			</div>

			<div class="page404-extra-info">
				<?php
				/**
				 * Hook: storms_after_404_content.
				 *
				 * @hooked storms_{{ Shortcodes para produtos relacionados etc }} - 10
				 */
				do_action( 'storms_after_404_content' );
				?>
			</div>

		</main><!-- /.main -->

		<!-- Sidebar -->
		<?php get_sidebar(); ?>

	</div>

<?php
get_footer();
