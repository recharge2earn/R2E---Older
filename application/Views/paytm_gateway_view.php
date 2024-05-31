
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Add Fund Using paytm </title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

   <?php include("app_css.php"); ?>
 <script type="text/javascript">
   function getId(id) { 
       return document.getElementById(id); 
   } 
   function validation() { 
       getId("btnSubmit").style.display="none"; 
       getId("wait_tip").style.display=""; 
       return true; 
   } 
</script> 

</head>
<body> 
 <?php include("menu.php"); ?>
    
    
    <br />
  <div class="container">
  <!--  <div class="alert alert-danger"><H1>ICICI AND UPI NOT WORKING TEMPORARY, PLEASE USE ONLY HDFC BANK FOR ANY TRASACTIONS</H1></div>-->
   <?php
	if($this->session->flashdata('message')){
	echo "<div class='alert alert-danger fade in'>".$this->session->flashdata('message')."</div>";}	
	if($message != ''){
	echo "<div class='alert alert-danger fade in'><b>".$message."</b></div>";}
	?>
	
	
    <div class="panel panel-danger">
      <div class="panel-heading"><b>ADD FUND <br>
      
     
   
     
  </div>
      <div class="panel-body">     
      
      <form action="<?php echo base_url()."paytm_gateway"; ?>" method="post" autocomplete="off" name="frmChangePassword" id="frmChangePassword">
  
 
     
     <div class="form-group">
         <lable for="txtReqamt"><b>Amount:</b></lable>
     <input class="form-control" required="" id="txtReqamt" name="txtReqamt"  placeholder="Please Enter Amount" data-toggle="tooltip" title="Please Enter Amount"  type = "number" />
     </div>
   
      
 
      
      
      
   
   
<input type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" value="Submit"><span id="wait_tip" style="display:none;"> Please wait...<img src="images/ajax-loader2.gif"
           id="loading_img"/></span> 
          </from></div>
    </div></div></div>
  
<br />

<br />






<br />




<br />



<br />

<br />
    <!-- Copyright Area Start -->
    <?php include("footer.php"); ?> 
    <!-- Copyright Area End -->

    <!-- Back To Top Button Start -->
    <div id="backToTop">
        <a href="body" data-animate-scroll="true"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- Back To Top Button End -->

    <?php include("app_js.php"); ?>
    
</body>
</html>
