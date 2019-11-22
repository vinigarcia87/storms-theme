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
 * Menu Template
 * The template part for the main menu
 */

use \StormsFramework\Bootstrap;

?>
<nav id="main-navigation" class="navbar navbar-expand-lg navbar-light bg-light" role="navigation">
	<div class="container">

		<a class="navbar-brand" href="<?php echo esc_url( get_bloginfo('url') ); ?>">
			<img class="brand" src="<?php echo \StormsFramework\Helper::get_asset_url('/img/storms/logo/cloud_storms.png') ?>" alt="Storms Websolutions"/>
		</a>

		<!-- Botao collapse menu para mobile -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'main_menu',
						'depth'          => 2,
						'container'      => false,
						'menu_class'     => 'nav navbar-nav mr-auto mt-2 mt-lg-0',
						'fallback_cb'    => '\\StormsFramework\\Bootstrap\\WP_Bootstrap_Navwalker::fallback',
						'walker'         => new Bootstrap\WP_Bootstrap_Navwalker()
					)
				);
			?>
			<div class="nav nav-secondary navbar-right">
				<!-- Formulario de Busca do Site -->
				<?php Bootstrap\Bootstrap::get_search_form(); ?>
			</div>
		</div><!--/.navbar-collapse -->
	</div>
</nav>
