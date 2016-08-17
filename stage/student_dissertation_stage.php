<?php
	$step = '2';
	$path = '..';
	require_once('../common/sess.php');
	require_once('../common/configure.php');
	require_once('../classes/Database.class.php');
	require_once('../classes/Query.class.php');
	
	$title =  'List Research Study :: ';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	require_once('../includes/commonheader.php');
	
	$db = new Query();
	$result = $db->fetchAllRecord(' tb_student_staff_rel ss, tb_role_stage_rel rs, vw_dissertation_details dd ', 'dd.dist_id,dd.std_id,dd.std_name,dd.chrt_name,dd.con_name, dd.dist_name, dd.dist_doc ',  ' rs.role_id = ss.role_id AND (ss.rel_status = "S" OR ss.rel_status="P") AND dd.std_id =ss.std_id AND dd.dist_id = ss.dissertation_id AND ss.staff_id="'.$UID.'"
AND rs.stg_id="'.$sid.'" AND rs.role_id="'.$role.'" AND dd.chrt_id= "'.$cid.'" ',  NULL, '  dd.dist_doc ', NULL, 0,'All');
?>
<div id="main">
	<div class="top-bar">
			<h1>Manage Research Study</h1>
		</div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		
		<th>Student Name</th>
		<th>Cohort</th>
		<th>Concentration</th>
		<th>Title</th>
		<th>Update on</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($result))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t\t";
      			echo '<td><a href="dissertation_progress.php?did=',$data->dist_id,'&amp;rid=',$role,'&amp;sid=',$sid,'">',$data->std_name,'</a></td>';
				echo '<td>',$data->chrt_name,'</td>';
				echo '<td>',$data->con_name,'</td>';
				echo '<td>',$data->dist_name,'</td>';
				echo '<td>',$data->dist_doc,'</td>';
    		echo '</tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>