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
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<meta content="IE=edge" http-equiv="X-UA-Compatible">

		<meta name="author" content="Storms Websolutions" />
		<meta name="copyright" content="Copyright (c)2012-<?php echo date('Y') ?> Storms Websolutions. <?php echo __('All rights reserved', 'storms') ?>." />

		<meta http-equiv="content-language" content="<?php bloginfo('language'); ?>" />

		<!-- Title -->
		<title>Em breve | <?php bloginfo('name'); ?></title>

		<link rel="icon" href="<?php echo \StormsFramework\Helper::get_asset_url( '/img/storms/icons/storms_favicon.png' ); ?>">

		<link href="<?php  echo \StormsFramework\Helper::get_asset_url( '/css/construction.min.css' ); ?>" rel="stylesheet" />
	</head>
	<body class="under-construction">

		<div class="container-fluid">
			<div class="header">
				<h1><?php bloginfo('name'); ?></h1>
				<h2>Mais um website produzido por Storms Websolutions</h2>
			</div>
			<div class="content col text-center">
				<h3>Nosso site está quase pronto!</h3>
				<p>
					<strong>Em breve</strong>, mais um grande projeto desenvolvido pela Storms Websolutions. Aguarde nosso lançamento!
				</p>
				<a class="header-brand" href="http://www.storms.com.br/" rel="noopener noreferrer" target="_blank">
					<img class="" src="<?php echo \StormsFramework\Helper::get_asset_url( '/img/storms/logo/storms/logo-storms-branca.png' ); ?>" alt="Storms Websolutions"/>
				</a>
				<p class="login text-center">
					<a href="<?php echo esc_url( wp_login_url() ); ?>" title="Login">
						<span class="fa fa-lock" title="Login"></span>
					</a>
				</p>
			</div>
		</div>

	</body>
</html>
