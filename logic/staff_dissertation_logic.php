<?php
$role_obj = $db->fetchRecord(' tb_roles', ' role_num ', ' role_id="'.$role.'"');
$rel_sts = ($sts == 'M') ? 'P' : 'C';
$next_order = ($sts == 'M') ? $staff_fail_step : $staff_next_step;	
if($role_obj->role_num == 1)
{
	if($next_order != 0)
	{
		require_once('major_changes.php');
	}
	else
	{
		$next_id = $std_id;
		$next_order = ($sts == 'M') ? $rel_ord :($rel_ord+1);
	}
}
else
{
	if($sts == 'M')
	{
		$db->storeDetails(' tb_student_staff_rel ', ' rel_status="P" ', ' WHERE dissertation_id="'.$did.'" AND std_id="'.$std_id.'" AND role_id="'.$role.'" ');
		if($staff_fail_step == 0)
		{
			$next_order = $rel_ord;
			$next_id = $std_id;
		}
		else
		{
			require_once('major_changes.php');
		}		
	}
	else
	{
		$staff_rel = $db->fetchAllRecord(' tb_student_staff_rel ' , ' staff_id,rel_status ', ' std_id="'.$std_id.'" AND dissertation_id = "'.$did.'" AND role_id = "'.$role.'"' , NULL, NULL, NULL, NULL,'All');
		$cnt = 0;
		$sts_cnt = 0;
		$sts_arr = array();
		$sts_id = array();
		while($staff_rel_obj = mysql_fetch_object($staff_rel))
		{
			$staff_rel_arr[$cnt]['id'] = $staff_rel_obj->staff_id;
			$staff_rel_arr[$cnt]['sts'] = $staff_rel_obj->rel_status;
			$sts_arr[] = $staff_rel_obj->rel_status;
			if($staff_rel_obj->rel_status != 'C' && $staff_rel_obj->staff_id != $UID)
			{
				$sts_cnt++;
			}
			$cnt++;			
		}//End of while{}
		
		//Moving to next step
		if($sts_cnt == 0)
		{
			if($next_order == 0)
			{
				$next_id = $std_id;
				$next_order = $rel_ord+1;
			}
			else
			{
				require_once('major_changes.php');
			}
		}
		else
		{
			$next_order = $rel_ord;
			$next_id = 0;
		}
		
		if($next_id == 0)
		{
			$rid = $role;
		}
	}	
}
//$rel_ord = ($sts == 'M') ? $rel_ord :($rel_ord+1);