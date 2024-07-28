(function ($) {
    'use strict';
    var Property_Handler = function ($scope,$) {
        ERE.execute_nav();
        ERE_Carousel.init();
    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/beyot-property-carousel.default', Property_Handler);
    });

})(jQuery);