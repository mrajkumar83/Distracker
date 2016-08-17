<?php
session_start();
if(isset($_SESSION) && isset($_SESSION['UID']))
{
	header("Location: home.php");
	exit;
}
	$title =  'Login :: ';
	$css = array('css/logo.css');
	$js = array('js/jquery.validate.js', 'js/login.js');
	
	require_once('common/configure.php');
	require_once('includes/commonheader.php');
	if(isset($_REQUEST['Err']))
	{
		switch($_REQUEST['Err'])
		{
			default:
				$div_err = '<div class="errorDiv">Invalid Username or Password.</div>';
			break;
			case 2:
				$div_err = '<div class="errorDiv">Please contact Administrator, you are De-activated.</div>';
			break;
			
			case 5:
				$div_err = '<div class="errorDiv">For your security purpose system restricts you to log into multiple systems, at the same time.  Please log-off from the other system to use in this system.</div>';
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
    <div class="moduleBoxWrapper_TOP">Welcome to <?php echo APPLICATION_TITLE;?></div>
    <div class="moduleBoxWrapper_BACK">
      <div class="boxText"><strong>Please enter your username and password to begin.</strong>
      </div>
      <div class="clearBoth"></div>
      <div class="boxText">
        <form method="post" name="loginfrm" id="loginfrm" action="./logic/login_logic.php" autocomplete="off">
          <ul class="loginFields">
            <li>Username<span class="complsory">*</span></li>
            <li>
              <input name="uname" id="uname" size="30" maxlength="100" autocomplete="off" type="text" required="required">
            </li>
            <li>Password<span class="complsory">*</span></li>
            <li>
              <input name="upassword" id="upassword" size="30" maxlength="100" autocomplete="off" type="password" required="required">
            </li>
            <li>
              <input type="submit" class="gradient submit" value="Login" id="frmsubmit" alt="Submit" title="Submit">
            </li>
          </ul>
        </form>
        <div class="clearBoth"></div>
        <ul>
          <!-- <li>New Joinee&nbsp;:&nbsp;<a href="register.php?utype=SD">Student</a>&nbsp;|&nbsp;<a href="register.php?utype=SF">Staff</a></li> -->
		<li><a href="forgot-password.php">Forgot Password</a></li>
          <li>Contact the <?php echo APPLICATION_TITLE;?> support team</li>
          <div style="padding-left:30px;">
          <div class="boxText">Email:&nbsp;&nbsp;<a href="mailto:customerservice@distracker.com">customerservice@distracker.com</a></div>
		  </div>
        </ul>
      </div>
    </div>
  </div>
  <div class="moduleBoxWrapper_BOTTOM"></div>
</div>
<?php require('includes/footer.php');?>
</body>
</html>