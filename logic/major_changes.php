<?php
$nextrole_num = $db->fetchRecord(' tb_role_stage_rel rsr, tb_roles r ', ' r.role_num, r.role_id ', '  r.role_id = rsr.role_id AND  rsr.rel_ord ="'.$next_order.'" ');
if($nextrole_num->role_num == 1)
{
	$nextAllocation = $db->fetchRecord(' tb_role_stage_rel rsr, tb_student_staff_rel ssr ', ' ssr.staff_id, ssr.role_id ', '  ssr.role_id = rsr.role_id AND  rsr.rel_ord ="'.$next_order.'" AND ssr.dissertation_id="'.$did.'" ');
	$next_id = $nextAllocation->staff_id;
	$db->storeDetails(' tb_student_staff_rel ', ' rel_status="S" ', ' WHERE dissertation_id="'.$did.'" AND std_id="'.$std_id.'" AND role_id="'.$nextAllocation->role_id.'" AND staff_id="'.$next_id.'" ');
}
else
{
	$next_id = 0;
	$db->storeDetails(' tb_student_staff_rel ', ' rel_status="S" ', ' WHERE dissertation_id="'.$did.'" AND std_id="'.$std_id.'" AND role_id="'.$nextrole_num->role_id.'" ');
}