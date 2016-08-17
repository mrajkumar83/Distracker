$().ready(function() {
	$('#date_enrollment').datepick();
	$("#registerFrm").validate({
		rules: {
			prefix:{
				required : true
			},
			fname:{
				required : true
			},
			lname:{
				required : true
			},
			registrationno : {
				required : true,
				digits : true,
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
			zip:{
				digits: true
			},
			telephone:{
				digits: true
			},
			date_enrollment : {
				required : true,
				date : true
			},
			userid:{
				required : true,
				minlength : 6,
				remote: "../logic/validate.php"
			},
			user_password:{
				required : true,
				minlength : 6
			},
			cohort:{
				required : true
			},
			concentration:{
				required : true
			},
			lang:{
				required : true
			},
			email_id:{
				required : true,
				email:true,
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
			pic_img :{
				accept: "jpe?g|gif|png"
			}
		},
		messages: {
			prefix:{
				required: "Required"
			},
			fname:{
				required: "Required"
			},
			lname:{
				required: "Required"
			},
			registrationno : {
				required: "Required",
				remote: "Duplicate Entry"
			},
			date_enrollment : {
				required: "Required"
			},
			userid:{
				required: "Required",
				remote: "Duplicate Entry"
			},
			user_password:{
				required : "Required"
			},
			zip:{
				digits: "Number only"
			},
			telephone:{
				digits: "Number only"
			},
			cohort:{
				required : "Required"
			},
			concentration:{
				required : "Required"
			},
			lang:{
				required : "Required"
			},
			email_id:{
				required : "Required",
				remote: "Duplicate Entry"
			},
			pic_img :{
				accept: "jpeg | gif | png only"
			}
		}
	});
});