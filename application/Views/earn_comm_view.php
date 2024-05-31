<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Parent Commission</title>
<?php include("script1.php"); ?>
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

<script>	
$(document).ready(function(){
$( "#txtFrom,#txtTo" ).datepicker({dateFormat:'yy-mm-dd'});
	setTimeout(function(){$('div.message').fadeOut(1000);}, 5000);
						   });
	

	</script>
    <script type="text/javascript">
<!--
function printContent(id){				
//document.getElementById("TrNo").innerHTML = document.getElementById("db_trno"+id).innerHTML;
document.getElementById("SpanDate").innerHTML = document.getElementById("db_date"+id).innerHTML;
document.getElementById("SpanSSID").innerHTML = document.getElementById("db_ssid"+id).innerHTML;
document.getElementById("SpanVCNO").innerHTML = document.getElementById("db_mobile"+id).innerHTML + "["+document.getElementById("db_company"+id).innerHTML+"]";
document.getElementById("SpanAmount").innerHTML = document.getElementById("db_amount"+id).innerHTML;
document.getElementById("SpanStatus").innerHTML = document.getElementById("db_status"+id).innerHTML;


str=document.getElementById("PrintData").innerHTML;
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
<div id="container">
  <div id="header">
 <?php require_once("general_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("agent_menu.php"); ?> 
  </div>
  <div class="bck">
<h2>Earn Recharge Commission Report</h2>
<form action="<?php echo base_url()."earn_comm"; ?>" method="post" name="frmReport" id="frmReport">
From Date :<input type="text" name="txtFrom" readonly id="txtFrom" class="text" title="Select From Date." maxlength="10" /> </td>
To Date :<input type="text" name="txtTo" id="txtTo" class="text" readonly title="Select From To." maxlength="10" />

<input type="submit" name="btnSearch" id="btnSearch" value="Search" class="button" title="Click to search." />
</form>
 
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if(isset($result_all))
	{
		
	?>
    <h2>Search Result</h2>
    <div id="all_transaction">
<table style="width:100%;" id="example" class='dataTable' cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader" style="background: #110303;color: #fff;">
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="40" height="30" >Sr No</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="60" height="30" >ID</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Recharge By</th>
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Recharge Date Time</th>            
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="60" height="30" >Company Name</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="60" height="30" >Mobile No</th>        
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="30" height="30" >Amount</th>
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="30" height="30" >Received Commission</th>   
	    
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="50" height="30" >Status</th>        
     
    </tr>
    <?php	$total_cost=0;$total_amount=0;$total_commission=0;$i = 0;foreach($result_all->result() as $result) 	
	{
	
	  ?>
   
	<tr id="<?php echo "Print_".$i ?>" class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="width:60px;"><?php echo ($i + 1); ?></td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="width:60px;"><?php echo "<span id='db_ssid".$i."'>".$result->recharge_id."</span>"; ?></td> 
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="width:150px;"><?php echo "<span id='db_ssid".$i."'>".$result->recharge_by."</span>"; ?></td> 
<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="width:150px;"><?php echo "<span id='db_date".$i."'>".$result->add_date."</span>"; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="width:150px;"><?php echo "<span id='db_company".$i."'>".$result->company_name."</span>"; ?></td> 
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="width:150px;"><?php echo "<span id='db_mobile".$i."'>".$result->mobile_no."</span>"; ?></td> 
<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="width:150px;"><?php echo "<span id='db_amount".$i."'>".$result->recAmount."</span>"; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="width:150px;"><?php echo "<span id='db_amount".$i."'>".$result->amount."</span>"; ?></td>
 
  
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="width:150px;">
    <?php if($result->recharge_status == "Pending"){echo "<span id='db_status".$i."' class='orange'>".$result->recharge_status."</span>";} ?>
  <?php if($result->recharge_status == "Success"){echo "<span id='db_status".$i."' class='green'>".$result->recharge_status."</span>";} ?>
  <?php if($result->recharge_status == "Failure"){echo "<span id='db_status".$i."' class='red'>".$result->recharge_status."</span>";} ?>
  </td>
  
 </tr>
		<?php
		if($result->recharge_status == "Success")
		{
			$total_amount= $total_amount + $result->recAmount;
			$total_commission=$total_commission+$result->amount;
		}
		$i++;} ?> 
         <tr class="ColHeader">
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" ></th>
	 <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" ></th>
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" ></th>  
      <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" ></th> 
          
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" ></th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" ></th>        
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" ></th>        
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" ></th>        
        <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" ></th>        
    </tr>        
		</table>
        </div>
       <?php
		}
	   else{
		   echo "<div class='message'>Record Not Found.</div>";
		   }
	   
	   ?>
<center>
<a href="#" onClick="printContent('all_transaction')"></a>
</center>
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