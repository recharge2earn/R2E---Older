<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>API Report</title>
<?php include("script1.php");?>
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
  <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("admin_menu1.php"); ?> 
  </div>

<div id="container">
  <div>
<h2 class="h2">API Report</h2>
<form action="<?php echo base_url()."api_report"; ?>" method="post" name="frmReport" id="frmReport">
<fieldset>
<legend>Search By</legend>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;API : </td>

<select id="ddlAPI" name="ddlAPI" class="select" title="Select API Name.">
<option>--Select--</option>
<?php
	$rslt = $this->db->query("select * from tblapi");
 foreach($rslt->result() as $row)
 {
	echo '<option value="'.$row->api_name.'">'.$row->api_name.'</option>'; 
 }
?>
</select><br>
From Date :<input type="text" name="txtFrom" id="txtFrom" class="text" title="Select From Date." maxlength="10" /> To Date : <input type="text" name="txtTo" id="txtTo" class="text" title="Select From To." maxlength="10" /><input type="submit" name="btnSearch" id="btnSearch" value="Search" class="button" title="Click to search." />
</fieldset>
<hr style="width:100%;">
</form>
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if(isset($result_api))
	{
		if($result_api->num_rows() > 0)
		{
	?>
    <h2 class="h2">Search Result</h2>
    <div id="tblMobileReport">
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr style="background: #110303;color: #fff;" class='colHeader'>
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="30" height="30" >Sr No</th>
	 <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="50" height="30" >Recharge ID</th>    
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Recharge Date Time</th>            
  	 <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="60" height="30" >Agent Id </th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="30" height="30" >By</th>
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Execute</th>    
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Company</th>
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="80" height="30" >Mobile No</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="30" height="30" >Amount</th> 
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Operator Id</th>        
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="60" height="30" >Status</th>        
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="60" height="30" ></th>        
    </tr>
    <?php	$total_amount=0;$i = 0;foreach($result_api->result() as $result) 	{  ?>
			<tr id="<?php echo "Print_".$i ?>" class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:30px;width:30px;"><?php echo ($i + 1); ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:50px;width:50px;"><?php echo "<span id='db_ssid".$i."'>".$result->recharge_id."</span>"; ?></td> 
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo "<span id='db_date".$i."'>".$result->recharge_date." ".$result->recharge_time."</span>"; ?></td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:60px;width:60px;"><?php echo $result->username; ?></td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:30px;width:30px;"><?php echo $result->recharge_by; ?></td>
   <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo $result->ExecuteBy; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo "<span id='db_company".$i."'>".$result->company_name."</span>"; ?></td> 
<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:80px;width:80px;"><?php echo "<span id='db_mobile".$i."'>".$result->mobile_no."</span>"; ?></td> 
<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:30px;width:30px;"><?php echo "<span id='db_amount".$i."'>".$result->amount."</span>"; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:60px;width:60px;"><?php echo "<span id='db_amount".$i."'>".$result->operator_id."</span>"; ?></td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:60px;width:60px;">
    <?php if($result->recharge_status == "Pending"){echo "<span id='db_status".$i."' class='orange'>".$result->recharge_status."</span>";} ?>
  <?php if($result->recharge_status == "Success"){echo "<span id='db_status".$i."' class='green'>".$result->recharge_status."</span>";} ?>
  <?php if($result->recharge_status == "Failure"){echo "<span id='db_status".$i."' class='red'>".$result->recharge_status."</span>";} ?>
  </td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:60px;width:60px;"><a href="#" onClick="printContent('<?php echo "".$i ?>')">Print</a></td>
 </tr>
		<?php
		if($result->recharge_status == "Success"){
		$total_amount= $total_amount + $result->amount;}
		$i++;} ?>
         <tr style="background: #110303;color: #fff;" class='colHeader'>
    <th scope="col" align="left"></th>
	<th scope="col" align="left"></th>    
	<th scope="col" align="left"></th>        
    <th scope="col" align="left"></th>            
    <th scope="col" align="left"></th>
    <th scope="col" align="left"></th>    
    <th scope="col" align="left"></th>    
    <th scope="col" align="left">Successfull Transaction : </th>
    <th scope="col" align="left"><?php echo $total_amount; ?></th>        
    <th scope="col" align="left"> <a href="#" onClick="printContent('tblMobileReport')">PRINT</a> </th>        
	<th scope="col" align="left"></th> 
    <th scope="col" align="left"></th>            
    </tr>        
		</table>
        <?php  echo $pagination; ?>       
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
<th scope="col" align="left">GT ID</th>
</tr>
<tr>
<td align="left"><span id="SpanDate"></span></td>
<td align="left"><span id="SpanSSID"></span></td>
</tr>
</table>
<table style="width:700px">
<tr>
<td align="left">Recharge No</td>
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
</div>
<div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
  
</body>
</html>