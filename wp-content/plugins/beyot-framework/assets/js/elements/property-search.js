(function ($) {
	'use strict';
	var Property_Search_Handler = function ($scope,$) {
		if ($scope.find('.ere-search-properties-map').length > 0) {
			ERE_Property_Map_Search.init();
		} else {
			ERE_Property_Search.init();
		}
	};
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/beyot-property-search.default', Property_Search_Handler);
	});
})(jQuery);