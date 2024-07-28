(function ($) {
    'use strict';
    var Property_Gallery_Handler = function ($scope,$) {
        ERE_Carousel.init($scope);
        ERE_property_gallery.init();
    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/beyot-property-gallery.default', Property_Gallery_Handler);
    });

})(jQuery);