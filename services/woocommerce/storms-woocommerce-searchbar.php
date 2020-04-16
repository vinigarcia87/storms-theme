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
 * WC_SearchBar
 * This code creates the shop searchbar as a widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Searchbar for WooCommerce, with categories dropdown
 *
 * Class Storms_WC_SearchBar
 */
class Storms_WC_SearchBar extends WC_Widget
{

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'Widget WC Search Bar';
		$this->widget_description = __( 'Shows a custom WooCommerce search bar', 'storms' );
		$this->widget_id          = 'storms_wc_searchbar';
		$this->widget_name        = __( 'Storms WC Search Bar', 'storms' );

		$this->settings = array(
			'title' => array(
				'type'  => 'text',
				'std'   => __( '', 'storms' ),
				'label' => __( 'Title', 'storms' )
			),
			'label_input' => array(
				'type'  => 'text',
				'std'   => __( '', 'storms' ),
				'label' => __( 'Label search text', 'storms' )
			),
            'label_dropdown' => array(
                'type'  => 'text',
                'std'   => __( '', 'storms' ),
                'label' => __( 'Label categories text', 'storms' )
            ),
			'type' => array(
				'type'  => 'select',
				'std'   => 'product',
				'label' => __( 'Type category', 'storms' ),
				'options' => array(
					'product'   => __( 'Product', 'storms' ),
					'blog'  => __( 'Blogs', 'storms' )
				)
			),
			'hide_empty' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Hide if category is empty', 'storms' )
			),
			'el_class' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Extra class', 'storms' )
			)
		);

		parent::__construct();
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		$hide_empty = esc_attr( $instance['hide_empty'] ?? 0 );
        $label_input = esc_attr( $instance['label_input'] ?? __( 'Procurar por...', 'storms' ) );
		$label_dropdown = esc_attr( $instance['label_dropdown'] ?? __( 'Selecionar categorias', 'storms' ) );
		$type = esc_attr( $instance['type'] ?? 'product' );
		$el_class = esc_attr( $instance['el_class'] ?? '' );

		$class = [ 'searchbar-form' ];
		$class[] = $el_class;
		$argss = array(
			'orderby'    => 'titles',
			'order'      => 'ASC',
			'exclude'    => 1, //remove uncategory
			'hide_empty' => true // $hide_empty
		);
		$is_blog = $type == 'blog';
		$cat = $is_blog ? 'category' : 'product_cat';
		$product_categories = get_terms( $cat, $argss );

		$categoryHierarchy = array();
		storms_sort_terms_hierarchicaly( $product_categories, $categoryHierarchy );
		$product_categories = $categoryHierarchy;

		$count = count( $product_categories );

        ob_start();
        $this->widget_start( $args, $instance );
		?>
		<form method="get" id="storms-wc-searchbar-form" class="<?php echo esc_attr( implode( ' ', $class ) );?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">

            <div class="input-group">
                <input class="form-control search-input" type="text" aria-label="<?php _e( 'Search our products', 'storms' ); ?>"
					   value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php echo esc_attr( $label_input ); ?>" />

                <div class="input-group-append">
					<button class="btn btn-outline-secondary dropdown-toggle categories-dropdown-btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo esc_attr( $label_dropdown ); ?> <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu" role="menu">
						<a class="dropdown-item" href="">
							<?php echo esc_attr( $label_dropdown ); ?>
						</a>
                        <?php
                        if ( $count > 0 ) {
                            foreach ( $product_categories as $product_category ) { ?>
								<a class="dropdown-item parent-cat" href="<?php echo esc_attr( $product_category->slug ); ?>">
									<?php echo esc_attr( $product_category->name); ?>
								</a>
                                <?php
                                foreach ( $product_category->children as $child ) { ?>
									<a class="dropdown-item child-cat" href="<?php echo esc_attr( $child->slug ); ?>">
										<?php echo esc_attr( $child->name); ?>
									</a>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>

					<button type="submit" id="searchsubmit" class="btn btn-outline-secondary search-submit-button">
						<i class="fa fa-search" aria-hidden="true"></i>
					</button>
                </div>
            </div>

            <?php if( ! $is_blog ): ?>
                <input type="hidden" name="post_type" value="product">
                <input type="hidden" disabled="disabled" value="" name="product_cat" />
            <?php else: ?>
                <input type="hidden" disabled="disabled" value="" name="cat" />
            <?php  endif;?>

		</form>
		<?php
		$this->widget_end( $args );
		echo ob_get_clean();
	}

}

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

function storms_register_wc_searchbar() {
	register_widget('storms_wc_searchbar');
}
add_action( 'widgets_init', 'storms_register_wc_searchbar' );
