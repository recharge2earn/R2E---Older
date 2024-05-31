<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Your Bank Details</title>
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>           
    <script>
	$(document).ready(function(){
	//global vars
	var form = $("#frmBank");
	var sbank = $("#ddlBank");
	var sifsc = $("#txtIfscCode");
	var accountno = $("#txtAccountNo");
	var sbranchname = $("#txtBranchName");	
	sbank.focus();
	sbank.blur(validatesBankname)
	sifsc.blur(validatesIfsc)
	accountno.blur(validatesAccountno)
	sbranchname.blur(validatesBranchName)	
	form.submit(function(){
		if(validatesBankname() & validatesIfsc() & validatesAccountno() & validatesBranchName())
			{				
			return true;
			}
		else
			return false;
	});
	function validatesBankname(){
		if(sbank[0].selectedIndex ==  0){
			sbank.addClass("error");		
			return false;
		}
		else{
			sbank.removeClass("error");
			return true;
		}
	}	
	function validatesIfsc(){
		if(sifsc.val() ==  ""){
			sifsc.addClass("error");		
			return false;
		}
		else{
			sifsc.removeClass("error");
			return true;
		}
	}
	function validatesAccountno(){
		if(accountno.val() ==  ""){
			accountno.addClass("error");		
			return false;
		}
		else{
			accountno.removeClass("error");
			return true;
		}
	}
	function validatesBranchName(){
		if(sbranchname.val() ==  ""){
			sbranchname.addClass("error");		
			return false;
		}
		else{
			sbranchname.removeClass("error");
			return true;
		}
	}
	
	setTimeout(function(){$('div.message').fadeOut(1000);}, 2000);	
});
	function Confirmation(value)
	{
		var varName = document.getElementById(""+value).innerHTML;
		if(confirm("Are you sure?\nyou want to delete "+varName+" bank.") == true)
		{
			document.getElementById('hidValue').value = value;
			document.getElementById('frmDelete').submit();
		}
	}
	function SetEdit(value)
	{
		
		document.getElementById('ddlBank').value=document.getElementById("hidbankid_"+value).value;
		document.getElementById('txtIfscCode').value=document.getElementById("ifsc_"+value).innerHTML;
		document.getElementById('txtAccountNo').value=document.getElementById("accno_"+value).innerHTML;
		document.getElementById('txtBranchName').value=document.getElementById("branch_"+value).innerHTML;
		document.getElementById('btnSubmit').value='Update';
		document.getElementById('hidID').value = value;
		document.getElementById('myLabel').innerHTML = "Edit Bank Details";
	}
	function SetReset()
	{
		document.getElementById('btnSubmit').value='Submit';
		document.getElementById('hidID').value = '';
		document.getElementById('myLabel').innerHTML = "Add Bank Details";
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
    <h2><span id="myLabel">Add Bank Details</span></h2>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
    <form action="<?php echo base_url()."d_admin_bank_details"; ?>" method="post" name="frmBank" id="frmBank">
    <fieldset>
    <table border="0" cellspacing="3" cellpadding="3">
    <tr>
<td align="right"><label for="ddlBank"><span style="color:#F06">*</span> Bank Name : </label></td><td align="left"><select id="ddlBank" name="ddlBank" title="Select Bank Name.<br />Click on drop down" class="select"><option>Select Bank</option>
<?php
$str_query = "select * from tblbank";
		$result = $this->db->query($str_query);		
		for($i=0; $i<$result->num_rows(); $i++)
		{
			echo "<option value='".$result->row($i)->bank_id."'>".$result->row($i)->bank_name."</option>";
		}
?>
</select>
</td>
</tr>
  <tr>
    <td align="right"><label for="txtIfscCode"><span style="color:#F06">*</span>IFSC Code : </label></td>
    <td align="left"><input type="text" name="txtIfscCode" title="Enter IFSC Code" id="txtIfscCode" class="text" />
    </td>
  </tr>
  <tr>
    <td align="right"><label for="txtAccountNo"><span style="color:#F06">*</span>Account No : </label></td>
    <td align="left"><input type="text" name="txtAccountNo" title="Enter Bank Account No." id="txtAccountNo" class="text" />
    </td>
  </tr>
  <tr>
    <td align="right"><label for="txtBranchName"><span style="color:#F06">*</span>Branch Name : </label></td>
    <td align="left"><input type="text" name="txtBranchName" title="Enter Branch Name." id="txtBranchName" class="text" />
    <span id="sBankInfo"></span>
    </td>
  </tr>
  
  <tr>
    <td align="right">&nbsp;</td>
    <td align="left">
    <input type="submit" class="button" value="Submit" name="btnSubmit" id="btnSubmit" />
    <input type="reset" class="button" onClick="SetReset()" value="Cancel" name="btnCancel" id="btnCancel" />    
    </td>
    </tr>
</table>
</fieldset>
<input type="hidden" id="hidID" name="hidID" />
</form>
    <form action="<?php echo base_url()."d_admin_bank_details"; ?>" method="post" autocomplete="off" name="frmDelete" id="frmDelete">
    <input type="hidden" id="hidValue" name="hidValue" />
    <input type="hidden" id="action" name="action" value="Delete" />
</form>

<h2>View Your Bank Details</h2>
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader">
    <th scope="col" align="left" style="width:55px">Delete</th>
    <th scope="col" align="left" style="width:55px;">Edit</th>
    <th scope="col" align="left">Bank Name</th>
	<th scope="col" align="left">IFSC Code</th>    
	<th scope="col" align="left">Account No</th>
    <th scope="col" align="left">Branch Name</th>    
    </tr>
    <?php	$i = 0;foreach($result_bank->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><img src="<?php echo base_url()."images/delete.PNG"; ?>" height="20" width="20" onClick="Confirmation('<?php echo $result->user_bank_id; ?>')" title="Delete Row" /></td>
 <td><img src="<?php echo base_url()."images/Edit.PNG"; ?>" onClick="SetEdit('<?php echo $result->user_bank_id; ?>')" title="Edit Row" /></td>
 <td><span id="<?php echo $result->user_bank_id; ?>"><?php echo $result->bank_name; ?></span>
 <input type="hidden" name="hidbankid_<?php echo $result->user_bank_id; ?>" id="hidbankid_<?php echo $result->user_bank_id; ?>" value="<?php echo $result->bank_id; ?>" />
 </td>
 <td><span id="ifsc_<?php echo $result->user_bank_id; ?>"><?php echo $result->ifsc_code; ?></span></td>
 <td><span id="accno_<?php echo $result->user_bank_id; ?>"><?php echo $result->account_number; ?></span></td>
 <td><span id="branch_<?php echo $result->user_bank_id; ?>"><?php echo $result->branch_name; ?></span></td>
 </tr>
		<?php 	
		$i++;} ?>
		</table>
       <?php  echo $pagination; ?>       

	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
     <?php require_once("general_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>