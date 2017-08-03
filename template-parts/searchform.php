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
 * Search Form Template
 * The template part for the search form
 */
?>

<?php $search_terms = get_search_query(); ?>

<form role="form" action="<?php echo esc_url( get_bloginfo('url') ); ?>/" id="searchform" method="get" class="navbar-form">
    <div class="input-group input-group-sm">
		<label for="s" class="sr-only"><?php echo __( 'Search', 'storms' ); ?></label>
		<input type="text" class="form-control" id="s" name="s" placeholder="<?php echo __( 'Search', 'storms' ); ?>" <?php if ( $search_terms !== '' ) { echo ' value="' . $search_terms . '"'; } ?> />
		<span class="input-group-btn">
            <button type="submit" class="btn btn-default">
				<span class="fa fa-search"></span>
			</button>
        </span>
    </div>
</form>
