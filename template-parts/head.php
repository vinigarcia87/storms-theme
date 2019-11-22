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
 * Head
 * The Head part of the website
 * Includes all the scripts and page definitions
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">

	<meta http-equiv="content-language" content="<?php bloginfo('language'); ?>" />

	<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
	?>
	</head>
	<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" <?php body_class(); ?>>
		<!-- Skip navigation for accessibility -->
		<a id="skippy" class="sr-only sr-only-focusable" href="#main-container"><div class="container"><span class="skiplink-text"><?php _e( 'Skip to main content', 'storms' ); ?></span></div></a>

        <!--[if lte IE 9]>
		<div class="alert alert-warning affix text-center alert-dismissible fade in" style="margin-bottom: 0; width: 100%; z-index: 2147483647;">
		    <?php _e('It looks like you&#8217;re using an <strong>outdated</strong> browser. Please, <a href="http://browsehappy.com/">update your browser</a> for the best experience on the web.', 'storms'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		</div>
        <script src="<?php echo \StormsFramework\Helper::get_asset_url( '/js/bootstrap/alert.js' ); ?>"></script>
        <![endif]-->
