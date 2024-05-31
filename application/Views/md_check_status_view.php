<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Check Transaction Status</title>
<?php include("script1.php"); ?>
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
 <?php require_once("general_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("agent_menu.php"); ?> 
  </div>
    <div id="back-border">
  </div>
  <div class="bck">

   <h2>Check Recharge Status By Recharge ID</h2>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>  
    <div style="padding-top:20px;">  
    <form method="post" name="frmBalance" action="" style="padding-left:30px;">
    <table>
    <tr>
    <td>Enter Recharge ID:<input type="text" id="txtTid" name="txtTid" title="Enter Transaction ID"><input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" /></td>
    </tr>
    <tr>
    <td align="center">
    
    </td>
    </tr>
    </table>
</form>
</div>
<?php if(isset($result_payment)) {
	if($result_payment->num_rows() > 0){ ?>
<h2 class="h2" >View Status</h2>
<div id="tblMobileReport">
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader" style="background: #110303;color:#fff;">
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Recharge ID</th> 
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Date Time</th>  
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Company</th>          
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Mobile</th>
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Amount</th>
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >BY</th>       
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Status</th>    
 	 <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Business Partner</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Operator ID</th>
    </tr>
     <?php	$total_amount=0;$i = 0;foreach($result_payment->result() as $result) 	{  ?>
			<tr id="<?php echo "Print_".$i ?>" class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo "<span id='db_company".$i."'>".$result->recharge_id ."</span>"; ?></td> 
   <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo "<span id='db_date".$i."'>".$result->recharge_date." ".$result->recharge_time."</span>"; ?></td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo "<span id='db_mobile".$i."'>".$result->company_name."</span>"; ?></td> 
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo "<span id='db_amount".$i."'>".$result->mobile_no."</span>"; ?></td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo "<span id='db_company".$i."'>".$result->amount."</span>"; ?></td> 
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo "<span id='db_mobile".$i."'>".$result->recharge_by."</span>"; ?></td> 
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo "<span id='db_amount".$i."'>".$result->recharge_status."</span>"; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo "<span id='db_amount".$i."'>".$result->business_name."</span>"; ?></td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo "<span id='db_amount".$i."'>".$result->operator_id."</span>"; ?></td>

 <?php       } ?>
        
		</table>
        </div>
<?php       }else{ ?>
	<div class='message'>Record Not Found.</div>
<?php }}?>

</div>
<div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
  
</div>

</body>
</html>