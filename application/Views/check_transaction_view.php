<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Check Recharge Transaction</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>   
 
<script>  
$(document).ready(function(){
$( "#txtFromDate,#txtToDate " ).datepicker({dateFormat:'yy-mm-dd'});
  setTimeout(function(){$('div.message').fadeOut(1000);}, 5000);
               });
  

  
  function statuschecking(value)
  {
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
      }
      });
    
  }
    function doSearch() {
        var searchText = document.getElementById('txtsearchbox').value;
        var targetTable = document.getElementById('example');
        var targetTableColCount;

        //Loop through table rows
        for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
          var rowData = '';

          //Get column count from header row
          if (rowIndex == 0) {
            targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
            continue; //do not execute further code for header row.
          }

          //Process data rows. (rowIndex >= 1)
          for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
            var cellText = '';

            if (navigator.appName == 'Microsoft Internet Explorer')
              cellText = targetTable.rows.item(rowIndex).cells.item(colIndex).innerText;
            else
              cellText = targetTable.rows.item(rowIndex).cells.item(colIndex).textContent;

            rowData += cellText;
          }

          // Make search case insensitive.
          rowData = rowData.toLowerCase();
          searchText = searchText.toLowerCase();

          //If search term is not found in row data
          //then hide the row, else show
          if (rowData.indexOf(searchText) == -1)
            targetTable.rows.item(rowIndex).style.display = 'none';
          else
            targetTable.rows.item(rowIndex).style.display = 'table-row';
        }
      }
  </script>
   
 <script type="text/javascript">
    
  function ActionSubmit(value,name)
  {
    alert("here");
  
    if(document.getElementById('action_'+value).selectedIndex != 0)
    {
      
      var isstatus;
      if(document.getElementById('action_'+value).value == "Success")
      {isstatus = 'Success';}
      else if(document.getElementById('action_'+value).value == "Failure")
      {isstatus='Failure';}
      else if(document.getElementById('action_'+value).value == "Pending")
      {isstatus='Pending';}
      
      if(confirm('Are you sure?\n you want to '+isstatus+' rechrge for - ['+name+']')){
        document.getElementById('hidstatus').value= document.getElementById('action_'+value).value;
        document.getElementById('hidrechargeid').value= value;        
        document.getElementById('frmCallAction').submit();
        }
    }
  }
  function AccountActionSubmit(value,amount,Id)
  {
    alert(document.getElementById('accountaction_'+Id).selectedIndex);
    if(document.getElementById('accountaction_'+Id).selectedIndex != 0)
    {
      alert("inside");
      if(document.getElementById('accountaction_'+Id).value == "Refund")
      {
        if(confirm('Are you sure?\n you want to Refund Amount Of - ['+name+']')){
        document.getElementById('hidrecId').value= value;
        document.getElementById('hidewid').value= Id;
        document.getElementById('hidrefset').value= "Set";          
        document.getElementById('frmRefund').submit();
        }
      }
    }
  }
  
</script>
</head>

<body>
<?php require_once("admin_menu.php"); ?> 


<div class="container">


<div class="panel panel-default">
  <div class="panel-heading">Search Transaction by Recharge ID</div>
  <div class="panel-body">

<form id="frmflag" name="frmflag" method="post">
<input type="hidden" id="hidflag" name="hidflag">
<input type="hidden" id="hidvalue" name="hidvalue">
</form>

<form id="frmRefund" name="frmRefund" method="post">
<input type="hidden" id="hidrecId" name="hidrecId">
<input type="hidden" id="hidewid" name="hidewid">
<input type="hidden" id="hidrefset" name="hidrefset">
</form>
  
  <input type="hidden" id="renderflag" value="true"/>
  


    <form class="form-inline" action="<?php echo base_url()."check_transaction" ?>" method="post" name="frmSearch" id="frmSearch">
     <div class="form-group">
     <label for="txtRecId">Recharge ID:</label>
  <input type="text" title="Recharge Id." class="form-control" name="txtRecId" id="txtRecId" >
</div>

<input type="submit" class="btn btn-default" value="Search" name="btnSearch" id="btnSearch" >     



 </form>

<br />

 
<form id="checkStatus" name="checkStatus" method="post" action="<?php echo base_url()."list_recharge"?>" >
<input type="hidden" id="hidid" name="hidid" />
<input type="hidden" id="hidstatuscheck" name="hidstatuscheck"/>
</form>
 <form action="<?php echo base_url()."list_recharge" ?>" method="post" name="frmCallAction" id="frmCallAction">
<input type="hidden" id="hidstatus" name="hidstatus" />
<input type="hidden" id="hidrechargeid" name="hidrechargeid" />
<input type="hidden" id="hidaction" name="hidaction" value="Set" />
 </form>
    <?php
  if ($message != ''){echo "<div id='msg' class='alert alert-danger'><span id='msgspan'>".$message."</span></div>"; }
  if($this->session->flashdata('message')){
  echo "<div id='msg' class='alert alert-danger'><span id='msgspan'>".$this->session->flashdata('message')."</span></div>";}
  if(isset($result_recharge)){  
  ?>  
     <div class="table-responsive"> 
    
<table class="table table-hover">
    <tr>  
    <th>Sr No</th>
    <th>Recharge Id</th>
     <th>Operator Id</th>  
     <th>Transaction Id</th>
     <th>Name</th>
     <th>Company Name</th>
   <th>Mobile No</th>    
   <th>Amount</th>    
     <th>API</th>    
   <th>Recharge By</th>
     <th>Status</th> 
     <th>Action</th>                   
    </tr>
    <?php $totalRecharge = 0; $i = count($result_recharge->result());foreach($result_recharge->result() as $result)   {  ?>
      <tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
            <td><?php echo $i; ?></td>
 <td><a class="btn btn-info" href="<?php echo base_url()."recharge_detail/index/".$this->Common_methods->encrypt($result->recharge_id); ?>" target="_blank"><?php echo $result->recharge_id; ?></a></td>
  <td><?php echo $result->operator_id; ?></td>
 <td><?php echo $result->transaction_id; ?></td>
 <td><a class="btn btn-info" href="<?php echo base_url()."profile/view/".$this->Common_methods->encrypt("Agent")."/".$this->Common_methods->encrypt($result->user_id);?>" target="_blank"><?php echo $result->business_name; ?></a></td>

 <td><?php echo $result->company_name; ?></td>
 <td><?php echo $result->mobile_no; ?></td>
 <td><?php echo $result->amount; ?></td>
 <td><?php echo $result->ExecuteBy; ?></td>
 <td><?php echo $result->recharge_by; ?></td>
 <td>
 <?php if($result->recharge_status == 'Pending'){echo "<span class='btn btn-warning'><a id='sts".$result->recharge_id."' href='javascript:statuschecking(".$result->recharge_id.")' >Pending</a></span>";}
 if($result->recharge_status == 'Success'){$totalRecharge += $result->amount;echo "<span class='btn btn-success' ><a id='sts".$result->recharge_id."' href='javascript:statuschecking(".$result->recharge_id.")' >Success</a></span>";}
 if($result->recharge_status == 'Failure'){echo "<span class='btn btn-danger'>
 <a id='sts".$result->recharge_id."' href='javascript:statuschecking(".$result->recharge_id.")' >Failure</a></span>";}
 
 ?></td>
  <td>
  
 <select class="form-control" id="action_<?php echo $result->recharge_id; ?>" onChange="ActionSubmit('<?php echo $result->recharge_id; ?>','<?php echo $result->mobile_no; ?>')">
 <option value="Select">Select</option>
 <option value="Pending">Pending</option>
 <option value="Success">Success</option>
 <option value="Failure">Failure</option>
 </select>

 </td>
 </tr>
    <?php   
    $i--;} ?>
        <tr>  
        <th></th>  
    <th></th>  
     <th> </th>
      <th> </th>
     <th> </th>
     <th> </th>
   <th>Total Succesful Recharge </th>    
   <th><?php echo $totalRecharge; ?></th>    
     <th></th>    
   <th> </th>
     <th></th>                   
     <th></th>                   
    </tr>
    </table> 
         <?php  echo $pagination; ?>        
       <?php } ?>


<hr>

       
       <?php if(isset($result_account)){ ?>
       <table class="table table-hover">
        <b> Account Report</b>
      <tr>  
    <th>Payment Date</th>
     <th>Business Name</th>
       <th>recharge_id</th>
        <th>Transaction Type</th>
        
         <th>Description</th>
          <th>Credit Amount</th>
           <th>Debit Amount</th>
            <th>Balance</th>
             <th>Action</th>
       </tr>
       <?php foreach($result_account->result() as $rw){ ?>
        <tr>
        <td><?php echo $rw->add_date; ?></td>
        <td><?php echo $rw->bname; ?></td>
        <td><?php echo $rw->recharge_id; ?></td>
        <td><?php echo $rw->transaction_type; ?></td>
        <td><?php echo $rw->description; ?></td>
        <td><?php echo $rw->credit_amount; ?></td>
       <td><?php echo $rw->debit_amount; ?></td>
        <td><?php echo $rw->balance; ?></td>
       <td>

 <select class="form-control" id="accountaction_<?php echo $rw->Id; ?>" onChange="AccountActionSubmit('<?php echo $rw->recharge_id; ?>','<?php echo $rw->debit_amount; ?>','<?php echo $rw->Id; ?>')">
 <option value="Select">Select</option>
 <option value="Refund">Refund</option>
 </select>
 </td>
        </tr>
       <?php } ?>
       </table> 
       <?php } ?>
</div>
</div>
</div>
</div>




  

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
 

</body>
</html>