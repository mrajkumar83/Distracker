<?php
	$step = '2';
	$path = '..';
	
	require_once('../common/sess.php');
	require_once('../common/configure.php');
	require_once('../classes/Database.class.php');
	require_once('../classes/Query.class.php');
	
	$title =  'Pending Research Study';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	require_once('../includes/commonheader.php');
	
	$db = new Query();
	$fields = ' dd.dist_id,dd.std_id,dd.std_name,dd.chrt_name,dd.con_name, dd.dist_name, DATE_FORMAT(dd.dist_doc, "%b %e, %Y") AS dist_doc,chrt_id, r.role_id, r.role_title  ';
	$cond = isset($role) ? ' AND r.role_id ="'.$role.'" ' : '';
	$result = $db->fetchAllRecord(' tb_student_staff_rel ss, vw_dissertation_details dd, tb_roles r ', $fields,  ' ss.rel_status = "S" AND r.role_id = ss.role_id AND dd.std_id = ss.std_id AND dd.dist_id = ss.dissertation_id AND ss.staff_id = "'.$UID.'" '.$cond,  NULL, '  dd.dist_doc ', NULL, 0,'All');
	$total = $db->totalcnt;
?>
<div id="main">
	<div class="top-bar">
			<h1>Pending Research Study</h1>
		</div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>		
		<th>Title</th>
		<th>Student Name</th>
		<th>Cohort</th>
		<th>Concentration</th>		
		<th>Role</th>
		<th>Update on</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		if($total > 0){
			while($data = mysql_fetch_object($result))
			{
					$class = ($row%2) ? 'even' : 'odd';
					echo '<tr class="',$class,'">',"\n\t\t";
						echo '<td><a href="dissertation-flow.php?did=',$data->dist_id,'&amp;rid=',$data->role_id,'">',$data->dist_name,'</a></td>',
							'<td>',$data->std_name,'</td>',
							'<td>',$data->chrt_name,'</td>',
							'<td>',$data->con_name,'</td>',
							'<td>',$data->role_title,'</td>',
							'<td>',$data->dist_doc,'</td>',
					'</tr>',"\n";
					$row++;
			}
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>