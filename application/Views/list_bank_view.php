<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bank Details</title>
<?php include("script1.php"); ?>

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
			document.getElementById('hidRemark_details').value = document.getElementById('hidRemark_Details_'+id).value;
			 
			document.getElementById('frmAction').submit();
			}
		}
	}
	</script>
</head>
<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("agent_menu.php"); ?> 
  </div>
  <div>
  </div>
  <div>
<h2 class="h2">Bank List</h2>
    <?php
	if($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";}
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
<form action="<?php base_url()."list_payment_request" ?>" method="post" name="frmAction" id="frmAction">
<input type="hidden" name="hidUserID" id="hidUserID" />
<input type="hidden" name="hidStatus" id="hidStatus" />
<input type="hidden" name="hidID" id="hidID" />
<input type="hidden" name="hidRemark" id="hidRemark" />
<input type="hidden" name="hidAmount" id="hidAmount" />
<input type="hidden" name="hidRemark_details" id="hidRemark_details" />
<input type="hidden" name="hidBankCharge" id="hidBankCharge" />
<input type="hidden" name="hidBankID" id="hidBankID" />
<input type="hidden" name="hidAction" id="hidAction" value="Perform" />
</form>

<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader">
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Sr No</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Bank Name</th>            
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Branch Name</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Account Number</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >IFSC Code</th>
    
                        
    </tr>
    <?php	$i = 0;foreach($result_bank->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo ($i + 1); ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo $result->bank_name; ?></td> 
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo $result->branch_name; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo $result->account_number; ?>
 </td> 
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo $result->ifsc_code; ?></td>
 
 </tr>
		<?php 	
		$i++;} ?>
		</table>
    




</table>        

     <p align="center"><strong>***Dear business associates please fill payment request form after making any payments to us*** </strong></p>

</div>
<div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
</div>

  
</body>
</html>