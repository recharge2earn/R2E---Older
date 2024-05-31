<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Transaction Receipt</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>   
  
  <script>
            function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
        </script>

</head>

<body>

  

 <div id="printableArea">
<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading">Transaction Details</div>
      <div class="panel-body">       
     

        <table class="table table-hover">
        <tr>
            <th>
                Description
            </th>
            <th>
               
            </th>
        </tr>


<tr>
<td>Account/Consumer/Customer/Number :</td>
<td><?php echo $data->row(0)->mobile_no; ?> </td>
</tr>

<tr>
<td>TX ID:</td>
<td><?php echo $data->row(0)->recharge_id; ?> </td>
</tr>

<tr>
<td>Operator Id :</td>
<td><?php echo $data->row(0)->operator_id; ?> </td>
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
<td> Date :</td>
<td> <?php echo $data->row(0)->add_date; ?></td>
</tr>

<tr>
<td>Status :</td>
<td> <?php echo $data->row(0)->recharge_status; ?> </td>
</tr>



</div>
    <tr>
<td><input type="button" class="btn btn-primary" onclick="printDiv('printableArea')" value="Print" /></td>
<td></td></tr>
</table>
        </div>
    </div>
</div>

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
    
</body>
</html>