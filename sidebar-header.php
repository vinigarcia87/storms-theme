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
 * Sidebar Template
 * The sidebar containing the main widget area
 */

?>

<aside id="sidebar" class="sidebar header-sidebar" role="complementary">
	<?php
		/*
		* When we call the dynamic_sidebar() function, it'll spit out
		* the widgets for that widget area. If it instead returns false,
		* then the sidebar simply doesn't exist, so we'll hard-code in
		* some default sidebar stuff just in case.
		*/
		if ( ! dynamic_sidebar( 'header-sidebar' ) ) : ?>

            <p class="text-right">
                <?php esc_html_e( 'Desenvolvimento de Software', 'storms' ); ?><br/>
                <?php esc_html_e( 'vinicius.garcia@storms.com.br', 'storms' ); ?><br/>
                <?php esc_html_e( 'Telefone: (41) 98825.3688', 'storms' ); ?><br/>
                <a href="<?php echo esc_url( wp_login_url() ); ?>" title="Login">
                    <?php esc_html_e( 'Acessar meu sistema', 'storms' ); ?> <span class="fa fa-lock" title="Login"></span>
                </a>
            </p>

    <?php endif; ?>
</aside><!-- /.sidebar -->
