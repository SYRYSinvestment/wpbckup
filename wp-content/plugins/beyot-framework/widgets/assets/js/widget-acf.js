var G5Plus_Widget_Acf = G5Plus_Widget_Acf || {};
(function($){
	"use strict";
	G5Plus_Widget_Acf = {
		init : function() {
			this.collapse();
			this.changeTitle();
			this.addSection();
			this.deleteSection();
			var $wrap = $('.widget_acf_wrap');
			this.initSelect2($wrap);
			this.uploadImage();
			this.initCheckbox($wrap);
			this.registerRequireElement($wrap);
			$('input, select', $wrap).each(function () {
				G5Plus_Widget_Acf.initRequireElement($(this));
			});
			this.sortable();
		},
		sortable : function() {
			if ($.isFunction($.fn.sortable)){
				$('.accordion-wrap').sortable({
					update: function(){
						G5Plus_Widget_Acf.reIndexSection($('.widget_acf_wrap'));
					}
				});
			}
		},
		collapse : function() {
			var $title = $('h3.title','.widget_acf_accordion');
			$title.off('click').on('click',function(){
				var $parent = $(this).parent();
				var $fieldset = $('.fieldset', $parent);
				var $collapse = $fieldset.attr('data-collapse');
				if ((typeof $collapse) == 'undefined' || $collapse == '1') {
					$fieldset.slideDown();
					$fieldset.attr('data-collapse', '0');
					$('span', jQuery(this)).removeClass('collapse-in');
					$('span', jQuery(this)).addClass('collapse-out');
				} else {
					$fieldset.slideUp();
					$fieldset.attr('data-collapse', '1');
					$('span', jQuery(this)).removeClass('collapse-out');
					$('span', jQuery(this)).addClass('collapse-in');
				}
			});
		},
		changeTitle : function() {
			$('input[data-title="1"]', '.widget_acf_accordion').off('keyup').on('keyup',function(){
				var $title = $(this).val();
				var $parent = $(this).attr('data-section-id');
				if ($title == ''){
					$title = 'New Section';
				}
				$('span:last-child', '#' + $parent + ' h3.title').text($title);
			});
		},
		addSection : function() {
			$('.button.add', '.widget_acf_wrap').off('click').on('click',function(){
				var $data_section_wrap = $(this).parent().parent();
				var $section = $('.widget_acf_accordion', $data_section_wrap).last().clone(true);
				$('input,textarea', $($section)).each(function () {
					$(this).val('');
				});
				$('.media img', $section).remove();
				$('.media .remove-media', $section).remove();
				$('.icon-preview i',$section).attr('class','');

				$('h3.title span', $section).last().html('New Section');
				$('.fieldset', $section).attr('data-collapse', 0);
				$('.fieldset', $section).show();
				$('input', $section).first().focus();
				$('.widget_acf_accordion', $data_section_wrap).last().after($section);

				G5Plus_Widget_Acf.reIndexSection($(this));

				var $wrap = $('.widget_acf_accordion', $data_section_wrap).last();
				$('div.select-wrap', $wrap).each(function () {
					var $label = $('label', $(this)).clone(false);
					var $select = $('select', $(this)).clone(false);
					var $input = $('input[type="hidden"]', $(this)).clone(false);
					$select.removeClass('select2-offscreen');
					$(this).empty();
					if (typeof $label != 'undefined') {
						$(this).append($label);
					}
					if (typeof $input != 'undefined') {
						$(this).append($input);
					}
					if (typeof $select != 'undefined') {
						$(this).append($select);
					}

				});
				G5Plus_Widget_Acf.initSelect2($wrap);
				G5Plus_Widget_Acf.initCheckbox($wrap);
				G5Plus_Widget_Acf.registerRequireElement($wrap);
			});
		},
		deleteSection : function(){
			$('.button.deletion', '.widget_acf_wrap').off('click').on('click',function(){
				var $wrap = $(this).parent().parent().parent().parent();
				var $items = $('.widget_acf_accordion', $($wrap)).length;
				var $data_section_id = $(this).parent().parent().parent();
				if ($items > 1) {
					$($data_section_id).remove();
					G5Plus_Widget_Acf.reIndexSection($(this));
				} else {
					$('input', $($wrap)).each(function () {
						$(this).val('');
					});
					$('h3.title span', $($wrap)).last().html('New Section');
				}
			});
		},
		reIndexSection : function($elm_raise_event) {
			var $wrap = '.widget_acf_wrap';
			var $section = '.widget_acf_accordion';
			var $prefix_id = 'widget_acf_accordion_';
			$($section, $wrap).each(function ($index) {
				$index--;
				$(this).attr('id', $prefix_id + $index);
				$('input,textarea', $(this)).each(function () {
					if (typeof $(this).attr('name') != 'undefined') {
						$(this).attr(
							"name", $(this).attr("name").replace(/\[(\d+)\](?!.*\[\d+\])/, '[' + $index + ']')
						);
					}

					if (typeof($(this).attr('id'))  != 'undefined'){
						$(this).attr(
							"id", $(this).attr("id").replace(/[0-9]$/, $index)
						);
					}

					$(this).attr(
						"data-section-id", ($prefix_id + $index)
					);

				});

				$('div[data-require-element-id]', $(this)).each(function () {
					$(this).attr(
						"data-require-element-id", $(this).attr("data-require-element-id").replace(/[0-9]$/, $index)
					);
				});


				$('select', $(this)).each(function () {
					if (typeof $(this).attr('name') != 'undefined') {
						$(this).attr(
							"name", jQuery(this).attr("name").replace(/\[(\d+)\](?!.*\[\d+\])/, '[' + $index + ']')
						);
					}
					$(this).attr(
						"id", $(this).attr("id").replace(/[0-9]$/, $index)
					);
				});
				$('a.button.deletion').each(function () {
					$(this).attr(
						"data-section-id", ($prefix_id + $index)
					);
				});
			});
		},
		initSelect2 : function($wrap) {
			if ($.isFunction(jQuery.fn.select2)) {
				$('select.select2', $wrap).each(function () {
					var id = $(this).attr('id');
					var divSelect2 = $(this).next();
					if (typeof (divSelect2) != 'undefined') {
						divSelect2.remove();
					}
					$(this).select2({width : '100%'});

					var $multiple = $(this).attr('data-multiple');
					if (typeof($multiple) != 'undefined' && $multiple == '1') {

						var $input = $('input', $(this).parent()).first();
						var $values = $($input).val();
						$(this).val($values.split(',')).trigger('change');
						$(this).on('select2:selecting',function(e){
							var ids = $(this).val();
							if (typeof (ids) == 'undefined' || ids == null)
								ids = '';
							if (ids != "") {
								ids += ",";
							}
							ids += e.params.args.data.id;
							$($input).val(ids);
						});

						$(this).on('select2:unselecting',function(e){
							var ids = $($input).val();
							var arr_ids = ids.split(",");
							var newIds = "";
							for (var i = 0; i < arr_ids.length; i++) {
								if (arr_ids[i] != e.params.args.data.id) {
									if (newIds != "") {
										newIds += ",";
									}
									newIds += arr_ids[i];
								}
							}
							$($input).val(newIds);
						});
					}

					var data_select_icon = $(this).attr('data-select-icon');
					if (typeof data_select_icon != 'undefined' && data_select_icon == '1') {
						$(this).select2({
							formatResult: G5Plus_Widget_Acf.formatIconState,
							formatSelection: G5Plus_Widget_Acf.formatIconState
						});
					}
				});
			}
		},
		initCheckbox : function($wrap){
			$('.checkbox', $wrap).each(function () {
				var $checkbox = $(this);
				$checkbox.off();
				$checkbox.change(function () {
					if ($checkbox.is(':checked')) {
						$checkbox.val('1');
					} else {
						$checkbox.val('0');
					}
				})
			});
		},
		registerRequireElement : function($wrap) {
			$('input, select', $wrap).change(function () {
				G5Plus_Widget_Acf.initRequireElement($(this));
			})
		},
		initRequireElement : function($wrap) {
			var id = $wrap.attr('id');
			var value = $wrap.val();

			$('div[data-require-element-id="' + id + '"]').each(function () {
				var compare = $(this).attr('data-require-compare');
				var values = $(this).attr('data-require-values');
				if (typeof values != 'undefined' && values != '') {
					values = values.split(',');
				}
				var isShow = false;
				if (compare == '!=')
					isShow = true;

				$.each(values, function ($i, $v) {
					if ($v == value) {
						isShow = compare == '=';
						return;
					}
				});
				if (isShow) {
					$(this).show();
				} else {
					$(this).hide();
				}
			});
		},
		uploadImage: function () {
			$('.widget-acf-upload-button').each(function () {
				$(this).off('click').on('click',function(event){
					event.preventDefault();

					// check for media manager instance
					if (wp.media.frames.gk_frame) {
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
					// Function used for the image selection and media manager closing
					var gk_media_set_image = function () {
						var selection = wp.media.frames.gk_frame.state().get('selection');

						// no selection
						if (!selection) {
							return;
						}

						// iterate through selected elements
						selection.each(function (attachment) {
							var url = attachment.attributes.url;
							var parent = $(wp.media.frames.gk_frame.clicked_button).parent();
							var img = $('img', parent);
							var buttonRemove = $('a.remove-media', parent);

							var inputId = $('input[data-type="id"]', parent);
							var inputUrl = $('input[data-type="url"]', parent);
							var width = wp.media.frames.gk_frame.clicked_button.attr('data-width');
							var height = wp.media.frames.gk_frame.clicked_button.attr('data-height');
							if (typeof width == 'undefined') {
								width = 46;
							}
							if (typeof height == 'undefined') {
								height = 28;
							}
							if (img.length <= 0) {
								img = '<img src="" width="' + width + '" height="' + height + '">';
								img = $(img);
							}
							img.attr('src', url);
							inputUrl.val(url);
							inputId.val(attachment.attributes.id);
							parent.prepend(img);


							if (buttonRemove.length <= 0) {
								buttonRemove = $('<a href="javascript:void(0);" class="button remove-media">Remove</a>');
								buttonRemove.insertAfter(wp.media.frames.gk_frame.clicked_button);
							}
							G5Plus_Widget_Acf.removeImage(parent);
						});
					};

					// closing event for media manger
					//wp.media.frames.gk_frame.on('close', gk_media_set_image);
					// image selection event
					wp.media.frames.gk_frame.on('select', gk_media_set_image);
					// showing media manager
					wp.media.frames.gk_frame.open();
				});

				G5Plus_Widget_Acf.removeImage($(this).parent());
			});
		},
		removeImage: function (parent) {
			$('.remove-media', parent).off('click').on('click',function(){
				var inputId = $('input[data-type="id"]', parent);
				var inputUrl = $('input[data-type="url"]', parent);
				var img = $('img', parent);
				img.remove();
				inputUrl.val('');
				inputId.val('');
				$(this).remove();
			});
		},
		formatIconState : function(state) {
			if (!state.id) {
				return state.text;
			}
			var $state = $(
				'<span><i class="' + state.element[0].value.toLowerCase() + '"/> ' + state.text + '</span>'
			);
			return $state;
		}
	};
})(jQuery);


