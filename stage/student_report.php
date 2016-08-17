<?php
	$step = '2';
	$path = '..';
	$title =  'Student Reports :: ';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	
	require_once('includes/common.php');
	
	function addLink($text, $sts, $did='')
	{
		if($sts == 'D')
		{ return $text;}
		
		return '<a href="dissertation_report.php?op=H&amp;did='.$did.'">'.$text.'</a>';
	}
	
	function processStatus($sts)
	{
		$status = '';
		switch($sts)
		{
			case 'A':
				$status = 'Allocated';
			break;
			
			case 'S':
				$status = 'In Process';
			break;
			
			case 'N':
				$status = 'Not Started';
			break;
			
			case 'C':
				$status = 'Completed';
			break;
		}
		return $status;
	}
	
	$cond = '';
	$rows_cnt = 0;
	$fname = isset($fname) ? $fname : '';
	$lname = isset($lname) ? $lname : '';
	$registrationno = isset($registrationno) ? : '';
	$date_enrollment = isset($date_enrollment) ? : '';
	$cohort = isset($cohort) ? $cohort : '';
	$concentration = isset($concentration) ?$concentration : '';
	$program = isset($program) ?$program : '';
		
	$chrt = $db->fetchAllRecord('tb_cohort ' , ' cohort_id,cohort_name ', ' cohort_status="A" ' , NULL, ' cohort_name ', NULL,NULL,'All');
	$concen = $db->fetchAllRecord('tb_concentration ' , ' concentration_id,concentration_name ', ' concentration_status="A" ' , NULL, ' concentration_name ', NULL, NULL,'All');
	
	$prgm = $db->fetchAllRecord('tb_programs ' , ' program_id, program_name ', NULL , NULL, ' program_name ', NULL, NULL,'All');
	
	require_once($path.'/pages/student_report.php');
	if(isset($Search))
	{
		$cond .= ($fname != '') ? 'AND LOWER(ui.user_fname) LIKE "%'.strtolower($fname).'%"' : '';
		$cond .= ($lname != '') ? ' AND LOWER(ui.user_lname) LIKE "'.strtolower($lname).'%" ' : '';
		$cond .= ($registrationno != '') ? ' AND ui.user_registration LIKE "'.$registrationno.'%" ' : '';
		$cond .= ($date_enrollment != '') ?  ' AND ui.user_doe LIKE "%'.$date_enrollment.'%" ': '';
		$cond .= ($cohort != '') ?  ' AND dd.chrt_id="'.$cohort.'" ' : '';
		$cond .= ($concentration != '') ? ' AND dd.con_id="'.$concentration.'" ': '';
		$cond .= ($program != '') ? ' AND dd.program_id="'.$program.'" ': '';
		
		if($cond != '')
		{
			$cond = ' dd.std_id= ui.user_id AND d.dissertation_id=dd.dist_id '.$cond;
			$student_rec = $db->fetchAllRecord('tb_user_info ui, vw_dissertation_details dd, tb_dissertation d ' , ' std_name, con_name, dist_name, chrt_name, d.disseration_status, d.disseration_process_state, d.dissertation_id, dd.program_name ', $cond , NULL, ' ui.user_fname ', NULL,NULL,'All');	
			$rows_cnt = $db->getRowCount();
		}
		
		if($rows_cnt == 0)
		{
			echo '<div >No Results found.</div>';
		}
		else
		{
		?>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
		<thead>
			<th>Program</th>
			<th>Student Name</th>
			<th>Research Title</th>
			<th>Cohort</th>
			<th>Track</th>
			<th>Status</th>
		  </thead>
		  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($student_rec))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',$data->program_name,'</td>';
				echo '<td>',addLink($data->std_name, $data->disseration_status, $data->dissertation_id),'</td>',"\n";
				echo '<td>',$data->dist_name,'</td>',
					'<td class="center">',$data->chrt_name,'</td>',
					'<td class="center">',$data->con_name,'</td>',
					'<td class="center">',processStatus($data->disseration_process_state),'</td>';
      			
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
  <?php
		}//End of else
	}//End of Search condition
?>
</div>
</div>
