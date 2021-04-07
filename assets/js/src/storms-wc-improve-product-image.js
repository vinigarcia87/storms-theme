
document.body.addEventListener( 'click', function( event ) {

	if( event.target.classList.contains( 'zoomImg' ) &&
		event.target.closest( '.woocommerce-product-gallery__wrapper' ) ) {
		// Open lightbox on image click
		document.querySelector( '.woocommerce-product-gallery__trigger' ).click();
	}

}, false );
