(function ($) {
	'use strict';
	var Property_Advanced_Search_Handler = function ($) {
		ERE_Property_Advanced_Search.init();
	};
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/beyot-property-advanced-search.default', Property_Advanced_Search_Handler);
	});
})(jQuery);