<?php
	require_once('common/configure.php');
	$title =  'Registered :: ';
	$css = array('css/all.css');
	require_once('includes/commonheader.php');
?>
<div id="main">
<div class="logo">
	<div class="header-right"><a href="index.php"><strong>Login</strong></a></div>
</div>
<div class="bodyDiv">
<?php 
if(isset($sts) && $sts == 'AA')
{
	echo '<div style="text-align:center; margin:300px auto; font-weight:bold;">Thanks for registering.  Please check E-mail and activate your account.<br>';
	echo '<a href="index.php">Login</a></div>';
}
?>
</div>
</div>
<?php require('includes/footer.php');?>

