<div id="main">

<div class="top-bar">
	<h1>Staff List</h1>
</div>
<div class="select-bar">
	<h2>Search the Staff</h2>
</div>

<div class="table">
<form name="frmreport" id="frmreport" method="post">
<table class="listing form" cellpadding="0" cellspacing="0">
  <tr>
		  <td class="first"><strong>First Name</strong></td>
		  <td class="first"><input type="text" class="text" name="fname" id="fname" value="<?php echo $fname;?>"></td>
		  <td class="first"><strong>Last Name</strong></td>
		  <td class="last"><input type="text" class="text" name="lname" id="lname" value="<?php echo $lname;?>"></td>
	</tr>	

		<tr>
		  <td class="first" ><strong>Languages</strong></td>
		  <td class="first" colspan="3">
			<?php
			while($langs_rec = mysql_fetch_object($langs))
			{
				echo '<input type="checkbox" name="lang[]" value="',$langs_rec->lang_id,'" id="lang[',$langs_rec->lang_id,']"',(in_array($langs_rec->lang_id, $lang) ? ' checked="checked"': ''),'>&nbsp;
				  <label for="lang[',$langs_rec->lang_id,']">',$langs_rec->lang_name,'</label>';
				$i++;
			}
			?>
		  </td>		  
		</tr>
		
  </table>
<!-- Search button begining-->
 <p class="buttons" >
  <input name="Search" type="submit" value="Submit">
</p>
<!-- search button end-->

</form>
</div>