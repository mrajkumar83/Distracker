$().ready(function() {
	$("#reviewfrm").validate({
		rules: {
		/*
			disseration_files[]:{
				accept: "(docx?|pdf|txt|xlsx?)"
			}*/
		},
		messages: {
			disseration_files:{
				accept: "Only following extensions are allowed Doc(x)|Pdf|Txt|Xls(x)"
			}
		},
		submitHandler: function(f){
		editor.post();
        $('form input[type=submit]').attr('disabled', 'disabled');
        $("#reviewfrm").submit();
    }
	});
	$('input[type="radio"]').click(function(event) {
		var msg = $("#msg");
		if($( "input:checked" ).val() == 'A'){
			msg.attr('required', '');
		}
		else
		{
			msg.attr('required', 'required');
		}
	   // State has changed to checked/unchecked.
    });
	$(".parentContainers .Chapters").click(function(e) {	
			MenuSelect(e, this);
		});
	$("#mode_field").click(function(){
		$('#filestable').append (  
                    '<tr class="bg"><td><input type="file" name="disseration_files[]" accept="(docx?|pdf|txt|xlsx?)" />&nbsp;&nbsp;<input type="button" class="btnRemove" value="Delete" onclick="del_click(this)"></td></tr>');
		});
});
/** Powered by sarktechnologies.net **/
function MenuSelect(event, obj){
	var event = event ||  window.event;
	var target = event.target || event.srcElement;
	var container = $(target).parent().children('.childContainers');
	container.toggleClass('hideContainer');
}

function del_click(obj)
{
	$(obj).parent().parent().remove (); 
}