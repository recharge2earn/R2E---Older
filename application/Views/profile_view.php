<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Profile</title>
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
      <div class="panel-heading">Account Details</div>
      <div class="panel-body">

    
      <table class="table table-hover">
   


<tr>
<td><b>Login Mobile No :</b></td>
<td> </td>
<td><?php echo $data->row(0)->mobile_no;?></td>
</tr>

<tr>
<td><b>Password :</b></td>
<td> </td>
<td><?php echo $data->row(0)->password;?></td>
</tr>





<tr>
<td><b>API User id :</b></td>
<td> </td>
<td><?php echo $data->row(0)->username;?></td>
</tr>



<tr>
<td><b>Name :</b></td>
<td> </td>
<td><?php echo $data->row(0)->business_name;?></td>
</tr>
<tr>

<td><b>Parent Name :</b></td>
<td> </td>
<td><?php echo $data->row(0)->parent_name;?></td>
</tr>
<tr>
<td><b>Address :</b></td>
<td> </td>
<td><?php echo $data->row(0)->postal_address;?></td>
</tr>
<tr>
<td><b>Email ID :</b></td>
<td> </td>
<td><?php echo $data->row(0)->emailid;?></td>
</tr>






<tr>
<td><b>Alternate Number :</b></td>
<td> </td>
<td><?php echo $data->row(0)->landline;?></td>
</tr>
<tr>
<td><b>Activation date :</b></td>
<td> </td>
<td><?php echo $data->row(0)->add_date;?></td>
</tr>
</table>
   
 </div>
    </div>
</div>

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
</body>
</html>