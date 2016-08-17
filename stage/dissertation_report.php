<?php
	$step = '2';
	$path = '..';
	$title =  'Reports ';
	$css = array('css/miscpages.css', 'css/report.css');//, 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css'
	$js = array('js/jquery.validate.js');//'report.js', 'jquery.metadata.js', 'jquery.dataTables.min.js'
	$last_report = '';
	
	require_once('includes/common.php');
	require_once('includes/reportFuncs.php');
	
	$dissertation = $db->fetchRecord(' vw_dissertation_details ', ' std_id, std_name, program_name,con_name, chrt_name, dist_name, dist_desc, DATE_FORMAT(dist_doc, "%b-%e- %Y") AS dist_doc, lang_name,lang_id  ', ' dist_id="'.$did.'" ');
	$std_id = $dissertation->std_id;
	$cond = ($dissertation->lang_id == 1) ?  ' role_constraints<>"1" ' : NULL;
	$db->fetchAllRecord(' tb_roles r LEFT JOIN tb_student_staff_rel rel ON r.role_id=rel.role_id AND rel.dissertation_id="'.$did.'" LEFT JOIN tb_user_info i ON rel.staff_id=i.user_id ' , ' r.role_id, r.role_title, r.role_desc,rel.staff_id, CONCAT(i.user_prefix," ",i.user_fname," ",i.user_lname) name, role_num ' , $cond, NULL,'  r.role_id ', NULL, 0,'All');
	$total_cnt = $db->getRowCount();
	for($i=0; $i<$total_cnt; $i++)
	{
		$x = $db->getRowObject();
		$role[$i]['id'] = $x->role_id;
		$role[$i]['title'] = $x->role_title;
		$role[$i]['staff'] = ((!isset($x->staff_id) || $x->staff_id == '' || $x->staff_id == 0) ? '<span class="allocation not">Not Assigned' : '<span class="allocation">'.$x->name ).'</span>';
		$role[$i]['staff_id'] = $x->staff_id;
		$role[$i]['num'] = $x->role_num;
	}	

	$db->fetchAllRecord(' tb_stages ' , ' stg_id, stg_title ' , NULL, NULL,'  stg_id ', NULL, 0,'All');
	$total_cnt = $db->getRowCount();
	for($i=0; $i<$total_cnt; $i++)
	{
		$x = $db->getRowObject();
		$stage[$i]['id'] = $x->stg_id;
		$stage[$i]['title'] = $x->stg_title;
	}
		
	$db->fetchAllRecord(' tb_role_stage_rel ' , ' stg_id, role_id, rel_ord ' , NULL, NULL,'  rel_ord ', NULL, 0,'All');
	$total_cnt = $db->getRowCount();
	for($i=0; $i<$total_cnt; $i++)
	{
		$x = $db->getRowObject();
		$rel[$x->stg_id][$x->role_id] = $x->rel_ord;
	}
	if($dissertation->lang_id != 1)
	{
		$chk_staff = $db->fetchRecord(' tb_student_staff_rel', ' staff_id ', ' dissertation_id="'.$did.'" AND std_id="'.$dissertation->std_id.'"  AND role_id="12" ');
		if($chk_staff){
			$rel[7][12]= $chk_staff->staff_id;
			$rel[9][12]= $chk_staff->staff_id;
		}
	}
	
	$hist_cnt = $db->fetchRecord(' tb_dissertation_history ', ' count(1) cnt ', ' dissertation_id="'.$did.'" AND std_id="'.$dissertation->std_id.'" ');
	switch($hist_cnt->cnt)
	{
		case 0:
		break;
		
		case 1:
			$hist = $db->fetchRecord(' tb_dissertation_history ', ' DATE_FORMAT(doc, "%b-%e-%Y") date ', ' dissertation_id="'.$did.'" AND std_id="'.$dissertation->std_id.'" ');
			$std_rep[1] = array('status' => 'AS', 'date' => $hist->date);
		break;
		
		default:
			$db->fetchAllRecord(' tb_dissertation_history ' , ' staff_id,stage_id, role_id, status, next_id,next_order, DATE_FORMAT(doc, "%b-%e-%Y") date,chk_staff ' , ' dissertation_id="'.$did.'" AND std_id="'.$dissertation->std_id.'" AND stage_id<>0 AND role_id<>0 ', NULL,'  history_id ', NULL, 0,'All');
			$total_cnt = $db->getRowCount();
			for($i=0; $i<$total_cnt; $i++)
			{
				$x = $db->getRowObject();
				$report[$x->stage_id][$x->role_id][$x->staff_id] = array('status' => $x->status,
																		'date' => $x->date,
																		'next'=>$x->next_id,
																		'step'=>$x->next_order,
																		'chk_staff' => $x->chk_staff,
																		'stg_id' => $x->stage_id);				
												
				$last_report = array('status' => $x->status,
								'date' => $x->date,
								'next'=>$x->next_id,
								'step'=>$x->next_order,
								'chk_staff' => $x->chk_staff,
								'stg_id' => $x->stage_id,
								'role_id' =>$x->role_id,
								'staff' => $x->staff_id);
																		
				$std_rep[$x->stage_id]=array('staff' => $x->staff_id, 'status' => $x->status, 'date' => $x->date, 'nextid'=>$x->next_id);
				if($x->next_id == $dissertation->std_id && $x->status != 'M')
				{
					$std_rep[$x->stage_id+1]=array('staff' => 0, 'status' => 'SA', 'date' => $x->date);
				}
			}
		break;
	}
	/*
	echo '<pre>';
	print_r($last_report);
	exit;*/
	/**** Condition for Next Assignment ****/
	if(is_array($last_report))
	{
		if($last_report['role_id'] == 12)
		{
			$correct_rol = $db->fetchRecord(' tb_role_stage_rel ', ' role_id  ', ' rel_ord="'.$last_report['step'].'" ');	
			$last_report['role_id'] = $correct_rol->role_id;
		}
		if($last_report['next'] != 0 && $last_report['chk_staff'] == 0 )//&& $last_report['status'] != 'M'
		{
			$next_sts = 'AS';
			if($last_report['next'] == $dissertation->std_id)
			{
				if($last_report['status'] == 'M')
				{
					$last_report['next'] = 0;
					$next_sts = 'E';				
				}
			}
			else
			{
				$next_role = $db->fetchRecord(' tb_role_stage_rel rel, tb_roles r ', ' r.role_id ', ' r.role_id=rel.role_id AND rel.rel_ord="'.$last_report['step'].'" ');
				$last_report['role_id'] = $next_role->role_id;
			}
			$report[$last_report['stg_id']][$last_report['role_id']][$last_report['next']] = array('status' => $next_sts,
																	'date' => $x->date,
																	'step'=>$last_report['next']);

		}
		else if($last_report['chk_staff'] > 0)
		{
			$report[$last_report['stg_id']][12][$last_report['next']] = array('status' => 'AS',
																	'date' => $x->date,
																'step'=>$last_report['next']);
		}
		else if($last_report['next'] == 0)
		{
			$mul_roles = $db->fetchRecord(' tb_role_stage_rel rel, tb_roles r ', ' r.role_id, r.role_num ', ' r.role_id=rel.role_id AND rel.rel_ord="'.$last_report['step'].'" ');
			if($mul_roles->role_num > 1)
			{
				$next_ids = $db->fetchAllRecord(' tb_student_staff_rel ' , ' staff_id ' , ' role_id="'.$mul_roles->role_id.'" AND dissertation_id="'.$did.'" AND std_id="'.$dissertation->std_id.'" ',NULL, NULL, NULL, 0,'All');
				while ($next_rec = mysql_fetch_object($next_ids)) {
					$report[$last_report['stg_id']][$mul_roles->role_id][$next_rec->staff_id] = array('status' => 'AS',
																'date' => $x->date,
																'step'=>$next_rec->staff_id);
				}
			}
		}
	}
	
	$role_cnt = count($role);
	$stage_cnt = count($stage);
	switch($UTYPE){
		case 'SD':
			$page_title = 'Student Report';
		break;
	}
	
	$back_btn = '';
	echo $_SERVER['HTTP_REFERER'];
	if(strrpos($_SERVER['HTTP_REFERER'], "activities_list") !==  false){
		$back_btn = '<input type="button" onclick="javascript:document.location.href=\'activities_list.php\';" value="<<Back"><br/>';
	}
?>
<div id="main">
	<div class="select-bar">
				    <h2><?php echo 'Student Report';?></h2>
			</div>
<?php 
require_once($path.'/pages/dissertation_details.php');
if($hist_cnt->cnt > 0)
{
	require_once($path.'/pages/report.php');
}
else
{
	echo '<div style="margin:0 auto; text-align:center;font-weight:bold;">Staff Allocation Pending</div>';
}
?>
</div>
</div>
