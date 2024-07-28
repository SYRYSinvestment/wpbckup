(function ($) {
	"use strict";

	var GF_Widget_Areas = {
		init : function() {
			$('.gf-sidebars-wrap .gf-sidebars-remove-item').on('click', function () {
				var $this = $(this);
				if (confirm(gf_widget_areas_variable.confirm_delete)) {
					var widget_name = $this.data('id');

					$.ajax({
						type: "POST",
						url: gf_widget_areas_variable.ajax_url,
						data: {
							name: widget_name
						},
						success: function (response) {
							if (response.trim() == 'widget-area-deleted') {
								$this.closest('tr').slideUp(200).remove();
							}
						}
					});
				}
			});
		}
	};

	$(function () {
		GF_Widget_Areas.init();
	});
})(jQuery);
