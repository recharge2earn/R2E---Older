<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>   

  
</head>

<body>
<?php require_once("admin_menu.php"); ?> 


<?php include("admin_model.php"); ?>

<div class="container">
    <div class="row">
                <div class="col-md-3 col-sm-6" >
                    <!-- Pricing Table Item Start -->
                    <div class="pricing-table-item">
                        <div class="pt-head" style="background-color:#3CB371">
                         <div class="pt-plan">Total Success</div>
                           
                            <div class="pt-price-tag"><?php echo 0+$total_success;?></div>
                           
                        </div>
                    </div>
                    <!-- Pricing Table Item End -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <!-- Pricing Table Item Start -->
                    <div class="pricing-table-item">
                        <div class="pt-head" style="background-color:#DC143C">
                          <div class="pt-plan">Total Failure</div>
                        
                            <div class="pt-price-tag"><?php echo 0+$total_failure;?></div>
                          
                        </div>
                    </div>
                    <!-- Pricing Table Item End -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <!-- Pricing Table Item Start -->
                    <div class="pricing-table-item">
                        <div class="pt-head" style="background-color:#FF6347">
                         <div class="pt-plan">Total Pending</div>
                       
                            <div class="pt-price-tag"><?php echo 0+$total_pending;?></div>
                           
                        </div>
                    </div>
                    <!-- Pricing Table Item End -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <!-- Pricing Table Item Start -->
                    <div class="pricing-table-item">
                        <div class="pt-head" style="background-color:#0072B5">
                        <div class="pt-plan">Total purchase by client</div>
                       
                            <div class="pt-price-tag"><?php echo 0+$total_purchase;?></div>
                            
                        </div>
                    </div>
                    <!-- Pricing Table Item End -->
                </div>
            </div>
<br>
<div class="panel panel-primary">
      <div class="panel-heading">Recent Payment Request</div>
      <div class="panel-body">

<div class="table-responsive">
<table class="table table-hover">
    <tr>
   
    <th>Name</th>        
    <th>Mode</th>        
    <th>Amount</th>                
    <th>Bank Ref</th>               
    <th>Remark</th>                     
                            
                      
    </tr>
    <?php
 $this->load->model('List_payment_request_model');
        $result = $this->List_payment_request_model->get_payment_request();
        $result_payment = $this->List_payment_request_model->get_payment_request_limited(0,5);
$i = 0;foreach($result_payment->result() as $result)    {  ?>
                                
    
<tr>

 <td> <?php echo $result->business_name; ?></td> 

  
 <td><?php echo $result->payment_mode; ?></td>
 
  <td><?php echo $result->request_amount; ?></td>
 <td><?php echo $result->cheque_no; ?></td>
  <td><?php echo $result->remarks; ?></td>
  
   
 </tr>
        <?php } ?>
        </table>
     <a href="list_payment_request" type="button" class="btn btn-primary" rol="button">Process Payment</a>

         </div>
    </div>
</div>


<!--<div class="panel panel-primary">
      <div class="panel-heading">Recent Recharges </div>
     <div class="panel-body">
  <?php
  echo '<div class="table-responsive"><table class="table">
  <thead>
          <tr>
    <tr>
    <th>TXID</th>
    <th>Operator</th>
    <th>Number</th>
    <th>Amount</th>
     <th>Status</th>
  <th>Operator Id</th> 
  <th>Recharge By</th>
    <th>Date Time</th>  

    </tr> </thead>
          <tbody>'
    ;
  $str_query_recharge = "select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany where tblcompany.company_id=tblrecharge.company_id  order by tblrecharge.recharge_id desc limit 0, 5";
  $result_recharge = $this->db->query($str_query_recharge);   
  $i = 0;
  foreach($result_recharge->result() as $resultRecharge)  { 
    echo '<tr'; 
    if($i%2 == 0){
      echo "row1"; 
      }
      else{ 
      echo "row2";
      }
    echo '">';
    echo '<td>'.$resultRecharge->recharge_id.'</td>';
        echo '<td>'.$resultRecharge->company_name.'</td>';
    echo '<td>'.$resultRecharge->mobile_no.'</td>';
    echo '<td>'.$resultRecharge->amount.'</td>';
          
    echo '<td>';
    if($resultRecharge->recharge_status == "Pending") { echo '<span style="color:orange;">Pending</span>'; }  
    if($resultRecharge->recharge_status == 'Success') { echo '<span style="color:green;">Success</span>'; }  
    if($resultRecharge->recharge_status == 'Failure') { echo '<span style="color:red;">Failure</span>'; }     
    echo '</td>';
    echo '<td>'.$resultRecharge->operator_id.'</td>';
    echo '<td>'.$resultRecharge->recharge_by.'</td>';
    echo '<td>'.$resultRecharge->recharge_date.'<br/>'.$resultRecharge->recharge_time.'</td>';
     
  echo '</td> ';
  echo '</tr>';   
    $i++;} 
    echo ' </tbody></table></div>'; ?>
  
  </div>
</div>-->



<div class="panel panel-primary">
      <div class="panel-heading">Recent Complain</div>
      <div class="panel-body">

<div class="table-responsive">
<table class="table table-hover">
    <tr>
   
    <th>Complain ID</th>        
    <th>Complain</th>        
    <th>User </th>                
    <th>Date</th>               
    <th>Remark</th>                     
                            
                      
    </tr>
    <?php
 $this->load->model('List_complain_model');
        $result = $this->List_complain_model->get_complain();
        $result_complain = $this->List_complain_model->get_complain_limited(0,5);
$i = 0;foreach($result_complain->result() as $result)    {  ?>
                                
    
<tr>

 <td> <?php echo $result->complain_id; ?></td> 

  
 <td><?php echo $result->message; ?></td>
 
  <td><?php echo $result->business_name; ?></td>
 <td><?php echo $result->complain_date; ?></td>
  <td><?php if($result->complain_status == "Pending"){echo "<span class='btn btn-warning'>".$result->complain_status."</span>";} ?>
  <?php if($result->complain_status == "Solved"){echo "<span class='btn btn-success'>".$result->complain_status."</span>";} ?>
  <?php if($result->complain_status == "Unsolved"){echo "<span class='btn btn-danger'>".$result->complain_status."</span>";} ?></td>
  
   
 </tr>
        <?php } ?>
        </table>
     <a href="list_complain" type="button" class="btn btn-primary" rol="button">Solve Complain</a>

         </div>
    </div>
</div>





</div>

  
 


     
      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
 
</body>
</html>