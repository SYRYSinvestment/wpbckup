(function ($) {
	'use strict';
	var Property_Search_Map_Handler = function ($) {
		ERE_Property_Search_Map.init();
	};
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/beyot-property-search-map.default', Property_Search_Map_Handler);
	});
})(jQuery);