<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title.APPLICATION_TITLE;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/ico" href="http://pathsdev.distracker.com/img/favicon.ico">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
<![endif]-->
<!--[if IE]>
    <link rel="stylesheet" type="text/css" href="all-ie-only.css" />
<![endif]-->
<?php
	$css_length = count($css);
	for($i =0 ; $i < $css_length; $i++)
	{
		echo '<link rel="stylesheet" type="text/css" href="'.$css[$i].'">';
	}
?>
 <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
<?php
	$js_length = isset($js) ? count($js) : 0;		
	for($i =0 ; $i < $js_length; $i++)
	{
		echo '<script type="text/javascript" src="'.$js[$i].'"></script>';
	}
?><script language="javascript" type="text/javascript">window.history.forward();</script> 
</head>
<body>