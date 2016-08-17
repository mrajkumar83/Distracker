<div class="table">
	<?php echo $back_btn;?>
<table class="listing form" cellpadding="0" cellspacing="0">
	<tr>
		  <td class="first"><strong>Program</strong></td>
		  <td class="first" style="background:#ECECEC;" colspan="3"><?php echo $dissertation->program_name;?></td>
	</tr>
	<tr>
		  <td class="first"><strong>Student Name</strong></td>
		  <td class="first" style="background:#ECECEC;"><?php echo $dissertation->std_name;?></td>
		  <td class="first"><strong>Date of Enrolment</strong></td>
		  <td class="last" style="background:#ECECEC;"><?php echo $dissertation->dist_doc;?></td>
	</tr>			
	<tr>
		<td class="first"><strong>Cohort</strong></td>
		<td class="first" style="background:#ECECEC;"><?php echo $dissertation->chrt_name;?></td>
		<td class="first"><strong>Track</strong></td>
		<td class="last" style="background:#ECECEC;"><?php echo $dissertation->con_name;?></td>
	 </tr>
	 <?php
	 if(@$op != 'H' && isset($role_title) && @$op!='C' && $UTYPE=='SD')// && $nextstep_staff != ''
	 {
	 ?>
	 <tr>
		<td class="first"><strong><?php echo $role_title;?></strong></td>
		<td class="first" colspan="3" style="background:#ECECEC;"><?php echo $nextstep_staff;?></td>
	 </tr>
	 <?php
	 }
	 ?>
	 <tr>
		<td class="first"><strong>Research Study Title</strong></td>
		 <td colspan="3" class="first" style="background:#ECECEC;"><?php echo $dissertation->dist_name;?></td>
	</tr>
	<tr>
		<td class="first"><strong>Methodology Type</strong></td>
		 <td colspan="3" class="first" style="background:#ECECEC;"><?php echo $dissertation->dist_desc;?></td>
	</tr>
  </table>
  <br />