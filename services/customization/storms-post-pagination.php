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
 * storms-posts-widget.php
 * {{ Why this file is here? }}
 */

function storms_numeric_posts_nav() {

	if( is_singular() ) {
		return;
	}

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/** Add current page to the array */
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}

	/** Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<nav class="post-pagination"><ul class="pagination">' . "\n";

	/** Previous Post Link */
	if ( get_previous_posts_link() ) {
		add_filter( 'previous_posts_link_attributes', function() { return 'class="page-link"'; } );
		printf('<li class="page-item">%s</li>' . "\n", get_previous_posts_link( '&laquo;' ));
	}

	/** Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="page-item active"' : ' class="page-item"';

		printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) ) {
			echo '<li>…</li>';
		}
	}

	/** Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="page-item active"' : ' class="page-item"';
		printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/** Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) ) {
			echo '<li class="page-item">…</li>' . "\n";
		}

		$class = $paged == $max ? ' class="page-item active"' : ' class="page-item"';
		printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/** Next Post Link */
	if ( get_next_posts_link() ) {
		add_filter( 'next_posts_link_attributes', function() { return 'class="page-link"'; } );
		printf('<li class="page-item">%s</li>' . "\n", get_next_posts_link( '&raquo;' ));
	}

	echo '</ul></nav>' . "\n";
}
