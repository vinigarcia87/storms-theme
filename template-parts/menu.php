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
 * Menu Template
 * The template part for the main menu
 */

use \StormsFramework\Template;

defined( 'ABSPATH' ) || exit;
?>
<nav id="main-navigation" class="main-menu navbar navbar-expand-lg navbar-light bg-light" role="navigation" data-toggle="sticky-onscroll">
	<div class="<?php echo Template::menu_container(); ?>">

		<?php if( 'yes' === \StormsFramework\Helper::get_option( 'storms_show_menu_image', 'yes' ) ) : ?>

		<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php
				$image_id = get_theme_mod( 'storms_menu_image' );
				if ( ! empty( $image_id ) ) :
					$url          = esc_url_raw( wp_get_attachment_url( $image_id ) );

					$image_data  = wp_get_attachment_metadata( $image_id );
					$width  = $image_data['width'];
					$height = $image_data['height'];
			?>
				<img class="brand" src="<?php echo esc_url( $url ); ?>" height="<?php esc_attr_e( $height ); ?>" width="<?php esc_attr_e( $width ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/>
			<?php else : ?>
				<?php /* <img class="brand" src="<?php echo \StormsFramework\Helper::get_asset_url('/img/storms/logo/cloud_storms.png') ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/> */ ?>
			<?php endif; ?>
		</a>

		<?php endif; ?>

		<!-- Collapse menu button for mobile -->
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'main_menu',
						'depth'           => 2,
						'container'       => false,
						'menu_class'      => 'navbar-nav',
						'fallback_cb'     => '\\StormsFramework\\Bootstrap\\WP_Bootstrap_Navwalker::fallback',
						'walker'          => new \StormsFramework\Bootstrap\WP_Bootstrap_Navwalker()
					)
				);
			?>

			<div class="header-menu-sidebar-right">
				<?php if ( is_active_sidebar( 'header-menu-sidebar-right' ) ) : ?>
					<?php dynamic_sidebar( 'header-menu-sidebar-right' ); ?>
				<?php endif; ?>
			</div>
		</div><!--/.navbar-collapse -->
	</div>
</nav>
