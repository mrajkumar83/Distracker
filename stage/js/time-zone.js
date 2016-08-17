$().ready(function() {
	$("#frm_timezone").validate({
		rules: {
			tz_timezone:{
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
			tz_name: {
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
			tz_timezone:{
				required: "Please enter GMT Difference.",
				remote: "Duplicate Entry"
			},
			tz_name: {
				required: "Please enter Time-zone.",
				remote: "Duplicate Entry"
			}
		}
	});
});