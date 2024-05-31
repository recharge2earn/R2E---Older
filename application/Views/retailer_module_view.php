<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Retailer Module</title>
	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
            <script>
	$(document).ready(function(){	
	setTimeout(function(){$('div.message').fadeOut(1000);}, 2000);	
});
	</script>

    </head>

<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("r_header.php"); ?> 
  </div>
  <br>
  <div id="back-border">
  </div>
        <?php
	if ($this->session->flashdata('message')){echo "<div class='message'>".$this->session->flashdata('message')."</div>"; }
	?>
  <center>
  <div style="height:280px;padding-top:150px;">
  <table width="350px" cellpadding="5" cellspacing="5" border="0">
  <tr>
  <td valign="middle" align="center"><a href="<?php echo base_url()."account"; ?>" class="module"><span><br><br> Account <br> System</span></a></td>
  <td valign="middle" align="center"><a href="<?php echo base_url()."retailer_home"; ?>" class="module"><span><br><br>Recharge System</span></a></td>
  </tr>
  </table>
  </div>
    </center>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
<!-- end #container --></div>
<div class='alertBox'>
<?php require_once("alert_message.php"); ?>
</div>
  <div id="footer">
     <?php require_once("r_footer.php"); ?>
  <!-- end #footer --></div>
</body>
</html>