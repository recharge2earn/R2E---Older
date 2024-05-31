<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>All Transaction Report</title>
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
$(function () {
    $("#txtFrom").datepicker({
        minDate: "-6",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        onClose: function (selectedDate, instance) {
            if (selectedDate != '') { //added this to fix the issue
                $("#txtTo").datepicker("option", "minDate", selectedDate);
                var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
                date.setMonth(date.getMonth() + 3);
                console.log(selectedDate, date);
                $("#txtTo").datepicker("option", "minDate", selectedDate);
                $("#txtTo").datepicker("option", "maxDate", date);
            }
        }
    });
    $("#txtTo").datepicker({
        minDate: "dateToday",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        onClose: function (selectedDate) {
            $("#txtFrom").datepicker("option", "maxDate", selectedDate);
        }
    });
});
	</script>

    <script language="javascript">
    function complainadd(recahrge_id)
    {
        
        document.getElementById("hidcomplain").value = "Set";
        document.getElementById("recid").value = recahrge_id;
        document.getElementById("frmcomplain").submit();
    }
    </script>
    <script type="text/javascript">
<!--
function printContent(id){  
if (id == 'all_transaction')
{
    str=document.getElementById(id).innerHTML;
}
else
{           
//document.getElementById("TrNo").innerHTML = document.getElementById("db_trno"+id).innerHTML;
document.getElementById("SpanDate").innerHTML = document.getElementById("db_date"+id).innerHTML;
document.getElementById("SpanSSID").innerHTML = document.getElementById("db_ssid"+id).innerHTML;
document.getElementById("SpanVCNO").innerHTML = document.getElementById("db_mobile"+id).innerHTML + "["+document.getElementById("db_company"+id).innerHTML+"]";
document.getElementById("SpanAmount").innerHTML = document.getElementById("db_amount"+id).innerHTML;
document.getElementById("SpanStatus").innerHTML = document.getElementById("db_status"+id).innerHTML;
str=document.getElementById("PrintData").innerHTML;
}

newwin=window.open('','printwin','left=100,top=100,width=400,height=400');
newwin.document.write('<HTML>\n<HEAD>\n');
newwin.document.write('<TITLE>Print Page</TITLE>\n');
newwin.document.write('<script>\n');
newwin.document.write('function chkstate(){\n');
newwin.document.write('if(document.readyState=="complete"){\n');
newwin.document.write('window.close()\n');
newwin.document.write('}\n');
newwin.document.write('else{\n');
newwin.document.write('setTimeout("chkstate()",2000)\n');
newwin.document.write('}\n');
newwin.document.write('}\n');
newwin.document.write('function print_win(){\n');
newwin.document.write('window.print();\n');
newwin.document.write('chkstate();\n');
newwin.document.write('}\n');
newwin.document.write('<\/script>\n');
newwin.document.write('</HEAD>\n');
newwin.document.write('<BODY onload="print_win()">\n');
newwin.document.write(str);
newwin.document.write('</BODY>\n');
newwin.document.write('</HTML>\n');
newwin.document.close();
}
    
//-->
</script>
</head>
<body oncopy="return false" oncut="return false" onpaste="return false" ondragstart="return false;" ondrop="return false; class="twoColFixLtHdr">

<?php require_once("menu.php"); ?> 


<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading">Transaction Details</div>
      <div class="panel-body">


<form id="frmcomplain" action="complain" name="frmcomplain" method="post">
<input type="hidden" id="recid" name="recid">
<input type="hidden" id="hidcomplain" name="hidcomplain">
</form>
  

<form class="form-inline" action="<?php echo base_url()."child_transactions"; ?>" method="post" name="frmReport" id="frmReport">

<div class="form-group">
<label for="txtFrom">From Date :</label>
<input type="text" name="txtFrom" id="txtFrom" class="form-control" readonly title="Select From Date." maxlength="10" />
</div>

<div class="form-group">
<lable for="txtTo">To Date :</lable>
<input type="text" name="txtTo" id="txtTo" class="form-control" readonly title="Select From To." maxlength="10" />
</div>


<div class="form-group">
<label for="ddlUser">Retailer :</label>

<select name="ddlUser" id="ddlUser" class="form-control" title="Select Agent.">
<?php
    if($this->session->userdata("user_type") == "MasterDealer")
    {
        $str_agent = "select user_id,business_name,username from tblusers where parent_id in (select user_id from tblusers where parent_id = ?)";
    }
    else
    {
        $str_agent = "select user_id,business_name,username from tblusers where parent_id = ?";
    }
    $rslt_user = $this->db->query($str_agent,array($this->session->userdata("id")));
    foreach($rslt_user->result() as $row)
    {
 ?>
<option value="<?php echo $this->Common_methods->encrypt($row->user_id); ?>"><?php echo $row->business_name."  [".$row->username."]"; ?></option>
<? } ?>
</select>
</div>


<input type="submit" name="btnSearch" id="btnSearch" value="Search" class="btn btn-primary" title="Click to search." />

</form>




    <?php
    if ($message != ''){echo "<div class='alert alert-danger'>".$message."</div>"; }
    if(isset($result_all))
    {
        if($result_all->num_rows() > 0)
        {
    ?>

    <h2>Search Result</h2>

  <div class="table-responsive">
<table class="table table-hover">
    <tr>
    <th>Sr No</th>
   <th>Recharge ID</th>
   <th>Recharge By</th>
   <th>Operator Id</th>
    <th>Date Time</th> 
 
   <th>Company Name</th>
    <th>Mobile No</th>
        
   <th>Amount</th>
    <th>Debit Amount</th>        
    <th>Status</th>    
       
            
    </tr>
    <?php   $total_amount=0;$total_commission=0;$i = 0;foreach($result_all->result() as $result)    {  ?>
            <tr id="<?php echo "Print_".$i ?>" class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><?php echo ($i + 1); ?></td>
  <td><?php echo "<span id='db_ssid".$i."'>".$result->recharge_id."</span>"; ?></td> 
  <td><?php echo "<span id='db_ssid".$i."'>".$result->business_name."</span>"; ?></td> 
  <td><?php echo "<span id='db_ssid".$i."'>".$result->operator_id."</span>"; ?></td>
 <td><?php echo "<span id='db_date".$i."'>".$result->recharge_date." ".$result->recharge_time."</span>"; ?></td>
  
 <td><?php echo "<span id='db_company".$i."'>".$result->company_name."</span>"; ?></td> 
 <td><?php echo "<span id='db_mobile".$i."'>".$result->mobile_no."</span>"; ?></td> 

 <td><?php echo "<span id='db_amount".$i."'>".$result->amount."</span>"; ?></td>
    <?php 
    if($result->recharge_status == "Success")
    {
        $total_commission += $result->commission_amount;
        $debit_amount = $result->amount - $result->commission_amount;
    }
    else
    {
        $debit_amount = 0;
    }
    ?>
  <td><?php echo "<span id='db_amount".$i."'>".$debit_amount."</span>"; ?></td>
 
  <td>
    <?php if($result->recharge_status == "Pending"){echo "<span id='db_status".$i."' class='btn btn-warning'>".$result->recharge_status."</span>";} ?>
  <?php if($result->recharge_status == "Success"){echo "<span id='db_status".$i."' class='btn btn-success'>".$result->recharge_status."</span>";} ?>
  <?php if($result->recharge_status == "Failure"){echo "<span id='db_status".$i."' class='btn btn-danger'>".$result->recharge_status."</span>";} ?>
  </td>
 
  
        <?php
        if($result->recharge_status == "Success"){
        $total_amount= $total_amount + $result->amount;}
        $i++;} ?>
        
     
    </tr>        
        </table>
        </div>
        </div>
       <?php
        }
       else{
           echo "<div class='alert alert-danger'>Record Not Found.</div>";
           }
       
       }?>
<center>
</center>
<div id="PrintData" style="display:none;">


<table class="table table-hover">
<tr>
<th>Date &amp; Time</th>
<th>ID</th>
</tr>
<tr>
<td><span id="SpanDate"></span></td>
<td><span id="SpanSSID"></span></td>
</tr>
</table>
<table style="width:700px">
<tr>
<td>VC NO.</td>
<td><span id="SpanVCNO"></span></td>
</tr>
<tr>
<td>Recharge Amount (Rs.)</td>
<td><span id="SpanAmount"></span>&nbsp;<span id="SpanCompany"></span></td>
</tr>
<tr>
<td>Status</td>
<td><span id="SpanStatus"></span></td>
</tr>
<tr>
<td>***Have A Nice Day***</td>
</tr>
</table>
</div>
</div>
</div>
</div>

  
 

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>


  
</body>
</html>