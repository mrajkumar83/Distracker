$().ready(function() {
	$('input[type="submit"]').click(function(){
		$('.toSelect').each(function() {
			$(this).find('option').each(function(){
				$(this).attr('selected','selected');
			});
		});
	});
	
	$("#allocationfrm").validate({
		rules: {
		'stg[1]':{
				required : true			
			}			
			,'stg[8][]':{
				minlength:2				
			},'stg[10][]':{
				minlength:4		
			}		},
		messages: {
		'stg[1]':{
				required: "Required"
			},'stg[8][]':{
				minlength:"Select Min 2 members"
			},'stg[10][]':{
				minlength:"Select Min 4 members"		
			}
		}
	});
});
/** Powered by sarktechnologies.net **/
function swap(self, cond)
{
	var obj = self.parentNode.parentNode;
	var from = cond ? '.fromSelect' : '.toSelect';
	var to = cond ? '.toSelect' : '.fromSelect';
	var fromObj = $(obj).find(from+' option:selected');
	var toObj = $(obj).find(to);
	
	if(fromObj.length < 1)
	{
		alert('Select atleast one Staff member.');
		return;
	}
	fromObj.each( function() {
            toObj.append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
			//new Option($(this).text(), $(this).val(), true, true));
            $(this).remove();
    });
	$(obj).find('.toSelect option').each(function() {
		$(this).attr('selected','selected');
	});
}
function displaySelected(self)
{
	var obj = self.parentNode.parentNode;
	var txt = '';
	$(obj).html();
	$(self).find('option:selected').each( function() {
		if($(this).val() != '')
            txt += $(this).text()+'<br>';
    });
	$(obj).find('.selectedItem').html(txt);
}