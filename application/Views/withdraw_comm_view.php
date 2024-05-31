<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Withdraw Commission</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>   
<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
    <script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
    <script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
    <script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
    <script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                       
  
<script>    
$(document).ready(function(){
$( "#txtFrom,#txtTo" ).datepicker({dateFormat:'yy-mm-dd'});
    setTimeout(function(){$('div.message').fadeOut(1000);}, 5000);
                           });
    </script>
<script language="javascript">
    function ActionSubmit(value,user_id,comm,commtype,fromdate,todate)
    {
        alert(user_id+" "+comm);
        if(document.getElementById('ddlaction'+value).selectedIndex != 0)
        {
            var isstatus;
            if(document.getElementById('ddlaction'+value).value == "Success")
            {isstatus = 'Success';}else{isstatus='Failure';}
            
            if(confirm('Are you sure?\n you want to Payment Commissin to - ['+user_id+']')){
                document.getElementById('hidstatus').value= document.getElementById('ddlaction'+value).value;
                document.getElementById('hiduser_id').value= user_id;       
                document.getElementById('hidtype').value= commtype; 
                document.getElementById('hidamount').value= comm;   
                document.getElementById('hidfrom').value= fromdate;
                document.getElementById('hidto').value= todate;         
                document.getElementById('frmCallAction').submit();
                }
        }
    
    }
    </script>
</head>
<body>

<?php require_once("menu.php"); ?> 


<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading">Withdraw Commission</div>
      <div class="panel-body">

<form class="form-inline" action="<?php echo base_url()."withdraw_comm" ?>" method="post" name="frmSearch" id="frmSearch">
    
<div class="form-group">
<label for="txtFrom" >From Date :</label>
<input type="form-control" name="txtFrom" id="txtFrom" class="form-control" title="Select Date." maxlength="10" />
</div>

<div class="form-group">
<label for="txtTo">To Date : </label>

<input type="text" name="txtTo" id="txtTo" class="form-control" title="Select Date." maxlength="10" /> 
</div>

<input type="submit" name="btnSearch" id="btnSearch" value="Search" class="btn  btn-primary" title="Click to search." />

<br />
 </form>
<form action="<?php echo base_url()."withdraw_comm" ?>" method="post" name="frmCallAction" id="frmCallAction">
<input type="hidden" id="hidstatus" name="hidstatus" />
<input type="hidden" id="hidtype" name="hidtype" />
<input type="hidden" id="hiduser_id" name="hiduser_id" />
<input type="hidden" id="hidamount" name="hidamount" />
<input type="hidden" id="hidfrom" name="hidfrom" />
<input type="hidden" id="hidto" name="hidto" />
<input type="hidden" id="hidaction" name="hidaction" value="Set" />
 </form>
   


    <?php
    if ($message != ''){echo "<div class='alert alert-danger'>".$message."</div>"; }
    ?>    
    

<?php if(isset($result_comm)) { ?>

<div class="table-responsive">
<table class="table table-hover">

    <tr>
    <th>Sr No</th>
   <th>User Code</th>
   <th>Business Name</th>
    <th>Mobile No</th>
     <th>Email Id</th>
     <th>Comm Type</th>
    <th>Comm Amount</th>
   
 
   <th>From Date</th>
   <th>To Date</th>
   <th>Action</th>            
    </tr>
    <?php $i=0; foreach($result_comm->result() as $result)  {  ?>
    <tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
    <td><?php echo $i+1; ?></td>  
 <td><?php echo $result->username; ?></td>
 <td><?php echo $result->business_name; ?></td>
 <td><?php echo $result->mobile_no; ?></td>
 <td width="120"><?php echo $result->emailid; ?></td>
 <td><?php echo $result->commission_type; ?></td>
 <td><?php echo $result->totalComm; ?></td>

 <td><?php echo $fromdate; ?></td>
 <td><?php echo $todate; ?></td>
 <td width="120">
 <select class="form-control" id="ddlaction<?php echo $i+1; ?>" name="ddlaction" onChange="ActionSubmit('<?php echo $i+1; ?>','<?php echo $result->username;  ?>','<?php echo $result->totalComm; ?>','<?php echo $result->commission_type; ?>','<?php echo $fromdate; ?>','<?php echo $todate; ?>')">
 <option>Select</option>
 <option>Success</option>
 </select>
 </td>
 
  
 </tr>
        <?php   
        $i++;} ?>
        </table>
<?php       } ?>



  
   </div>
    </div>
</div>
</div>
      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>

</body>
</html>