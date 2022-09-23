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
 * Search Form Template
 * The template part for the search form
 */

defined( 'ABSPATH' ) || exit;
?>

<form id="searchform" role="search" class="search-form form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">

	<div class="input-group">
		<label for="s" class="sr-only"><?php echo __( 'Search' ); ?></label>
		<input type="search" class="search-field form-control" id="s" name="s" placeholder="<?php esc_attr_e( 'Search' ); ?>" value="<?php echo get_search_query(); ?>" />

		<button class="btn" type="submit"><span class="fa fa-search" aria-hidden="true"></span></button>
	</div>

</form>
