$().ready(function() {
	$("#frm_concentration").validate({
		rules: {
			concentration_ref:{
				required : true
			},
			concentration_edate:{
				required : true,
				date : true
			},
			concentration_name:{
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
			concentration_languages:{
				required : true
			}
		},
		messages: {
			concentration_ref:{
				required: "Required"
			},
			concentration_edate:{
				required: "Required",
				date: "Select appropriate date"
			},
			concentration_name:{
				required: "Required",
				remote: "Duplicate Entry"
			},
			concentration_languages:{
				required: "Required"
			}
		}
	});
	$('#concentration_edate').datepick();
});