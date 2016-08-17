<div id="main">

<div class="top-bar">
	<h1>Student's Activity</h1>
</div>
<div class="select-bar">
	<h2>Search the Student</h2>
</div>

<div class="table">
<form name="frmactivities" id="frmactivities" method="post">
<table class="listing form" cellpadding="0" cellspacing="0">

	<tr>
		  <td class="first"><strong>Student Name</strong></td>
		  <td class="first"  colspan="3"><input type="text" class="text" name="sname" id="sname" value="<?php echo $sname;?>"></td>
	</tr>
	
	<tr>
		  <td class="first"><strong>From Date</strong></td>
		  <td class="first"><input type="text" class="text" name="fdate" id="fdate" value="<?php echo $fdate;?>"></td>
		  <td class="first"><strong>To Date</strong></td>
		  <td class="last"><input type="text" class="text" name="tdate" id="tdate" value="<?php echo $tdate;?>"></td>
	</tr>


		<tr>
		  <td class="first" ><strong>Activities</strong></td>
		  <td class="first" colspan="3">
			<input type="radio" value="Y" name="activity"<?php echo ($activity == 'Y') ? ' checked="checked"' : ''?>> With
			&nbsp;&nbsp;
		  <input type="radio" value="N" name="activity"<?php echo ($activity == 'N') ? ' checked="checked"' : ''?>> With&nbsp;out
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

<div id="sts"></div>
	<div class="top-bar"><h1>Students List</h1></div>
	  <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Student Name</th>
		<th>Research Study Title</th>
		<th>Last Login</th>
		<th>Last Submission</th>
		<th>Pending</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($result))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',$data->name ,'</td>',"\n";
				echo '<td><a href="dissertation_report.php?op=H&did=',$data->dist_id,'">',$data->title,'</a></td>';
				echo '<td>',(($data->login_time == '00-00-0000') ? "-" : $data->login_time),'</td>';
				echo '<td>',(($data->doc == '00-00-0000') ? "-" : $data->doc),'</td>';
				echo '<td>',(($data->std_id == $data->next_id) ? "Student" : $data->user_fullname),'</td>';
    		echo '</tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>