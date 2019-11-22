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
?>

<?php $search_terms = get_search_query(); ?>
<form role="search" class="form-inline my-2 my-lg-0" action="<?php echo esc_url( get_bloginfo('url') ); ?>/" id="searchform" method="get">
	<input type="search" class="form-control mr-sm-2" id="s" name="s"
		   placeholder="<?php echo __( 'Search' ); ?>" <?php if ( $search_terms !== '' ) { echo ' value="' . $search_terms . '"'; } ?> />

	<button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><span class="fa fa-search"></span></button>
</form>
