<?php
/******* History *****************/
$std_name = $dissertation->std_name;
$std_photo = ($dissertation->std_photo != '' && file_exists($path.'/images/photos/'.$dissertation->std_photo)) ? $path . '/images/photos/'. $dissertation->std_photo : $path . '/img/profile_noimg.jpg'; 


$tables = ' tb_dissertation_history h LEFT JOIN tb_user_info u ON u.user_id= h.staff_id ,vw_stage_role_rel r ';
$std = ($UTYPE == 'SD') ? $UID : $userdata->std_id;
$history = $db->fetchAllRecord($tables , ' h.history_id, CONCAT(u.user_prefix," ",u.user_fname," ",u.user_lname) name,  u.user_photo,h.comments,h.status, r.stg_id,r.stg_title,r.role_id,r.role_title, DATE_FORMAT(h.doc, "%b-%e- %Y") doc, h.staff_id, h.chk_staff ', '  
h.stage_id = r.stg_id AND r.role_id=h.role_id AND h.std_id="'.$std.'" AND h.dissertation_id="'.$did.'" ', NULL , ' h.doc ',  ' DESC ', NULL,'All');
if($next_order != 0)
{

	if($next_order  > 21)
	{
		$stgdata->stg_title = 'Graduated';
	}
	else if(!isset($stgdata->stg_title) || $stgdata->stg_title == '')
	{
		$stgdata->stg_title = 'Yet to Allocate Staff';
	}
}
else
{
	$stgdata->stg_title = 'Pending With Other Staff';
}