<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Account Balance</title>
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <link rel="stylesheet" href="<?php echo base_url()."js/jquery.alerts.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script> 
    <script src="<?php echo base_url()."js/jquery.alerts.js"; ?>"></script>             
    <script>
	$(document).ready(function(){
	//global vars
	var form = $("#frmAmt");
	var amt = $("#txtCharge");
	var remark = $("#txtRemark");
	
	amt.focus();
	form.submit(function(){
		if(validatesAmount() & validateRemark())
			{				
			return true;
			}
		else
			return false;
	});
	
	function validatesAmount(){
		//if it's NOT valid
		if(amt.val() ==  ""){
			//sbank.addClass("error");
			jAlert('Enter Amount', 'Alert Dialog');			
			return false;
		}
		//if it's valid
		else{
			amt.removeClass("error");
			return true;
		}
	}
	function validateRemark()
	{
		if(remark.val() ==  ""){
			//sbank.addClass("error");
			jAlert('Enter Remark', 'Alert Dialog');			
			return false;
		}
		//if it's valid
		else{
			remark.removeClass("error");
			return true;
		}
	}
		
});
		
	function SetReset()
	{
		document.getElementById('btnSubmit').value='Submit';
		document.getElementById('hidID').value = '';
		document.getElementById('myLabel').innerHTML = "Add Bank";
	}
	</script>
</head>
<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("a_menu.php"); ?> 
  </div>
  <div id="back-border">
  </div>
  <div class="bck">
    <h2><span id="myLabel">Account Balance</span></h2>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";}	
	$str_query = "select * from  tblcharges where  type = 'sms'";
	$rslt = $this->db->query($str_query);
	$sms_charge = $rslt->row(0)->amount;
	?>
    <form action="<?php echo base_url()."account_balance"; ?>" method="post" name="frmAmt" id="frmAmt">
    <fieldset>
    <table border="0" cellspacing="3" cellpadding="3">
    <tr>
    <td>Current Balance : </td>
    <td><strong><?php echo $balance;?></strong></td>
    </tr>
    <tr>
    <td align="right"><label for="txtPinQty"><span style="color:#F06">*</span>Credit Amount </label></td>
    <td align="left"><input type="text" name="txtAmount" title="Enter Amount For SMS Charge." id="txtCharge" class="text" />
    </td>
  </tr>
  <tr>
    <td align="right"><label for="txtPinQty"><span style="color:#F06">*</span>Remark </label></td>
    <td align="left"><input type="text" name="txtRemark" title="Enter Remark." id="txtRemark" class="text" />
    </td>
  </tr>

  
  <tr>
    <td align="right">&nbsp;</td>
    <td align="left">
    <input type="submit" value="Add" class="button" name="btnSubmit" id="btnSubmit" />       
    </td>
    </tr>
</table>
</fieldset>
</form>    

     

	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>