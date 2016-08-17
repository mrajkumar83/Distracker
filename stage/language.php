<?php
	$step = '2';
	$path = '..';
	$title =  'Language ';
	$css = array('css/register.css', 'css/miscpages.css');
	$js = array('js/jquery.validate.js', 'js/lang.js');
	
	require_once('../common/sess.php');
	require_once('../common/configure.php');
	require_once('../classes/Database.class.php');
	require_once('../classes/Query.class.php');
	require_once('../includes/commonheader.php');
	
	$db = new Query();
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'ADD';
	$lang_name = '';
	$lang_code = '';
	$pageTitle = 'Add Language';
	
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_languages ', ' lang_name,lang_code ', ' lang_id="'.$id.'"');		
		$op = 'Edit';
		$lang_name = $data->lang_name;
		$lang_code = $data->lang_code;
		$pageTitle = 'Edit Language';
	}
?>
<div id="main">
	<div class="top-bar">
		<h1><?php echo $pageTitle;?></h1>
	</div>
	<?php require_once('../pages/language.php');?>
</div>
</body>
</html>
