<?php
	$path = '..';
	$step = '1';
	$title = 'Student :: ';
	
	$css = array('css/left_menu.css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
	$js = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', 'js/common.js');
	
	require_once('../common/configure.php');
	require_once('../common/sess.php');		
	require_once('../includes/commonheader.php');	
	if($UTYPE != 'SD')
	{
?>	<script language="javascript">
		window.parent.document.location.href = "../index.php";
	</script>
</body>
</html>
<?php
	}
?>
<div id="middle" class="row">
	<div id="left-column" class="col-sm-2">	
		<!--
		<h3>Dissertation</h3>
		<ul class="nav">
			<li class="text leftMenuActive"><a target="frame2" href="manage_dissertation.php">Manage Dissertation</a></li>
		</ul>
		-->
		
        <h3>Research Study Flow</h3>
			<ul class="nav">
				<li  class="last"><a target="frame2" href="dissertation_list.php?op=L">Research Tasks </a></li>				
			</ul>
		<h3>My Reports</h3>
			<ul class="nav">
				<li  class="last"><a target="frame2" href="dissertation_list.php?op=R">Research Progress</a></li>
			</ul>
		</div>
		<div class="col-sm-10">
		<iframe id="frame2" name="frame2" src="dissertation_list.php?op=L" width="86%" height="600px" frameborder="0"></iframe>
		</div>
</div>
</body>
</html>