
(function ($) {
    'use strict';
    var Post_Handler = function ($scope,$) {
        G5Plus.common.owlCarousel();
    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/beyot-posts.default', Post_Handler);
    });

})(jQuery);