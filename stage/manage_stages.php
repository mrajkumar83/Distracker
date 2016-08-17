<?php
	$step = '2';
	$path = '..';
	require_once('../common/configure.php');
	require_once('../classes/Database.class.php');
	require_once('../classes/Query.class.php');
	$title =  'List Stage';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	require_once('../includes/commonheader.php');
	
	$db = new Query();
	$result = $db->fetchAllRecord(' tb_stages ' , ' stg_id,stg_title,stg_description,stg_order,stg_sts ', NULL , NULL, NULL, NULL, 0,'All');
?>
<div id="main">
	<div class="top-bar"><h1>Manage Stages</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Stage Title</th>
		<th>Stage Order</th>
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
      			echo '<td>',$data->stg_title,'</td>',"\n";
				echo '<td>',$data->stg_order,'</td>';
      			echo '<td class="center">',($data->stg_sts == 'A' ? '' : 'In-'),'Active</td>';
      			echo '<td class="center"><a href="stage.php?op=E&amp;id=',$data->stg_id,'" title="Edit Stage" alt="Edit Stage"><div class="img edit"></div></a>&nbsp;';
				echo '<a href="javascript:del(\'../logic/stage_logic.php?op=D&amp;id=',$data->stg_id,'\');" title="Delete Stage" alt="Delete Stage"><div class="img delete"></div></a>';
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>