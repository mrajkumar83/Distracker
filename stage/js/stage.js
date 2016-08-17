$().ready(function() {
	$("#frm_stage").validate({
		rules: {
			stg_title:{
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
			stg_title:{
				required: "Please enter stage title.",
				remote: "Duplicate Entry"
			}
		}
	});
});