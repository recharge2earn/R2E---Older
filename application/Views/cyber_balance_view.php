<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cyberplate Balance</title>
   <?php include("script1.php"); ?>               
</head>
<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("admin_menu1.php"); ?> 
  </div>
  <div id="back-border">
  </div>
  <div>
    <h2 class="h2">Cyberplate Balance</h2>               
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?><br><br>
    <strong>Current Balance :<?php echo $balance; ?></strong>
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
     <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
 
</body>
</html>
