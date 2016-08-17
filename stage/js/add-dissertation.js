$().ready(function() {
	$("#frm_dissertation").validate({
		rules: {
			std_id:{
				required : true
			},
			disseration_program: {
				required : true
			},
			disseration_language:{
				required : true
			},
			disseration_cohort:{
				required : true
			},
			disseration_concentration:{
				required : true
			},
			disseration_name:{
				required : true
			}
		},
		messages: {
			std_id:{
				required: "Required"
			},
			disseration_program: {
				required : "Required"
			},
			disseration_language:{
				required: "Required"
			},
			disseration_cohort:{
				required: "Required"
			},
			disseration_concentration:{
				required: "Required"
			},
			disseration_name:{
				required: "Required"
			}
		}
	});
	$("#disseration_program").change(function() {
		if($(this).attr('previous') == '' || $("#disseration_concentration").val() == ''){
			changeTrack()
		}else{
			if(confirm("Changes to Program will affect Track value and clears the Track for this Research.  Do you want to proceed?")){
				changeTrack();
			}else{
				$(this).val($(this).attr('previous'));
			}
		}	
	});
	
});

function changeTrack(){
		$("#disseration_program").attr('previous',$("#disseration_program").val());
		if($("#disseration_program").find(':selected').data('mandatory') == 'N'){	
			$("#disseration_concentration").val('');
			$("#disseration_concentration").prop('disabled', true);
			$("#disseration_concentration").attr('required', 'required');
			
		}else{
			$("#disseration_concentration").attr('required', '');
			$("#disseration_concentration").prop('disabled', false);
		}
}