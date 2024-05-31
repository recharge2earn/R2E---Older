<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tree Structure</title>
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
    <script src="<?php echo base_url()."js/qTip.js"; ?>"></script>
     <link rel="stylesheet" href="<?php echo base_url()."css_tree/jquery.jOrgChart.css"; ?>"/>
 
    <!-- jQuery includes -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script src="<?php echo base_url()."js_tree/tooltip.js"; ?>" type="text/javascript"></script>
    <script language="javascript" src="<?php echo base_url()."js_tree/jOrgChart2.js"; ?>"> </script>
    <script src="<?php echo base_url()."js_tree/jquery.jOrgChart.js"; ?>"></script>
<script type="text/javascript">
$(document).ready(function(){$('.tTip').betterTooltip({speed: 150, delay: 300});});
</script>
    
<style>
.tip {
	width: 250px;
	padding-top:18px;
	overflow: hidden;
	display: none;
	position: absolute;
	color:#00F;
	z-index: 500;
	background: transparent url(images_tree/tipTop.png) no-repeat top;}
.tipMid {background: transparent url(images_tree/tipMid.png) repeat-y; padding: 0 15px 10px 15px;}
.tipBtm {background: transparent url(images_tree/tipBtm.png) no-repeat bottom; height: 32px;}
a:link
{
text-decoration:none;
color:#FFF;
}
a:visited
{
	color:#FFF;
}
a:active
{
	color:#FFF;
}
		 
</style>  
    
</head>
<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("a_menu.php"); ?> 
  </div>
  <div class="bck">
   <h2><span id="myLabel">Tree Structure</span></h2>           
   <form action="<?php echo base_url()."treestr"; ?>" method="post" name="frmaccess_rights" id="frmaccess_rights">          
</form>
    
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>