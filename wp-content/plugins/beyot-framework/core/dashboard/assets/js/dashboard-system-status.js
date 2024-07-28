(function ($) {
	"use strict";
	var GF_Dashboard_System_Status = function() {
		this.init();
	};
	GF_Dashboard_System_Status.prototype = {
		init: function() {
			this.tooltips();
			this.get_status_report();
			this.copy();
			this.textarea_click();
		},
		tooltips: function() {
			if ($().powerTip) {
				var options = {};
				$('.gf-tooltip').powerTip(options);
			}
		},
		get_status_report : function() {
			var self = this;
			$('.gf-debug-report').on('click', function (event) {
				event.preventDefault();
				var $wrap = $(this).closest('.gf-system-status-info'),
					$parent = $(this).closest('.gf-system-info'),
					$info = $wrap.find('.gf-system-report');

				var report = '';
				$('.gf-box:not(.gf-copy-system-status)', '.system-status').each(function () {
					var $heading = $(this).find('.gf-box-head'),
						$system_status = $(this).find('.gf-system-status-list');
					report += "\n### " + $.trim($heading.text()) + " ###\n\n";

					$('li', $system_status).each(function () {
						var $label = $(this).find('.gf-label'),
							$info = $(this).find('.gf-info'),
							the_name = $.trim($label.text()).replace(/(<([^>]+)>)/ig, ''),
							the_value = $.trim($info.text()).replace(/(<([^>]+)>)/ig, '');

						report += '' + the_name + ': ' + the_value + "\n";

					});

				});
				$('.gf-system-report textarea[name="system-report"]').val(report);

				$parent.slideUp("slow", function () {
					$info.slideDown('slow',function() {
						self.select_all();
					});
				});
			});
		},
		select_all : function() {
			$('.gf-system-report textarea[name="system-report"]').focus().select();
		},
		copy : function() {
			var self = this;
			$(".gf-copy-system-report").on('click', function (e) {
				e.preventDefault();
				self.select_all();
				document.execCommand('copy');
			});
		},
		textarea_click: function () {
			var self = this;
			$('.gf-system-report textarea[name="system-report"]').on('click',function () {
				self.select_all();
			});
		}

	};

	$(document).ready(function(){
		new GF_Dashboard_System_Status();
	});
})(jQuery);
