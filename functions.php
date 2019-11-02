<?php
/**
 * Storms Framework (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2017, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   1.0.0
 *
 * Functions file
 * Here we load all code we gonna need
 */

/*********************************
 *  Configuração Storms Framework
 *********************************/

// Define the Storms Theme version
if ( !defined( 'STORMS_THEME_VERSION' ) ) {
	define( 'STORMS_THEME_VERSION', '1.0.0' );
}

// System Environment
if ( !defined( 'SF_ENV' ) ) {
    define( 'SF_ENV', 'DEV' );
}

// Define the System Version
if ( !defined( 'STORMS_SYSTEM_VERSION' ) ) {
	define( 'STORMS_SYSTEM_VERSION', 'YYYY.MM.DD' );
}

// Require services of this theme
require_once 'services/storms-theme-setup.php';
require_once 'services/storms-environment-config.php';
require_once 'services/storms-wp-default-configuration.php';


/**
 * =====================================================================================================================
 */

/**
 * You need to testing things?
 * Do it here!
 */
if( ! function_exists( 'storms_testing' ) ) {
	function storms_testing() {
		//\StormsFramework\Storms\Helper::debug( 'Debugging' );
	}
	//add_action( 'init', 'storms_testing' );
}

function storms_inspect_scripts() {
    $wp_scripts = wp_scripts();
    \StormsFramework\Storms\Helper::debug( $wp_scripts->queue );
}
//add_action( 'wp_head', 'storms_inspect_scripts', 999 );

/**
 * 					REVISAR ESSES CODIGOS!
 * =====================================================================================================================
 */

// @TODO Revisar!!
require_once 'services/storms-woocommerce-wishlist.php';
require_once 'services/storms-woocommerce-changes.php';
require_once 'services/storms-woocommerce-cart-mini.php';
require_once 'services/storms-woocommerce-searchbar.php';
//require_once 'services/storms-calculo-st.php';

// Remove Wordpress oembed
// @see https://www.isitwp.com/remove-everything-oembed/

//Remove the REST API endpoint.
remove_action('rest_api_init', 'wp_oembed_register_route');

// Turn off oEmbed auto discovery.
add_filter( 'embed_oembed_discover', '__return_false' );

//Don't filter oEmbed results.
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

//Remove oEmbed discovery links.
remove_action('wp_head', 'wp_oembed_add_discovery_links');

//Remove oEmbed JavaScript from the front-end and back-end.
remove_action('wp_head', 'wp_oembed_add_host_js');

/**
 * =====================================================================================================================
 */

/**
 * Recursively sort an array of taxonomy terms hierarchically. Child categories will be
 * placed under a 'children' member of their parent term.
 * Source: http://wordpress.stackexchange.com/a/99516/54025
 *
 * @param Array   $cats     taxonomy term objects to sort
 * @param Array   $into     result array to put them in
 * @param integer $parentId the current parent ID to put them in
 */
function storms_sort_terms_hierarchicaly(Array &$cats, Array &$into, $parentId = 0) {
	foreach ($cats as $i => $cat) {
		if ($cat->parent == $parentId) {
			$into[$cat->term_id] = $cat;
			unset($cats[$i]);
		}
	}

	foreach ($into as $topCat) {
		$topCat->children = array();
		storms_sort_terms_hierarchicaly($cats, $topCat->children, $topCat->term_id);
	}
}

/**
 * Parsing a posts
 * The filter we added will receive the raw HTML of the post and return the transformed content.
 * @see https://css-tricks.com/leverage-wordpress-functions-reduce-html-posts/
 */
function storms_the_content( $content ) {

    // First encode all characters to their HTML entities
    $encoded = mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' );

    // Load the content, suppressing warnings (libxml complains about not having
    // a root element (we have many paragraphs)
    $html = new DOMDocument();
    $ok = @$html->loadHTML( $encoded, LIBXML_HTML_NODEFDTD | LIBXML_NOBLANKS );

    // If it didn't parse the HTML correctly, do not proceed. Return the original, untransformed, post
    if ( !$ok ) {
        return $content;
    }

    // Pass the document to all filters
    storms_content_remove_wrapping_p( $html );
    storms_rel_noopener( $html );

    // Filtering is done. Serialize the transformed post
    $string = $html->saveHTML();
    return str_replace( array( '<html><body>', '</body></html>' ), '', $string );

}
//add_filter( 'the_content', 'storms_the_content' );

/**
 * Removing wrapping paragraphs
 * Remove the wrapping paragraph from images and other elements, such as picture, video, audio, and iframe.
 * @see https://css-tricks.com/leverage-wordpress-functions-reduce-html-posts/#article-header-id-13
 * @see https://www.jitbit.com/alexblog/256-targetblank---the-most-underestimated-vulnerability-ever/
 */
function storms_content_remove_wrapping_p( $html ) {
    // Iterating a nodelist while manipulating it is not a good thing, because
    // the nodelist dynamically updates itself. Get all things that must be
    // unwrapped and put them in an array.
    $tagNames = array( 'img', 'picture', 'video', 'audio', 'iframe' );
    $mediaElements = array();
    foreach ( $tagNames as $tagName ) {
        $nodes = $html->getElementsByTagName( $tagName );
        foreach ( $nodes as $node ) {
            $mediaElements[] = $node;
        }
    }

    foreach ( $mediaElements as $element ) {

        // Get a reference to the parent paragraph that may have been added by
        // WordPress. It might be the direct parent node or the grandparent
        // (LOL) in case of links
        $paragraph = null;

        // Get a reference to the image itself or to the link containing the
        // image, so we can later remove the wrapping paragraph
        $theElement = null;

        if ( $element->parentNode->nodeName == 'p' ) {
            $paragraph = $element->parentNode;
            $theElement = $element;
        } else if ( $element->parentNode->nodeName == 'a' &&
            $element->parentNode->parentNode->nodeName == 'p' ) {
            $paragraph = $element->parentNode->parentNode;
            $theElement = $element->parentNode;
        }

        // Make sure the wrapping paragraph only contains this child
        if ( $paragraph && $paragraph->textContent == '' ) {
            $paragraph->parentNode->replaceChild( $theElement, $paragraph );
        }
    }
}

/**
 * Adding rel=noopener
 * Fixing security issue regarding links opening in a new tab.
 * @see https://css-tricks.com/leverage-wordpress-functions-reduce-html-posts/#article-header-id-14
 * @see https://mathiasbynens.github.io/rel-noopener/
 */
function storms_rel_noopener( $html ) {
    $nodes = $html->getElementsByTagName( 'a' );
    foreach ( $nodes as $node ) {
        $node->setAttribute( 'rel', 'noopener noreferrer' );
    }
}
