<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Tree Structure</title>
    <link rel="stylesheet" href="<?php echo base_url()."css_tree/jquery.jOrgChart.css"?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."css_tree/tooltip.css"?>"/>
 
    <!-- jQuery includes -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script src="<?php echo base_url()."js_tree/tooltip.js"?>" type="text/javascript"></script>
    <script language="javascript" src="js_tree/jOrgChart2.js"> </script>
    <script src="<?php echo base_url()."js_tree/jquery.jOrgChart.js"?>"></script>
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
<link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
  </head>

<body class="twoColFixLtHdr">
  <div id="container">
   <div id="header">
 <?php require_once("general_header.php"); ?> 
  </div>
  <div id="menu" style="padding-bottom:0px;">
   <?php require_once("general_menu.php"); ?> 
  </div>
    <div id="chart" class="bck" align="center" style="padding-top:80px;"><?php echo $this->view_data['tree'];?> </div>
    <div id="footer" style="margin-top:10px;">
     <?php require_once("general_footer.php"); ?>
  <!-- end #footer --></div>
    </div>
</body>
</html>