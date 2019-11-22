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
 * Footer Content Template
 * The content of the footer
 */

?>

<div class="row no-margin-left no-margin-right margin-bottom-row">
	<div class="col-md-8 offset-md-2 col-sm-7 offset-sm-2 text-center">
		<p>&copy; <?php printf( esc_html__( '2012 - %1$s by %2$s - All rights reserved.', 'storms' ), date('Y'), '<strong>Storms Websolutions</strong>' ); ?></p>
	</div>
	<div class="col-md-2 col-sm-2 logo-storms">
		<a href="<?php echo esc_url('http://www.storms.com.br'); ?>">
			<img src="<?php echo esc_url( \StormsFramework\Helper::get_asset_url('/img/storms/logo/bn_storms_white.png') ) ?>" alt="Storms Websolutions"/>
		</a>
	</div>
</div>
