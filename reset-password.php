<?php
	require_once('./common/configure.php');
	require_once('./classes/Database.class.php');
	require_once('./classes/Query.class.php');
	
	$db = new Query();
	$db->fetchRecord(' tb_users ', ' * ', 'user_email="'.$mail.'" AND user_sess="'.$id.'"');
     
	if(isset($db) && $db->getRowCount()< 1)
	{
           header('Location: forgot-password.php?Err=5');
		exit;
	}
	$title =  'Reset-Password :: ';
	$css = array('css/logo.css');
	$js = array('js/reset-password.js');
	
	require_once('common/configure.php');
	require_once('includes/commonheader.php');
	if(isset($_REQUEST['Err']))
	{
		switch($_REQUEST['Err'])
		{
			case 1:
				$div_err = '<div class="errorDiv">Enter valid Email-Id.</div>';
			break;
			
			case 2:
				$div_err = '<div class="errorDiv">You are not a registered user.</div>';
			break;
			
			case 3:
				$div_err = '<div class="errorDiv">Please contact Administrator, you are De-activated.</div>';
			break;			
		}
	}
	else
	{
		$div_err = '';
	}
?>
<div class="logo"></div>
<div class="mainBox">
  <div class="contentBox">
	<?php echo $div_err;?>
    <div class="moduleBoxWrapper_TOP"><?php echo APPLICATION_TITLE;?> - Reset Password</div>
    <div class="moduleBoxWrapper_BACK">
      <div class="boxText"><strong>Enter your new password below:</strong>
      </div>
      <div class="clearBoth"></div>
	  <div class="msgBox"></div>
      <div class="boxText">
        <form method="post" name="changepassword" id="changepassword" action="./logic/reset-logic.php" autocomplete="off">
          <ul class="loginFields">
			<li>&nbsp;</li>
            <li>New Password <span class="complsory">*</span></li>
            <li>
              <input name="newpassword" id="newpassword" size="30" maxlength="100" autocomplete="off" type="password">
            </li>
            <li>&nbsp;</li>
            <li>Re-enter Password <span class="complsory">*</span></li>
            <li>
              <input name="confirmpassword" id="confirmpassword" size="30" maxlength="100" autocomplete="off" type="password">
            </li>
            <li>
              <input type="submit" class="gradient submit" value="Reset Password" id="frmsubmit" alt="Submit" title="Submit">
            </li>
          </ul>
           <input name="uemail" id="uemail" value="<?php echo $mail?>" type="hidden">
        </form>
        <div class="clearBoth"></div>     
      </div>
    </div>
  </div>
  <div class="moduleBoxWrapper_BOTTOM"></div>
</div><br><br>
<?php require('includes/footer.php');?>
</body>
</html>