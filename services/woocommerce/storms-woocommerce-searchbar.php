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

if( \StormsFramework\Helper::is_woocommerce_activated() ) {

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

			add_action( 'wp_footer', array( $this, 'register_scripts' ) );

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
			<div class="storms-wc-searchbar-container">
				<form method="get" id="storms-wc-searchbar-form" class="<?php esc_attr_e( implode( ' ', $class ) ); ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">

					<div class="input-group">

						<?php if( 'prepend' === $dropdown_position ): ?>
							<?php $this->get_categories_dropdown( $label_dropdown, $type, $hide_empty ); ?>
						<?php endif; ?>

						<input class="form-control search-input" type="text" aria-label="<?php _e( 'Search our products', 'storms' ); ?>"
							   value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php echo esc_attr( $label_input ); ?>" autocomplete="off" />

						<?php $loader_image = \StormsFramework\Helper::get_asset_url('/img/spinner.gif'); ?>
						<span class="storms-wc-searchbar-loader-image hidden" style="background-image:url('<?php echo esc_url( $loader_image ) ?>');" ></span>

						<?php if( 'append' === $dropdown_position ): ?>
							<?php $this->get_categories_dropdown( $label_dropdown, $type, $hide_empty ); ?>
						<?php endif; ?>

						<button type="submit" id="searchsubmit" class="btn btn-outline-secondary search-submit-button">
							<i class="bi bi-search" aria-hidden="true"></i> <?php esc_attr_e( $search_button_text ); ?>
						</button>
					</div>

					<?php if( 'blog' === $type ): ?>
						<input type="hidden" disabled="disabled" value="" name="cat" />
					<?php else: ?>
						<input type="hidden" name="post_type" value="product">
						<input type="hidden" disabled="disabled" value="" name="product_cat" />
					<?php  endif;?>

				</form>
				<div class="storms-wc-searchbar-results-container hidden">
					<div class="storms-wc-searchbar-results"></div>
				</div>
			</div>
			<?php
			$this->widget_end( $args );
			echo ob_get_clean();
		}

		/**
		 * Register the scripts for the searchbar
		 */
		public function register_scripts() {

			wp_enqueue_script( 'storms-wc-searchbar-script',
				\StormsFramework\Helper::get_asset_url('/js/storms-wc-searchbar' . ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min' ) . '.js' ),
				array(), STORMS_FRAMEWORK_VERSION, true );

			// Add WordPress data to a Javascript file
			wp_localize_script('storms-wc-searchbar-script', 'storms_wc_searchbar_vars', [
				'ajax_url' 					=> admin_url('admin-ajax.php'),
				//'wc_ajax_url' 				=> WC_AJAX::get_endpoint( "%%endpoint%%" ),
				'storms_wc_searchbar_nonce' => wp_create_nonce( 'storms-wc-searchbar' ),
				'debug_mode' 				=> defined('WP_DEBUG') && WP_DEBUG,
			]);

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
			<button id="storms-wc-searchbar-dropdown" class="btn btn-outline-secondary dropdown-toggle categories-dropdown-btn" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
				<?php echo esc_attr( $label_dropdown ); ?> <span class="caret"></span>
			</button>
			<div class="dropdown-menu" role="menu" aria-labelledby="storms-wc-searchbar-dropdown">
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

	function storms_wc_searchbar_load_posts() {
		if ( ! is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_POST['action'] ) && 'storms_wc_searchbar_load_posts' == $_POST['action'] ) ) {

			if ( ! wp_verify_nonce( $_POST['security'], 'storms-wc-searchbar' ) ) {
				throw new Exception( __( 'Security check failed', 'storms' ) );
			}

			$posts_per_page = 5;
			$page = 1;

			$query_args = apply_filters( 'is_customize_register_args', array(
				// Query performance optimization.
				'fields'         	=> 'ids',
				'no_found_rows'  	=> true,
				'order'		 		=> 'DESC',
				'suppress_filters' 	=> true,
				'post__in'			=> false,
				'publish' 			=> 'publish',
				'inherit' 			=> 'inherit',
				'posts_per_page'	=> $posts_per_page,
				'paged'				=> $page,
				's' => esc_attr( $_POST['s'] ),
				'post_type'  => esc_attr( $_POST['post_type'] ),
			));

			$the_query = new WP_Query( $query_args );

			if( \StormsFramework\Helper::is_plugin_activated( 'relevanssi/relevanssi.php' ) ) {
				$posts_ids = relevanssi_do_query( $the_query );
			} else {
				$posts_ids = $the_query->posts;
			}

			// TODO We should keep the list of words the users search for...
			$date = (new \DateTime( 'now', new \DateTimeZone( 'America/Sao_Paulo' ) ))->format( 'Y-m-d H:i:s' );
			//\StormsFramework\Helper::debug( $date . ' - User is searching for: ' . $the_query->query['s'] );
			//\StormsFramework\Helper::debug( $_POST );

			if( ! empty( $posts_ids ) ) {

				$results = '<div class="storms-wc-searchbar-results-wrapper">';
				foreach( $posts_ids as $post_id ) {
					$product = wc_get_product( $post_id );

					$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'woocommerce_thumbnail' );

					$results .= '<div class="storms-wc-searchbar-result">';
					$results .= '	<div class="storms-wc-searchbar-result-image">';
					$results .= '		<a href="' . esc_url( get_post_permalink( $post_id ) ) . '">';
					$results .= '			<img src="' . esc_url( $img[0] ) . '" width="60" height="60">';
					$results .= '		</a>';
					$results .= '	</div>';
					$results .= '	<div class="storms-wc-searchbar-result-text">';
					$results .= '		<a href="' . esc_url( get_post_permalink( $post_id ) ) . '">';
					$results .= '			<h4>' . $product->get_name() . '</h4>';
					$results .= '			<p>' . wp_trim_words( $product->get_short_description(), 20, '...' ) . '</p>';
					$results .= '		</a>';
					$results .= '	</div>';
					$results .= '</div>';
				}
				$results .= '</div>';

				if( $the_query->found_posts > $posts_per_page ) {
					$results .= '</div>';
					$results .= '<div class="storms-wc-searchbar-show-more-results">';
					$results .= 	'<div class="storms-wc-searchbar-show-more-results-text">' . __( 'Mostrar mais resultados...', 'storms' ) . ' <span>(' . ( $the_query->found_posts - ( $posts_per_page * $page ) ) . ')</span></div>';
					$results .= '</div>';
				}

				echo $results;
			} else {
				echo '<div class="storms-wc-searchbar-ajax-search-no-result">' . __( 'Não encontramos nenhum resultado!', 'storms' ) . '</div>';
			}

			wp_reset_postdata();

			die();
		}
	}
	add_action( 'wp_ajax_storms_wc_searchbar_load_posts' , 'storms_wc_searchbar_load_posts' );
	add_action( 'wp_ajax_nopriv_storms_wc_searchbar_load_posts', 'storms_wc_searchbar_load_posts' );

	// Change the Default Search URL Slug
	function storms_change_search_url() {
		if ( is_search() && ! empty( $_GET['s'] ) ) {

			$redirect_url = home_url( '/' . __( 'search', 'storms' ) . '/' ) . urlencode( get_query_var( 's' ) );

			// Needed for WooCommerce search
			if( 'product' === $_GET['post_type'] ) {
				$redirect_url .= '?post_type=product';
			}

			wp_redirect( $redirect_url );
			exit();
		}
	}
	add_action( 'template_redirect', 'storms_change_search_url' );

}
