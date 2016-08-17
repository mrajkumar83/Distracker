<?php
	$title =  'Confirmation for Password Change - Research Tracking System';
	$css = array('css/logo.css');
	$js = array('reset-password.js');
	require_once('includes/commonheader.php');
?>
<div class="logo"></div>
<div class="mainBox">
  <div class="contentBox">
	<?php echo $div_err;?>
    <div class="moduleBoxWrapper_TOP">Research Tracking System - Confirmation Message</div>
    <div class="moduleBoxWrapper_BACK">
      <!-- <div class="boxText"><strong>Confirmation for Password Change:</strong></div> -->
      <div class="clearBoth"></div>
	  <div class="msgBox"></div>
      <div class="boxText">
			<p>Your Password has been successfully changed.  Please click the link to re-direct to <a href="index.php" style="text-decoration: underline; color:#00F">Login</a>.</p>
        <div class="clearBoth"></div>     
      </div>
    </div>
  </div>
  <div class="moduleBoxWrapper_BOTTOM"></div>
</div><br><br>
<?php require('includes/footer.php');?>
</body>
</html>
