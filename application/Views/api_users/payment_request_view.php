<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Request</title>
 <?php include("script1.php"); ?>
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
    <script src="<?php echo base_url()."js/external/jquery.bgiframe-2.1.2.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>                    
   <link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>           
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script>
	$(document).ready(function(){
	//global vars
	$( "#txtPaymentdate,#txtChaquedate" ).datepicker({dateFormat:'yy-mm-dd'});
	var form = $("#frmPayment");
	var reqamt = $("#txtReqamt");	
	var paymentdate = $("#txtPaymentdate");
	var ddlpaymod = $("#ddlPaymod");
	var chaqueno = $("#txtChaqueno");
	var chaquedate = $("#txtChaquedate");						
	var depositBank = $("#ddlDepositBank");
	var depositTime = $("#ddlDeptime");						
	//On Submitting
	form.submit(function(){
		if(validateRequestamount() & validatePaymentdate() & validatePaymentmod() & validatesDepositBankName() & validatesChaqueNumber() & validatesChaqueDate())
			{				
			return true;
			}
		else
			return false;
	});
	//validation functions
	function validateRequestamount(){
		if(reqamt.val() == ""){reqamt.addClass("error");return false;}
		else{
			if(reqamt.val() < 1000){alert("Minimum amount require 1000.");reqamt.addClass("error");}
			else{
			reqamt.removeClass("error");return true;}		}
	}
	function validatePaymentdate(){
		if(paymentdate.val() == ""){paymentdate.addClass("error");return false;}
		else{paymentdate.removeClass("error");return true;}		
	}
	function validatePaymentmod(){
		if(ddlpaymod[0].selectedIndex == 0){ddlpaymod.addClass("error");return false;}
		else{ddlpaymod.removeClass("error");return true;
		}
	}		
	function validatesDepositBankName(){	
		if(depositBank[0].selectedIndex == 0){depositBank.addClass("error");return false;}
		else{depositBank.removeClass("error");return true;}
	}	
	function validatesChaqueNumber(){
		if(chaqueno.val() == ""){chaqueno.addClass("error");return false;}
		else{chaqueno.removeClass("error");return true;}
	}
	function validatesChaqueDate(){	
		if(chaquedate.val() == ""){chaquedate.addClass("error");return false;}
		else{chaquedate.removeClass("error");return true;}
	}			
});
		function  setAccount()
	{
		if(document.getElementById('ddlDepositBank').selectedIndex != 0)
		{
			var varAccount_no=$("#ddlDepositBank")[0].options[document.getElementById('ddlDepositBank').selectedIndex].getAttribute('account_no');
			var varBranch_name=$("#ddlDepositBank")[0].options[document.getElementById('ddlDepositBank').selectedIndex].getAttribute('branch_name');
			var varIfsc_code=$("#ddlDepositBank")[0].options[document.getElementById('ddlDepositBank').selectedIndex].getAttribute('ifsc_code');			
			document.getElementById('deposit_account_no').innerHTML = "<br />Account No : "+varAccount_no+"<br />IFSC Code : "+varIfsc_code+"<br />Branch Name : "+varBranch_name;
		}
		else{document.getElementById('deposit_account_no').innerHTML="";}
	}

	function ChangeForm()
	{
		if(document.getElementById('ddlPaymod').value == 'Cash')
		{
			document.getElementById('txtChaquedate').disabled = true;
			document.getElementById('txtChaqueno').disabled = true;
			document.getElementById('txtChaqueno').value = '-';
			document.getElementById('txtChaquedate').value = '-';	
			document.getElementById("ddlClientBank").disabled = true;		
		}
		else
		{
			document.getElementById('txtChaquedate').disabled = false;
			document.getElementById('txtChaqueno').disabled = false;
			document.getElementById("ddlClientBank").disabled = false;
			document.getElementById('txtChaqueno').value = '';
			document.getElementById('txtChaquedate').value = '';						
		}
	}
	</script>
</head>
<body class="twoColFixLtHdr">
  <?php require_once("apiuser_header.php"); ?>  
 <?php require_once("ApiMenu.php"); ?> 

<div id="container">
  <div style="20px;">
   <h2><span id="myLabel">Payment Request</span></h2>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";}
	?>
    <div class="breadcrumb">
<form action="<?php echo base_url().'api_users/payment_request'; ?>" method="post" name="frmPayment" id="frmPayment">
        
    <table border="0" cellspacing="3" cellpadding="3">
    <tr>
    <td align="right"><label for="txtReqamt"><span style="color:#F06">*</span>Request For Amount :</label></td>
    <td align="left"><input type="text" onKeyPress="return isNumeric(event);" name="txtReqamt" title="Enter Request Amount" id="txtReqamt" class="text" maxlength="10" />
    <span>Minimum Limit 1000</span>
    </td>
  </tr>
  <tr>
    <td align="right"><label for="txtPaymentdate"><span style="color:#F06">*</span>Payment Date :</label></td>
    <td align="left"><input type="text" name="txtPaymentdate" title="Enter Payment Date" id="txtPaymentdate" class="text" />
    </td>
  </tr>
  <tr>
<td align="right"><label for="ddlPaymod"><span id="paymodInfo" style="color:#F06">*</span> Payment Mode</label></td><td><select class="select" id="ddlPaymod" name="ddlPaymod" title="Select Payment Mode." onChange="ChangeForm()">
<option>--Select--</option>
<option value="Cash">Cash In Bank</option>
<option value="Cheque/DD">Chaque/DD</option>
<option value="E-Transfer">Online E-Transfer</option>
<option value="NEFT/RTGS">NEFT/RTGS</option>
</select></td>
</tr>
  <tr>
<td align="right" valign="top"><label for="ddlDepositBank"><span id="paymodInfo" style="color:#F06">*</span> Deposit Bank Name : </label></td><td><select onChange="setAccount()" class="select" id="ddlDepositBank" name="ddlDepositBank" title="Select Deposit Bank.">
<option>--Select--</option>
<?php
$str_query = "select tbluser_bank.*,(select bank_name from tblbank where bank_id = tbluser_bank.bank_id) as bank_name from tbluser_bank order by user_bank_id";
		$result = $this->db->query($str_query);		
		foreach($result->result() as $rw)
		{
			echo "<option account_no='".$rw->account_number."' branch_name='".$rw->branch_name."' ifsc_code='".$rw->ifsc_code."' value='".$rw->user_bank_id."'>".$rw->bank_name."</option>";
		}
?>
</select>

<span id="deposit_account_no" style="font-weight:bold;"></span>
</td>
</tr>

<tr>
	<td align="right"><label for="ddlDeptime1">Deposit Time :</label></td>
    <td align="left"><select id="ddlDeptime" name="ddlDeptime" title="Select Deposit Time." class="select"><option>---- * Select * ----</option>
    <option value="10:30 AM">10:30 AM</option>
    <option value="11:00 AM">11:00 AM</option>
	<option value="11:30 AM">11:30 AM</option>    
   	<option value="12:00 PM">12:00 PM</option>
    <option value="12:30 PM">12:30 PM</option>
   	<option value="1:00 PM">1:00 PM</option>        
	<option value="1:30 PM">1:30 PM</option>
   	<option value="2:00 PM">2:00 PM</option>
	<option value="2:30 PM">2:30 PM</option>
   	<option value="3:00 PM">3:00 PM</option>                        
	<option value="3:30 PM">3:30 PM</option>
   	<option value="4:00 PM">4:00 PM</option>            
   	<option value="4:30 PM">4:30 PM</option>                
    </select>
    </td>    
  </tr>
  <tr>
	<td align="right"><label for="ddlClientBank"><span style="color:#F06">*</span>Your Bank Name :</label></td>
    <td align="left"><select id="ddlClientBank" name="ddlClientBank" title="Select Your Bank Name." class="select">			<option>---- * Select * ----</option>
    <?php
$str_query = "select * from tblbank";
		$resultClient = $this->db->query($str_query);		
		for($i=0; $i<$resultClient->num_rows(); $i++)
		{
			echo "<option value='".$resultClient->row($i)->bank_id."'>".$resultClient->row($i)->bank_name."</option>";
		}
?>

    </select>
    </td>    
  </tr>

  <tr>
   <td align="right"><label for="txtChaqueno"><span style="color:#F06">*</span>Chaque/DD Number :</label></td>
   <td align="left"><input type="text" title="Enter Chaque Number.<br />e.g 66075" id="txtChaqueno" name="txtChaqueno" class="text" /><br />
    </td>
  </tr>
  <tr>
   <td align="right"><label for="txtChaquedate"><span style="color:#F06">*</span>Chaque/DD Date :</label></td>
   <td align="left"><input type="text" title="Enter Chaque Number.<br />e.g 12/08/2012" id="txtChaquedate" name="txtChaquedate" class="text" /><br />
    </td>
  </tr>
<tr>
   <td align="right"><label for="txtRemarks">Remarks :</label></td>
   <td align="left"><textarea id="txtRemarks" name="txtRemarks" title="Enter Remarks." cols="21" rows="4" class="listbox"></textarea><br />
   </td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="left"><input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" class="button" /></td>
  </tr>
</table>
</form>
</div>

<h2 class="h2">View Payment Request</h2>

<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class='colHeader' style="background-color:#CCCCCC;">
    <th scope="col" align="left">Payment Date</th>
    <th scope="col" align="left">Amount</th>
    <th scope="col" align="left">Mode</th>        
    <th scope="col" align="left">Deposit Time</th>        
    <th scope="col" align="left">Bank Name</th>        
    <th scope="col" align="left">Bank Charge</th>        
    <th scope="col" align="left">Remarks</th>                
    <th scope="col" align="left">Response Message</th>                    
    <th scope="col" align="left">Status</th>                        
    </tr>
    <?php	$i = 0;foreach($result_payment->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><?php echo $result->payment_date; ?></td>
 <td><?php echo $result->request_amount; ?></td>
 <td><?php echo $result->payment_mode; ?></td>
 <td><?php echo $result->deposite_time; ?></td>
  <td><?php echo $result->bank_name; ?></td>
    <td><?php echo $result->bank_charge; ?></td>
 <td><?php echo $result->remarks; ?></td>
  <td><?php echo $result->deposit_remark; ?></td>
  <td>  
  <?php if($result->request_status == "Pending"){echo "<span class='orange'>".$result->request_status."</span>";} ?>
  <?php if($result->request_status == "Success"){echo "<span class='green'>".$result->request_status."</span>";} ?>
  <?php if($result->request_status == "Cancel"){echo "<span class='red'>".$result->request_status."</span>";} ?>
  </td>
 
 </tr>
		<?php 	
		$i++;} ?>
		</table>
       <?php  echo $pagination; ?>

</div>
</div>
<?php require_once("general_footer.php"); ?>
</body>
</html>