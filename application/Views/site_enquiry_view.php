<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Site Enquiry</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>   
 

</head>
<body>
<?php require_once("admin_menu.php"); ?> 


<div class="container">
<div class="panel panel-primary">
  <div class="panel-heading">List of Contact Form submitted from website </div>
  <div class="panel-body">

    <?php
	if($this->session->flashdata('message')){
	echo "<div class='alert alert-warning'>".$this->session->flashdata('message')."</div>";}
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>



<div class="table-responsive">
<table class="table table-hover">
    <tr>
    <th>Sr No</th>
            
    
  
    
    <th>Name</th>        
    <th>Email</th>        
    <th>Contact Number</th>                
    <th>Message</th>               
	                            
    </tr>
    <?php	$i = 0;foreach($get_form as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><?php echo ($i + 1); ?></td>
 <td><?php echo $result->name; ?></td> 
 <td><?php echo $result->email; ?></td> 
 <td><?php echo $result->number; ?></td> 
 <td><?php echo $result->message; ?></td> 
 </tr>
		<?php 	
		$i++;} ?>
		</table>
     

</div>

</div>
</div>
</div>


      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
  
</body>
</html>