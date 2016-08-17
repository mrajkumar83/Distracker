<?php
	$title =  'Email Confirmation :: ';
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
    <div class="moduleBoxWrapper_TOP">Reset your Password</div>
    <div class="moduleBoxWrapper_BACK">
      
      <div class="clearBoth"></div>
	  <div class="msgBox">

             <p>When you receive your sign in information, follow the directions in the email to reset your password.</p>
</div>
      <div class="boxText">
        
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