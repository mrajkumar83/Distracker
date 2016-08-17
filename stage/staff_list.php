<?php
	$step = '2';
	$path = '..';
	
	$title =  'Staff List :: ';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	require_once('includes/common.php');
	$table = ' (SELECT h.history_id, dd.con_name, dd.chrt_name, dd.dist_name, dd.std_name, s.stg_title, dist_doc, h.dissertation_id, dd.program_name 
FROM tb_stages s, vw_dissertation_details dd
LEFT JOIN tb_dissertation_history h ON h.dissertation_id = dd.dist_id
WHERE h.stage_id = s.stg_id
AND dd.dist_id
IN (

SELECT DISTINCT (
dissertation_id
)
FROM `tb_student_staff_rel`
WHERE staff_id = "'.$sid.'"
)) temptable
group by dissertation_id ';
	
	$result = $db->fetchAllRecord($table , ' MAX(history_id), con_name, chrt_name, dist_name, std_name, stg_title, dist_doc,dissertation_id, program_name ', NULL , NULL, '  std_name', NULL, 0,'All');
	$tot_cnt = $db->getRowCount();
?>
<div id="main">
	<div id="sts"></div>
	<div class="top-bar"><h1>Staff Report</h1></div>
	<div class="select-bar">
	<h2>Report for Staff - <?php echo $sname;?></h2>
</div>
<div>Found total of <?php echo $tot_cnt;?> students. Click on the name of the student to see the detail report for the student.</div>
	  <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Student Name</th>
		<th>Program</th>
		<th>Cohort</th>
		<th>Track</th>
		<th>Current Status</th>
		<th>Research Title</th>
		<th>Last Update on</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($result))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td><a href="dissertation_report.php?op=H&amp;did='.$data->dissertation_id.'">',$data->std_name ,'</a></td>',"\n";
				echo '<td>',$data->program_name,'</td>';
				echo '<td>',$data->chrt_name,'</td>';
				echo '<td>',$data->con_name,'</td>',
					'<td>',$data->stg_title,'</td>',
					'<td>',$data->dist_name,'</td>',
					'<td>',$data->dist_doc,'</td>';
    		echo '</tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>