
<!DOCTYPE html>
<html>
<head>

<title>Invoice</title>
 
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
 <div class="table-responsive">
   	
  <table id="table_id" class="table table-striped table-bordered">
                          
                            <thead>
						
                                <tr>
                                  
                                    <th>Operator</th>
                                    <th>Quantity</th>
                                    <th>User ID</th>
                                    <th>Business Name</th>
                                     <th>Balance</th>
                                 
                                </tr>
                            </thead>
                            <tbody>
							<?php 
							
							
							
										$query=mysql_query("SELECT sum(amount),  tblcompany.company_name, tblusers.business_name,tblusers.user_id, recharge_status FROM tblrecharge, tblcompany, tblusers WHERE tblusers.user_id = tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id and recharge_status ='Success' group by tblusers.user_id");
							while($row=mysql_fetch_array($query)){
							$id=$row['company_id'];
							?>
                              
										<tr>
									
                                         <td><?php echo $row['company_name'] ?></td>
                                         <td><?php echo $row['sum(amount)'] ?></td>
                                         <td><?php echo $row['user_id'] ?></td>
                                         <td><?php echo $row['business_name'] ?></td>
                                          <?php
                                          $user = $row['user_id'];
                            $balance1 = mysql_query("SELECT balance FROM `tblewallet` where user_id = '$user' order by Id desc limit 1") or die(mysql_error());
                            while ($balance2 = mysql_fetch_array($balance1)) {
                                ?>
                                         <td><?php echo $balance2['balance']
                                         ?></td>
                                      
                                </tr>
                         
                          <?php }
                            ?>	   
						          <?php } ?>
                            </tbody>
                        </table> 
				
				</div>   
                           
                   
</div>
<script>$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
     
</body>
</html>
