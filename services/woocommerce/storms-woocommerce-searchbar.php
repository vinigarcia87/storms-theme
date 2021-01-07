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
			'dropdown_position' => array(
				'type'  => 'select',
				'std'   => 'prepend',
				'label' => __( 'Dropdown position', 'storms' ),
				'options' => array(
					'prepend'   => __( 'Prepend', 'storms' ),
					'append'  => __( 'Append', 'storms' ),
					'hide'  => __( 'Hide', 'storms' ),
				)
			),
			'type' => array(
				'type'  => 'select',
				'std'   => 'product',
				'label' => __( 'Type category', 'storms' ),
				'options' => array(
					'product'   => __( 'Product', 'storms' ),
					'blog'  => __( 'Blog', 'storms' )
				)
			),
			'hide_empty' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Hide if category is empty', 'storms' )
			),
			'search_button_text' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Search button text', 'storms' )
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
		$dropdown_position = esc_attr( $instance['dropdown_position'] ?? 'prepend' );
		$type = esc_attr( $instance['type'] ?? 'product' );
		$search_button_text = esc_attr( $instance['search_button_text'] ?? '' );
		$el_class = esc_attr( $instance['el_class'] ?? '' );

		$class = [ 'searchbar-form' ];
		$class[] = $el_class;

        ob_start();
        $this->widget_start( $args, $instance );
		?>
		<form method="get" id="storms-wc-searchbar-form" class="<?php esc_attr_e( implode( ' ', $class ) ); ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">

            <div class="input-group">

				<?php if( 'prepend' === $dropdown_position ): ?>
					<div class="input-group-prepend">
						<?php $this->get_categories_dropdown( $label_dropdown, $type, $hide_empty ); ?>
					</div>
				<?php endif; ?>

                <input class="form-control search-input" type="text" aria-label="<?php _e( 'Search our products', 'storms' ); ?>"
					   value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php echo esc_attr( $label_input ); ?>" />

                <div class="input-group-append">

					<?php if( 'append' === $dropdown_position ): ?>
						<?php $this->get_categories_dropdown( $label_dropdown, $type, $hide_empty ); ?>
					<?php endif; ?>

					<button type="submit" id="searchsubmit" class="btn btn-outline-secondary search-submit-button">
						<i class="fa fa-search" aria-hidden="true"></i> <?php esc_attr_e( $search_button_text ); ?>
					</button>
                </div>
            </div>

            <?php if( 'blog' === $type ): ?>
				<input type="hidden" disabled="disabled" value="" name="cat" />
            <?php else: ?>
				<input type="hidden" name="post_type" value="product">
				<input type="hidden" disabled="disabled" value="" name="product_cat" />
            <?php  endif;?>

		</form>
		<?php
		$this->widget_end( $args );
		echo ob_get_clean();
	}

	private function get_categories_dropdown( $label_dropdown, $type, $hide_empty ) {
		$argss = array(
			'orderby'    => 'titles',
			'order'      => 'ASC',
			'exclude'    => 1, //remove uncategory
			'hide_empty' => $hide_empty
		);
		$cat = ( 'blog' === $type ) ? 'category' : 'product_cat';
		$categories = get_terms( $cat, $argss );

		$categoryHierarchy = array();
		\StormsFramework\Helper::sort_terms_hierarchically( $categories, $categoryHierarchy );
		$categories = $categoryHierarchy;

		$count = count( $categories );
		?>
		<button class="btn btn-outline-secondary dropdown-toggle categories-dropdown-btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<?php echo esc_attr( $label_dropdown ); ?> <span class="caret"></span>
		</button>
		<div class="dropdown-menu" role="menu">
			<a class="dropdown-item" href="#">
				<?php echo esc_attr( $label_dropdown ); ?>
			</a>
			<?php
			if ( $count > 0 ) { ?>
				<ul class="parent-list">
					<?php
					foreach ( $categories as $category ) { ?>

						<li class="dropdown-item parent-cat"><a href="<?php echo esc_attr( get_term_link( $category ) ); ?>">
								<?php echo esc_attr( $category->name ); ?></a>
							<?php
							if( ! empty( $category->children ) ) { ?>
								<ul class="child-list">
									<?php
									foreach ( $category->children as $child ) { ?>
										<li class="dropdown-item child-cat"><a href="<?php echo esc_attr( get_term_link( $child ) ); ?>">
												<?php echo esc_attr($child->name); ?></a></li>
										<?php
									}
									?>
								</ul>
								<?php
							}
							?>
						</li>
						<?php
					}
					?>
				</ul>
				<?php
			}
			?>
		</div>
		<?php
	}
}

function storms_register_wc_searchbar() {
	register_widget('storms_wc_searchbar');
}
add_action( 'widgets_init', 'storms_register_wc_searchbar' );
