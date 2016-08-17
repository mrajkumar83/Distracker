<?php
	$step = '2';
	$path = '..';
	$title =  'Concentration :: ';
	$css = array('css/miscpages.css', 'css/jquery.datepick.css');
	$js = array('js/jquery.validate.js', 'js/concentration.js', 'js/date/jquery.datepick.js');
	
	require_once('../common/sess.php');
	require_once('../common/configure.php');
	require_once('../classes/Database.class.php');
	require_once('../classes/Query.class.php');
	require_once('../common/checksess.php');
	require_once('../includes/commonheader.php');
	
	$langs = $db->fetchAllRecord('tb_languages ' , ' lang_id,lang_name ', NULL , NULL, NULL, NULL,NULL,'All');
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'ADD';
	$concentration_name = '';
	$concentration_ref = '';
	$concentration_edate = '';
	$concentration_languages = array();
	$concentration_description = '';
	$concentration_status = 'A';
	$pageTitle = 'Add Track';
	
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_concentration ', ' * ', ' concentration_id="'.$id.'"');		
		$op = 'Edit';
		$concentration_name = $data->concentration_name;
		$concentration_ref = $data->concentration_ref;
		$concentration_edate = date_reverse($data->concentration_edate);
		$concentration_languages =  explode(',', $data->concentration_languages);
		$concentration_description = $data->concentration_description;
		$concentration_status = $data->concentration_status;
		$pageTitle = 'Edit  Track';
	}
?>
<div id="main">
	<div class="top-bar">
		<h1><?php echo $pageTitle;?></h1>
	</div>
	<?php require_once('../pages/concentration.php');?>
</div>
</body>
</html>
