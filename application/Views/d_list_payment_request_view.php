<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Deposit Request</title>
<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                       
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script>	
	
	function SubmitAction(user_id,id)
	{
		if(document.getElementById('ddlAction_'+id).selectedIndex != 0)
		{
			if(confirm('Are you sure?\nyou want to submit action.'))
			{
			document.getElementById('hidUserID').value= user_id;
			document.getElementById('hidID').value= id;
			document.getElementById('hidAmount').value= document.getElementById('Amount_'+id).innerHTML;
			document.getElementById('hidRemark').value= document.getElementById('txtRemark_'+id).value;
			document.getElementById('hidBankCharge').value= document.getElementById('txtBankcharge_'+id).value;
			document.getElementById('hidStatus').value = document.getElementById('ddlAction_'+id).value;		
			document.getElementById('hidBankID').value = document.getElementById('hidbank_id_'+id).value;					
			document.getElementById('frmAction').submit();
			}
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
<h2>Deposit Payment</h2>
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
<form action="<?php base_url()."d_list_payment_request" ?>" method="post" name="frmAction" id="frmAction">
<input type="hidden" name="hidUserID" id="hidUserID" />
<input type="hidden" name="hidStatus" id="hidStatus" />
<input type="hidden" name="hidID" id="hidID" />
<input type="hidden" name="hidRemark" id="hidRemark" />
<input type="hidden" name="hidAmount" id="hidAmount" />
<input type="hidden" name="hidBankCharge" id="hidBankCharge" />
<input type="hidden" name="hidBankID" id="hidBankID" />
<input type="hidden" name="hidAction" id="hidAction" value="Perform" />
</form>

<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader">
    <th scope="col" align="left">Sr No</th>
    <th scope="col" align="left">Distributer ID</th>            
    <th scope="col" align="left">Txn ID</th>
    <th scope="col" align="left">Bank Name</th>
    <th scope="col" align="left">Amount</th>        
    <th scope="col" align="left">Date</th>        
    <th scope="col" align="left">Pay Mode</th>                
    <th scope="col" align="left">Cheque No</th>                
    <th scope="col" align="left">Status</th>                        
    <th scope="col" align="left">Bank Charge</th>                
    <th scope="col" align="left">Remark</th>                
    <th scope="col" align="left">Action</th>                            
    </tr>
    <?php	$i = 0;foreach($result_payment->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><?php echo ($i + 1); ?></td>
 <td><?php echo $result->username; ?></td> 
 <td><?php echo $result->tid; ?></td>
 <td><?php echo $result->bank_name; ?>
 <input type="hidden" name="hidbank_id_<?php echo $result->payment_request_id; ?>" id="hidbank_id_<?php echo $result->payment_request_id; ?>" value="<?php echo $result->bank_id; ?>" />
 </td> 
 <td><span id='Amount_<?php echo $result->payment_request_id;?>'><?php echo $result->request_amount; ?></span></td>
  <td><?php echo $result->payment_date; ?></td>
 <td><?php echo $result->payment_mode; ?></td>
  <td><?php echo $result->cheque_no; ?></td>
  <td>  
  <?php if($result->request_status == "Pending"){echo "<span class='orange'>".$result->request_status."</span>";} ?>
  <?php if($result->request_status == "Success"){echo "<span class='green'>".$result->request_status."</span>";} ?>
  <?php if($result->request_status == "Cancel"){echo "<span class='red'>".$result->request_status."</span>";} ?>
  </td>
  
   <td><input type="text" style="text-align:right;width:60px;" name="txtBankcharge" title="Enter Bank Charge." id="txtBankcharge_<?php echo $result->payment_request_id;?>" onKeyPress="return isNumeric(event)" class="text" /></td>   
    <td><input type="text" name="txtRemark" title="Enter Remark." id="txtRemark_<?php echo $result->payment_request_id;?>" class="text" /></td>
 <td><select id="ddlAction_<?php echo $result->payment_request_id;?>" onChange="SubmitAction('<?php echo $result->user_id ?>','<?php echo $result->payment_request_id;?>')" name="ddlAction">
 <option>Select</option>
  <option value="Success">Success</option>
   <option value="Cancel">Cancel</option>
 </select></td> 
 </tr>
		<?php 	
		$i++;} ?>
		</table>
       <?php  echo $pagination; ?>

</div>
<div id="footer">
     <?php require_once("general_footer.php"); ?>
  <!-- end #footer --></div>
  
</div>

</body>
</html>