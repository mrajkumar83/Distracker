<?php
	$title =  'Forgot ';
	$css = array('css/logo.css');
	$js = array('js/forgot-password.js');
	
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
                       
                       case 5:
				$div_err = '<div class="errorDiv">Password reset is expired or already made use. Try once again.</div>';
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
    <div class="moduleBoxWrapper_TOP">Forgot Password</div>
    <div class="moduleBoxWrapper_BACK">
      <div class="boxText"><strong>Please enter your Email to begin.</strong>
      </div>
      <div class="clearBoth"></div>
	  <div class="msgBox"></div>
      <div class="boxText">
        <form method="post" name="forgotfrm" id="forgotfrm" action="./logic/forgot-logic.php" autocomplete="off">
          <ul class="loginFields">
			<li>&nbsp;</li>
            <li>E-mail <span class="complsory">*</span></li>
            <li>
              <input name="uemail" required="required" id="uemail" size="30" maxlength="100" email="true" autocomplete="off" type="text">
            </li>
            
            <li>
              <input type="submit" class="gradient submit" value="Submit" id="frmsubmit" alt="Submit" title="Submit">
            </li>
          </ul>
        </form>
        <div class="clearBoth"></div>
        <ul>
		<!-- <li>New Joinee&nbsp;:&nbsp;<a href="register.php?utype=SD">Student</a>&nbsp;|&nbsp;<a href="register.php?utype=SF">Staff</a></li> -->
		  <li><a href="index.php">Login</a></li>
          <li>Contact the <?php echo APPLICATION_TITLE;?> support team</li>
          <div style="padding-left:30px;">
          <div class="boxText">Email:&nbsp;&nbsp;<a href="mailto:customerservice@distracker.com">customerservice@distracker.com</a></div>
		  </div>
        </ul>        
      </div>
    </div>
  </div>
  <div class="moduleBoxWrapper_BOTTOM"></div>
</div><br><br>
<?php require('includes/footer.php');?>
</body>
</html>
