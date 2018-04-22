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
 * WC_SearchBar
 * This code creates the shop searchbar as a widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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
                <input class="form-control search-input" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php echo esc_attr( $label_input ); ?>" />

                <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle categories-dropdown-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo esc_attr( $label_dropdown ); ?> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right categories-dropdown">
                        <li value="">
                            <a href="">
                                <?php echo esc_attr( $label_dropdown ); ?>
                            </a>
                        </li>
                        <?php
                        if ( $count > 0 ) {
                            foreach ( $product_categories as $product_category ) { ?>
                                <li class="parent-cat">
                                    <a href="<?php echo esc_attr( $product_category->slug ); ?>">
                                        <?php echo esc_attr( $product_category->name); ?>
                                    </a>
                                </li>
                                <?php
                                foreach ( $product_category->children as $child ) { ?>
                                    <li class="child-cat">
                                        <a href="<?php echo esc_attr( $child->slug ); ?>">
                                            <?php echo esc_attr( $child->name); ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </ul>

                    <button type="submit" id="searchsubmit" class="btn btn-default search-submit-button">
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

function storms_register_wc_searchbar() {
	register_widget('storms_wc_searchbar');
}
add_action( 'widgets_init', 'storms_register_wc_searchbar' );
