
(function ($) {
    'use strict';
    var Property_Handler = function ($scope,$) {
        ERE.move_link_to_carousel($scope);
        ERE_Carousel.init($scope);
    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/beyot-property.default', Property_Handler);
    });

})(jQuery);