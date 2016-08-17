<?php
if($allocation->cnt > 0)
{
	if(!$nextstep && $next_order<21 && $op!= 'C')
	{
		echo '<iframe id="frame2" name="frame2" src="admin-allocation-mail.php?s='.urlencode($dissertation->std_name).'&t='.urlencode($dissertation->dist_name).'&e='.urlencode($dissertation->email).'&amp;step='.$nextstep_role.'" width="86%" height="40px" frameborder="0"></iframe>';
	}
	require_once($path.'/pages/dissertation_progress.php');
}
else
{
	echo '<iframe id="frame2" name="frame2" src="admin-allocation-mail.php?s='.urlencode($dissertation->std_name).'&t='.urlencode($dissertation->dist_name).'&e='.urlencode($dissertation->email).'" width="86%" height="40px" frameborder="0"></iframe>';
}