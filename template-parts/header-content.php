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
 * Header Content Template
 * The content of the header
 */

defined( 'ABSPATH' ) || exit;
?>
<div id="page-banner" class="st-grid-row row" role="banner">
	<div class="page-banner-content col-sm-7 col-md-8 col-lg-6">
		<?php
		$header_image = get_custom_header();
		if ( ! empty( $header_image ) ) :
		?>
			<a class="header-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img class="" src="<?php echo esc_url( $header_image->url ); ?>" height="<?php esc_attr_e( $header_image->height ); ?>" width="<?php esc_attr_e( $header_image->width ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
			</a>
		<?php else : ?>
			<a class="header-brand" href="<?php echo esc_url( get_bloginfo('url') ) ?>">
				<img class="" style="height: 75px;" src="<?php echo esc_url( \StormsFramework\Helper::get_asset_url('/img/storms/logo/generic-logo.svg') ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/>
			</a>
		<?php endif; ?>
	</div>

	<div class="page-banner-sidebar col-sm-5 col-md-4 offset-lg-2">
        <?php get_sidebar( 'header' ); ?>
	</div>
</div>
