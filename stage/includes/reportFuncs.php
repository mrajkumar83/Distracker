<?php
function staffReport($s, $r, $sf=0, $num=0 ){
	global $report, $rel, $db, $std_id, $did ;
	
	if(isset($report[$s][$r][$sf]))
	{
		switch($report[$s][$r][$sf]['status'])
		{
			case 'A':
				return abbr('A', $report[$s][$r][$sf]['date']);
			break;
			
			case 'C':
				return abbr('C', $report[$s][$r][$sf]['date']);
			break;
			
			case 'F':
				return abbr('F', $report[$s][$r][$sf]['date']);
			break;
			
			case 'M':
				return abbr('R', $report[$s][$r][$sf]['date']);
			break;
			
			case 'AS':
				return abbr('AS', $report[$s][$r][$sf]['date']);
			break;
			
			default:
				return abbr('NS');
			break;
		}
	}
	else
	{
		if(isset($report[$s][$r][0]) && isset($report[$s][$r][0]['status']))
		{
			if($rel[$s][$r] == $report[$s][$r][0]['step'] && $num < 2)
			{
				return abbr('AS', $report[$s][$r][0]['date']);
			}
			else
			{
				return abbr('AS', $report[$s][$r][0]['date']);//Might have to work
			}
		}
		return abbr('NS');
	}
}

function studentReport($s){
	global $std_rep, $std_id;
	if(isset($std_rep[$s]) && $std_rep[$s]['status'] == 'M' &&  $std_rep[$s]['nextid'] != $std_id)
	{
		return abbr('S', $std_rep[$s]['date']);
	}
	if(!isset($std_rep[$s]))
	{
		return abbr('NS');
	}
	else
	{
		switch($std_rep[$s]['status'])
		{
			case 'M':
				return abbr('E');
			break;
			
			case 'AS':
				return abbr('AS', $std_rep[$s]['date']);
			break;
			
			case 'SA':
				return abbr('SA', $std_rep[$s]['date']);
			break;
			
			default:
				return abbr('S', $std_rep[$s]['date']);
			break;
		}
		
	}	
}
	
function abbr($str, $date=''){
	$arr = array();
	switch($str)
	{
		case 'NS':
			$arr['i'] = 'notstarted';
			$arr['msg'] = 'Not Started';
		break;
		
		case 'S':
			$arr['i'] = 'ok';
			$arr['msg'] = 'Submitted'.($date ? '</div><div class="date">'.$date : '');
		break;
		
		case 'A':
			$arr['i'] = 'ok';
			$arr['msg'] = 'Approved'.($date ? '</div><div class="date">'.$date : '');
		break;
		
		case 'AS':
			$arr['i'] = '';
			$arr['msg'] = 'Assigned'.($date ? '</div><div class="date">'.$date : '');
		break;
		
		case 'SA':
			$arr['i'] = '';
			$arr['msg'] = 'To Start';
		break;
		
		case 'C':
			$arr['i'] = 'ok';
			$arr['msg'] = 'Approved <br>with comments'.($date ? '</div><div class="date">'.$date : '');
		break;
		
		case 'F':
			$arr['i'] = 'ok';
			$arr['msg'] = 'Forwarded <br>to CFS'.($date ? '</div><div class="date">'.$date : '');
		break;
		
		case 'R':
			$arr['i'] = 'review';
			$arr['msg'] = 'Major Changes'.($date ? '</div><div class="date">'.$date : '');
		break;
		
		case 'E':
			$arr['i'] = 'edit';
			$arr['msg'] = 'Editing';
		break;
	}
	return $arr;
}