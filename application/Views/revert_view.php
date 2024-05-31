<title>Revert Balance</title>
 
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
</head>

<body>
<br>
<br>
<div class="container">
    <form action="" method="GET">
      
      <div class="col-md-4">
  <div class ="form-group">
      <lable for="amount">Revert Amount</lable>
      <input type="number" class="form-control" id="amount" name="amount">
      </div>
  </div>
  
  <div class="col-md-4">
  <div class ="form-group">
      <lable for="mamount">MINIMUM BALANCE</lable>
      <input type="number" class="form-control" id="mamount" name="mamount">
      </div>
  </div>
  
  <div class="col-md-4">
  <div class ="form-group">
      <lable for="mrecharge">MINIMUM RECHARGE</lable>
      <input type="number" class="form-control" id="mrecharge" name="mrecharge">
      </div>
  </div>
  
  <div class="col-md-6">
  <div class="form-group">
    <label for="from_date">From Date:</label>
    <input type="date" date-format="yyyy/mm/dd" class="form-control" id="from_date" name="from_date">
    </div>
  </div>
  
  <div class="col-md-6">
  <div class="form-group">
    <label for="to_date">To Date:</label>
    <input type="date" date-format="yyyy/mm/dd" class="form-control" id="to_date" name="to_date">
  </div>
  
  </div>
  <button type="submit" name="submit" class="btn btn-default">Submit</button>
</form>
  </div>
<br />
  
<br /> 
   <?php if(isset($_GET['submit']))
   {?>
       <table id="table_id" class="table table-striped table-bordered">
                          
                            <thead>
            
                                <tr>
                                  
                                    <th>Customer Name</th>
                                    <th>User ID</th>
                                   
                             
                                    <th>Total Recharge</th>
                                    
                                     <th>Balance</th>
                                  
                                 
                                </tr>
                            </thead>
                            <tbody>
              <?php 
              $user_id = $_GET[user_id];
              echo '<div class="alert alert-success"><h1>From Date: '.$from_date = $_GET[from_date];
              echo ' To Date: '.$to_date = $_GET[to_date].'</h1></div><br />';
              $notin = "1727,1551,1805,1645,1840,1852,2026,1538,1916,1979,1565,1950,1798,1669,2189,1735,1547,2699,1872,1765,2208,2613,2498,2483,2601,2641,2499,2363,1836,1959,1958,2312,2392";
                    $query=mysql_query("SELECT sum(amount),  tblcompany.company_name, tblusers.business_name,tblusers.user_id, recharge_status FROM tblrecharge, tblcompany, tblusers WHERE tblusers.user_id = tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id and recharge_status ='Success' and recharge_date>='$from_date' and recharge_date<='$to_date' and tblusers.user_id NOT IN ($notin) group by tblusers.user_id")or die(mysql_error());
              while($row=mysql_fetch_array($query)){
              $id=$row['user_id'];
              ?>
                              
                    <tr>
                  
                                         <td><?php echo $row['business_name'] ?></td>
                                          <td><?php echo $row['user_id'] ?></td>
                                         
                                        
                                         <td><?php echo $row['sum(amount)']?></td>
                                          
                                          
                                         
                                          <?php
                            $resultss = mysql_query("SELECT balance FROM `tblewallet` where user_id = '$id' order by Id desc limit 1") or die(mysql_error());
                            while ($rowss = mysql_fetch_array($resultss)) {
                                ?>
                                         <td><?php echo $balance = $rowss['balance']; 
                                        if($balance > $_GET['mamount'] && $row['sum(amount)'] > $_GET['mrecharge'] )
                                        {
                                            
                                             $dr_user_id = $id;
                                            
                                            
                                             $this->load->model('Add_balance_model');
          echo   $amount = $_GET['amount'];
          echo ", REVERTED";
			$payment_type= "cash";
			$remark = "Daily Uses Charge";
			$transaction_type = "PAYMENT";
			$cr_user_id  = $this->Userinfo_methods->getAdminId();
			$description =  $this->Insert_model->getRevertPaymentDescription($cr_user_id, $dr_user_id,$amount);
			$this->Insert_model->tblewallet_Payment_CrDrEntry($cr_user_id,$dr_user_id,$amount,$remark,$description,$payment_type);
                                            
                                            
                                            
                                        }
                                        
                                  
                                        ?></td>
                                       
                                      
                                </tr>
                         
                      <?php } ?>
                       <?php } ?>
                            </tbody>
                        </table> 
        
</div>
<script>$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
<?php }
else{
    
    echo "no data found";
}?>
<table class ="table">
<?php
                            $result = mysql_query("SELECT sum(debit_amount), sum(credit_amount) FROM tblewallet WHERE transaction_type = 'JADY' and user_id !='100'  and DATE(add_date)>='$from_date' and DATE(add_date)<='$to_date'") or die(mysql_error());
                            while ($rows = mysql_fetch_array($result)) {
                                
                               $jady = $rows['sum(debit_amount)'];
                               $credit = $rows['sum(credit_amount)']
                                
                                ?> 
                                
                                <th>Total Reverted <?php echo $jady;?></th>
                                
                                  <?php }?>
                                  </table>
</body>
</html>
