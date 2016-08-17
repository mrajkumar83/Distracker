<?php
	$step = '2';
	$path = '..';	
	$title =  'Role-Stage :: ';
	$css = array('css/miscpages.css', 'css/jquery.datepick.css');
	$js = array('js/cohort.js', 'js/date/jquery.datepick.js');
	require_once('includes/common.php');
	
	$db = new Query();
	$order = $db->fetchRecord(' tb_role_stage_rel ' , ' MAX(rel_ord) AS ord ', NULL , NULL, NULL, NULL, 0,'All');
	$role_stage__ord = (int)$order->ord;
	
	$roles = $db->fetchAllRecord('tb_roles ' , ' role_id,role_title ', ' role_status = "A" ' , NULL, 'role_title', NULL,NULL,'All');
	$roles1 = $db->fetchAllRecord('tb_roles ' , ' role_id,role_title ', ' role_status = "A" ' , NULL, 'role_title', NULL,NULL,'All');
	$stage = $db->fetchAllRecord('tb_stages ' , ' stg_id,stg_title ', ' stg_sts = "A" ' , NULL, NULL, NULL,NULL,'All');
	
	
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'ADD';
	$stg_id = '';
	$role_id = '';
	$nextstep = '';
	$role_stage__ord += 1;
	$rel_ord = $role_stage__ord;
	$rolestg_order_sel = $rel_ord;
	$chkrole = '';
	$failstep = '';
	$mail_to = '';
	$pageTitle = 'Add Stage Role Relation';
	
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_role_stage_rel ', ' * ', ' stg_role_id="'.$id.'"');		
		$op = 'Edit';
		$stg_id = $data->stg_id;
		$role_id = $data->role_id;
		$nextstep = $data->nextstep;
		$rolestg_order_sel = $data->rel_ord;
		$mail_to = $data->mail_to;
		
		$pageTitle = 'Edit Stage Role Relation';
	}
	
?>
<div id="main">
	<div class="top-bar">
			<h1><?php echo $pageTitle;?></h1>
		</div>
	<?php require_once('../pages/role_stage.php');?>
</div>
</body>
</html>