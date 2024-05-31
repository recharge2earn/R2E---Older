<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ApiUser Transactions</title>
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

     <style>
	  .ui-datepicker
	 {
	 width:200px;
	 font-size:14px;
	 }
	 .odd { 
        background-color: #FCF7F7;
      }
    .even {
        background-color: #E3DCDB;
    }
	
	 </style>
    
    <script src="<?php echo base_url()."js/jquery.dataTables.min.js"; ?>"></script> 
    <link href="<?php echo base_url()."jquery.dataTables.css"; ?>" rel="stylesheet" type="text/css" />    
   
   
</head>
<body class="twoColFixLtHdr">
<div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
<div id="container">
     <?php require_once("admin_menu1.php"); ?>   
  <div>
  <div class="row-fluid">
		<div class="span12">
			<div class="span6">
				<span style="color:#023a99;"><h2>ApiUser Transaction Report</h2></span>
			</div>
		</div>
	</div>                 
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
    <div class="breadcrumb">
<form action="<?php echo base_url()."apiuser_transaction_reoprt"; ?>" method="post" name="frmReport" id="frmReport">

ApiUser Name : 

<select title="Select Distributor Name." name="ddlUserName" id="ddlUserName" class="select">
    <option value="0">--Select--</option>
    <?php
		$result_retailer = $this->db->query("select * from tblusers where usertype_name='APIUSER' order by business_name");		
		for($i=0; $i<$result_retailer->num_rows(); $i++)
		{
			echo "<option value='".$result_retailer->row($i)->user_id	."'>".$result_retailer->row($i)->business_name."</option>";
		}
?>
</select>

<select id="ddlService" name="ddlService" class="select" title="Select Service">
<option>--Select--</option>
<?php
		echo $this->common_value->getServiceName();
		echo "<option value='ALL'>ALL</option>";		
?>
</select><br>
From Date :<input type="text" name="txtFrom" id="txtFrom" class="text" title="Select From Date." maxlength="10" />To Date : <input type="text" name="txtTo" id="txtTo" class="text" title="Select From To." maxlength="10" /><input type="submit" name="btnSearch" id="btnSearch" value="Search" class="button" title="Click to search." />
</fieldset>
</form>


    
</div>


<div class="row-fluid">
		<div class="span12">
			<div class="span6">
				<span style="color:#023a99;"><h2>ApiUser Transactions</h2></span>
			</div>
		</div>
	</div>

 <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if(isset($result_rch))
	{
		if($result_rch->num_rows() > 0)
		{
	?>
    <div id="tblMobileReport">
<table style="width:100%;font-size:14px;" cellpadding="3" cellspacing="0" border="0">
    <tr style="background: #CCCCCC;">
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="64">Sr No</th>
	 <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="64">Recharge ID</th>    
	 <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="64">Transaction ID</th>
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="64">Recharge Date Time</th>            
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="64">Recharge By</th>            
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="64">Company Name</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="64">Mobile No</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="64">Amount</th>        
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="64">Status</th>        
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="64"></th>        
    </tr>
    <?php	$total_amount=0;$i = 0;foreach($result_rch->result() as $result) 	{  ?>
			<tr id="<?php echo "Print_".$i ?>" class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34"><?php echo ($i + 1); ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34"><?php echo "<span id='db_ssid".$i."'>".$result->recharge_id."</span>"; ?></td> 
<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34"><?php echo "<span id='db_trno".$i."'>".$result->transaction_id."</span>"; ?></td> 
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34"><?php echo "<span id='db_date".$i."'>".$result->recharge_date." ".$result->recharge_time."</span>"; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34"><?php echo "<span id='db_date".$i."'>".$result->username."</span>"; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34"><?php echo "<span id='db_company".$i."'>".$result->company_name."</span>"; ?></td> 
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34"><?php echo "<span id='db_mobile".$i."'>".$result->mobile_no."</span>"; ?></td> 
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34"><?php echo "<span id='db_amount".$i."'>".$result->amount."</span>"; ?></td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34">
    <?php if($result->recharge_status == "Pending"){echo "<span id='db_status".$i."' class='orange'>".$result->recharge_status."</span>";} ?>
  <?php if($result->recharge_status == "Success"){echo "<span id='db_status".$i."' class='green'>".$result->recharge_status."</span>";} ?>
  <?php if($result->recharge_status == "Failure"){echo "<span id='db_status".$i."' class='red'>".$result->recharge_status."</span>";} ?>
  </td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34"><a href="#" onClick="printContent('<?php echo "".$i ?>')">Print</a></td>
 </tr>
		<?php
		if($result->recharge_status == "Success"){
		$total_amount= $total_amount + $result->amount;}
		$i++;} ?>
         <tr class="ColHeader">
    <th scope="col" align="left"></th>
	<th scope="col" align="left"></th>
	<th scope="col" align="left"></th>   
    <th scope="col" align="left"></th>   
    <th scope="col" align="left"></th>            
    <th scope="col" align="left"></th>
    <th scope="col" align="left">Successfull Transaction Amount :</th>
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

    
	<!-- end #mainContent --></div>
    
    <a href="#" onClick="scrolltotop()">top</a>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>
