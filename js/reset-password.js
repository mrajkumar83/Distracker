$().ready(function() {
	$("#changepassword").validate({
		rules: {
			newpassword:{
			    required: true,
				minlength: 5
			},
			confirmpassword: {
				required: true,
				minlength: 5,
			equalTo: "#newpassword"
			}
		},
		messages: {
		    newpassword: {
				required: "<span>Required</span>",
				minlength: "Your password must be at least 5 characters long"
				},
			confirmpassword: {
				required: "<span>Required</span>",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			}
	    }
	});
});