<?php
/**
 * Storms Framework (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2017, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   3.0.0
 *
 * Header Content Template
 * The content of the header
 */

use \StormsFramework\Storms\Helper;
?>
<div id="page-banner" class="row" role="banner">
	<div class="col-md-5">
		<?php
		$header_image = get_header_image();
		if ( ! empty( $header_image ) ) :
		?>
			<a class="header-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img class="" src="<?php echo esc_url( $header_image ); ?>" height="<?php echo esc_attr( $header_image->height ); ?>" width="<?php esc_attr_e( $header_image->width ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
			</a>
		<?php else : ?>
			<a class="header-brand" href="<?php echo esc_url( get_bloginfo('url') ) ?>">
				<img class="" style="height: 75px;" src="<?php echo esc_url( Helper::get_asset_url('/img/storms/logo/generic-logo.svg') ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/>
			</a>
		<?php endif; ?>
	</div>
	<div class="col-md-4 col-md-offset-3">
	<?php if ( is_active_sidebar( 'header-sidebar' ) ) : ?>
		<section class="header-sidebar" role="complementary">
			<?php dynamic_sidebar( 'header-sidebar' ); ?>
		</section>
	<?php else: ?>
		<p class="text-right">
			<?php esc_html_e( 'Desenvolvimento de Software', 'storms' ); ?><br/>
			<?php esc_html_e( 'vinicius.garcia@storms.com.br', 'storms' ); ?><br/>
			<?php esc_html_e( 'Telefone: (41) 8825.3688', 'storms' ); ?><br/>
			<a href="<?php echo esc_url( wp_login_url() ); ?>" title="Login">
				<?php esc_html_e( 'Acessar meu sistema', 'storms' ); ?> <span class="fa fa-lock" title="Login"></span>
			</a>
		</p>
	<?php endif; ?>
	</div>
</div>
