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
 * Footer 1 sidebar Template
 * The content of the footer 1 sidebar
 */

defined( 'ABSPATH' ) || exit;
?>
<?php if ( is_active_sidebar( 'footer-1-sidebar-top' ) ) : ?>
    <div class="st-grid-row row" role="complementary">
        <section class="footer-1-sidebar-top col-sm-12">
            <?php dynamic_sidebar( 'footer-1-sidebar-top' ); ?>
        </section>
    </div>
<?php endif; ?>

<div class="st-grid-row row" role="complementary">
    <?php if ( is_active_sidebar( 'footer-1-sidebar-left' ) ) : ?>
        <section class="footer-1-sidebar-left col-sm-4">
            <?php dynamic_sidebar( 'footer-1-sidebar-left' ); ?>
        </section>
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'footer-1-sidebar-middle' ) ) : ?>
        <section class="footer-1-sidebar-middle col-sm-4">
            <?php dynamic_sidebar( 'footer-1-sidebar-middle' ); ?>
        </section>
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'footer-1-sidebar-right' ) ) : ?>
        <section class="footer-1-sidebar-right col-sm-4">
            <?php dynamic_sidebar( 'footer-1-sidebar-right' ); ?>
        </section>
    <?php endif; ?>
</div>

<?php if ( is_active_sidebar( 'footer-1-sidebar-bottom' ) ) : ?>
    <div class="st-grid-row row" role="complementary">
        <section class="footer-1-sidebar-bottom col-sm-12">
            <?php dynamic_sidebar( 'footer-1-sidebar-bottom' ); ?>
        </section>
    </div>
<?php endif; ?>
