$().ready(function() {
	
	$(function () {
            $("#fdate").datepicker({
                numberOfMonths: 1,//Change for number of months displayed
                onSelect: function (selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() + 1);
                    $("#tdate").datepicker("option", "minDate", dt);
                }
            });
            $("#tdate").datepicker({
                numberOfMonths: 1,
                onSelect: function (selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() - 1);
                    $("#fdate").datepicker("option", "maxDate", dt);
                }
            });
        });
		
		$("#frmactivities").validate({
		rules: {
			fdate: {
				required: function(element){
					return $("#tdate").val().length > 0;
				}
			},
			tdate: {
				required: function(element){
					return $("#fdate").val().length > 0;
				}
			}
		},
		messages: {			
			fdate: {
				required: "Enter \"To Date\""
			},
			tdate: {
				required: "Enter \"From Date\""
			}
		}
	});
	
});//End of ready