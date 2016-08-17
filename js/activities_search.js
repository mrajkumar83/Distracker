$().ready(function() {
	
	$(function () {
            $("#from_date").datepicker({
                numberOfMonths: 2,
                onSelect: function (selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() + 1);
                    $("#txtTo").datepicker("option", "minDate", dt);
                }
            });
            $("#to_date").datepicker({
                numberOfMonths: 2,
                onSelect: function (selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() - 1);
                    $("#txtFrom").datepicker("option", "maxDate", dt);
                }
            });
        });
	
	
	
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
				digits : true
			},
			date_enrollment : {
				required : true,
				date : true
			},
			userid:{
				required : true,
				minlength : 6,
				remote: "logic/validate.php"
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
				remote: "logic/validate.php"
			},
			pic_img :{
				accept: "jpe?g|gif|png",
				maxSize:      '1m'
				//data-max-size='32k'
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
				required: "Required"
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