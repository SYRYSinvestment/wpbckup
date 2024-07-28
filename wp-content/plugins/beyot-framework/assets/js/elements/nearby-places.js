(function ($) {
	'use strict';
	var Nearby_Places_Handler = function ($scope,$) {
		$('.g5plus-nearby-places',$scope).each(function () {
			new G5Plus_Nearby_Places(this);
		});

		typeof (google) !== 'undefined' && google.maps.event.addDomListener(window, 'load', function () {


		});
	};
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/beyot-nearby-places.default', Nearby_Places_Handler);
	});

})(jQuery);