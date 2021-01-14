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
 * Footer Content Template
 * The content of the footer
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="st-grid-row row no-margin-left">
	<div class="copyright-storms col-md-8 offset-md-2 text-center">
		<p><?php echo apply_filters( 'storms_footer_3_info', sprintf( esc_html__( '&copy; 2012 - %1$s by %2$s - All rights reserved.', 'storms' ), date('Y'), '<a href="http://storms.com.br/" target="_blank" rel="noopener noreferrer"><strong>Storms Websolutions</strong></a>' ) ); ?></p>
	</div>
	<div class="logo-storms col-md-2 text-center">
		<a href="<?php echo esc_url('https://www.storms.com.br/'); ?>" rel="noopener noreferrer" target="_blank">
			<img src="<?php echo esc_url( \StormsFramework\Helper::get_asset_url('/img/storms/logo/bn_storms_white.png') ) ?>" alt="Storms Websolutions"/>
		</a>
	</div>
</div>
