(function ($) {
	"use strict";
	var G5Plus_PFUI = G5Plus_PFUI || {},
		post_format = ['audio','gallery','link','quote','video'];


	G5Plus_PFUI.onReady = {
		init : function() {
			G5Plus_PFUI.postFormats.init();
			G5Plus_PFUI.media.init();
		}
	};

	G5Plus_PFUI.postFormats = {
		init : function() {
			setTimeout(function () {
				$('.editor-post-format select').trigger('change');
				$('[name="post_format"]:checked').trigger('change')
			},1000);

			$(document).on('change','.editor-post-format select',function (event) {
				G5Plus_PFUI.postFormats.switch_post_format_content($(this).val());
			});

			$('[name="post_format"]').on('change',function(){
				G5Plus_PFUI.postFormats.switch_post_format_content($(this).val());
			});
		},

		switch_post_format_content : function($post_format) {
			$('[id^="g5plus-pfui-post-format-"]').hide();
			$('#g5plus-pfui-post-format-' + $post_format).show();

		}
	};

	G5Plus_PFUI.media = {
		_frame : null,
		init : function() {
			$('#wpbody').on('click', '.g5plus-pfui-gallery-button', function(e){
				e.preventDefault();
				G5Plus_PFUI.media.frame().open();
			});

			this.event();
		},
		event : function() {
			var $gallery = $('.g5plus-pfui-gallery-picker .gallery');

			$gallery.on('update', function(){
				var ids = [];
				$(this).find('> span').each(function(){
					ids.push($(this).data('id'));
				});
				$('[name="g5plus_format_gallery_images"]').val(ids.join(','));
			});

			$gallery.sortable({
				placeholder: "g5plus-pfui-ui-state-highlight",
				revert: 200,
				tolerance: 'pointer',
				stop: function () {
					$gallery.trigger('update');
				}
			});

			$gallery.on('click', 'span.close', function(e){
				$(this).parent().fadeOut(200, function(){
					$(this).remove();
					$gallery.trigger('update');
				});
			});
		},
		frame : function() {
			if (this._frame) {
				return this._frame;
			}

			this._frame = wp.media({
				title : g5plus_pfui_post_format.media_title,
				library : {
					type : 'image'
				},
				button : {
					text : g5plus_pfui_post_format.media_button
				},
				multiple : true
			});
			this._frame.on('open', this.updateFrame).state('library').on('select', this.select);
			return this._frame;
		},
		select : function() {
			var selection = this.get('selection'),
				$gallery = $('.g5plus-pfui-gallery-picker .gallery');

			selection.each(function(model) {
				var thumbnail = model.attributes.url;
				if( model.attributes.sizes !== undefined && model.attributes.sizes.thumbnail !== undefined )
					thumbnail = model.attributes.sizes.thumbnail.url;
				$gallery.append('<span data-id="' + model.id + '" title="' + model.attributes.title + '"><img src="' + thumbnail + '" alt="" /><span class="close">x</span></span>');
				$gallery.trigger('update');
			});
		},
		updateFrame: function() {

		}

	};


	$(document).ready(G5Plus_PFUI.onReady.init);
	//$(window).load(G5Plus.onLoad.init);

})(jQuery);
