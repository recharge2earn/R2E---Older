<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MasterDealer Balance Report</title>
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
 <?php require_once("general_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("general_menu.php"); ?> 
  </div> 
  <div class="bck">
<h2>Distributor Balance Report</h2>
<form action="<?php echo base_url()."d_mdealer_balance_report"; ?>" method="post" name="frmReport" id="frmReport">
<fieldset>
<legend>Search By</legend>
<table>
<tr>
<td>
MasterDealer Name : 
</td>
<td>
<select title="Select MasterDealer Name." name="ddlUserName" id="ddlUserName" class="select">
    <option value="0">--Select--</option>
    <?php
		$result_retailer = $this->db->query("select * from tblusers where usertype_name='MasterDealer' and parent_id='".$this->session->userdata('id')."' order by business_name");		
		for($i=0; $i<$result_retailer->num_rows(); $i++)
		{
			echo "<option value='".$result_retailer->row($i)->user_id	."'>".$result_retailer->row($i)->business_name."</option>";
		}
		echo "<option value='ALL'>ALL</option>";
?>
</select>
<input type="submit" value="Submit" class="button" name="btnSearch" id="btnSearch" />
</td>
</tr>
</table>
</fieldset>
</form>
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if(isset($result_balance))
	{
		if($result_balance->num_rows() > 0)
		{
	?>
    <div id="tblMobileReport">
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader" style="background: #110303;color: #fff;">
    <th scope="col" align="left">Sr No</th>
	<th scope="col" align="left">MasterDealer Name</th>    
	<th scope="col" align="left">Current Balance</th>
    </tr>
    <?php	$total_amount=0;$i = 0;foreach($result_balance->result() as $result) 	{  ?>
			<tr id="<?php echo "Print_".$i ?>" class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><?php echo ($i + 1); ?></td>
 <td><?php echo "<span id='db_ssid".$i."'>".$result->business_name."</span>"; ?></td> 
 <td><?php echo "<span id='db_trno".$i."'>".$result->balance."</span>"; ?></td> 
 </tr>
		<?php
		$i++;} ?>         
		</table>
        </div>
       <?php
		}
	   else{
		   echo "<div class='message'>Record Not Found.</div>";
		   }
	   
	   }?>
</div>
<div id="footer">
     <?php require_once("general_footer.php"); ?>
  <!-- end #footer --></div>
</div>

  
</body>
</html>