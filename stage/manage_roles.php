<?php
	$step = '2';
	$path = '..';
	require_once('../common/configure.php');
	require_once('../classes/Database.class.php');
	require_once('../classes/Query.class.php');
	$title =  'List Roles';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	require_once('../includes/commonheader.php');
	
	$db = new Query();
	$result = $db->fetchAllRecord(' tb_roles ' , ' role_id,role_title,role_sc,role_desc,role_num,role_disp_ord,role_reqd,role_constraints,role_status ', NULL , NULL, NULL, NULL, 0,'All');
?>
<div id="main">
	<div class="top-bar"><h1>Manage Roles</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Role Title</th>
		<th>Short Title</th>
		<th>Order</th>
		<th>Status</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($result))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',$data->role_title,'</td>',"\n";
				echo '<td>',$data->role_sc,'</td>';
				echo '<td>',$data->role_disp_ord,'</td>';
      			echo '<td class="center">',($data->role_status == 'A' ? '' : 'In-'),'Active</td>';
      			echo '<td class="center"><a href="role.php?op=E&amp;id=',$data->role_id,'" title="Edit Role" alt="Edit Role"><div class="img edit"></div></a>&nbsp;';
				echo '<a href="javascript:del(\'../logic/role_logic.php?op=D&amp;id=',$data->role_id,'\');" title="Delete Role" alt="Delete Role"><div class="img delete"></div></a>';
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>