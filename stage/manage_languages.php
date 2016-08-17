<?php
	$step = '2';
	$path = '..';
	require_once('../common/configure.php');
	require_once('../classes/Database.class.php');
	require_once('../classes/Query.class.php');
	$title =  'List Languages';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	require_once('../includes/commonheader.php');
	
	$db = new Query();
	$result = $db->fetchAllRecord(' tb_languages ' , ' lang_id,lang_name,lang_code ', NULL , NULL, '  lang_name', NULL, 0,'All');
	function chkLang($id)
	{
		global $db;
		$lan_obj = $db->fetchRecord(' tb_dissertation ', ' count(1) AS cnt ', ' disseration_language="'.$id.'"');
		if($lan_obj->cnt > 0)
		{
			return false;
		}
		
		$lan_obj = $db->fetchRecord(' tb_user_info ', ' count(1) AS cnt ', ' user_lang in ('.$id.')');
		if($lan_obj->cnt > 0)
		{
			return false;
		}
		return true;
	}
?>
<div id="main">
	<div class="top-bar"><h1>Manage Languages</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Language Name</th>
		<th>Code</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($result))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',$data->lang_name,'</td>',"\n";
				echo '<td>',$data->lang_code,'</td>';
      			echo '<td class="center"><a href="language.php?op=E&amp;id=',$data->lang_id,'" title="Edit Language" alt="Edit Language"><div class="img edit"></div></a>&nbsp;';
				if(chkLang($data->lang_id))
				{
					echo '<a href="javascript:del(\'../logic/language-logic.php?op=D&amp;id=',$data->lang_id,'\');" title="Delete Language" alt="Delete Language"><div class="img delete"></div></a>';
				}
    		echo '</td></tr>',"\n";
			$row++;			
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>