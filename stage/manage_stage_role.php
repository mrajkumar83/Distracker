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
	$result = $db->fetchAllRecord(' tb_role_stage_rel ' , ' stg_role_id,stg_id,role_id,rel_ord,	mail_to ', NULL , NULL, NULL, NULL, 0,'All');
?>
<div id="main">
	<div class="top-bar"><h1>Manage Stage Roles</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Stage Title</th>
		<th>Role Title</th>		
		<th>Order</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($result))
		{
			$roles = $db->fetchRecord('tb_roles ' , ' role_id,role_title ', ' role_id ="'.$data->role_id.'" ' , NULL, 'role_title', NULL,NULL,'All');
			$stage = $db->fetchRecord('tb_stages ' , ' stg_id,stg_title ', ' stg_id ="'.$data->stg_id.'" ' , NULL, NULL, NULL,NULL,'All');
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',$stage->stg_title,'</td>',"\n";
				echo '<td>',$roles->role_title,'</td>',"\n";				
      			echo '<td>',$data->rel_ord,'</td>',"\n";
      			echo '<td class="center"><a href="role_stage.php?op=E&amp;id=',$data->stg_role_id,'" title="Edit Role" alt="Edit Role"><div class="img edit"></div></a>&nbsp;';
				echo '<a href="javascript:del(\'../logic/role_stage_logic.php?op=D&amp;id=',$data->stg_role_id,'\');" title="Delete Role" alt="Delete Role"><div class="img delete"></div></a>';
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>