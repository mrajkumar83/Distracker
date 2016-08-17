$().ready(function() {
	$("#loginfrm").validate({
		rules: {
			uname:{
				required : true
			},
			upassword:{
				required : true
			}
		},
		messages: {
			uname:{
				required: "Required"
			},
			upassword:{
				required: "Required"
			}
		}
	});
});