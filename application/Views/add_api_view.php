<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add API</title>
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
  
  
   <div align="right"><a href="#" class="btn btn-danger" role="button" data-toggle="modal" data-target="#myModal">+Add API</a> 
  <a href="edit_opcode" class="btn btn-success" role="button">Edit operator code</a></div>      
   
<div class="panel panel-default">
  <div class="panel-body">
      
      
      <div class="col-sm-6">Your call back url : <?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']."/rsp";?> </div>
      <div class="col-sm-6">Your Server IP : 3.6.174.157</div>
     </div>
</div>
   
  
	
	
	
	
	

<!-- Modal -->

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	



<?php $i = 0;foreach($result_api->result() as $result)  {  ?>

<div class="panel panel-primary">
  <div class="panel-heading"><h4><?php echo $result->api_name; ?></h4></div>
  <div class="panel-body">
   <form action="<?php echo base_url()."add_api"; ?>" method="post" autocomplete="off" name="frmDelete" id="frmDelete">
    <input type="hidden" id="hidValue" name="hidValue" value="<?php echo $result->api_id; ?>" />
    
    <input type="hidden" id="hidID" name="hidID" value="<?php echo $result->api_id; ?>" />
    

  
  
  <div class="row">
      
      
  <div class="col-sm-4">
  <div class="form-group">
  <label for="txtAPIName">API NAME:</label>
  <input type="text" name="txtAPIName" class="form-control" id="txtAPIName" value="<?php echo $result->api_name; ?>">
</div>
</div>




  <div class="col-sm-4">
   <div class="form-group">
 
   <label for="response_type">Response type:</label>
  <select class="form-control" id="response_type" name="response_type" >
    <option><?php echo $result->response_type; ?></option>
    <option>json</option>
    <option>xml</option>
    <option>csv</option>
    
  </select>
  
  
  
 
</div>
  
  
  </div>
  <div class="col-sm-4">
  
   <div class="form-group">
 
   <label for="response_type">Method:</label>
  <select class="form-control" id="method" name="method" >
    <option><?php echo $result->method; ?></option>
    <option>GET</option>
    <option>POST</option>
    
    
  </select>
  
  
  
 
</div>
  
  </div>
</div>
  
   <div class="row">
      
      
  <div class="col-sm-12">
  <div class="form-group">
  <label for="txtAPIName">Request URL:</label>
  <input type="text"  data-toggle="tooltip" data-placement="top" title="For operator code use  ooo ,  for number mmm , for orderid rrr  for amount aaa" name="url" class="form-control input-lg" id="url" value="<?php echo $result->url; ?>">
</div>
</div>

</div> 

<h4>Recharge Response</h4>

  
   <div class="row">
      
      
  <div class="col-sm-3">
  <div class="form-group">
  <label for="status_response_text">Status:</label>
  <input type="text" name="status_response_text" class="form-control" id="status_response_text" value="<?php echo $result->status_response_text; ?>">
</div>
</div>




  <div class="col-sm-3">
   <div class="form-group">
 
   <label for="txid_response_text">Transaction ID:</label>
  <input type="text" name="txid_response_text" class="form-control" id="txid_response_text" value="<?php echo $result->txid_response_text; ?>">
    
 
  
  
  
 
</div>
  
  
  </div>
  <div class="col-sm-3">
  
   <div class="form-group">
 
   <label for="response_type">Operator ID:</label>
   <input type="text" name="opid_response_text" class="form-control" id="opid_response_text" value="<?php echo $result->opid_response_text; ?>">
    
  
  
  
 
</div>
  
  </div>
  
   <div class="col-sm-3">
  
   <div class="form-group">
 
   <label for="message_response_text">Message:</label>
   <input type="text" name="message_response_text" class="form-control" id="message_response_text" value="<?php echo $result->message_response_text; ?>">
    
  
  
  
 
</div>
  
  </div>
</div>
  
 


  <div class="row">
      
      
  <div class="col-sm-6">
  <div class="form-group">
  <label for="success_response_text">Success Value:(eg. Success, SUCCESS etc)</label>
  <input type="text" name="success_response_text" class="form-control" id="success_response_text" value="<?php echo $result->success_response_text; ?>">
</div>
</div>
<div class="col-sm-6">
  <div class="form-group">
  <label for="failure_response_text">Failure Value:(eg. FAILURE, FAILED, Failure etc)</label>
  <input type="text" name="failure_response_text" class="form-control" id="failure_response_text" value="<?php echo $result->failure_response_text; ?>">
</div>
</div>



    
     <div class="col-sm-12">
  <div class="form-group">
  <label for="balance_url">Balance API URL:</label>
  <input type="text"  data-toggle="tooltip" data-placement="top" title="For username uuu, for password ppp" name="balance_url" class="form-control input-lg" id="balance_url" value="<?php echo $result->balance_url; ?>">
</div>
</div>
    






  <div class="col-sm-6">
   <div class="form-group">
 
   <label for="balance_response_text">Balance Response Value:</label>
  <input type="text" name="balance_response_text" class="form-control" id="balance_response_text" value="<?php echo $result->balance_response_text; ?>">
    
 
</div>
  
  
  </div>

  
  
  
  
  
  
  
  




</div>

<div class="row">
    <div class="col-sm-6">
<div class="form-group">
     <label for="ipaddress">If Recharge failed, Auto select  second API:</label>
 <select id="second_api" name="second_api" class="form-control">
<option value="<?php echo $result->second_api; ?>"><?php  $second = $result->second_api;


	$rslt_api = $this->db->query("select * from tblapi where api_id='$second'");
	
	echo $rslt_api->row(0)->api_name;


?></option>
<option value="">Disable</option>
<?php 
	$rslt_api = $this->db->query("select * from tblapi");
	foreach($rslt_api->result() as $row)
	{
?>

<option value="<?php echo $row->api_id;?>"><?php echo $row->api_name;?></option>
<?php } ?>
</select> </div>
</div>
</div>








  <button type="submit" name="btnSubmit" value="Update" class="btn btn-success">Update</button>
<button type="submit" class="btn btn-danger" name="action" value="action" >Delete</button>
  
  </div>
</div>
</form>
       <?php  
    $i++;} ?>

</div>















     <?php require_once("footer.php"); ?>
 
  <?php include("app_js.php"); ?>
</body>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add API</h4>
      </div>
      <div class="modal-body">
        
        
        <form action="<?php echo base_url()."add_api"; ?>" method="post" autocomplete="off" name="Submit" id="Submit">
    

  
  
  <div class="row">
      
      
  <div class="col-sm-4">
  <div class="form-group">
  <label for="txtAPIName">API NAME:</label>
  <input type="text" name="txtAPIName" class="form-control" id="txtAPIName">
</div>
</div>




  <div class="col-sm-4">
   <div class="form-group">
 
   <label for="response_type">Response type:</label>
  <select class="form-control" id="response_type" name="response_type" >
   
    <option>json</option>
    <option>xml</option>
    <option>csv</option>
    
  </select>
  
  
  
 
</div>
  
  
  </div>
  <div class="col-sm-4">
  
   <div class="form-group">
 
   <label for="response_type">Method:</label>
  <select class="form-control" id="method" name="method" >

    <option>GET</option>
    <option>POST</option>
    
    
  </select>
  
  
  
 
</div>
  
  </div>
</div>
  
   <div class="row">
      
      
  <div class="col-sm-12">
  <div class="form-group">
  <label for="txtAPIName">Request URL:</label>
  <input type="text"  data-toggle="tooltip" data-placement="top" title="For operator code use  ooo ,  for number mmm , for orderid rrr  for amount aaa" name="url" class="form-control input-lg" id="url">
</div>
</div>

</div> 
  
   <div class="row">
      
      
  <div class="col-sm-3">
  <div class="form-group">
  <label for="status_response_text">Status Response :</label>
  <input type="text" name="status_response_text" class="form-control" id="status_response_text">
</div>
</div>




  <div class="col-sm-3">
   <div class="form-group">
 
   <label for="txid_response_text">API txid response:</label>
  <input type="text" name="txid_response_text" class="form-control" id="txid_response_text">
    
 
  
  
  
 
</div>
  
  
  </div>
  <div class="col-sm-3">
  
   <div class="form-group">
 
   <label for="response_type">operator Id Response:</label>
   <input type="text" name="opid_response_text" class="form-control" id="opid_response_text">
    
  
  
  
 
</div>
  
  </div>
  
   <div class="col-sm-3">
  
   <div class="form-group">
 
   <label for="message_response_text">Message  Response:</label>
   <input type="text" name="message_response_text" class="form-control" id="message_response_text">
    
  
  
  
 
</div>
  
  </div>
</div>
  
  
  <div class="row">
      
      
  <div class="col-sm-4">
  <div class="form-group">
  <label for="success_response_text">Success text:</label>
  <input type="text" name="success_response_text" class="form-control" id="success_response_text" >
</div>
</div>
<div class="col-sm-4">
  <div class="form-group">
  <label for="failure_response_text">Failure text:</label>
  <input type="text" name="failure_response_text" class="form-control" id="failure_response_text" >
</div>
</div>


<div class="col-sm-4">
  <div class="form-group">
  <label for="ipaddress">Ip Address:</label>
  <input type="text" name="ipaddress" class="form-control" id="ipaddress" >
</div>
</div>



</div>
  <button type="submit" name="btnSubmit" value="Submit" class="btn btn-success">Add</button>

  
  </div>
</div>
</form>
        
        
        
      </div>
      
    </div>

  </div>
</div>
</html>
