
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>DashBoard</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

 <?php include("app_css.php"); ?>
    
    <script language="javascript">
  function complainadd(recahrge_id)
  {
    
    document.getElementById("hidcomplain").value = "Set";
    document.getElementById("recid").value = recahrge_id;
    document.getElementById("frmcomplain").submit();
  }
  </script>
  <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});

function statuschecking(value)
	{
		document.getElementById("divstatus"+value).style.display = "none";
		document.getElementById("divprocess"+value).style.display = "block";
		$.ajax({
			url:'<?php echo base_url()."rec_status/test?id=";?>'+value,
			type:'post',
			cache:false,
			success:function(html)
			{
				if(html == "gtid is wrong.")
				{
					document.getElementById("sts"+value).innerHTML = "Failure";
				}
				else
				{
					document.getElementById("sts"+value).innerHTML = html;
				}
				document.getElementById("divstatus"+value).style.display = "block";
				document.getElementById("divprocess"+value).style.display = "none";
			}
			});
		
	}
	function disputechecking(value)
	{
		document.getElementById("divstatus"+value).style.display = "none";
		document.getElementById("divprocess"+value).style.display = "block";
		$.ajax({
			url:'<?php echo base_url()."dispute/test?id=";?>'+value,
			type:'post',
			cache:false,
			success:function(html)
			{
				if(html == "gtid is wrong.")
				{
					document.getElementById("dsp"+value).innerHTML = "Failure";
				}
				else
				{
					document.getElementById("dsp"+value).innerHTML = html;
				}
				document.getElementById("divstatus"+value).style.display = "block";
				document.getElementById("divprocess"+value).style.display = "none";
			}
			});
		
	}
</script>

</head>

<body"> 
 <?php include("menu.php"); ?>
  
   <div class="container">
<?php
	if($this->session->flashdata('message')){
	echo "<div class='alert alert-success fade in'>".$this->session->flashdata('message')."</div>";}	
	if($message != ''){
	echo "<div class='alert alert-success fade in'>".$message."</div>";}
	?>
	</div>


  <div class="container">

<div class="row">
                <div class="col-md-3 col-sm-6">
                    <!-- Pricing Table Item Start -->
                    <div class="pricing-table-item">
                        <div class="pt-head">
                         <div class="pt-plan">Total Success</div>
                           
                            <div class="pt-price-tag"><?php echo 0+$total_success;?></div>
                           
                        </div>
                    </div>
                    <!-- Pricing Table Item End -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <!-- Pricing Table Item Start -->
                    <div class="pricing-table-item">
                        <div class="pt-head">
                          <div class="pt-plan">Total Failure</div>
                        
                            <div class="pt-price-tag"><?php echo 0+$total_failure;?></div>
                          
                        </div>
                    </div>
                    <!-- Pricing Table Item End -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <!-- Pricing Table Item Start -->
                    <div class="pricing-table-item">
                        <div class="pt-head">
                         <div class="pt-plan">Total Pending</div>
                       
                            <div class="pt-price-tag"><?php echo 0+$total_pending;?></div>
                           
                        </div>
                    </div>
                    <!-- Pricing Table Item End -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <!-- Pricing Table Item Start -->
                    <div class="pricing-table-item">
                        <div class="pt-head">
                        <div class="pt-plan">Wallet Topup</div>
                       
                            <div class="pt-price-tag"><?php echo 0+$total_purchase;?></div>
                            
                        </div>
                    </div>
                    <!-- Pricing Table Item End -->
                </div>
            </div>


 
   
    <br>
    


<div class="row">
                <div class="col-md-3 col-sm-6">
                    <!-- Pricing Table Item Start -->
                    <div class="pricing-table-item">
                        <div class="pt-head">
                         <div class="pt-plan">Opening Balance</div>
                           
                            <div class="pt-price-tag"><?php echo 0+$opening_balance;?></div>
                           
                        </div>
                    </div>
                    <!-- Pricing Table Item End -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <!-- Pricing Table Item Start -->
                    <div class="pricing-table-item">
                        <div class="pt-head">
                          <div class="pt-plan">Recharge Debit</div>
                        
                            <div class="pt-price-tag"><?php 
                            
                             foreach ($get_recharge_credit_debit->result_array() as $value)
	    {
	       $refund =  $value['sum(credit_amount)'];
	     echo  $recharge = $value['sum(debit_amount)']+0;
	    }
                            
                            ?></div>
                          
                        </div>
                    </div>
                    <!-- Pricing Table Item End -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <!-- Pricing Table Item Start -->
                    <div class="pricing-table-item">
                        <div class="pt-head">
                         <div class="pt-plan">Refund Credit</div>
                       
                            <div class="pt-price-tag"><?php echo 0+$refund;?></div>
                           
                        </div>
                    </div>
                    <!-- Pricing Table Item End -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <!-- Pricing Table Item Start -->
                    <div class="pricing-table-item">
                        <div class="pt-head">
                        <div class="pt-plan">Revert</div>
                       
                            <div class="pt-price-tag"><?php 
                            
                             
	    
	     foreach ($billing_credit_debit->result_array() as $value)
	    {
	      echo  $revert = $value['sum(debit_amount)']+0;
            $billing = $value['sum(credit_amount)'];
	    }
                            
                            ?></div>
                            
                        </div>
                    </div>
                    <!-- Pricing Table Item End -->
                </div>
            </div>

    
    
    <br>
    
    
    
 
 <div class="panel panel-default">
  <div class="panel-heading">Todays Operator Report-</div>
  <div class="panel-body">
  
   <table class="table table-hover">
    <thead>
      <tr>
        <th>Company</th>
        <th>Total Success</th>
      
      </tr>
    </thead>
    <?php foreach ($operator_report->result_array() as $row)
		{
		    ?>
	 
      <tr>
        <td><?php  echo $row['company_name'];?></td>
         <td><?php  echo $row['sum(amount)'];?></td>
      </tr>
     
     <?php 	} ?> 
  </table>
  
  
  
  </div>
</div>   





</div>
   
    <?php include("footer.php"); ?>
   
    <div id="backToTop">
        <a href="body" data-animate-scroll="true"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- Back To Top Button End -->
<?php include("app_js.php"); ?>
    
    
        
        
</body>
</html>
