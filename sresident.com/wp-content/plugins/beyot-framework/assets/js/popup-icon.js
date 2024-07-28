(function($){
	"use strict";
	var G5Plus_Popup_Icon =  {
		htmlTag : {
			wrapper : '.popup-icon-wrapper',
			iconPreview :'#iconPreview',
			btnSave : '#btnSave'
		},
		vars : {
			obj_Call : null,
			current_icon : ''
		},
		init : function (obj_Call) {
			G5Plus_Popup_Icon.vars.obj_Call = null;
			G5Plus_Popup_Icon.vars.current_icon = '';
			if (obj_Call != undefined) {
				G5Plus_Popup_Icon.vars.obj_Call = obj_Call;
				if (obj_Call.val() != '') {
					G5Plus_Popup_Icon.vars.current_icon = obj_Call.val();
				}
			}
			if ($('#g5plus-framework-popup-icon-wrapper').length == 0) {
				$.ajax({
					type   : 'POST',
					data   : 'action=popup_icon',
					url    : g5plus_framework_meta.ajax_url,
					success: function (html) {
						$('body').append(html);
						G5Plus_Popup_Icon.showPopup();
					},
					error  : function (html) {
					}
				});

			} else {
				G5Plus_Popup_Icon.showPopup();
			}
		},
		showPopup: function(){
			G5Plus_Popup_Icon.processButton();
			tb_show('Icons','#TB_inline?height=545&width=750&inlineId=g5plus-framework-popup-icon-wrapper',false);
		},
		processButton: function(){
			$('#txtSearch',G5Plus_Popup_Icon.htmlTag.wrapper).val('');
			$('.list-icon ul li',G5Plus_Popup_Icon.htmlTag.wrapper).show();
			$('#txtSearch',G5Plus_Popup_Icon.htmlTag.wrapper).keyup(function(){
				// Retrieve the input field text and reset the count to zero
				var filter = jQuery(this).val(), count = 0;
				// Loop through the icon list
				$('.list-icon ul li a',G5Plus_Popup_Icon.htmlTag.wrapper).each(function(){
					// If the list item does not contain the text phrase fade it out
					if ($(this).attr('title').search(new RegExp(filter, "i")) < 0) {
						$(this).parent().fadeOut();
					} else {
						$(this).parent().show();
						count++;
					}
				});
			});

			$('.list-icon ul li a',G5Plus_Popup_Icon.htmlTag.wrapper).off('click').on('click',function(){
				G5Plus_Popup_Icon.vars.current_icon = $(this).attr('title');
				G5Plus_Popup_Icon.setPreview();
			});


			$(G5Plus_Popup_Icon.htmlTag.btnSave,G5Plus_Popup_Icon.htmlTag.wrapper).off('click').on('click',function(){
				tb_remove();
				if (G5Plus_Popup_Icon.vars.obj_Call != null && G5Plus_Popup_Icon.vars.obj_Call != undefined) {
					G5Plus_Popup_Icon.vars.obj_Call.val(G5Plus_Popup_Icon.vars.current_icon);
					G5Plus_Popup_Icon.vars.obj_Call.trigger('change');
				}
			});

			G5Plus_Popup_Icon.setPreview();

			if (G5Plus_Popup_Icon.vars.current_icon != '') {
				var obj_icon_current = $('.list-icon ul li a[title="'+G5Plus_Popup_Icon.vars.current_icon+ '"]',G5Plus_Popup_Icon.htmlTag.wrapper);
				if (obj_icon_current.length > 0){
					obj_icon_current.addClass('active');
					setTimeout(function(){
						$('.list-icon',G5Plus_Popup_Icon.htmlTag.wrapper).animate({scrollTop : obj_icon_current.position().top },1000);
					},500);

				}
			}
		},
		setPreview : function() {
			$('.list-icon ul li a',G5Plus_Popup_Icon.htmlTag.wrapper).removeClass('active');
			if (G5Plus_Popup_Icon.vars.current_icon != '') {
				$(G5Plus_Popup_Icon.htmlTag.iconPreview + ' i',G5Plus_Popup_Icon.htmlTag.wrapper).attr('class', G5Plus_Popup_Icon.vars.current_icon);
				$(G5Plus_Popup_Icon.htmlTag.iconPreview,G5Plus_Popup_Icon.htmlTag.wrapper).prev('span').text(G5Plus_Popup_Icon.vars.current_icon);

			}
		}
	};

	$(document).ready(function(){
		setTimeout(function() {
			$(document).on('click','.browse-icon',function(){
				var text_box = $(this).prev('input');
				G5Plus_Popup_Icon.init(text_box);
			});

			$(document).on('change','.input-icon',function(){
				var icon = $(this).val();
				$('.icon-preview > i',$(this).parent()).attr('class', icon);
			});
		}, 1000);
	});
})(jQuery);
