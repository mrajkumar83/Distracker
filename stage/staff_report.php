<?php
	$step = '2';
	$path = '..';
	$title =  'Student Reports :: ';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js','js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	require_once('includes/common.php');
	
	function addLink($text, $sid='')
	{
		return '<a href="staff_list.php?sid='.$sid.'&amp;sname='.urlencode($text).'">'.$text.'</a>';
	}
	
	function langDisplay($lang)
	{
                if($lang == '')
		{
			return '';
		}
		global $db;
		$lang_name = '';
		$langs = $db->fetchAllRecord('tb_languages ' , ' lang_name ', ' lang_id in ('.$lang.') ' , NULL, ' lang_name ', NULL,NULL,'All');
		while($langs_rec = mysql_fetch_object($langs))
		{
			$lang_name .= $langs_rec->lang_name.',';
		}
		
		return trim($lang_name, ',');
	}
	
	function workLoad($id)
	{
	        if($id == '')
		{
			return '';
		}
		global $db;
		$items = '';
		$wrk = $db->fetchAllRecord('tb_student_staff_rel ' , ' COUNT(0) AS cnt ', ' staff_id =  "'.$id.'" AND rel_status !=  "C" ' , NULL, NULL, NULL,NULL,'All');
		while($wrk_rec = mysql_fetch_object($wrk))
		{
			$items = $wrk_rec->cnt;
		}
		
		return (int)$items;
	}
	
	$cond = '';
	$rows_cnt = 0;
	$fname = isset($fname) ? $fname : '';
	$lname = isset($lname) ? $lname: '';
	$lang = isset($lang) ?  $lang : array();
		
	$langs = $db->fetchAllRecord('tb_languages ' , ' lang_id,lang_name ', NULL , NULL, ' lang_name ', NULL,NULL,'All');
		
	require_once($path.'/pages/staff_report.php');
	if(isset($Search))
	{
		$lang_merge = @implode(',', $lang);		
		$cond .= ($fname != '') ? ' AND LOWER(user_fname) LIKE "'.strtolower($fname).'%"' : '';
		$cond .= ($lname != '') ? ' AND LOWER(user_lname) LIKE "'.strtolower($lname).'%" ' : '';
		$cond .= ($lang_merge != '') ? ' AND user_lang IN ('.$lang_merge.') ': '';
				
		if($cond != '')
		{
			$cond = ' u.user_id= ui.user_id AND (u.user_type="AD" OR u.user_type="SF") '.$cond ;
			$staff_rec = $db->fetchAllRecord('tb_user_info ui, tb_users u  ' , ' u.user_id, CONCAT(ui.user_prefix, " ",ui.user_fname, " ", ui.user_lname) full_name, ui.user_lang, ui.user_skype, u.user_email,u.user_status ', $cond , NULL, ' user_fname ', NULL,NULL,'All');	
			$rows_cnt = $db->getRowCount();
		}
		
		if($rows_cnt == 0)
		{
			echo '<div>No Results found.</div>';
		}
		else
		{
		?>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
		<thead>
			<th>Staff Name</th>
			<th>Languages</th>
			<th>Email</th>
			<th>Skype Id</th>
			<th>Assigned/Working</th>
			<th>Status</th>
		  </thead>
		  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($staff_rec))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',addLink($data->full_name, $data->user_id),'</td>',"\n";
				echo '<td>',langDisplay($data->user_lang),'</td>',
					'<td class="center">',$data->user_email,'</td>',
					'<td class="center">',$data->user_skype,'</td>',	
					'<td class="center">',workLoad($data->user_id),'</td>',				
					'<td class="center">',(($data->user_status == 'A') ? 'Active' : 'De-Active'),'</td>';
      			
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
  <?php
		}//End of else
	}//End of Search condition
?>
</div>
</div>