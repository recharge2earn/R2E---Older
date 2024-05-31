<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Account Ledger Report</title>
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>   



</head>
<body>

<?php include('admin_menu.php'); ?>


  <div class="panel panel-primary">
<div class="panel-heading">Account Report</div>
  <div class="panel-body"><form action="<?php echo base_url()."account_report" ?>" method="post" name="frmCallAction" id="frmCallAction">
<input type="hidden" id="hidstatus" name="hidstatus" />
<input type="hidden" id="hiduserid" name="hiduserid" />
<input type="hidden" id="hidaction" name="hidaction" value="Set" />
 </form>
 
 
    <?php
  if ($message != ''){echo "<div class='message'>".$message."</div>"; }
  if($this->session->flashdata('user_message')){echo "<div id='message' class='message'>".$this->session->flashdata('user_message')."</div>";}
  
    if($this->session->flashdata('message')){echo "<div class='message'>".$this->session->flashdata('message')."</div>";} 
  
  ?>

    <form class="form-inline" action="<?php echo base_url()."account_report" ?>" method="post" name="frmSearch" id="frmSearch">

<div class="form-group">
	<label for="txtFrom">From Date :</label>
     <input type="date" name="txtFrom" id="txtFrom" class="form-control" title="Select Date." maxlength="10" />
</div>

<div class="form-group">
	<label for="txtTo">To Date :</label>
     <input type="date" name="txtTo" id="txtTo" class="form-control" title="Select Date." maxlength="10" /> 

</div>

     <input type="submit" name="btnSearch" id="btnSearch" value="Search" class="btn btn-primary" title="Click to search." />
 </form>
 
 <br />
    <table class="table table-striped table-bordered">
    <tr>
     <th >Payment Date</th>
    <th>Payment Id</th>
    <th>Payment To</th>
    <th>User type</th>
    <th>Transaction type</th>
     <th>Payment type</th>
    <th>Description</th>
    <th>Remark</th>
    <th>Credit Amount</th>
    <th>Debit Amount</th>
    <th>Balance</th>
    
    
    </tr>
    <?php $i = 0;foreach($result_mdealer->result() as $result)  {  ?>
      <tr>
<td class="small"><?php echo $result->payment_date; ?></td>
 <td><?php echo $result->payment_id; ?></td>
  <td><b><?php echo $result->bname; ?></b></td>
  <td><?php echo $result->usertype; ?></td>
  <td class="small"><?php echo $result->transaction_type; ?></td>
   <td><?php echo $result->payment_type; ?></td>
 <td class="small"><?php echo $result->description; ?></td>
 <td><?php echo $result->remark; ?></td>
 <td><?php echo $result->credit_amount; ?></td>
  <td><b><?php echo $result->debit_amount; ?></b></td>
  <td class="small"><?php echo $result->balance; ?></td>
 
 </tr>
    <?php   
    $i++;} ?>
  </table>
   <?php  echo $pagination; ?>
</div>
</div>
 

<script>
	
		$(document).ready(function () {
			$(".find-duplicates").duplifer();
		});

	</script>

     <?php require_once("a_footer.php"); ?>

  <?php include('app_js.php'); ?>
</body>
</html>

