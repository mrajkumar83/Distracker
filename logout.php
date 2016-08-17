<?php
@session_start();
require_once('./common/configure.php');
require_once('./classes/Database.class.php');
require_once('./classes/Query.class.php');

$db = new Query();

$output = $db->storeDetails('tb_users', ' user_sess="0" ',' WHERE user_sess="'.session_id().'" ');
session_destroy();

if(isset($step))
{
	switch($step)
	{
		case '1':
			$step = '.parent';
		break;
		
		case '2':
			$step = '.parent.parent';
		break;
		
		default:
			$step = '';
		break;
	}
}else
{
	header("Location: index.php");
}
?>
<html>
<body>
<script language="javascript">
	window<?php echo $step;?>.document.location.href = "../index.php";
</script>
</body>
</html>