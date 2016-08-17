$().ready(function() {
	$("#forgotfrm").validate({
		rules: {
			uemail:{
				required : true,
				email:true,
				remote: "logic/validate.php"
			}
		},
		messages: {
			uemail:{
				required : "Required",
				remote: "Unregistered E-mail"
			}
		}
	});
});