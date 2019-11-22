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
?>
<?php if ( is_active_sidebar( 'footer-1-sidebar-top' ) ) : ?>
    <div class="row" role="complementary">
        <section class="col-sm-12 footer-1-sidebar-top">
            <?php dynamic_sidebar( 'footer-1-sidebar-top' ); ?>
        </section>
    </div>
<?php endif; ?>

<div class="row" role="complementary">
    <?php if ( is_active_sidebar( 'footer-1-sidebar-left' ) ) : ?>
        <section class="col-sm-4 footer-1-sidebar-left">
            <?php dynamic_sidebar( 'footer-1-sidebar-left' ); ?>
        </section>
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'footer-1-sidebar-middle' ) ) : ?>
        <section class="col-sm-4 footer-1-sidebar-middle">
            <?php dynamic_sidebar( 'footer-1-sidebar-middle' ); ?>
        </section>
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'footer-1-sidebar-right' ) ) : ?>
        <section class="col-sm-4 footer-1-sidebar-right">
            <?php dynamic_sidebar( 'footer-1-sidebar-right' ); ?>
        </section>
    <?php endif; ?>
</div>

<?php if ( is_active_sidebar( 'footer-1-sidebar-bottom' ) ) : ?>
    <div class="row" role="complementary">
        <section class="col-sm-12 footer-1-sidebar-bottom">
            <?php dynamic_sidebar( 'footer-1-sidebar-bottom' ); ?>
        </section>
    </div>
<?php endif; ?>
