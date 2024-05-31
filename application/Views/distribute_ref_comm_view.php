<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Distribute Commission</title>
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
    <script language="javascript">
	function ActionSubmit(value,user_id,comm,commtype,fromdate,todate)
	{
		alert(user_id+" "+comm);
		if(document.getElementById('ddlaction'+value).selectedIndex != 0)
		{
			var isstatus;
			if(document.getElementById('ddlaction'+value).value == "Success")
			{isstatus = 'Success';}else{isstatus='Failure';}
			
			if(confirm('Are you sure?\n you want to Payment Commissin to - ['+user_id+']')){
				document.getElementById('hidstatus').value= document.getElementById('ddlaction'+value).value;
				document.getElementById('hiduser_id').value= user_id;		
				document.getElementById('hidtype').value= commtype;	
				document.getElementById('hidamount').value= comm;	
				document.getElementById('hidfrom').value= fromdate;
				document.getElementById('hidto').value= todate;			
				document.getElementById('frmCallAction').submit();
				}
		}
	
	}
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
<form action="<?php echo base_url()."distribute_ref_comm" ?>" method="post" name="frmSearch" id="frmSearch">
     From Date :<input type="text" name="txtFrom" id="txtFrom" class="text" title="Select Date." maxlength="10" /> To Date : <input type="text" name="txtTo" id="txtTo" class="text" title="Select Date." maxlength="10" /> <input type="submit" name="btnSearch" id="btnSearch" value="Search" class="button" title="Click to search." />

<br />
 </form>
<form action="<?php echo base_url()."distribute_ref_comm" ?>" method="post" name="frmCallAction" id="frmCallAction">
<input type="hidden" id="hidstatus" name="hidstatus" />
<input type="hidden" id="hidtype" name="hidtype" />
<input type="hidden" id="hiduser_id" name="hiduser_id" />
<input type="hidden" id="hidamount" name="hidamount" />
<input type="hidden" id="hidfrom" name="hidfrom" />
<input type="hidden" id="hidto" name="hidto" />
<input type="hidden" id="hidaction" name="hidaction" value="Set" />
 </form>
   <h2><span id="myLabel">Pending Commission</span></h2>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>    
    

<?php if(isset($result_comm)) { ?>
<table style="width:100%;" cellpadding="3" cellspacing="0" border="1">

    <tr class="ColHeader">
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="30">Sr No</th>
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="50" height="30">User Code</th>
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="80" height="30">Business Name</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="60" height="30">Mobile No</th>
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30">Email Id</th>
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="40" height="30">Comm Type</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="40" height="30">Comm Amount</th>
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="40" height="30">TotalDeposit</th>
 
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30">From Date</th>
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30">To Date</th>
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="30">Action</th>            
    </tr>
    <?php $i=0; foreach($result_comm->result() as $result) 	{  ?>
    <tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
	<td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo $i+1; ?></td>	
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo $result->username; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo $result->business_name; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo $result->mobile_no; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" width="120"><?php echo $result->emailid; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="right" height="34" width="30" ><?php echo $result->commission_type; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="right" height="34" width="30" ><?php echo $result->totalComm; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="right" height="34"><?php echo $result->totalDeposit; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo $fromdate; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo $todate; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" width="120">
 <select style="width:120px;" id="ddlaction<?php echo $i+1; ?>" name="ddlaction" onChange="ActionSubmit('<?php echo $i+1; ?>','<?php echo $result->username;  ?>','<?php echo $result->totalComm; ?>','<?php echo $result->commission_type; ?>','<?php echo $fromdate; ?>','<?php echo $todate; ?>')">
 <option>Select</option>
 <option>Success</option>
 </select>
 </td>
 
  
 </tr>
		<?php 	
		$i++;} ?>
		</table>
<?php       } ?>
</div>
<div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
  
</div>

</body>
</html>