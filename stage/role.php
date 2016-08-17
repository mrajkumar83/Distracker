<?php
	$step = '2';
	$path = '..';	
	$title =  'Role :: ';
	$css = array('css/miscpages.css');
	$js = array('js/jquery.validate.js', 'js/role.js');
	require_once('includes/common.php');
	
	$db = new Query();
	$order = $db->fetchRecord(' tb_roles ' , ' MAX(role_disp_ord) AS ord ', NULL , NULL, NULL, NULL, 0,'All');
	$role_ord = (int)$order->ord;
	
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'ADD';
	$role_title = '';
	$role_sc = '';
    $role_desc = '';
	$role_num = '';
	$role_ord += 1;
	$role_disp_ord = $role_ord;
	$role_order_sel = $role_ord;
	$role_reqd = '';
	$role_constraints = '';
	$role_status = 'A';
	$pageTitle = 'Add Role';
	
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_roles ', ' * ', ' role_id="'.$id.'"');		
		$op = 'Edit';
		$role_title = $data->role_title;
		$role_sc = $data->role_sc;
		$role_desc = $data->role_desc;
		$role_num = $data->role_num;
		$role_order_sel = $data->role_disp_ord;
		$order1 = $data->role_disp_ord;
		$role_reqd = $data->role_reqd;
		$role_constraints = $data->role_constraints;
		$role_status = $data->role_status;
		$pageTitle = 'Edit Roles';
	}
	
?>
<div id="main">
	<div class="top-bar">
			<h1><?php echo $pageTitle;?></h1>
		</div>
	<?php require_once('../pages/role.php');?>
</div>
</body>
</html>

