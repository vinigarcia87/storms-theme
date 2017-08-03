<?php
/**
 * Storms Framework (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2016, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   3.0.0
 *
 * Footer Content Template
 * The content of the footer
 */
?>
<div class="footer-1-sidebar text-center" role="complementary">
	<?php if ( is_active_sidebar( 'footer-1-sidebar-1' ) ) : ?>

		<?php if ( is_active_sidebar( 'footer-1-sidebar-1' ) ) : ?>
			<div class="row">
				<div class="col-md-12">
					<section class="footer-1-sidebar-1">
						<?php dynamic_sidebar( 'footer-1-sidebar-1' ); ?>
					</section>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'footer-1-sidebar-2' ) ) : ?>
		<div class="row">
			<div class="col-md-12">
				<section class="footer-1-sidebar-2">
					<?php dynamic_sidebar( 'footer-1-sidebar-2' ); ?>
				</section>
			</div>
		</div>
		<?php endif; ?>

	<?php endif; ?>
</div>