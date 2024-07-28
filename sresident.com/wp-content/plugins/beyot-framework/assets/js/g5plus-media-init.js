var g5plus_media = g5plus_media || {};
(function ($) {
	"use strict";
	g5plus_media = {
		init: function () {
			$(document).on('click','[data-toggle="browse-image"]',function (event) {
				event.preventDefault();

				// check for media manager instance
				if(wp.media.frames.gk_frame) {
					wp.media.frames.gk_frame.open();
					wp.media.frames.gk_frame.clicked_button = $(this);
					return;
				}

				// configuration of the media manager new instance
				wp.media.frames.gk_frame = wp.media({
					title: 'Select image',
					multiple: false,
					library: {
						type: 'image'
					},
					button: {
						text: 'Use selected image'
					}
				});

				wp.media.frames.gk_frame.clicked_button = $(this);

				var gk_media_set_image = function() {
					var selection = wp.media.frames.gk_frame.state().get('selection');

					// no selection
					if (!selection) {
						return;
					}

					// iterate through selected elements
					selection.each(function(attachment) {
						var url = attachment.attributes.url;
						wp.media.frames.gk_frame.clicked_button.parent().find('input').val(url).trigger('change');
					});
				};

				// closing event for media manger
				//wp.media.frames.gk_frame.on('close', gk_media_set_image);
				// image selection event
				wp.media.frames.gk_frame.on('select', gk_media_set_image);
				// showing media manager
				wp.media.frames.gk_frame.open();
			});
		}
	};

	$(document).ready(function () {
		g5plus_media.init();
	});

})(jQuery);