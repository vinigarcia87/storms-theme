/**
 * Observer to help stick the menu element to the top
 * @see https://stackoverflow.com/a/56678169/1003020
 * @see https://www.youtube.com/watch?v=RxnV9Xcw914
 */

if( 'IntersectionObserver' in window ) {

	const sticky_el = document.querySelector('[data-toggle="sticky-onscroll"]'); // This is the menu we wanna stick

	if( sticky_el ) {

		// Check if the WP adminbar is present
		const has_wp_adminbar = document.querySelector('body').classList.contains('admin-bar');

		const body = document.querySelector('body');
		const header_el = document.querySelector('header > div'); // This is the element right on top of the menu we wanna stick
		const wrap_el = document.querySelector('#wrap'); // This is the element right after the menu we wanna stick

		// The height of the sticky menu
		const margin = sticky_el.offsetHeight;
		const offsetTop = sticky_el.offsetTop;

		const headerObserverOptions = {
			//rootMargin: (has_wp_adminbar ? '-' + offsetTop + 'px' : '0px')
		};

		const headerObserver = new IntersectionObserver(
			function (entries, headerObserver) {
				entries.forEach(entry => {

					// Try to identify what size is the user's device
					const body_class_list = body.classList;
					const is_device_xs = body_class_list.contains('sts-media-xs');
					const is_device_sm = body_class_list.contains('sts-media-sm');
					const is_device_md = body_class_list.contains('sts-media-md');
					const is_device_lg = body_class_list.contains('sts-media-lg');
					const is_device_xl = body_class_list.contains('sts-media-xl');
					// Maybe we couldn't identify the device's size
					const is_device_unknown = ! is_device_xs && ! is_device_sm && ! is_device_md && ! is_device_lg && ! is_device_xl;

					// Avoid this behaviour on specific media sizes
					// TODO Make this filter customizable
					if( is_device_xs || is_device_sm || is_device_md || is_device_lg ) {
						sticky_el.classList.add('position-static');
						sticky_el.classList.remove('fixed-top');

						body.classList.remove('has-fixed-menu');

						wrap_el.style.marginTop = "0";

						return;
					}

					// When the element right on top the menu is out of the viewport, we stick the menu
					if (!entry.isIntersecting) {
						// Add classes to stick the menu
						sticky_el.classList.remove('position-static');
						sticky_el.classList.add('fixed-top');

						// Add class to body, informing that we have a fixed element
						body.classList.add('has-fixed-menu');

						// Fix the position of the wrap element, so the screen don't "jump"
						wrap_el.style.marginTop = margin.toString() + 'px';
					} else {
						// When the element right on top the menu is back, whe unstick the menu
						sticky_el.classList.add('position-static');
						sticky_el.classList.remove('fixed-top');

						body.classList.remove('has-fixed-menu');

						wrap_el.style.marginTop = '0';
					}
				});
			},
			headerObserverOptions);

		headerObserver.observe( header_el );
	}
}
