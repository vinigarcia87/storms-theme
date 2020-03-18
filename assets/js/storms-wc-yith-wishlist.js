/**
 * Wishlist - Count number of products wishlist in ajax
 * @see https://support.yithemes.com/hc/en-us/articles/115001372967-Wishlist-How-to-count-number-of-products-wishlist-in-ajax
 */
/* global storms_wc_yith_wishlist_vars */
jQuery( function( $ ) {

	// storms_vars is required to continue, ensure the object exists
	if ( typeof storms_wc_yith_wishlist_vars === 'undefined' ) {
		return false;
	}

    $( document ).on( 'added_to_wishlist removed_from_wishlist added_to_cart', function() {
        var counter = $( '.wishlist-counter' );

        $.ajax( {
            url: storms_wc_yith_wishlist_vars.ajax_url,
            data: {
                action: 'yith_wcwl_update_wishlist_count'
            },
            dataType: 'json',
            success: function( data ){
                counter.html( data.count );
            },
            beforeSend: function() {
                //counter.block();
            },
            complete: function() {
                //counter.unblock();
            }
        } );
    } );

} );
