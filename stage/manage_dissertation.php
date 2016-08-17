<?php
	$step = '2';
	$path = '..';
	$title =  'Research Study Tracker | Research List :: ';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	
	require_once('../common/sess.php');
	require_once('../common/configure.php');
	require_once('../classes/Database.class.php');
	require_once('../classes/Query.class.php');
	require_once('../includes/commonheader.php');
	
	$db = new Query();
	$cond = $UTYPE == 'SD' ? ' std_id="'.$UID.'" ' : NULL;
	$result = $db->fetchAllRecord(' vw_dissertation_details ' , ' dist_id, dist_name, std_name, chrt_name, program_name, con_name, lang_name ', $cond , NULL , ' dist_doc ', NULL, 0,'All');
	
	function chkDissert($id)
	{
		global $db, $utype;
		
		$diss_obj = $db->fetchRecord(' tb_student_staff_rel ', ' count(1) AS cnt ', ' dissertation_id="'.$id.'" AND rel_status<>"A" ');
		if($diss_obj->cnt > 0)
		{
			return false;
		}
		
		$diss_obj = $db->fetchRecord(' tb_dissertation_history ', ' count(1) AS cnt ', ' dissertation_id="'.$id.'"');
		if($diss_obj->cnt > 0)
		{
			return false;
		}
		return true;
	}
?>
<div id="main">
	<div class="top-bar"><h1>Manage Research Study</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Program</th>
		<th>Research Study</th>
		<th>Student Name</th>
		<th>Cohort</th>
		<th>Track</th>
		<th>Language</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($result))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t\t";
				echo '<td>',$data->program_name,'</td>';
				echo '<td>',$data->dist_name,'</td>';
				echo '<td>',$data->std_name,'</td>';
				echo '<td>',$data->chrt_name,'</td>';
				echo '<td>',$data->con_name,'</td>';
				echo '<td>',$data->lang_name,'</td>';
      			echo '<td class="center"><a href="dissertation.php?op=E&amp;id=',$data->dist_id,'" title="Edit Research Study" alt="Edit Research Study"><div class="img edit"></div></a>&nbsp;';
				if(chkDissert($data->dist_id))
				{
					echo '<a href="javascript:del(\'../logic/dissertation-logic.php?op=D&amp;id=',$data->dist_id,'\');" title="Delete Research Study" alt="Delete Research Study"><div class="img delete"></div></a>';
				}
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>