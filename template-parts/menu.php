<?php
/**
 * Storms Framework (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2017, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   3.0.0
 *
 * Menu Template
 * The template part for the main menu
 */

use \StormsFramework\Storms\Bootstrap,
    \StormsFramework\Storms\Helper;

?>
<nav id="main-navigation" class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php echo esc_url( get_bloginfo('url') ); ?>">
				<img class="brand" src="<?php echo Helper::get_asset_url('/img/storms/logo/cloud_storms.png') ?>" alt="Storms Websolutions"/>
			</a>
			<!-- Botao collapse menu para mobile -->
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<div class="pull-left">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</div>
				<span class="colapsed-menu-btn-title pull-right">Menu</span>
			</button>
		</div>
		<div class="collapse navbar-collapse">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'main_menu',
						'depth'          => 2,
						'container'      => false,
						'menu_class'     => 'nav navbar-nav',
						'fallback_cb'    => '\\StormsFramework\\Storms\\Bootstrap\\NavWalker::fallback',
						'walker'         => new Bootstrap\NavWalker()
					)
				);
			?>
			<div class="nav nav-secondary navbar-right">
				<!-- Formulario de Busca do Site -->
				<?php Bootstrap\Bootstrap::get_search_form(); ?>
			</div>
		</div><!--/.nav-collapse -->
	</div>
</nav>
