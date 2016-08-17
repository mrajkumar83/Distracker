<?php
	$step = '2';
	$path = '..';
	$title =  'Program ';
	$css = array('css/register.css', 'css/miscpages.css');
	$js = array('js/jquery.validate.js', 'js/program.js');
	
	require_once('../common/sess.php');
	require_once('../common/configure.php');
	require_once('../classes/Database.class.php');
	require_once('../classes/Query.class.php');
	require_once('../includes/commonheader.php');
	
	$db = new Query();
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'ADD';
	$program_name = '';
	$program_mandatory = 'N';
	$pageTitle = 'Add Program';
	
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_programs ', ' program_name, program_mandatory ', ' program_id="'.$id.'"');		
		$op = 'Edit';
		$program_name = $data->program_name;
		$program_mandatory = $data->program_mandatory;
		$pageTitle = 'Edit program';
	}
?>
<div id="main">
	<div class="top-bar">
		<h1><?php echo $pageTitle;?></h1>
	</div>
	<?php require_once('../pages/program.php');?>
</div>
</body>
</html>
