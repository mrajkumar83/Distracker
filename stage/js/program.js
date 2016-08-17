$().ready(function() {
	$("#frm_program").validate({
		rules: {
			program_name:{
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
			}
		},
		messages: {
			program_name:{
				required : 'Required',
				remote: "Duplicate Entry"
			}
		}
	});
});