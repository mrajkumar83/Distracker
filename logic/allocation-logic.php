<?php
$step = '2';
$path = '..';
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/checksess.php');
require_once('../common/fileupload.php');

function insertDB( $role, $staff)
{
	global $db,$std_id, $dissertation_id;
	return $db->storeDetails('tb_student_staff_rel', '  std_id="'.$std_id.'", dissertation_id = "'.$dissertation_id.'", role_id = "'.$role.'", staff_id = "'.$staff.'", rel_status="A", rel_doc="'.date(DATE_TIME_FORMAT).'"');
}
function loopPost($stg, $op = ''){
	global $db,$std_id, $dissertation_id;
	foreach($stg as $role => $staff)
	{
		if($op != '')
		{
			$db->delData('tb_student_staff_rel', ' std_id="'.$std_id.'" AND dissertation_id = "'.$dissertation_id.'" AND (rel_status <> "P" OR rel_status <> "C") AND role_id = "'.$role.'"');
		}
		if(is_array($staff))
		{
			$cnt = count($staff);
			if($cnt == 0)
			{
				insertDB( $role, 0);
			}
			for($i=0; $i<$cnt; $i++)
			{
				insertDB( $role, $staff[$i]);
			}
		}
		else
		insertDB( $role, $staff);
	}
}

switch($op)
{
	case 'ADD':
		loopPost($stg);
		//$db->storeDetails('tb_student_staff_rel', ' rel_status = "S"', ' WHERE std_id="'.$std_id.'" AND dissertation_id = "'.$dissertation_id.'" AND role_id = "1"'); //Start the process
		$db->storeDetails('tb_dissertation', ' disseration_process_state = "A"', ' WHERE std_id="'.$std_id.'" AND dissertation_id = "'.$dissertation_id.'"');//Change the project status
		$db->storeDetails('tb_dissertation_history', ' history_id="", std_id="'.$std_id.'", dissertation_id = "'.$dissertation_id.'", staff_id="0", role_id="0", stage_id="0", status="S", next_id="'.$std_id.'" ');
		
		$keys = array_keys($stg);
		$roles_rec = $db->fetchAllRecord(' tb_roles ' , ' role_id ', ' role_status="A" AND role_num>"1" ' , NULL, '  role_id ', NULL, 0,'All');
		while($roles = mysql_fetch_object($roles_rec))
		{
			if(!in_array($roles->role_id, $keys))
			{
					insertDB( $roles->role_id, 0);
			}
		}
		header('Location: ../stage/manage_allocation.php?project_sts=N');
		
	break;
	case 'Edit':
			$start_role =$db->fetchRecord(' tb_student_staff_rel ' , ' role_id ', ' std_id="'.$std_id.'" AND dissertation_id = "'.$dissertation_id.'" AND rel_status = "S"');
			loopPost($stg, 'E');
			$db->storeDetails('tb_student_staff_rel', ' rel_status = "S" ', ' WHERE std_id="'.$std_id.'" AND dissertation_id = "'.$dissertation_id.'" AND role_id="'.$start_role->role_id.'" ');
			header('Location: ../stage/manage_allocation.php?project_sts=A');
	break;

	case 'D':
			$db->delData('tb_student_staff_rel', ' std_id="'.$std_id.'" AND dissertation_id = "'.$dissertation_id.'"');
			$db->storeDetails('tb_dissertation', ' disseration_process_state = "N"', ' WHERE std_id="'.$std_id.'" AND dissertation_id = "'.$dissertation_id.'"');//Change the project status
			header('Location: ../stage/manage_users.php?sts=DD&utype='.$utype);
	break;

}
exit;