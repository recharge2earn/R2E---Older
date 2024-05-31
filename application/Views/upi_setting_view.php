<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UPI Setting</title>
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
  <div class="panel-heading"><h4> Update UPI</h4></div>
  <div class="panel-body">
   <form action="<?php echo base_url()."upi_setting"; ?>" method="post" autocomplete="off" name="frmDelete" id="frmDelete">
    
    
      <div class="row">
      
      
  <div class="col-sm-4">
  <div class="form-group">
  <label for="txtAPIName">UPI ID:</label>
  <input type="text" name="upi_id" class="form-control" id="upi_id" value="<?php echo $result_api->row(0)->upi_id; ?>">
</div>
<button type="submit" name="btnSubmit" value="Update" class="btn btn-success">Update</button>
</div>
  
  

  

  
  </div>
</div>
</form>


</div>
</div>















     <?php require_once("footer.php"); ?>
 
  <?php include("app_js.php"); ?>
</body>


</html>
