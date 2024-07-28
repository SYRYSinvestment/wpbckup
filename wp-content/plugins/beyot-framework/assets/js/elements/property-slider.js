(function ($) {
    'use strict';
    var Property_Slider_Handler = function ($scope, $) {
        ERE_Carousel.init($scope);
        ERE.init($scope);
    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/beyot-property-slider.default', Property_Slider_Handler);
    });

})(jQuery);