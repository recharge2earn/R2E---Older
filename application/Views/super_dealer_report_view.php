<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super Dealer Report</title>
<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                       
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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

</head>
<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("a_menu.php"); ?> 
  </div>  
  <div class="bck">
<h2>Super Dealer Report</h2>
<form action="<?php echo base_url()."master_dealer_report"; ?>" method="post" name="frmReport" id="frmReport">
<fieldset>
<legend>Search By</legend>
<table>
<tr>
<td>
Super Dealer Name : 
</td>
<td>
<select title="Select Master Dealer Name." name="ddlUserName" id="ddlUserName" class="select">
    <option value="0">--Select--</option>
    <?php		
		$result_dealer = $this->db->query("select * from tblusers where usertype_name='SuperDealer' order by business_name");		
		for($i=0; $i<$result_dealer->num_rows(); $i++)
		{
			echo "<option value='".$result_dealer->row($i)->user_id	."'>".$result_dealer->row($i)->business_name."</option>";
		}		
?>
</select>
</td>
<!--<td align="right">Service : </td>
<td>
<select id="ddlService" name="ddlService" class="select" title="Select Service Name.">
<option>--Select--</option>
<?php /*?><?php
		echo "<option value='ALL'>ALL</option>";
		echo $this->common_value->getServiceName();
?><?php */?>
</select>
</td>-->
</tr>
<tr>
<td align="right">From Date : </td>
<td align="left"><input type="text" name="txtFrom" id="txtFrom" class="text" title="Select From Date." maxlength="10" /> </td>
<td>To Date : </td>
<td align="left"><input type="text" name="txtTo" id="txtTo" class="text" title="Select From To." maxlength="10" /></td>
<td align="left"><input type="submit" name="btnSearch" id="btnSearch" value="Search" class="button" title="Click to search." /></td>
</tr>
</table>
</fieldset>
</form>
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if(isset($result_rch))
	{
		if($result_rch->num_rows() > 0)
		{
	?>
    <div id="tblMobileReport">
<table style="width:100%;" cellpadding="3" cellspacing="0" border="1">
    <tr class="ColHeader" style="background: #110303;color: #fff;">
   <th scope="col" align="left">ID</th>        
    <th scope="col" align="left">Date Time</th>
    <th scope="col" align="left">Company</th>    
    <th scope="col" align="left">Type</th> 
    <th scope="col" align="left">Mobile</th>      
    <th scope="col" align="left">Amount</th>
    <th scope="col" align="left">Commission Amount</th>
    <th scope="col" align="left">Old Balance</th>
    <th scope="col" align="left">New Balance</th>
    <th scope="col" align="left">Status</th>     
        
    </tr>
  <?php $balance_amount=$closing_balance;	$i = 0;foreach($result_rch->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><?php echo $result->SS_JV_ID; ?></td>            
 <td><?php echo $result->DATE_TIME; ?></td>
 <td><?php echo $result->PAYMENT_TO; ?></td>
 <td><?php echo $result->TYPE_NAME; ?></td>  
 <td><?php echo $result->REMARK; ?></td>  
 <td><?php echo $result->DR_AMOUNT; ?></td>
  <td><?php echo $result->CR_AMOUNT; ?></td>
  <td><?php if($i==0){echo $closing_balance;}else{echo $balance_amount;} ?></td>
   <td>   
   <?php
   if($result->STATUS == 'Failure'){ echo $balance_amount;} 
   else{
   $balance_amount =  ($balance_amount +  $result->CR_AMOUNT - $result->DR_AMOUNT);
  echo $balance_amount;
   }
  ?></td>     
  <td><?php if($result->STATUS == 'Success'){echo "<span class='green'>SUCCESS</span>";}
  if($result->STATUS == 'Failure'){echo "<span class='red'>FAILURE</span>";echo "<br /><span>Credit : failed transaction for <br/>Rs. ".$result->DR_AMOUNT." [".$result->REMARK."] <br/>(Revert back transaction)  </span>";}
  if($result->STATUS == 'Pending'){echo "<span class='orange'>PENDING</span>";}  
  ?></td>  
 </tr>
		<?php 	
		$i++;} ?>     
         <tr class="ColHeader" style="background: #110303;color: #fff;">
    <th scope="col" align="left"></th>	
    <th scope="col" align="left"></th>            
    <th scope="col" align="left"></th>
    <th scope="col" align="left"></th>
    <th scope="col" align="left"></th>	
    <th scope="col" align="left"></th>            
    <th scope="col" align="left"></th>
    <th scope="col" align="left"></th>
    <th scope="col" align="left"></th>        
    <th scope="col" align="left"> <a href="#" onClick="printContent('tblMobileReport')">PRINT</a> </th>        
	          
    </tr>        
		</table>
        </div>
       <?php
		}
	   else{
		   echo "<div class='message'>Record Not Found.</div>";
		   }
	   
	   }?>
<div id="PrintData" style="display:none;">
<div style="text-align:left;">
<table style="width:700px">
<tr>
<th scope="col" align="left">Transaction No</th>
<th scope="col" align="left">Date &amp; Time</th>
<th scope="col" align="left">ID</th>
</tr>
<tr>
<td align="left"><span id="TrNo"></span></td>
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

<div id="footer">
     <?php require_once("general_footer.php"); ?>
  <!-- end #footer --></div>
 </div>

</div>

</body>
</html>