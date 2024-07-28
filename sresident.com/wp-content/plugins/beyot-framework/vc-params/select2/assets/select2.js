(function ( $ ) {
	/*
	 Class used in edit form and editor models to save/render shortcode
	 */
	vc.atts.select2 = {
		init:function(param,$field){
			$('#'+ param.param_name + '_select2',$field).select2({width : '100%'});
			var is_version_4 = $('#'+ param.param_name + '_select2',$field).hasClass('select2-hidden-accessible');
			if ((typeof(param.multiple) != 'undefined') && param.multiple) {
				var data_value = $('#'+ param.param_name,$field).val().split(',');
				if (is_version_4) {
					for (var i = 0; i < data_value.length; i++) {
						if (data_value[i] == '') continue;
						var $element = $('#'+ param.param_name + '_select2',$field).find('option[value="'+ data_value[i] +'"]');
						$element.detach();
						$('#'+ param.param_name + '_select2',$field).append($element);
					}
					$('#'+ param.param_name + '_select2',$field).val(data_value).trigger('change');

					$('#'+ param.param_name + '_select2',$field).on('select2:selecting',function(e){
						var ids = $('#'+ param.param_name,$field).val();
						if (ids != "") {
							ids +=",";
						}
						ids += e.params.args.data.id;
						$('#'+ param.param_name,$field).val(ids);
					}).on('select2:unselecting',function(e){
						var ids = $('#'+ param.param_name,$field).val();
						var arr_ids = ids.split(",");
						var newIds = "";
						for(var i = 0 ; i < arr_ids.length; i++) {
							if (arr_ids[i] != e.params.args.data.id){
								if (newIds != "") {
									newIds +=",";
								}
								newIds += arr_ids[i];
							}
						}
						$('#'+ param.param_name,$field).val(newIds);
					}).on('select2:select',function(e){
						var element = e.params.data.element;
						var $element = $(element);

						$element.detach();
						$(this).append($element);
						$(this).trigger("change");
					});

				} else {
					var choices = [];
					if (data_value.length > 0) {
						for (var j = 0; j < data_value.length; j++) {
							if (data_value[j] == '') continue;
							var option = $('option[value="'+ data_value[j]  + '"]', $('#'+ param.param_name + '_select2',$field));
							choices[j] = { 'id':data_value[j], 'text':option.text()};
						}
						$('#'+ param.param_name + '_select2',$field).select2('data', choices);
					}

					$('#'+ param.param_name + '_select2',$field).on('select2-selecting',function(e){
						var ids = $('#'+ param.param_name,$field).val();
						if (ids != "") {
							ids +=",";
						}
						ids += e.val;
						$('#'+ param.param_name,$field).val(ids);
					}).on('select2-removed',function(e){
						var ids = $('#'+ param.param_name,$field).val();
						var arr_ids = ids.split(",");
						var newIds = "";
						for(var i = 0 ; i < arr_ids.length; i++) {
							if (arr_ids[i] != e.val){
								if (newIds != "") {
									newIds +=",";
								}
								newIds += arr_ids[i];
							}
						}
						$('#'+ param.param_name,$field).val(newIds);
					});
				}
			}
		}
	};
})( window.jQuery );