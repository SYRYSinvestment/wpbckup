(function ($) {
    'use strict';
    var Agents_Handler = function ($scope, $) {
        ERE_Carousel.init($scope);
    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/beyot-agents.default', Agents_Handler);
    });

})(jQuery);
