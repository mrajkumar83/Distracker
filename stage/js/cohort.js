$().ready(function() {
	$("#frm_cohort").validate({
		rules: {
			cohort_ref:{
				required : true
			},
			cohort_edate:{
				required : true,
				date : true
			},
			cohort_name:{
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
			cohort_languages:{
				required : true
			}
		},
		messages: {
			cohort_ref:{
				required: "Required"
			},
			cohort_edate:{
				required: "Required",
				date: "Select appropriate date"
			},
			cohort_name:{
				required: "Required",
				remote: "Duplicate Entry"
			},
			cohort_languages:{
				required: "Required"
			}
		}
	});
	$('#cohort_edate').datepick();
});