<?php
$allocation = $db->fetchRecord(' tb_student_staff_rel ', ' count(1) AS cnt ', ' dissertation_id="'.$did.'"');
if($allocation->cnt > 0){

	if($UTYPE == 'SD')
	{
		$userdata = $db->fetchRecord(' vw_dissertation_details i  JOIN tb_dissertation_history h ', ' i.program_id, i.program_name, h.history_id hid,i.std_id,i.std_name,i.std_photo,i.con_name,i.chrt_id, i.chrt_name,i.dist_name,i.dist_desc,DATE_FORMAT(i.dist_doc, "%b-%e- %Y") dist_doc,i.lang_name, h.status,h.next_id,h.next_order, i.email ', ' h.std_id=i.std_id AND h.dissertation_id=i.dist_id AND i.dist_id="'.$did.'" AND i.std_id="'.$UID.'" AND h.history_id = (
SELECT MAX(history_id) FROM  tb_dissertation_history WHERE std_id="'.$UID.'" AND dissertation_id="'.$did.'")');
		$next_order = $userdata->next_order;	
		
	}
	else
	{
		if(isset($rid))
		{
			$role_obj = $db->fetchRecord(' tb_roles', ' role_title, role_num ', ' role_id="'.$rid.'"');
			$role_title = $role_obj->role_title;
			if($role_obj->role_num > 1)
			{
				$userdata = $db->fetchRecord(' vw_dissertation_details i  JOIN tb_student_staff_rel r ', ' i.program_id, i.program_name, i.std_id,i.std_name,i.std_photo,i.con_name, i.chrt_id, i.chrt_name, i.dist_name, i.dist_desc, DATE_FORMAT(i.dist_doc, "%b-%e- %Y") dist_doc,i.lang_name, "S" AS status, i.email ', ' i.dist_id = "'.$did.'" AND r.staff_id = "'.$UID.'" AND r.role_id="'.$rid.'" AND i.dist_id = r.dissertation_id AND i.std_id = r.std_id AND r.rel_status = "S" ');
			
				$data_obj = $db->fetchRecord(' tb_role_stage_rel', ' rel_ord ', ' role_id="'.$rid.'"');
				$next_order = $data_obj->rel_ord;
			}else
			{
				$userdata = $db->fetchRecord(' vw_dissertation_details i  JOIN tb_dissertation_history h ', ' i.program_id, i.program_name, h.history_id hid, i.std_id, i.std_name, i.std_photo, i.con_name, i.chrt_id, i.chrt_name, i.dist_name, i.dist_desc, DATE_FORMAT(i.dist_doc, "%b-%e- %Y") dist_doc,i.lang_name, h.status,h.next_id,h.next_order,h.chk_staff, i.email ', ' h.std_id=i.std_id AND h.dissertation_id=i.dist_id AND i.dist_id="'.$did.'" AND next_id="'.$UID.'"  AND h.history_id=(SELECT MAX(history_id) FROM  tb_dissertation_history WHERE next_id="'.$UID.'"  AND dissertation_id="'.$did.'")');
				$next_order = $userdata->next_order;
			}
		}
		if(isset($op) && $op == 'C')
		{
			$userdata = $db->fetchRecord(' vw_dissertation_details i JOIN tb_dissertation_history h ', ' i.program_id, i.program_name, h.history_id hid, i.std_id,i.std_name, i.std_photo, i.con_name,i.chrt_id,i.chrt_name,i.dist_name,i.dist_desc,DATE_FORMAT(i.dist_doc, "%b-%e- %Y") dist_doc,i.lang_name, h.status,h.next_id,h.next_order,h.chk_staff,i.email ', '  i.dist_id="'.$did.'" AND h.history_id= (SELECT MAX(history_id) FROM tb_dissertation_history WHERE dissertation_id="'.$did.'") ');
			$next_order = $userdata->next_order;
		}
	}

	
	$next_order = ($next_order==0 && $UTYPE == 'SD')  ? $next_order+1 : $next_order;
	
	if($UTYPE=='SD' && $next_order==$max_step)
	{
		$userdata->next_id = $userdata->std_id+1;				
		$stgdata->stg_title = 'Completed';
	}
	else
	{
		if($UTYPE!='SD' && $userdata->chk_staff > 0)
		{
			$staff_next_step = $userdata->next_order;
			$staff_fail_step = $userdata->next_order;
			$stgdata = $db->fetchRecord(' tb_role_stage_rel r, tb_stages s', ' r.role_id,s.stg_id, s.stg_title, s.stg_description, r.nextstep, r.failstep, r.chkrole ', ' r.rel_ord ="'.$userdata->next_order.'" and r.stg_id=s.stg_id ');
			$stgdata->role_id = 12;
			$flow_chk = 'Y';
		}
		else
		{
			if($next_order != 0 && $next_order < $max_step )
			{
				$stgdata = $db->fetchRecord(' tb_role_stage_rel r, tb_stages s', ' r.role_id,s.stg_id, s.stg_title, s.stg_description, r.nextstep, r.failstep, r.chkrole ', ' r.rel_ord ="'.$next_order.'" and r.stg_id=s.stg_id ');
				$staff_next_step = $stgdata->nextstep;
				$staff_fail_step = $stgdata->failstep;
				$chkrole = $stgdata->chkrole;
				$chktable = 4;
			}
			else
			{
				$staff_next_step = 0;
				$staff_fail_step = 0;
			}
		}
		if($userdata->status != 'S')
		{
			$staff = $db->fetchRecord(' tb_user_info', ' user_fname, user_lname, user_prefix ', ' user_id="'.$userdata->next_id.'" ');
		}
		if($UTYPE == 'SD')
		$result = $db->fetchAllRecord(' tb_dissertation_history ' , ' * ', '  history_id<>"'.$userdata->hid.'" AND std_id="'.$UID.'" AND dissertation_id="'.$did.'" ', NULL , ' doc ',  ' DESC ', NULL,'All');
	}
}
else
{
	$userdata = $db->fetchRecord(' vw_dissertation_details i ', ' i.program_id, i.program_name,i.std_id, i.std_name, i.std_photo, i.con_name, i.chrt_id, i.chrt_name, i.dist_name, i.dist_desc, DATE_FORMAT(i.dist_doc, "%b-%e- %Y") dist_doc, i.lang_name, i.email ', '  i.dist_id="'.$did.'" ');
}