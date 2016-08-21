<?php
	$step = '2';
	$path = '..';
	$title =  'Research Study ';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css', 'css/report.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	
	require_once('includes/common.php');
	
	$link = (($op == 'L' || $op == 'H') ? 'dissertation-flow.php' : 'dissertation_report.php').'?op='.$op.'&amp;did=';
	
	switch($UTYPE)
	{
		case 'SD':
			$result = $db->fetchAllRecord(' tb_dissertation AS d LEFT JOIN tb_users u ON u.user_id = d.std_id LEFT JOIN tb_languages l ON l.lang_id = d.disseration_language LEFT JOIN tb_cohort ct ON ct.cohort_id=disseration_cohort LEFT JOIN tb_concentration cn ON cn.concentration_id=d.disseration_concentration LEFT JOIN tb_programs p ON p.program_id=d.disseration_program ' , ' d. dissertation_id AS id,d.disseration_name, p.program_name AS program,  u.user_fullname,l.lang_name, ct.cohort_name, cn.concentration_name, d.disseration_status ', ' d.std_id="'.$UID.'" ' , NULL, '  d.disseration_name ', NULL, 0,'All');
		break;
		
		default:
			$result = $db->fetchAllRecord(' tb_dissertation AS d LEFT JOIN tb_user_info u ON u.user_id = d.std_id LEFT JOIN tb_languages l ON l.lang_id = d.disseration_language LEFT JOIN tb_cohort ct ON ct.cohort_id=disseration_cohort LEFT JOIN tb_concentration cn ON cn.concentration_id=d.disseration_concentration LEFT JOIN tb_programs p ON p.program_id=d.disseration_program LEFT JOIN (SELECT next_id, dissertation_id FROM tb_dissertation_history WHERE history_id IN ( SELECT MAX( history_id ) FROM tb_dissertation_history GROUP BY dissertation_id)) AS h ON h.dissertation_id = d.dissertation_id ' , ' d. dissertation_id AS id,d.disseration_name, p.program_name AS program, CONCAT(u.user_prefix," ",u.user_fname," ", user_lname) AS user_fullname,l.lang_name, ct.cohort_name, cn.concentration_name, d.disseration_status, u.user_id, h.next_id ', ' d.disseration_process_state<>"N" AND ct.cohort_id="'.$cid.'" ', NULL, '  d.disseration_doc', NULL, 0,'All');
		break;
	}
	
	switch($op)
	{
		case 'H':
			$subTitle = '';// for History';
		break;
		
		case 'R':
			$subTitle = '';// for Reports';
		break;
		
		default:
			$subTitle = '';
		break;
	}
?>
<div id="main">
	<div class="top-bar">
			<h1>List of Research Studies <?php echo $subTitle;?></h1>
		</div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Program</th>
		<th>Research Study Title</th>
		<th>Student Name</th>
		<th>Cohort</th>
		<th>Track</th>
		<th>Language</th>
		<?php
		if($UTYPE !== 'SD' && $op === 'H')
			echo '<th>Help</th>';
		?>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($result))
		{
			$class = ($row%2) ? 'even' : 'odd';
			$name = ($data->disseration_status == 'N') ? $data->disseration_name : '<a href="'.$link.$data->id.'">'.$data->disseration_name.'</a>';
			echo '<tr class="',$class,'">',"\n\t\t";
				echo '<td>',$data->program,'</td>';
      			echo '<td>',$name,'</td>';
				echo '<td>',$data->user_fullname,'</td>';
				echo '<td>',$data->cohort_name,'</td>';
				echo '<td>',$data->concentration_name,'</td>';
				echo '<td>',$data->lang_name,'</td>';
				if($UTYPE !== 'SD' && $op === 'H'){
					echo '<td class="center">';
					echo ($data->next_id === $data->user_id) ? '<a href="dissertation-flow.php?op=U&amp;did='.$data->id.'&amp;std_id='.$data->user_id.'" title="Update" alt="Update"><div class="reports_img edit"></div></a>' : '&nbsp;';
						/*echo (($data->next_id === $data->user_id) ?  : );*/
					echo '</td>';
				}
    		echo '</tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>