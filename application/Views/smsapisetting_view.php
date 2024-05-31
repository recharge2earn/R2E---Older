<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SMS API Setting</title>
   <?php include("script1.php"); ?>
    <link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                       


    <script>
	function funsuccess()
	{
		document.getElementById("hidform").value = "Set";
		document.getElementById("hidvalue").value = document.getElementById("ddlsuccess").value;
		document.getElementById("frmsubmit").submit();
		
	}
	</script>
    <script language="javascript">
function numeric(e)
{
    var key = e.which;

    // backspace, tab, left arrow, up arrow, right arrow, down arrow, delete, numpad decimal pt, period, enter
    if (key != 8 && key != 9 && key != 37 && key != 38 && key != 39 && key != 40 && key != 46 && key != 110 && key != 190 && key != 13){
        if (key < 48){
            e.preventDefault();
        }
        else if (key > 57 && key < 96){
            e.preventDefault();
        }
        else if (key > 105) {
            e.preventDefault();
        }
    }
}
function setSMSCharge()
{
	document.getElementById("frmsmscharge").submit();
}
</script>
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
  <div class="bck">
    <h2><span id="myLabel">SMS API Setting</span></h2>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";}	

	?>
<form id="frmsubmit" name="frmsubmit" method="post">
<input type="hidden" id="hidvalue" name="hidvalue" />
<input type="hidden" id="hidform" name="hidform" />
</form>

Active SMS API: <?php echo $ActiveAPI;?>

    <select id="ddlsuccess" name="ddlsuccess" onChange="funsuccess()">
        <option value="">Select</option>
        <option value="1">Gujtech</option>
        <option value="0">sworldweb</option>
        <option value="2">dovesms</option>
    </select>



     <br><br><br>
     <hr>
     <div>
     <form id="frmsmscharge" name="frmsmscharge" method="post" action="<?php echo base_url()."smsapisetting"; ?>">
     SMS Charge : <input type="text" id="$txtsmscharge" name="txtsmscharge" onKeyDown="numeric(event)" value="<?php echo $smscharge; ?>"/><input style="width:70px;" type="button" id="btnsetsmscharge" name="btnsetsmscharge" value="Set" onClick="setSMSCharge()"></form>
     </div>

	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>