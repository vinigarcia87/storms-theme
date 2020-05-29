// WC Product Categories
jQuery( function( $ ) {

    // Ao abrir uma categoria pai, animamos a exibicao das categorias filhas - Depende do Animate.css
    $( '.widget_product_categories .product-categories > li.cat-parent' ).on('click','> a', function(evt) {
        evt.preventDefault();
        $(this).nextAll('.children')
				.removeClass('animated fadeInLeft')
				.addClass('animated fadeInLeft')
				.parent()
				.toggleClass('open')
				.siblings('.open')
				.removeClass('open');
    });

} );
