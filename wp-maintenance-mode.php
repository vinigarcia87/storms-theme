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
 * Under Construction Page
 * Page to show while the website is on construction
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="content-language" content="<?php bloginfo('language'); ?>" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<meta content="IE=edge" http-equiv="X-UA-Compatible">

		<meta name="google-site-verification" content="HfwaUx-c6_461t666AEFg48JsmL9i76BI78oAalzvMs">

		<meta name="author" content="Storms Websolutions" />
		<meta name="copyright" content="Copyright (c)2012-<?php echo date('Y') ?> Storms Websolutions. <?php echo __('All rights reserved', 'storms') ?>." />

		<meta name="description" content="">
		<meta name="keywords" content="">

		<link rel="dns-prefetch" href="//fonts.googleapis.com">

		<!-- Title -->
		<title>Manutenção - <?php bloginfo('name'); ?></title>

		<!-- font files -->
		<link href="//fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

		<link rel="icon" href="<?php echo \StormsFramework\Helper::get_asset_url( '/img/storms/icons/storms_favicon.png' ); ?>">

		<link href="<?php  echo \StormsFramework\Helper::get_asset_url( '/css/construction.min.css' ); ?>" rel="stylesheet" />
	</head>
	<body class="under-construction">

		<div class="banner-layer">
			<div class="message text-center">

				<h1>Estamos em manutenção</h1>
				<!---728x90--->

			</div>
			<div class="storms-container text-center">

				<div class="storms-content">
					<div class="left-grid">
						<h2 class="logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">

								<?php $logo_url = apply_filters( 'storms_maintenance_url_logo', \StormsFramework\Helper::get_asset_url( '/img/storms.png' ) ); ?>
								<img data-no-lazy="1" src="<?php echo esc_url( $logo_url ); ?>"  alt="<?php esc_attr_e( get_bloginfo( 'name', 'display' ) ); ?>" />
							</a>
						</h2>
					</div>
					<div class="right-grid">
						<p>
							Voltaremos em breve, enquanto isso entre em contato conosco através dos canais abaixo</p>

						<?php
						$business_info = [
							'address'  => 'Rua Ayrton Turra, 51 - Cajuru, Curitiba - PR, 82970-015',
							'phone'    => '+51 41 98825-3688',
							'phone_2'  => '+51 41 98825-3688',
							'email'    => 'vinicius.garcia@storms.com.br',
						];
						$business_info = apply_filters( 'storms_maintenance_business_info', $business_info );
						?>

						<div class="info-grids">
							<p><span class="bi bi-geo-alt"></span><?php esc_html_e( $business_info['address'] ) ?></p>
							<p><span class="bi bi-telephone"></span><?php esc_html_e( $business_info['phone'] ) ?></p>
							<?php if( ! empty( $business_info['phone_2'] ) ): ?><p><span class="bi bi-telephone"></span><?php esc_html_e( $business_info['phone_2'] ) ?></p><?php endif; ?>
							<p><span class="bi bi-envelope"></span>E-mail: <a href="mailto:<?php esc_html_e( $business_info['email'] ) ?>"><?php esc_html_e( $business_info['email'] ) ?></a></p>
						</div>
						<div class="social-grids">
							<ul>
								<?php
								$social_media_links = [
									'facebook'  => 'https://www.facebook.com/StormsWebsolutions',
									'twitter'   => 'https://twitter.com/StormsWebsolutions',
									'instagram' => 'https://www.instagram.com/StormsWebsolutions',
									'whatsapp'  => 'https://api.whatsapp.com/send?phone=5541988253688',
									'youtube'	=> 'https://www.youtube.com/c/StormsWebsolutions',
									'linkedin'	=> 'https://www.linkedin.com/company/StormsWebsolutions',
								];
								$social_media_links = apply_filters( 'storms_maintenance_social_media_links', $social_media_links );
								?>

								<?php if( ! empty( $social_media_links['facebook'] ) ): ?><li><a title="Siga no Facebook" href="<?php echo esc_url( $social_media_links['facebook'] ) ?>" rel="noopener noreferrer" target="_blank"><span class="bi bi-facebook"></span></a></li><?php endif; ?>
								<?php if( ! empty( $social_media_links['twitter'] ) ): ?><li><a title="Siga no Twitter" href="<?php echo esc_url( $social_media_links['twitter'] ) ?>" rel="noopener noreferrer" target="_blank"><span class="bi bi-twitter"></span></a></li><?php endif; ?>
								<?php if( ! empty( $social_media_links['instagram'] ) ): ?><li><a title="Siga no Instagram" href="<?php echo esc_url( $social_media_links['instagram'] ) ?>" rel="noopener noreferrer" target="_blank"><span class="bi bi-instagram"></span></a></li><?php endif; ?>
								<?php if( ! empty( $social_media_links['whatsapp'] ) ): ?><li><a title="Siga no WhatsApp" href="<?php echo esc_url( $social_media_links['whatsapp'] ) ?>" rel="noopener noreferrer" target="_blank"><span class="bi bi-whatsapp"></span></a></li><?php endif; ?>
								<?php if( ! empty( $social_media_links['youtube'] ) ): ?><li><a title="Siga no YouTube" href="<?php echo esc_url( $social_media_links['youtube'] ) ?>" rel="noopener noreferrer" target="_blank"><span class="bi bi-youtube"></span></a></li><?php endif; ?>
								<?php if( ! empty( $social_media_links['linkedin'] ) ): ?><li><a title="Siga no LinkedIn" href="<?php echo esc_url( $social_media_links['linkedin'] ) ?>" rel="noopener noreferrer" target="_blank"><span class="bi bi-linkedin"></span></a></li><?php endif; ?>
							</ul>
						</div>
						<!-- <a href="<?php echo esc_url( wp_login_url() ); ?>" title="Login"><span class="bi bi-lock" title="Login"></span></a> -->
					</div>
				</div>
			</div>
			<!---728x90--->
			<div class="footer">
				<p> © <?php echo date('Y') ?> <?php bloginfo('name'); ?>. Todos os direitos reservados.<br />
					Desenvolvido por <a href="https://www.storms.com.br/" rel="noopener noreferrer" target="=_blank">Storms Websolutions</a>
				</p>
			</div>
			<!---728x90--->
		</div>

	</body>
</html>
