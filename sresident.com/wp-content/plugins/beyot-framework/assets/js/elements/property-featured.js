(function ($) {
    'use strict';
    var Property_Featured_Handler = function ($scope, $) {
        ERE_property_featured.init();
        ERE_Carousel.init();
    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/beyot-property-featured.default', Property_Featured_Handler);
    });

})(jQuery);