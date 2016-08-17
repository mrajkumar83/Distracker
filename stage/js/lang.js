$().ready(function() {
	$("#frm_lang").validate({
		rules: {
			lang_name:{
				required : true,
				remote: {
						url: "../logic/validate.php",
						type: "post",
						data: {
								id: function() {
									return $( "#id" ).val();
								}
							}
					}
			},
			lang_code:{
				required : true
			}
		},
		messages: {
			lang_name:{
				required : 'Required',
				remote: "Duplicate Entry"
			},
			lang_code:{
				required : 'Required'
			}
		}
	});
});