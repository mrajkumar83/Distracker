<?php
/**** Next Condition **********/
$next_order = (isset($next_order) && $next_order != '') ? $next_order : 0;
$nextstep_staff = '';
if($UTYPE == 'SD')
{
	$staff_next_step =  $next_order;
}
if($staff_next_step != 0  && $next_order < $max_step)
{
	$nextAllocation = $db->fetchRecord(' tb_role_stage_rel rsr, tb_student_staff_rel ssr LEFT JOIN tb_user_info info ON info.user_id=ssr.staff_id, tb_roles r ', ' ssr.staff_id, r.role_title, CONCAT(info.user_prefix, ". ",info.user_fname, " ",info.user_lname) staff_name ', '  ssr.role_id = rsr.role_id AND r.role_id = rsr.role_id AND rsr.rel_ord ="'.$staff_next_step.'" AND ssr.dissertation_id="'.$did.'" ');
	if($nextAllocation->staff_id == 0)
	{
		$nextstep_role = $nextAllocation->role_title;
		$nextstep = false;
	}else
	{
		$role_title = $nextAllocation->role_title;
		$nextstep_staff = $nextAllocation->staff_name;
	}
	$role_title = ($UTYPE == 'SD') ? $nextAllocation->role_title : $role_title;
}