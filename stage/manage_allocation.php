<?php
	$step = '2';
	$path = '..';
	$title =  'List Allocation';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	require_once('includes/common.php');
	$con = (($project_sts == 'N') ? ' = ' : ' <> ').'"N"';
	
	$result = $db->fetchAllRecord(' tb_dissertation AS d LEFT JOIN tb_users u ON u.user_id = d.std_id LEFT JOIN tb_languages l ON l.lang_id = d.disseration_language LEFT JOIN tb_cohort ct ON ct.cohort_id=disseration_cohort LEFT JOIN tb_concentration cn ON cn.concentration_id=d.disseration_concentration LEFT JOIN tb_programs p ON p.program_id=d.disseration_program ' , ' d. dissertation_id AS id,d.disseration_name, u.user_fullname,l.lang_name, ct.cohort_name, cn.concentration_name, p.program_name ', ' d.disseration_process_state'.$con , NULL, '  d.disseration_doc', NULL, 0,'All');
	$page_title = ($project_sts == 'N') ? ' Staff ' : ' Modify ';
?>
<div id="main">
	<div class="top-bar">
			<h1><?php echo $page_title;?> Allocation</h1>
		</div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Program</th>
		<th>Research Study Title</th>
		<th>Student Name</th>
		<th>Cohort</th>
		<th>Track</th>
		<th>Lanaguage</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		$link = ('?psts='.$project_sts.'&amp;').(($project_sts == 'N') ? 'id=' : 'op=E&amp;id=');
		while($data = mysql_fetch_object($result))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t\t";
				echo '<td>',$data->program_name,'</td>';
      			echo '<td><a href="staff_allocation.php',$link,$data->id,'">',$data->disseration_name,'</a></td>';
				echo '<td>',$data->user_fullname,'</td>';
				echo '<td>',$data->cohort_name,'</td>';
				echo '<td>',$data->concentration_name,'</td>';
				echo '<td>',$data->lang_name,'</td>';
    		echo '</tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>