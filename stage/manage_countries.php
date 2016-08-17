<?php
	$step = '2';
	$path = '..';
	require_once('../common/configure.php');
	require_once('../classes/Database.class.php');
	require_once('../classes/Query.class.php');
	$title =  'Research Study System | List Roles';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	require_once('../includes/commonheader.php');
	
	$db = new Query();
	$result = $db->fetchAllRecord(' tb_country ' , ' country_id,country_name,iso_code_2,iso_code_3,address_format,country_disp_ord,status ', NULL , NULL, NULL, NULL, 0,'All');
?>
<div id="main">
	<div class="top-bar"><h1>Manage Countries</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Country Name</th>
		<th>Address Format</th>
		<th>Display Order</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($result))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',$data->country_name,'</td>',"\n";
				echo '<td>',$data->address_format,'</td>',"\n";
				echo '<td>',$data->country_disp_ord,'</td>';
      			
      			echo '<td class="center"><a href="country.php?op=E&amp;id=',$data->country_id,'" title="Edit Country" alt="Edit Country"><div class="img edit"></div></a>&nbsp;';
				echo '<a href="javascript:del(\'../logic/country_logic.php?op=D&amp;id=',$data->country_id,'\');" title="Delete Country" alt="Delete Country"><div class="img delete"></div></a>';
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>