<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment History</title>
<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                       
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
  <div>
   <h2><span id="myLabel">Payment History</span></h2>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>    

<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader">
    <th scope="col" align="left">Payment Date</th>
    <th scope="col" align="left">Amount</th>
    <th scope="col" align="left">Mode</th>        
    <th scope="col" align="left">Deposit Time</th>        
    <th scope="col" align="left">Bank Name</th>        
    <th scope="col" align="left">Bank Charge</th>        
    <th scope="col" align="left">Remarks</th>                
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
<div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
</div>

  
</body>
</html>