$().ready(function() {
	$("#reviewfrm").validate({		
		submitHandler: function(form){
		var content = editor.i.contentWindow.document.body.innerHTML;
		var chk = $( "input:checked").val;
		//console.log(content);
		//console.log(chk);
		if(chk != 'A' && (content == '<br>' && content == ''))
		{
			alert('Please enter your comments.');// Editor empty
			return false;
		}
		editor.post();
        $('form input[type=submit]').attr('disabled', 'disabled');
        form.submit();
    }
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