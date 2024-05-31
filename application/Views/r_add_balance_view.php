<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Balance</title>
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
    <script src="<?php echo base_url()."js/qTip.js"; ?>"></script>   
    <script>
$(document).ready(function(){
	//global vars
	var form = $("#frmBalance");
	var amount = $("#txtAmount");
	amount.focus();
	amount.blur(validatesAmount);
	form.submit(function(){
		if(validatesAmount())
			{
				if(Check() == false)
				{return false;}				
			}
		else
			return false;
	});
	function validatesAmount(){
		if(amount.val() == ""){
			amount.addClass("error");
			return false;
		}
		//if it's valid
		else{
			amount.removeClass("error");
			return true;
		}
	}	
});
	function Check()
	{		
		if(confirm("are you sure? you want to process balance for ["+document.getElementById('dname').innerHTML+"]") == true)
		{
	document.getElementById("frmBalance").submit();
	
		}
		else
		{
			return false;
		}
	}
	</script>
</head>
<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("general_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("general_menu.php"); ?> 
  </div>
  <div id="back-border">
  </div>
  <div>
<h2>Add Balance</h2>  
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if(isset($result_retailer))
	{
	if($result_retailer->num_rows() == 1)
	{
	?>    
    <fieldset>
    <form action="<?php echo base_url()."r_add_balance/process" ?>" method="post" name="frmBalance" id="frmBalance">
    <input type="hidden" value="<?php echo $result_retailer->row(0)->user_id; ?>" name="hidUserID" id="hidUserID" />
        <input type="hidden" name="hidName" id="hidName" value="<?php echo $result_retailer->row(0)->business_name; ?>" />
<table style="width:100%;" cellpadding="3" cellspacing="5" border="0">
    <tr>
    <td align="right">Current Balance :</td> <td align="left"><?php  echo $BalanceAmount;?></td>
    </tr>
    <tr>
    <td align="right">Distributor Name :</td> <td align="left" id="dname"><?php echo $result_retailer->row(0)->business_name; ?> 
    </td>
    </tr>
    <tr>
	<td align="right">Postal Address :</td>    
    <td align="left"><?php echo $result_retailer->row(0)->postal_address; ?></td>
    </tr>
    <tr>
	<td align="right">Land Mark :</td>   
     <td align="left"><?php echo $result_retailer->row(0)->landmark; ?></td> 
    </tr>
    <tr>
   	<td align="right">Contact Person :</td>    
     <td align="left"><?php echo $result_retailer->row(0)->contact_person; ?></td>
    </tr>
    <tr>
	<td align="right">Mobile :</td>
     <td align="left"><?php echo $result_retailer->row(0)->mobile_no; ?></td>
    </tr>
    <tr>
   	<td align="right">Email ID :</td>    
     <td align="left"><?php echo $result_retailer->row(0)->emailid; ?></td>
    </tr>
     <tr>
   	<td align="right">Amount :</td>    
     <td align="left"><input type="text" maxlength="10" onKeyPress="return isNumeric(event);" title="Enter Amount." class="text" name="txtAmount" id="txtAmount" /></td>
    </tr>
      <tr>
   	<td align="right"></td>    
     <td align="left"><input type="submit" class="button" name="btnSubmit" id="btnSubmit" value="Submit" /></td>
    </tr>
		</table>     
        </form>
        </fieldset>
        <?php }else{echo "No Data Found.";} }?>
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
     <?php require_once("general_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>