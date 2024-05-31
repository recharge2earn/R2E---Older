<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Deposit Request</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>   
 

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
<body>
<?php require_once("admin_menu.php"); ?> 


<div class="container">
<div class="panel panel-primary">
  <div class="panel-heading">Process Payment Request</div>
  <div class="panel-body">

    <?php
	if($this->session->flashdata('message')){
	echo "<div class='alert alert-warning'>".$this->session->flashdata('message')."</div>";}
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


<div class="table-responsive">
<table class="table table-hover">
    <tr>
    <th>Sr No</th>
    <th>Name</th>            
    
  
    
    <th>Amount</th>        
    <th>Date Time</th>        
    <th>Mode</th>                
    <th>Bank Ref no</th>               
	<th>User Remark</th>                     
    <th>Status</th>                        
    <th>Charges/Reject Amount</th>                
    <th>Your Comment</th>                
    <th>Action</th>                            
    </tr>
    <?php	$i = 0;foreach($result_payment->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><?php echo ($i + 1); ?></td>
 <td><?php echo $result->business_name; ?></td> 


 <input type="hidden" name="hidbank_id_<?php echo $result->payment_request_id; ?>" id="hidbank_id_<?php echo $result->payment_request_id; ?>" value="<?php echo $result->bank_id; ?>" />
 </td> 
  
 <td><span id='Amount_<?php echo $result->payment_request_id;?>'><?php echo $result->request_amount; ?></span>
 <?php
 $remark_details ='';
 if($result->payment_mode == 'Cash')
 {
	 $remark_details=$result->payment_mode.'->'.$result->bank_name.','.$result->remarks;
 }
 else
 {
	 $remark_details=$result->bank_name.'->'.$result->client_bank.'<br />'.$result->cheque_no.','.$result->remarks;
 }
 
 ?>
 <input type="hidden" name="hidRemark_Details_<?php echo $result->payment_request_id; ?>"
 id="hidRemark_Details_<?php echo $result->payment_request_id; ?>" value="<?php echo $remark_details;?>" />
 </td>
  <td><?php echo $result->add_date; ?></td>
 <td><?php echo $result->payment_mode; ?></td>
  <td><?php echo $result->cheque_no; ?></td>
    <td><?php echo $result->remarks; ?></td>
  <td>  
  <?php if($result->request_status == "Pending"){echo "<span class='btn btn-warning'>".$result->request_status."</span>";} ?>
  <?php if($result->request_status == "Success"){echo "<span class='btn btn-success'>".$result->request_status."</span>";} ?>
  <?php if($result->request_status == "Cancel"){echo "<span class='btn btn-danger'>".$result->request_status."</span>";} ?>
  </td>
  
   <td>
   <input type="text" name="txtBankcharge" title="Enter Bank Charge." id="txtBankcharge_<?php echo $result->payment_request_id;?>" onKeyPress="return isNumeric(event)" class="form-control" /></td>   
    <td>

    <input type="text" name="txtRemark" title="Enter Remark." id="txtRemark_<?php echo $result->payment_request_id;?>" class="form-control" />
    </td>

 <td>
 <select id="ddlAction_<?php echo $result->payment_request_id;?>" onChange="SubmitAction('<?php echo $result->user_id ?>','<?php echo $result->payment_request_id;?>')" name="ddlAction" class="form-control">
 <option>Select</option>
  <option value="Success">Success</option>
   <option value="Cancel">Cancel</option>
 </select>
 </td> 
 </tr>
		<?php 	
		$i++;} ?>
		</table>
       <?php  echo $pagination; ?>

</div>

</div>
</div>
</div>


      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
  
</body>
</html>