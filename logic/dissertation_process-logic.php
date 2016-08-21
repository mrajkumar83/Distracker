<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');
require_once('../common/checksess.php');	
require_once('../common/fileupload.php');
require_once('../stage/includes/proxy_user.php');//Has to be after common.php because session has not be disturbed

$staff = ($UTYPE != 'SD') ? $UID : 0;
$sts = ($UTYPE != 'SD') ? $sts : 'S';

$db->storeDetails(' tb_dissertation ', ' disseration_process_state="S" ', ' WHERE dissertation_id="'.$did.'" AND std_id="'.$std_id.'" ');

if($UTYPE == 'SD')
{
	$next_order = $rel_ord;
	$next_id = 0;
	$role_obj = $db->fetchRecord(' tb_roles', ' role_num ', ' role_id="'.$rid.'"');
	if($role_obj->role_num == 1)
	{
		$rel_sts = 'S';		
	}
	else
	{
		$db->storeDetails(' tb_student_staff_rel ', ' rel_status="S" ', ' WHERE dissertation_id="'.$did.'" AND std_id="'.$std_id.'" AND role_id="'.$rid.'" ');
		
	}
}else
{
	if((int)$sts > 0)
	{
		//$constraint_obj = $db->fetchRecord(' tb_role_stage_rel', ' role_num ', ' role_id="'.$rid.'"');
		$db->storeDetails(' tb_student_staff_rel ', ' rel_status="S" ', ' WHERE dissertation_id="'.$did.'" AND std_id="'.$std_id.'" AND role_id="'.$sts.'" ');
	}
	else
	{
		require_once('staff_dissertation_logic.php');
	}
}

//echo $std_id, '--',$did, '--',$rid, '--',$sid, '--',$next_order, '--',$msg, '--',$staff,'--', $sts, '--', $next_id;exit;
//echo date(DATE_TIME_FORMAT);exit;

if($UTYPE != 'SD' && (int)$sts > 0)
{
	$chk_staff = $db->fetchRecord(' tb_student_staff_rel', ' staff_id ', ' dissertation_id="'.$did.'" AND std_id="'.$std_id.'"  AND role_id="'.$sts.'" ');
	$db->storeDetails(' tb_student_staff_rel ', ' rel_status="C" ', ' WHERE dissertation_id="'.$did.'" AND std_id="'.$std_id.'" AND role_id="'.$rid.'" AND staff_id="'.$staff.'" ');
	$db->storeDetails(' tb_dissertation_history ', ' dissertation_id="'.$did.'", std_id="'.$std_id.'", role_id="'.$rid.'", staff_id="'.$staff.'",stage_id="'.$sid.'", comments="'.$msg.'", status="F", next_id="'.$chk_staff->staff_id.'", next_order="'.$rel_ord.'", chk_staff="'.$staff.'", doc="'.date(DATE_TIME_FORMAT).'" ');
	$hid = $db->newRowId;
}
else
{
	$history_result = $db->callProcedure('dissertationflow', $std_id, $did, $rid, $sid, $next_order, '"'.$msg.'"', $staff, '"'.$sts.'"', $next_id, '"'.date(DATE_TIME_FORMAT).'"', '@hid');
	$hid = mysql_fetch_row($history_result);
	$hid = $hid[0];
	if($flow_chk == 'Y')
	{
		$db->storeDetails(' tb_student_staff_rel ', ' rel_status="C" ', ' WHERE dissertation_id="'.$did.'" AND std_id="'.$std_id.'" AND staff_id="'.$staff.'" ');
	}
}
if(isset($_FILES['disseration_files']) && $hid)
{
	$cnt_files = (int)count($_FILES['disseration_files']['name']);
	for($i=0; $i<$cnt_files; $i++){
		$image = (isset($_FILES['disseration_files']['name'][$i]) && ($_FILES['disseration_files']['name'][$i] != '')) ? fileupload('TXT','../images/disseration_files','disseration_files',$i, '', $hid ) : '';
		$attachments = '';
		if($image)
		{
			$attachments[]= array('name' =>$_FILES['disseration_files']['name'][$i], 'path' => '../images/disseration_files/'.$image);
			$db->storeDetails(' tb_dissertation_documents ', ' document_id = "", document_uploader="'.$UID.'", document_name = "'.htmlspecialchars($_FILES['disseration_files']['name'][$i]).'", disseration_id = "'.$did.'", document_path = "'.$image.'", document_hid="'.$hid .'"');
		}
	}//End of for(;;)	
}//End of if()
require_once('mail_stages.php');
if(isset($op) && $op=='U' && isset($did) && isset($std_id) && is_numeric($std_id)){
	header('Location: dissertation_list.php?op=H&amp;cid='.$cid);
}
header('Location:../stage/dissertation-flow.php?did='.$did.'&op=C&sts_sent='.$sts);