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

		<meta name="description" content="A Dex tem a solução certa para o seu ônibus Volvo rodar tranquilo! Acesse e encontre peças com qualidade garantida e com a praticidade de poder escolher através do seu computador, celular ou tablet.">
		<meta name="keywords" content="Dex Peças, Peças Volvo, Ônibus, Caminhão">

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
			<div class="menssage text-center">

				<h1>Estamos em manutenção</h1>
				<!---728x90--->

			</div>
			<div class="storms-container text-center">

				<div class="storms-content">
					<div class="left-grid">
						<h2 class="logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img data-no-lazy="1" src="<?php  echo \StormsFramework\Helper::get_asset_url( '/img/logodex.png' ); ?>"  alt="<?php esc_attr_e( get_bloginfo( 'name', 'display' ) ); ?>" />
							</a>
						</h2>
					</div>
					<div class="right-grid">
						<p>
							Voltaremos em breve, enquanto isso entre em contato conosco através dos canais abaixo</p>

						<div class="info-grids">
							<p><span class="fa fa-map-marker"></span>Rua Cyro Correia Pereira, 3330 - CIC, Curitiba - PR, 81460-050</p>
							<p><span class="fa fa-phone"></span>Vendas: (41) 3317-7470</p>
							<p><span class="fa fa-phone"></span>  Outros Assuntos: (41) 3405-5560</p>
							<p><span class="fa fa-envelope"></span>E-mail: <a href="mailto:contato@dexpecas.com.br">contato@dexpecas.com.br</a></p>
						</div>
						<div class="social-grids">
							<ul>
								<li><a title="Siga no Facebook" href="https://www.facebook.com/DexPecas" rel="noopener noreferrer" target="_blank"><span class="fa fa-facebook"></span></a></li>
								<li><a title="Siga no Twitter" href="https://twitter.com/DexPecas" rel="noopener noreferrer" target="_blank"><span class="fa fa-twitter"></span></a></li>
								<li><a title="Siga no Instagram" href="https://www.instagram.com/dex_pecas" rel="noopener noreferrer" target="_blank"><span class="fa fa-instagram"></span></a></li>
								<li><a title="Siga no WhatsApp" href="https://api.whatsapp.com/send?phone=554133177470" rel="noopener noreferrer" target="_blank"><span class="fa fa-whatsapp"></span></a></li>
							</ul>
						</div>
						<!-- <a href="<?php echo esc_url( wp_login_url() ); ?>" title="Login"><span class="fa fa-lock" title="Login"></span></a> -->
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
