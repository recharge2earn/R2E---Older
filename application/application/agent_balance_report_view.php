<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agent Balance Report</title>
<?php include("script1.php"); ?>

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
   <?php require_once("admin_menu1.php"); ?> 
  </div>
  <div class="bck">
<h2>Agent Balance Report</h2>
<form action="<?php echo base_url()."agent_balance_report"; ?>" method="post" name="frmReport" id="frmReport">

Agent Name : 

<select title="Select Retailer Name." name="ddlUserName" id="ddlUserName" class="select">
    <option value="0">--Select--</option>
    <?php
		$result_retailer = $this->db->query("select * from tblusers where usertype_name='Agent' order by business_name");		
		for($i=0; $i<$result_retailer->num_rows(); $i++)
		{
			echo "<option value='".$result_retailer->row($i)->user_id	."'>".$result_retailer->row($i)->business_name."</option>";
		}
		echo "<option value='ALL'>ALL</option>";
?>
</select>
<input type="submit" value="Submit" class="button" name="btnSearch" id="btnSearch" />

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
    <tr style="background: #110303;color: #fff;">
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="30">Sr No</th>
	 <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="30">Agent Name</th>    
	 <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="30">Current Balance</th>
    </tr>
    <?php	$total_amount=0;$i = 0;foreach($result_balance->result() as $result) 	{  ?>
			<tr id="<?php echo "Print_".$i ?>" class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo ($i + 1); ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo "<span id='db_ssid".$i."'>".$result->business_name."</span>"; ?></td> 
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo "<span id='db_trno".$i."'>".$result->balance."</span>"; ?></td> 
 </tr>
		<?php
		$total_amount= $total_amount + $result->balance;
		$i++;} ?>    
         <tr class="ColHeader" style="background: #110303;color: #fff;">>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="30"></th>   
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="30">Total Balace : </th>
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="30"><?php echo $total_amount; ?></th>
         	          
    </tr>              
		</table>
        </div>
       <?php
		}
	   else{
		   echo "<div class='message'>Record Not Found.</div>";
		   }
	   
	   }?>
       <div id="footer">
     <?php require_once("general_footer.php"); ?>
  <!-- end #footer --></div>
 </div>
</div>


</body>
</html>