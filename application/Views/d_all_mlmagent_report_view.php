<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MLM Agent Report</title>
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
   <?php require_once("general_menu.php"); ?> 
  </div>
  <div class="bck">
<h2>MLM Agent Report</h2>
<form action="<?php echo base_url()."d_all_mlmagent_report"; ?>" method="post" name="frmReport" id="frmReport">
<fieldset>
<legend>Search By</legend>
<table>
<tr>
<td>
MLM Agent Name : 
</td>
<td>
<select title="Select Retailer Name." name="ddlUserName" id="ddlUserName" class="select">
    <option value="0">--Select--</option>
    <?php
		$result_retailer = $this->db->query("select * from tblusers where usertype_name='MLMAgent' and parent_id='".$this->session->userdata('id')."' order by business_name");		
		for($i=0; $i<$result_retailer->num_rows(); $i++)
		{
			echo "<option value='".$result_retailer->row($i)->user_id	."'>".$result_retailer->row($i)->business_name."</option>";
		}
		echo "<option value='ALL'>ALL</option>";
?>
</select>
</td>
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
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader" style="background: #110303;color: #fff;">
    <th scope="col" align="left">Sr No</th>
	<th scope="col" align="left">ID</th>        
    <th scope="col" align="left">Recharge Date Time</th>            
    <th scope="col" align="left">Company Name</th>
    <th scope="col" align="left">Mobile No</th>
    <th scope="col" align="left">Amount</th>        
    <th scope="col" align="left">Status</th>        
    <th scope="col" align="left"></th>        
    </tr>
    <?php	$total_amount=0;$i = 0;foreach($result_rch->result() as $result) 	{  ?>
			<tr id="<?php echo "Print_".$i ?>" class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><?php echo ($i + 1); ?></td>
  <td><?php echo "<span id='db_ssid".$i."'>".$result->recharge_id."</span>"; ?></td> 
 <td><?php echo "<span id='db_date".$i."'>".$result->recharge_date." ".$result->recharge_time."</span>"; ?></td>
 <td><?php echo "<span id='db_company".$i."'>".$result->company_name."</span>"; ?></td> 
 <td><?php echo "<span id='db_mobile".$i."'>".$result->mobile_no."</span>"; ?></td> 
 <td><?php echo "<span id='db_amount".$i."'>".$result->amount."</span>"; ?></td>
  <td>
    <?php if($result->recharge_status == "Pending"){echo "<span id='db_status".$i."' class='orange'>".$result->recharge_status."</span>";} ?>
  <?php if($result->recharge_status == "Success"){echo "<span id='db_status".$i."' class='green'>".$result->recharge_status."</span>";} ?>
  <?php if($result->recharge_status == "Failure"){echo "<span id='db_status".$i."' class='red'>".$result->recharge_status."</span>";} ?>
  </td>
   <td><a href="#" onClick="printContent('<?php echo "".$i ?>')">Print</a></td>
 </tr>
		<?php
		$total_amount= $total_amount + $result->amount;
		$i++;} ?>
         <tr class="ColHeader" style="background: #110303;color: #fff;">
    <th scope="col" align="left"></th>
	<th scope="col" align="left"></th>    
    <th scope="col" align="left"></th>            
    <th scope="col" align="left"></th>
    <th scope="col" align="left"></th>
    <th scope="col" align="left"><?php echo $total_amount; ?></th>        
    <th scope="col" align="left"><a href="#" onClick="printContent('tblMobileReport')">PRINT ALL</a></th>        
	<th scope="col" align="left"></th>            
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
     <?php require_once("general_footer.php"); ?>
  <!-- end #footer --></div>

</div>
  
</body>
</html>