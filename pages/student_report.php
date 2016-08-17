<div id="main">

<div class="top-bar">
	<h1>Student Report</h1>
</div>
<div class="select-bar">
	<h2>Search the Student</h2>
</div>

<div class="table">
<form name="frmreport" id="frmreport" method="post">
<table class="listing form" cellpadding="0" cellspacing="0">
	<tr>
		  <td class="first"><strong>Program</strong></td>
		  <td class="first" colspan="3">
		  <select class="text" name="program" id="program">
							<option value="">Please Select...</option>
							<?php
								while($program_rec = mysql_fetch_object($prgm))
								{
									echo '<option value="',$program_rec->program_id,'"',(($program_rec->program_id == $program) ? ' selected="selected"' : ''),'>',$program_rec->program_name,'</option>';
								}
							?>
						</select></td>
	</tr>
	<tr>
		  <td class="first"><strong>First Name</strong></td>
		  <td class="first"><input type="text" class="text" name="fname" id="fname" value="<?php echo $fname;?>"></td>
		  <td class="first"><strong>Last Name</strong></td>
		  <td class="last"><input type="text" class="text" name="lname" id="lname" value="<?php echo $lname;?>"></td>
	</tr>	

		<tr>
		  <td class="first" ><strong>Cohort</strong></td>
		  <td class="first">
			<select class="text" name="cohort" id="cohort">
							<option value="">Please Select...</option>
							<?php
								while($cohort_rec = mysql_fetch_object($chrt))
								{
									echo '<option value="',$cohort_rec->cohort_id,'"',(($cohort_rec->cohort_id == $cohort) ? ' selected="selected"' : ''),'>',$cohort_rec->cohort_name,'</option>';
								}
							?>
						</select>
		  </td>
		  <td class="first"><label><strong>Track</strong></label></td>
		  <td class="last">
		  `<select name="concentration" id="concentration" class="text">
							<option value="">Please Select...</option>
							<?php
								while($concen_rec = mysql_fetch_object($concen))
								{
									echo '<option value="'.$concen_rec->concentration_id.'"',(($concen_rec->concentration_id == $concentration) ? ' selected="selected"' : ''),'>',$concen_rec->concentration_name,'</option>';
								}
							?>
						</select>
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