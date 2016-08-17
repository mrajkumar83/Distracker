$().ready(function() {
	$("#frm_rolestage").validate({
		rules: {
			stg_id:{
				required : true
			},
			role_id:{
				required : true
			}
		},
		messages: {
			stg_id:{
				required: "Please select stage."
			},
			role_id:{
				required: "Please select role."
			}
		}
	});
});