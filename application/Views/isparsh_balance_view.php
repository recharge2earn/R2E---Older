<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>I-Sparsh Balance</title>
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                   
</head>
<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("a_menu.php"); ?> 
  </div>
  <div class="bck" style="height:320px;">
    <h2>I-Sparsh Balance</h2>               
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
    <strong style="margin-left:10px;font-size:18px;">Current Balance :<b style="color:#FB0000;"><?php echo $balance; ?></b></strong>
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
     <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
 
</body>
</html>
