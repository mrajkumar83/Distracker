<?php
	$step = '2';
	$path = '..';
	$title =  'Assign Admin :: ';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	require_once('includes/common.php');
	
	$result = $db->fetchAllRecord(' tb_users ' , ' user_id,user_name,user_fullname,user_email ', 'user_type="SF" AND user_status="A" AND user_id <> "'.$UID.'"' , NULL, '  user_name', NULL, 0,'All');
?>
<div id="main">
	<div id="sts"></div>
	<div class="top-bar">
			<h1>Assign Admin</h1>
		</div>
	  <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Name</th>
		<th>User Name</th>
		<th>Email</th>		
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($result))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td><a href="admin_user.php?op=E&amp;id=',$data->user_id,'" title="Change the User type" alt="Change the User type">',$data->user_fullname ,'</a></td>',"\n";
				echo '<td>',$data->user_name,'</td>';
				echo '<td>',$data->user_email,'</td>';
    		echo '</tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>