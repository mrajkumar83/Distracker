<?php
	require_once('../common/sess.php');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<style>
body {
    font-family: tahoma,arial,sans-serif;
    font-size: 11px;
}
div{
	margin:0 auto;
	text-align:center;
}
</style>
</head>
<body>
	<?php
		extract($_REQUEST);
		if(isset($op))
		{
			require_once("../common/attachsendmail.php");
			
			$admin_mail_arr = $_SESSION['ADMIN_EMAIL'];
			$admin_mail_arr_cnt = count($admin_mail_arr);
			$admin_mail_arr_name = array();
			$admin_mail_arr_mail = array();
			
			if($admin_mail_arr_cnt > 0){
				for($i=0; $i<$admin_mail_arr_cnt; $i++)
				{
					$admin_mail_arr_mail[] = $admin_mail_arr[$i]['mailid'];
				}//End of for
				$admin_mail_arr_mail = implode(',', $admin_mail_arr_mail);
			}//End of if
			else{
				$admin_mail_arr_mail = 'admin@distracker.com';
			}
            define('ADMINMAIL', $admin_mail_arr_mail);//mrajkumar83@gmail.com
			
			$replace_array = array('<StudentName>' => $s,
			'<DissertationTitle>'=>$t,
			'<URL>' => 'http://'.$_SERVER['SERVER_NAME'].'/index.php',
			'<StaffRole>' => (isset($step) ? ' '.$step : ''));
			
			switch($op)
			{
				case 'AS'://Allocate Staff
					
					$body = prepareBody('staff-allocation', $replace_array);
					$result = mailClient(ADMINMAIL,$body, 'Allocate Staff',$s,$e,'Administrator');
					if($result)
					{
						echo '<div>Mail send to Administrator</div>';				
					}
					else
						echo '<div>Unable to send mail to Administrator. Please try after some time.</div>';					
				break;
				
				case 'SA'://Staff Allocation
				
					$body = prepareBody('staff-allocation', $replace_array);
					$result = mailClient(ADMINMAIL,$body, 'Allocate Staff',$s,$e,'Administrator');
					if($result)
					{
						echo '<div>Mail send to Administrator for the role mentioned.</div>';				
					}
					else
						echo '<div>Unable to send mail to Administrator. Please try after some time.</div>';
				break;
			}
			exit;
			
		}else
		{
			if(isset($step))
			{
	?>
				<div>To inform Administrator to assign staff for Role:&quot;<?php echo $step;?>&quot; through automatic-mail, <a href="?op=SA&amp;s=<?php echo urlencode($s),'&amp;t=',urlencode($t),'&amp;e=',urlencode($e),'&amp;role=',urlencode($step);?>">Click Here</a></div>
	<?php	
			}
			else
			{
	?>
				<div>To inform Administrator to assign staff through automatic-mail, <a href="?op=AS&amp;s=<?php echo urlencode($s),'&amp;t=',urlencode($t),'&amp;e=',urlencode($e);?>">Click Here</a></div>
	<?php
			}
		}
	?>
</body>
</html>