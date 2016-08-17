<?php
	$step = '2';
	$title =  'Change Password';
	$css = array('css/all.css','css/register.css');
	$js = array('js/jquery.validate.js','js/changepassword.js');
	require_once('../common/sess.php');
	require_once('../common/configure.php');
	require_once('../classes/Database.class.php');
	require_once('../classes/Query.class.php');
	require_once('../common/checksess.php');
	require_once('../includes/commonheader.php');
	$db = new Query();
	echo '<div id="main">';
if(isset($changepassword))
{
	$rec = $db->fetchRecord('tb_users', ' user_password ','user_name="'.$UNAME.'" AND user_id="'.$UID.'" AND user_status="A" ');
	if( $rec->user_password == md5($oldpassword))
	{
		if($newpassword == $confrimpasword)
		{
			$db->storeDetails('tb_users', ' user_password="'.md5($newpassword).'"', ' WHERE user_id="'.$UID.'"');
			
			require_once('../logout.php');
			exit;
		}
		else
		{
			echo '<div class="message-div">Enter New Password  and Confirmation Password is not Matching.</div>';
		}
	}
	else
	{ 
		echo '<div class="message-div" >Enter Old Password Correctly.</div>';
	}
}
?>
<div class="top-bar">
	<h1>Change Password</h1>
</div>
<form action="changepassword.php" name="changepassword" id="changepassword" method="post" target="_self">
<table cellspacing="0" cellpadding="0" class="listing form" width="100%">
			  <tbody><tr>
			    <th colspan="2" align="left">&nbsp;&nbsp;Change Password</th>
			    </tr>
			  <tr>
                    <td class="first"><strong>Old Password</strong></td>
					<td class="last"><input type="password" name="oldpassword" id="oldpassword" value="" alt="Old Password" title="Old Password"  placeholder="Oldpassword "></td>
				</tr>
				<tr class="bg">
					<td class="first"><strong>New Password</strong></td>
					<td class="last"><input type="password" name="newpassword" id="newpassword" value="" alt="New Password" title="New Password"  placeholder="********" /></td>
		      </tr>
			  <tr>
                    <td class="first"><strong>Confirm Password</strong></td>
					<td class="last"><input type="password" name="confrimpasword" id="confrimpasword" value="" alt="Confirm Password" title="Confirm Password"   placeholder="******** "></td>
				</tr>
				    </tr>
				</table>
				<div class="label"> </div>
      <p class="label1">
        <input type="submit" value="Submit" class="login gradient" alt="Submit" name="changepassword" title=""/>
        &nbsp;
        <input type="reset" value="Reset" class="login cancel" alt="Reset" title="Reset" />
      </p>
				</form>
	</div>
</body>
</html>