<?php
$step = '2';
$path = '..';
$title = 'Allocation :: ';
$css = array('css/all.css', 'css/register.css');
$js = array('js/allocate.js');

$script = '';
$script_msg = '';
$script_extra = '';
$staff_cnt = $cnt = 0;
$staff = array();
$img = $path.'/img/profile_noimg.jpg';

require_once('includes/common.php');
	
$student = $db->fetchRecord(' tb_user_info u, tb_dissertation d LEFT JOIN tb_programs p ON p.program_id=d.disseration_program, tb_languages l, tb_cohort ct, tb_concentration cn ', ' u.user_id, u.user_fname, u.user_lname, u.user_prefix, u.user_registration, u.user_doe, u.user_photo, d.disseration_name, d.disseration_desc, l.lang_name, l.lang_id, ct.cohort_name, cn.concentration_name, p.program_name ', ' u.user_id = d.std_id
AND l.lang_id = d.disseration_language AND ct.cohort_id = disseration_cohort AND cn.concentration_id = d.disseration_concentration AND d.dissertation_id ="'.$id.'"');

$img = (($student->user_photo != '') &&  file_exists('../images/photos/'.$student->user_photo)) ? '../images/photos/'.$student->user_photo : $img;
$std_id = $student->user_id;

$staff_rec = $db->fetchAllRecord(' tb_users ' , ' user_id,user_name,user_fullname ', ' (user_type<>"SD" AND user_type<>"SA") AND user_status="A" ' , NULL, '  user_name', NULL, 0,'All');
while($staff_obj = mysql_fetch_object($staff_rec)){
	$staff[$cnt]['id'] = $staff_obj->user_id;
	$staff[$cnt]['name'] = $staff_obj->user_fullname.'['.$staff_obj->user_name.']';
	$cnt++;
}
$staff_cnt = count($staff);

//Condition for lang
$role_cond = ($student->lang_id == 1) ? ' AND role_constraints<>"1"	' : '';

$roles_rec = $db->fetchAllRecord('tb_roles ' , ' role_id,role_title, role_num, role_sc, role_reqd ', ' role_status="A" '.$role_cond , NULL, 'role_disp_ord', NULL,NULL,'All');
	
	
function createSelect($staff, $cnt, $num = 0, $name = '', $sel = array(), $req = false, $attrib=array())
{
	global $script, $script_msg;
	$selectBox = '<select class="text'.(($num>1) ? ' fromSelect" size="5" multiple="multiple" ': '"').($req ? ' required="required"' : '').' name="'.$name.'" id="'.$name.'"';
	if(count($attrib) > 0)
	{
		foreach($attrib as $key=>$val)
		{
			$selectBox .= ' '.$key.'="'.$val.'"';
		}
	}
	$selectBox .= '>'."\n\t";
	
	if($num<2)
	{
		$selectBox .= '<option value="">Please Select...</option>'."\n\t";
	}
	for($i=0; $i<$cnt;$i++)
	{
		
		$selectBox .= '<option value="'.$staff[$i]['id'].'"'.((isset($sel) && in_array($staff[$i]['id'], $sel)) ? ' selected="selected"': '').'>'.$staff[$i]['name'].'</option>'."\n\t";
	}
	$selectBox .= '</select>';
	if($num>1)
	{
		$selectBox .= '<br><span>For Multiple Selections press <strong>CTRL</strong> and Select</span>';
		//$script_extra .= '{"key":\''.$name.'\', value:"'.$num.'"},';
	}
	return $selectBox;
}

///// Variables //////
$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op  : 'ADD';
$prefix = '';

$utype = isset($utype) ? $utype : 'SD';
if($op == 'E' && $id>0)
{
	$op = 'Edit';
	$data_rec = $db->fetchAllRecord(' tb_student_staff_rel AS rel, tb_users AS u ' , ' rel.role_id,u.user_name,u.user_fullname, rel.staff_id, rel.rel_status ', ' rel.std_id="'.$std_id.'" AND rel.dissertation_id = "'.$id.'" AND rel.staff_id=u.user_id' , NULL, NULL, NULL, 0,'All');
	while($data = mysql_fetch_object($data_rec))
	{
		$stg[$data->role_id][] = $data->staff_id;
		$stg[$data->role_id]['staff'][$data->staff_id] = $data->user_fullname.'['.$data->user_name.']';
		$stg[$data->role_id]['sts'][$data->staff_id] = $data->rel_status;			
	}//End of while{}
}
$title = ($op == 'Edit') ? 'Modify Allocation': 'Staff Allocate';
?>
	<div id="main">
		<div class="top-bar">
			<h1>Assign staff to the Research Study</h1>
		</div>
		<?php 
		
		require_once('../pages/allocation.php');?>
	</div>	
</body>
</html>