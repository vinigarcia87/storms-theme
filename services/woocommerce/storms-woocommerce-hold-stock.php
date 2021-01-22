<?php
/**
 * Storms Websolutions (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2020, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   4.0.0
 *
 * Storms WooCommerce YITH Wishlist file
 * This code customize the YITH Wishlist
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( \StormsFramework\Helper::is_woocommerce_activated() ) {

	if (!function_exists('storms_define_woocommerce_hold_stock_options')) {

		function storms_define_woocommerce_hold_stock_options() {

			// Only setup if user is an admin
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$day_in_minutes = DAY_IN_SECONDS / 60;

			// Manter estoque (minutos)
			$held_duration = strval( .5 * $day_in_minutes ); // 1/2 dia - Este processamento irá rodar 2x ao dia

			if( $held_duration !== get_option( 'woocommerce_hold_stock_minutes' ) ) {

				wp_clear_scheduled_hook( 'woocommerce_cancel_unpaid_orders' );

				if ( '' !== $held_duration ) {
					wp_schedule_single_event( time() + ( absint( $held_duration ) * 60 ), 'woocommerce_cancel_unpaid_orders' );
				}

				update_option( 'woocommerce_hold_stock_minutes', $held_duration );
			}

			// Pedidos nao pagos com mais de 3 dias serao cancelados
			update_option( 'storms_wc_cancel_unpaid_expired_orders_delay_time', strval( 3 * $day_in_minutes ) );
		}

		add_action( 'admin_init', 'storms_define_woocommerce_hold_stock_options' );

	}

	if( \StormsFramework\Helper::is_plugin_activated( 'storms-holidays/storms-holidays.php' ) ) {

		/**
		 * List all national holidays for the current year
		 *
		 * @return array|object|null
		 * @throws Exception
		 */
		function storms_get_current_year_national_holidays( $holidays = [] ) {
			global $wpdb;

			$wpdb_table = $wpdb->prefix . 'storms_holidays';
			$query = "SELECT date, name, type, country, state, city, ID
                  	  FROM $wpdb_table WHERE YEAR( date ) = YEAR( CURRENT_DATE() ) AND country = %s AND type = %s
                  	  ORDER BY date ASC";
			$query = $wpdb->prepare( $query, 'BR', 'Nacional' );

			// Query output_type will be an associative array with ARRAY_A.
			$holidays = $wpdb->get_results( $query, ARRAY_A  );

			// Convert into array of dates
			if( ! empty( $holidays ) ) {
				return array_column( $holidays, 'date' );
			}
			return $holidays;
		}

	}

	/**
	 *
	 * @source https://stackoverflow.com/a/55793020/1003020
	 * @see \wc_cancel_unpaid_orders
	 * @see \WC_Install::create_cron_jobs
	 *
	 * @throws Exception
	 */
	function storms_wc_cancel_unpaid_expired_orders() {

		$day_in_minutes = DAY_IN_SECONDS / 60;
		$held_duration = absint( get_option( 'woocommerce_hold_stock_minutes', 1 * $day_in_minutes ) ); // 1 dia - Este processamento irá rodar 1x pro dia

		wp_clear_scheduled_hook( 'woocommerce_cancel_unpaid_orders' );
		wp_schedule_single_event( time() + ( absint( $held_duration ) * 60 ), 'woocommerce_cancel_unpaid_orders' );

		// Orders that had waited for payment more than the delay time will be automatically cancelled
		$boleto_processing_days = get_option( 'storms_wc_boleto_processing_days', 3 ); // Aguardamos o pgto do boleto processar por tres dias
		$boleto_due_to_working_days = get_option( 'storms_wc_boleto_due_to_working_days', 3 ); // Boletos tem vencimento de tres dias uteis apos a emissao

		$current_time = ( new DateTime( 'now', new DateTimeZone( 'America/Sao_Paulo' ) ) );

		$holidays = storms_get_current_year_national_holidays();

		/**
		 * Handle a custom query var to get orders with the __( 'Payment type', 'woocommerce-pagseguro' ) meta.
		 *
		 * @param array $query - Args for WP_Query.
		 * @param array $query_vars - Query vars from WC_Order_Query.
		 * @return array modified $query
		 */
		function storms_wc_cancel_unpaid_expired_orders_handle_custom_query_var( $query, $query_vars ) {
			$field = __( 'Payment type', 'woocommerce-pagseguro' );
			if ( ! empty( $query_vars[$field] ) ) {
				$query['meta_query'][] = array(
					'key'   => $field,
					'value' => esc_attr( $query_vars[$field] ),
				);
			}

			return $query;
		}
		add_filter( 'woocommerce_order_data_store_cpt_get_orders_query', 'storms_wc_cancel_unpaid_expired_orders_handle_custom_query_var', 10, 2 );

		// List all unpaid orders (status 'on-hold' or 'pending') that were paid with boleto
		// @source https://github.com/woocommerce/woocommerce/wiki/wc_get_orders-and-WC_Order_Query
		$args = array(
			'limit'        => -1,
			'status' 	   => [ 'wc-pending', 'wc-on-hold' ],
			__( 'Payment type', 'woocommerce-pagseguro' ) => 'boleto',
		);
		$unpaid_orders = wc_get_orders( $args );

		$log_msg[] = 'Running storms_wc_cancel_unpaid_expired_orders at ' . $current_time->format( 'Y-m-d H:i:s' );
		$log_msg[] = 'Found ' . count( $unpaid_orders ) . ' unpaid orders';

		if ( $unpaid_orders ) {
			foreach ( $unpaid_orders as $unpaid_order ) {

				$order_boleto_due_to_date = \StormsFramework\Helper::get_next_working_day( $unpaid_order->get_date_created(), $boleto_due_to_working_days, $holidays );
				$order_boleto_max_processing_date = ( new DateTime( $order_boleto_due_to_date->format( 'Y-m-d' ) ) )->add( new DateInterval( 'P' . $boleto_processing_days .'D' ) );

				// If max processing date has passed, we will cancel this order
				if( $current_time > $order_boleto_max_processing_date ) {

					// Cancel the order
					$unpaid_order->update_status( 'cancelled', __( 'The order was cancelled due to no payment from customer.', 'storms' ) );

					// Increase stock for billets
					wc_increase_stock_levels( $unpaid_order->get_id() );

					// Add a note
					$unpaid_order->add_order_note( __( 'O pedido foi cancelado, pois o tempo de espera do boleto se passou e nenhum pagamento foi registrado', 'storms' ) );

					$log_msg[] = 'Canceling order #' . $unpaid_order->get_id() . ' Payment type: ' . $unpaid_order->get_meta( __( 'Payment type', 'woocommerce-pagseguro' ) ) . ' ( Created on: ' . $unpaid_order->get_date_created()->format( 'Y-m-d H:i:s' ) . ' Boleto due to: ' . $order_boleto_due_to_date->format( 'Y-m-d' ) . ' - Max processing date: ' . $order_boleto_max_processing_date->format( 'Y-m-d' ) . ') with status ' . $unpaid_order->get_status();
				}
			}

			$log = wc_get_logger();
			$log->info( implode( '; ', $log_msg ), [ 'source' => 'storms-cancel-unpaid-orders' ] );
		}

	}

	add_action( 'woocommerce_cancel_unpaid_orders', 'storms_wc_cancel_unpaid_expired_orders', 10 );
	remove_action( 'woocommerce_cancel_unpaid_orders', 'wc_cancel_unpaid_orders' );

}
