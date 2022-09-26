/**
 * Function that add a class on body, to identify the current bootstrap media query
 * @see https://stackoverflow.com/a/53925202/1003020
 */
/* global storms_media_query_breakpoints_vars */

window.addEventListener( 'DOMContentLoaded', function() {

	// storms_media_query_breakpoints_vars is required to continue, ensure the object exists
	if ( typeof storms_media_query_breakpoints_vars === 'undefined' ) {
		return false;
	}

	function _mqDetector() {

		var mqDetector = document.createElement( 'div' );
		mqDetector.classList.add( 'mq-detector' );
		mqDetector.classList.add( 'invisible' );
		mqDetector.style.cssText = 'width: 0; height: 0;';

		mqDetector.innerHTML =
			'<div class="d-block d-sm-none" 		   data-type="xs"></div>' +
			'<div class="d-none d-sm-block d-md-none"  data-type="sm"></div>' +
			'<div class="d-none d-md-block d-lg-none"  data-type="md"></div>' +
			'<div class="d-none d-lg-block d-xl-none"  data-type="lg"></div>' +
			'<div class="d-none d-xl-block d-xxl-none" data-type="xl"></div>' +
			'<div class="d-none d-xxl-block"           data-type="xxl"></div>';

		return mqDetector;
	}

	function storms_device_detector() {

		var body = document.body;
		var mqDetector = document.querySelector( 'div.mq-detector' );

		if( mqDetector === null ) {
			body.appendChild( _mqDetector() );
			mqDetector = document.querySelector( 'div.mq-detector' );
		}

		// Get witch div is visible
		var screen_type = Array.from( mqDetector.children ).filter(  el => el.offsetWidth > 0 || el.offsetHeight > 0 || el.getClientRects().length > 0  )[0].getAttribute( 'data-type' );

		// Remove the element
		mqDetector.remove();

		// removes anything that starts with "sts-media-"
		document.body.className = body.className.replace( /\bsts-media-\S+/g, '' );

		// Adds class with the current screen type
		body.classList.add( 'sts-media-' + screen_type );

		return screen_type;
	}

	storms_device_detector();

	if( storms_media_query_breakpoints_vars.resizeMonitor ) {
		window.addEventListener( 'resize', storms_device_detector );
	}

} );
