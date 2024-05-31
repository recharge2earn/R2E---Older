<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Distributor Report</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>   
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



<script>    
$(document).ready(function(){
$( "#txtFrom,#txtTo" ).datepicker({dateFormat:'yy-mm-dd'});
    setTimeout(function(){$('div.message').fadeOut(1000);}, 5000);
                           });
    </script>
    <script type="text/javascript">
<!--
function printContent(id){
    
                
if (id == 'tblMobileReport')
{
    str=document.getElementById(id).innerHTML;
}
else
{
document.getElementById("TrNo").innerHTML = document.getElementById("db_trno"+id).innerHTML;
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
newwin.document.write("var a=document.getElementsByTagName('a');");
newwin.document.write("for(var i=0;i<a.length;i++){");
newwin.document.write("a[i].innerHTML = '';}");
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
<script language=JavaScript>
function ieClicked() {
    if (document.all) {
        return false;
    }
}
function firefoxClicked(e) {
    if(document.layers||(document.getElementById&&!document.all)) {
        if (e.which==2||e.which==3) {
            return false;
        }
    }
}
if (document.layers){
    document.captureEvents(Event.MOUSEDOWN);
    document.onmousedown=firefoxClicked;
}else{
    document.onmouseup=firefoxClicked;
    document.oncontextmenu=ieClicked;
}
document.oncontextmenu=new Function("return false")
function disableselect(e){
    return false
    }
    function reEnable(){
    return true
    }
    document.onselectstart=new Function ("return true")
    if (window.sidebar){
    document.onmousedown=disableselect
    document.onclick=reEnable
    }
</script>
</head>
<body oncopy="return false" oncut="return false" onpaste="return false" ondragstart="return false;" ondrop="return false; class="twoColFixLtHdr">


<?php require_once("admin_menu.php"); ?> 


<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading">Distributor Recharge Report</div>
      <div class="panel-body">


<form class="form-inline" action="<?php echo base_url()."distributor_transaction_reoprt"; ?>" method="post" name="frmReport" id="frmReport">

<div class="form-group">
    <label for="ddlUserName">Select Distributor: </label>

<select title="Select Distributor Name." name="ddlUserName" id="ddlUserName" class="form-control">
    <option value="0">--Select--</option>
    <?php
        $result_retailer = $this->db->query("select * from tblusers where usertype_name='Distributor' order by business_name");       
        for($i=0; $i<$result_retailer->num_rows(); $i++)
        {
            echo "<option value='".$result_retailer->row($i)->user_id   ."'>".$result_retailer->row($i)->business_name."</option>";
        }
        echo "<option value='ALL'>ALL</option>";
?>
</select>
</div>





 <div class="form-group">
    <label for="email">From Date:</label>
    <input type="text" name="txtFrom" id="txtFrom" readonly class="form-control" title="Select From Date." maxlength="10">
  </div>
  <div class="form-group">
    <label for="pwd">To Date:</label>
    <input type="text" name="txtTo" id="txtTo" class="form-control" readonly title="Select From To." maxlength="10">
  </div>

<input type="submit" name="btnSearch" id="btnSearch" value="Search" class="btn btn-primary" title="Click to search." />

</form>

    <?php
    if ($message != ''){echo "<div class='alert alert-danger'>".$message."</div>"; }
    if(isset($result_rch))
    {
        if($result_rch->num_rows() > 0)
        {
    ?>
    
    <div id="tblMobileReport">

<div class="table-responsive">
<table class="table table-hover">
    <tr>
     <th>Sr No</th>
     <th>Recharge ID</th>    
     <th>Transaction ID</th>
     <th>Recharge Date Time</th>  
      <th>Recharge By</th>           
     <th>Company Name</th>
    <th>Mobile No</th>
    <th>Amount</th>        
     <th>Status</th>        
     <th></th>        
    </tr>
    <?php   $total_amount=0;$i = 0;foreach($result_rch->result() as $result)    {  ?>
            <tr id="<?php echo "Print_".$i ?>" class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
            
 <td><?php echo ($i + 1); ?></td>
 
 <td><?php echo "<span id='db_ssid".$i."'>".$result->recharge_id."</span>"; ?></td> 
 
<td><?php echo "<span id='db_trno".$i."'>".$result->transaction_id."</span>"; ?></td> 

 <td><?php echo "<span id='db_date".$i."'>".$result->recharge_date." ".$result->recharge_time."</span>"; ?></td>
 <td><?php echo "<span id='db_date".$i."'>".$result->username."</span>"; ?></td>
 
 <td><?php echo "<span id='db_company".$i."'>".$result->company_name."</span>"; ?></td> 
 
 <td><?php echo "<span id='db_mobile".$i."'>".$result->mobile_no."</span>"; ?></td> 
 
 <td><?php echo "<span id='db_amount".$i."'>".$result->amount."</span>"; ?></td>
 
  <td>
    <?php if($result->recharge_status == "Pending"){echo "<span id='db_status".$i."' class='orange'>".$result->recharge_status."</span>";} ?>
    
  <?php if($result->recharge_status == "Success"){echo "<span id='db_status".$i."' class='green'>".$result->recharge_status."</span>";} ?>
  <?php if($result->recharge_status == "Failure"){echo "<span id='db_status".$i."' class='red'>".$result->recharge_status."</span>";} ?>
  </td>
  <td><a href="#" class="btn btn-primary" onClick="printContent('<?php echo "".$i ?>')">Print</a></td>
 </tr>
        <?php
        if($result->recharge_status == "Success"){
        $total_amount= $total_amount + $result->amount;}
        $i++;} ?>
         <tr>
    <th></th>
     <th></th>
     <th></th>    
     <th></th>            
    <th></th>
     <th></th>
     <th></th>        
     <th><a href="#" class="btn btn-primary" onClick="printContent('tblMobileReport')">PRINT ALL</a></th>        
     <th></th>            
      <th></th>            
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
<div id="PrintData" style="display:none;">
<div>
<table>
<tr>
<th>Transaction No</th>
<th>Date &amp; Time</th>
<th>ID</th>
</tr>
<tr>
<td><span id="TrNo"></span></td>
<td><span id="SpanDate"></span></td>
<td><span id="SpanSSID"></span></td>
</tr>
</table>
<table class="table table-hover">
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
<td colspan="2">***Have A Nice Day***</td>
</tr>
</table>
</div>
</div>

</div>

</div>
</div>
  


      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
  
</body>
</html>