/**
 * Function that add a class on body, to identify the current bootstrap media query
 * @see https://stackoverflow.com/a/53925202/1003020
 */
/* global storms_media_query_breakpoints_vars */
jQuery( function( $ ) {

	// storms_media_query_breakpoints_vars is required to continue, ensure the object exists
	if ( typeof storms_media_query_breakpoints_vars === 'undefined' ) {
		return false;
	}

	var storms_device_detector = function() {

		var $body = $( 'body' );
		var $mqDetector = $( 'div.mq-detector' );
		if( $mqDetector.length === 0 ) {
			$body.append( _mqDetector() );
			$mqDetector = $( 'div.mq-detector' );

			function _mqDetector() {
				return `<div class="mq-detector invisible" style="width: 0; height: 0;">
						<div class="d-block d-sm-none" 			 data-type="xs"></div>
						<div class="d-none d-sm-block d-md-none" data-type="sm"></div>
						<div class="d-none d-md-block d-lg-none" data-type="md"></div>
						<div class="d-none d-lg-block d-xl-none" data-type="lg"></div>
						<div class="d-none d-xl-block" 			 data-type="xl"></div>
					  </div>`;
			}
		}
		var screen_type = $mqDetector.children().filter( ':visible' ).data( 'type' );
		$mqDetector.remove();

		$body
			.removeClass( function( index, css ) {
				return ( css.match (/\bsts-media-\S+/g) || [] ).join(' '); // removes anything that starts with "sts-media-"
			} )
			.addClass( 'sts-media-' + screen_type );

		return screen_type;
	};

	storms_device_detector();
	if( storms_media_query_breakpoints_vars.resizeMonitor ) {
		$(window).on('resize', storms_device_detector);
	}

} );

