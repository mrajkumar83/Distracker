<?php
if(isset($_SESSION['TIMEZONE'])){
	ini_set( 'date.timezone', $_SESSION['TIMEZONE'] );
	@date_default_timezone_set($_SESSION['TIMEZONE']);
}
$db = new Query();
$u = $db->fetchRecord('tb_users', ' user_sess ', ' user_id="'.$UID.'" '); 
if($u->user_sess != session_id())
{
	session_destroy();
?><html>
	<body>
		<script language="javascript">
			window.parent.parent.document.location.href = "../index.php?Err=5";
		</script>
	</body>
</html>
<?php
	exit;
	}
?>