<?php
session_start();
if(isset($_SESSION) && isset($_SESSION['UID']))
{
	$UID = $_SESSION['UID'];
	$UNAME = $_SESSION['UNAME'];
	$UTYPE = $_SESSION['UTYPE'];
	$UEMAIL = $_SESSION['UEMAIL'];
	$UFULLNAME = $_SESSION['UFULLNAME'];
	if($_SESSION['TIMEZONE']){
		ini_set( 'date.timezone', $_SESSION['TIMEZONE'] );
	}
	@define('ADMINMAIL', $_SESSION['ADMIN_MAIL']);
}else{
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
<?php
	}
?>