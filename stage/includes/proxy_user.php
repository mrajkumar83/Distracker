<?php
if(isset($op) && $op=='U' && isset($did) && isset($std_id) && is_numeric($std_id)){
	$OUID = $UID;
	$OUNAME = $UNAME;
	$OUTYPE = $UTYPE;
	$OUEMAIL = $UEMAIL;	
	
	$std_details_proxy = $db->fetchRecord('tb_users', ' user_name, user_fullname, user_type, user_email ', '  user_id="'.$std_id.'" ');
	
	$UID = $std_id;
	$UNAME = $std_details_proxy->user_name;
	$UTYPE = $std_details_proxy->user_type;
	$UEMAIL = $std_details_proxy->user_email;
	$UFULLNAME = $std_details_proxy->user_fullname;	
}