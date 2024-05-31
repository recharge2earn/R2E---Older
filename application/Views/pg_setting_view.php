<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Gateway Setting</title>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
 <?php include("app_css.php"); ?>
    <link rel="stylesheet" href="<?php echo base_url()."js/jquery.alerts.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>               
    <script src="<?php echo base_url()."js/jquery.dataTables.min.js"; ?>"></script> 
    <script src="<?php echo base_url()."js/jquery.alerts.js"; ?>"></script>                
  <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>



    
    
</head>
<body>
    
   <?php include("admin_menu.php"); ?>  


  
  
  
  
 <div class="container">
 <?php
	if ($message != ''){echo "<div class='alert alert-success'>".$message."</div>"; }
	?>

<div class="panel panel-primary">
  <div class="panel-heading"><h4>PAYTM PAYMENT GATEWAY SETTING</h4></div>
  <div class="panel-body">
      
   <form action="<?php echo base_url()."pg_setting"; ?>" method="post" autocomplete="off" name="frmDelete" id="frmDelete">
    
    
      <div class="row">
      
      
  <div class="col-sm-4">
  <div class="form-group">
  <label for="txtAPIName">Marchant ID:</label>
  <input type="text" name="mid" class="form-control" id="mid" value="<?php echo $result_api->row(0)->mid; ?>">
</div>

</div>
  
   <div class="col-sm-4">
  <div class="form-group">
  <label for="txtAPIName">Marchant Key:</label>
  <input type="text" name="key" class="form-control" id="key" value="<?php echo $result_api->row(0)->token; ?>">
</div>

</div>
  
  </div>
  
<div class="row">
<?php 

$web_status = $result_api->row(0)->web_status;
$app_status = $result_api->row(0)->app_status; 




?>

<div class="col-sm-4">
  <label for="app_status">App Status:</label>
  <select class="form-control" id="app_status" name="app_status">
    <option value="<?php echo $app_status;?>" selected=""><?php echo $app_status;?></option>
    <option value="ON" >ON</option>
    <option value="OFF" >OFF</option>
    
  </select>
</div>
  
  <div class="col-sm-4">
  <label for="web_status">Web Status:</label>
  <select class="form-control" id="status" name="web_status">
      
      <option value="<?php echo $web_status;?>" selected=""><?php echo $web_status;?></option>
    <option value="ON" >ON</option>
    <option value="OFF" >OFF</option>
    
  </select>
</div>
  
  
  
  </div>
  

 <br>
  
  <button type="submit" name="btnSubmit" value="paytm" class="btn btn-success">Update</button>
</div>
</form>


</div>



<div class="panel panel-primary">
  <div class="panel-heading"><h4>UPI  GATEWAY SETTING</h4></div>
  <div class="panel-body">

  <div class="well">Call back url : <?php echo $domain = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']."/mrobo_upi/payment_callback_upi"; ?></div>
   <form action="<?php echo base_url()."pg_setting"; ?>" method="post" autocomplete="off" name="frmDelete" id="frmDelete">
    
    
      <div class="row">
      
      

  
   <div class="col-sm-4">
  <div class="form-group">
  <label for="txtAPIName">Marchant Token:</label>
  <input type="text" name="key" class="form-control" id="key" value="<?php echo $result_upi->row(0)->token; ?>">
</div>

</div>
  
  </div>
  
<div class="row">
<?php 

$web_status_upi = $result_upi->row(0)->web_status;
$app_status_upi = $result_upi->row(0)->app_status; 




?>

<div class="col-sm-4">
  <label for="app_status">App Status:</label>
  <select class="form-control" id="app_status" name="app_status">
    <option value="<?php echo $app_status_upi;?>" selected=""><?php echo $app_status_upi;?></option>
    <option value="ON" >ON</option>
    <option value="OFF" >OFF</option>
    
  </select>
</div>
  
  <div class="col-sm-4">
  <label for="web_status">Web Status:</label>
  <select class="form-control" id="status" name="web_status">
      
      <option value="<?php echo $web_status_upi;?>" selected=""><?php echo $web_status_upi;?></option>
    <option value="ON" >ON</option>
    <option value="OFF" >OFF</option>
    
  </select>
</div>
  
  
  
  </div>
  

 <br>
  
  <button type="submit" name="btnSubmit" value="upi" class="btn btn-success">Update</button>
</div>
</form>


</div>



</div>









     <?php require_once("footer.php"); ?>
 
  <?php include("app_js.php"); ?>
</body>


</html>
