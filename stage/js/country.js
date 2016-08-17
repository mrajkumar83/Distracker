$().ready(function() {
	$("#frm_country").validate({
		rules: {
			country_name:{
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
			country_name:{
				required: "Please enter country name.",
				remote: "Duplicate Entry"
			}
		}
	});
});