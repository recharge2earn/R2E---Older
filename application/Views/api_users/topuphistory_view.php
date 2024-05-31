<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ledger Report</title>
<?php include("script.php"); ?>
    <link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                       
  
<script>	
$(document).ready(function(){
$( "#txtFrom,#txtTo" ).datepicker({dateFormat:'yy-mm-dd'});
	setTimeout(function(){$('div.message').fadeOut(1000);}, 5000);
						   });
	</script>
    <style>
	.ui-datepicker
	{
		font-size:14px;
	}
	.disable
	{
		background:#CFD8FA;
	}
	.enabled
	{
	background:#FFFFFF;
	}
	#tblreport
	{
		font-family:Verdana, Geneva, sans-serif;font-size: 13px;

	}
	</style>
    <script>
	setTimeout(function(){$('div.message').fadeOut(1000);}, 3000);
	function ActionSubmit(value,name)
	{
		if(document.getElementById('action_'+value).selectedIndex != 0)
		{
			var isstatus;
			if(document.getElementById('action_'+value).value == 0)
			{isstatus = 'cancel';}else{isstatus='active';}
			
			if(confirm('Are you sure?\n you want to '+isstatus+' login for - ['+name+']')){
				document.getElementById('hidstatus').value= document.getElementById('action_'+value).value;
				document.getElementById('hiduserid').value= value;				
				document.getElementById('frmCallAction').submit();
				}
		}
	}
	function test()
	{
		var input = $('#txtRegLimit');
		$('#txtRegLimit').addClass("enabled");
		
	}
	function test2(user_id)
	{
		var ids = $('#txtRegLimit'+user_id).val();
		document.getElementById("process"+user_id).style.display="inline";
		$.ajax(
		{
		type: "GET",
		url: '<?php base_url()?>update_ids/update?ids='+ids+'&user_id='+user_id,
		cache: false,
		success: function(html)
		{

		},
		complete:function(msg)
		{
			document.getElementById("process"+user_id).style.display="none";
		}});
		
		
		
	}
	
	</script>
</head>
<body class="twoColFixLtHdr">
<div id="container">

 <?php require_once("ApiMenu.php"); ?> 

  <div id="back-border">
  </div>
  <div class="container">
<h2>Ledger Report</h2> 
 
 <form action="<?php echo base_url()."api_users/topuphistory" ?>" method="post" name="frmCallAction" id="frmCallAction">
<input type="hidden" id="hidstatus" name="hidstatus" />
<input type="hidden" id="hiduserid" name="hiduserid" />
<input type="hidden" id="hidaction" name="hidaction" value="Set" />
 </form>
 
 
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if($this->session->flashdata('user_message')){echo "<div id='message' class='message'>".$this->session->flashdata('user_message')."</div>";}
	
		if($this->session->flashdata('message')){echo "<div class='message'>".$this->session->flashdata('message')."</div>";}	
	
	?>    
<div class="breadcrumb">    
     <form action="<?php echo base_url()."api_users/topuphistory" ?>" method="post" name="frmSearch" id="frmSearch">
     
 
     From Date :<input type="text" name="txtFrom" id="txtFrom" class="text" title="Select Date." maxlength="10" />To Date :<input type="text" name="txtTo" id="txtTo" class="text" title="Select Date." maxlength="10" /><input type="submit" name="btnSearch" id="btnSearch" value="Search" class="button" title="Click to search." />

<br />
 </form>
 </div>
 <?php if($result_mdealer != false){ ?>
 <div style="width:240px;float:right;" align="right">  
 <table>
 <?php 
 	if($result_mdealer->num_rows() > 0){
  if($flagopenclose == 1){?>
  <br><br>
   <br><br>
     
     <?php } } ?> 
 </table></div>
 <?php 
 	if($result_mdealer->num_rows() > 0){?>
 <h2 style="position:absolute;padding-top:30px;width:100%;" >Ledger report From <?php echo $from_date; ?> To <?php echo $to_date; ?></h2>
 <?php } ?>
<table id="tblreport" style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader">
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="80" height="30" >Payment Date</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="40" height="30" >Payment Id</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="60" height="30" >Payment From</th>
    <!--<th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="50" height="30" >User type</th>-->
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="60" height="30" >Transaction type</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="15" height="30" >Description</th>
   
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="70" height="30" >Before Balance</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="70" height="30" >Credit Amount</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="70" height="30" >Debit Amount</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="60" height="30" >Balance</th>
    
    </tr>
      <?php 
	if($result_mdealer->num_rows() > 0){
   
   	$i = 0;foreach($result_mdealer->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
            <?php
				 if($result->payment_id > 0)
				 {
					 $payment_id = $result->payment_id;
					 $payment_info = $this->Common_methods->getPaymentInfo($payment_id);
					 $payment_from = $payment_info->row(0)->dr_usercode;
					 if($result->transaction_type != "Recharge")
					 {
						 if($payment_from == 0)
						 {
							 $payment_from = "AllInRecharge";
						 }
					 }
					
					 else
					 {
						 $payment_from = "";
					 }
					 $payment_from_usertype = $payment_info->row(0)->dr_usertype_name;
				 }
				  else if($result->transaction_type == "Flight_booking" or $result->transaction_type == "FLIGHT_BOOKING_COMMI")
					 {
						
							  $payment_id = $result->airbook_id;
							 $payment_from = "";
							 $payment_from_usertype = "";
							 
						
					 }
				 else
				 {
					 $payment_id = $result->recharge_id;
					 $payment_from = "";
					 $payment_from_usertype = "";
				 }
				  $date = date_create($result->add_date);
			 ?> 
            
<td style="padding:5px;" class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="width:120px;"><?php echo $date->format('d-M-Y H:i:s'); ?></td>

 <td style="padding:5px;" class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:30px;width:30px;"><?php echo $payment_id; ?></td>
 
  <td style="padding:5px;" class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:50px;width:60px;"><?php echo $payment_from; ?></td>
  
  <!--<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:50px;width:50px;"><?php echo $payment_from_usertype; ?></td>-->
  
  <td style="padding:5px;" class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:60px;width:60px;"><?php echo $result->transaction_type; ?></td>
  
 <td style="padding:5px;" class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:300px;width:300px;"><?php echo $result->description; ?></td>
 <?php if($result->credit_amount > 0)
 		{
			$before_balance =  $result->balance - $result->credit_amount;
		}
		else if($result->debit_amount > 0)
 		{
			$before_balance =  $result->balance + $result->debit_amount;
		}
  ?>
<td style="padding:5px;" class="padding_left_10px box_border_bottom box_border_right" align="right" height="34" style="min-width:300px;width:300px;"><?php echo $before_balance; ?></td>

 <td style="padding:5px;" class="padding_left_10px box_border_bottom box_border_right" align="right" height="34" style="min-width:60px;width:60px;"><?php echo $result->credit_amount; ?></td>
 
  <td style="padding:5px;" class="padding_left_10px box_border_bottom box_border_right" align="right" height="34" style="min-width:60px;width:60px;"><?php echo $result->debit_amount; ?></td>
  
  
  <td style="padding:5px;" class="padding_left_10px box_border_bottom box_border_right" align="right" height="34" style="min-width:60px;width:60px;"><?php echo "<b>".$result->balance."</b>"; ?></td>
  
 </tr>
		<?php 	
		$i++;} ?>

      <?php } else{?>
       <tr>
       <td colspan="10">
       <div class='message'> No Records Found</div>
       </td>
       </tr>
      <?php } ?>
		</table>
       <?php  echo $pagination; ?>
<?php } ?>
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>

