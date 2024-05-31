<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recharge Detail</title>
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
      <div class="panel-heading">Recharge Details</div>
      <div class="panel-body">       
     

        <table class="table table-hover">
        <tr>
            <th>
                Description
            </th>
            <th>
                Value
            </th>
        </tr>
<tr>

<td>Recharge ID:</td>
<td><?php echo $data->row(0)->recharge_id; ?> </td>
</tr>
<tr>
<td>Transaction Id :</td>
<td><?php echo $data->row(0)->transaction_id; ?> </td>
</tr>




<tr>
<td>Operator  :</td>
<td><?php echo $data->row(0)->company_name; ?> </td>
</tr>


<tr>
<td>Amount :</td>
<td><?php echo $data->row(0)->amount; ?> </td>
</tr>


<tr>
<td>Mobile No :</td>
<td><?php echo $data->row(0)->mobile_no; ?> </td>
</tr>

<tr>
<td>Recharge Date :</td>
<td> <?php echo $data->row(0)->add_date; ?></td>
</tr>

<tr>
<td>Status :</td>
<td> <?php echo $data->row(0)->recharge_status; ?> </td>
</tr>

<tr>
<td>Server response  :</td>
<td><?php echo $data->row(0)->response; ?> </td>
</tr>

<tr>
<td>Updated response  :</td>
<td><?php echo $data->row(0)->recharge_status; ?> </td>
</tr>

<tr>
<td>Commission :</td>
<td><?php echo $data->row(0)->commission_amount; ?></td>
</tr>

<tr>
<td>Closing Balance :</td>
<td><?php echo $data->row(0)->balance; ?></td>
</tr>



<tr>
<td>Cutomer Name : :</td>
<td> <?php echo $data->row(0)->business_name; ?></td>
</tr>


<tr>
<td>Parent name :</td>
<td><?php echo $data->row(0)->parent_name; ?> </td>
</tr>


</table>
        </div>
    </div>
</div>

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
    
</body>
</html>