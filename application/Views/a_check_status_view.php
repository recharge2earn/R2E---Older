<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Check Transaction Status</title>
<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                       
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
	.grn{background-color:#C7F3C5;color:#06C;}
	.wht{background-color:#FFF;color:#000;}
	</style>
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
</head>
<body class="twoColFixLtHdr">
<div id="container">
<div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("a_menu.php"); ?> 
  </div>
    <div id="back-border">
  </div>
  <div class="bck">

   <h2><span id="myLabel">All Balance Report for Perticular Mobile Number</span></h2>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>    
    <form method="post" name="frmBalance" action="" style="padding-left:30px;">
    <table>
    <tr>
    <td>Enter Mobile Number:</td>
    <td><input type="text" id="txtTid" name="txtTid" title="Enter Transaction ID"></td>
    </tr>
    <tr>
    <td colspan="2" align="center">
    <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" />
    </td>
    </tr>
    </table>
</form>

<?php if(isset($result_payment)) { ?>
<div id="tblMobileReport">
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader">
    <th scope="col" align="left">TxID</th>   
    <th scope="col" align="left">Company</th>          
    <th scope="col" align="left">Mobile</th>
    <th scope="col" align="left">Amount</th>
    <th scope="col" align="left">BY</th>       
    <th scope="col" align="left">Status</th>
    <th scope="col" align="left">Date Time</th>
    <th scope="col" align="left">Business Partner</th>
    </tr>
     <?php	$total_amount=0;$i = 0;foreach($result_payment->result() as $result) 	{  ?>
			<tr id="<?php echo "Print_".$i ?>" class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><?php echo "<span id='db_company".$i."'>".$result->transaction_id ."</span>"; ?></td> 
 <td><?php echo "<span id='db_mobile".$i."'>".$result->company_name."</span>"; ?></td> 
 <td><?php echo "<span id='db_amount".$i."'>".$result->mobile_no."</span>"; ?></td>
 <td><?php echo "<span id='db_company".$i."'>".$result->amount."</span>"; ?></td> 
 <td><?php echo "<span id='db_mobile".$i."'>".$result->recharge_by."</span>"; ?></td> 
 <td><?php echo "<span id='db_amount".$i."'>".$result->recharge_status."</span>"; ?></td>
 <td><?php echo "<span id='db_date".$i."'>".$result->recharge_date." ".$result->recharge_time."</span>"; ?></td>
  <td><?php echo "<span id='db_amount".$i."'>".$result->business_name."</span>"; ?></td>
 <?php       } ?>
        <tr class="ColHeader">
    <th scope="col" align="left"></th>	
    <th scope="col" align="left"></th>            
    <th scope="col" align="left"></th>
    <th scope="col" align="left"></th>
    <th scope="col" align="left"></th>
     <th scope="col" align="left"></th> 
     <th scope="col" align="left"></th>      
    <th scope="col" align="left"><a href="#" onClick="printContent('tblMobileReport')">PRINT ALL</a></th>
    </tr>
		</table>
        </div>
<?php       } ?>
<div id="PrintData" style="display:none;">
<div style="text-align:left;">
<table style="width:700px">
<tr>
<th scope="col" align="left">Date &amp; Time</th>
<th scope="col" align="left">ID</th>
</tr>
<tr>
<td align="left"><span id="SpanDate"></span></td>
<td align="left"><span id="SpanSSID"></span></td>
</tr>
</table>
<table style="width:700px">
<tr>
<td align="left">VC NO.</td>
<td align="left"><span id="SpanVCNO"></span></td>
</tr>
<tr>
<td align="left">Recharge Amount (Rs.)</td>
<td align="left"><span id="SpanAmount"></span>&nbsp;<span id="SpanCompany"></span></td>
</tr>
<tr>
<td align="left">Status</td>
<td align="left"><span id="SpanStatus"></span></td>
</tr>
<tr>
<td colspan="2">***Have A Nice Day***</td>
</tr>
</table>
</div>
</div>
</div>
<div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
  
</div>

</body>
</html>