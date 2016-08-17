$().ready(function() {
	$("#frm_role").validate({
		rules: {
			role_title:{
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
			role_title:{
				required: "Please enter role title.",
				remote: "Duplicate Entry"
			}
		}
	});
});