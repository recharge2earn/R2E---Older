<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login History</title>
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
    <script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    	
    <script src="<?php echo base_url()."js/qTip.js"; ?>"></script>   
    <script>
	$(document).ready(function(){
$( "#txtFromDate,#txtToDate" ).datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear: true});
	setTimeout(function(){$('div.message').fadeOut(1000);}, 5000);
						   });

	
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
  <div>
  </div>
  <div>
<h2 class="h2">Deposit Payment</h2>
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if($this->session->flashdata('user_message')){echo "<div class='message'>".$this->session->flashdata('user_message')."</div>";}
	?>    
    
     <form action="<?php echo base_url()."login_history" ?>" method="post" name="frmSearch" id="frmSearch">
<fieldset>
     <legend>Search Category</legend>
     <table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
     <tr>
    <td align="center">
    Search By :<select id="ddlSearchBy" name="ddlSearchBy" class="select" title="Select Search By">
    <option value="Mobile">Mobile No</option>    
    <option value="UserName">User Name</option>
    </select>
    &nbsp;
     <input type="text" title="Enter Search Word." class="text" name="txtSearch_Word" id="txtSearch_Word" /></td>	
	</tr>
    <tr>
    <td align="center">
    From Date : <input type="text" title="From Date." class="text" name="txtFromDate" id="txtFromDate" />
    To Date : <input type="text" title="From Date." class="text" name="txtToDate" id="txtToDate" />&nbsp;<input type="submit" class="button" value="Search" name="btnSearch" id="btnSearch" />
    </td>
    </tr>
</table>     
</fieldset>
<br />
 </form>
 
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr style="background: #110303;color: #fff;">
    <th scope="col" align="left">Sr No</th>
    <th scope="col" align="left">Name</th>
	<th scope="col" align="left">Login Date</th>
   	<th scope="col" align="left">Login Time</th>    
	<th scope="col" align="left">IP Address</th>
    </tr>
    <?php	$i = 0;foreach($result_login->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
  <td><?php echo ($i+1); ?></td>          
  <td><?php echo $result->name; ?></td>
 <td><?php echo $result->date_login; ?></td>
 <td><?php echo $result->time_login; ?></td>
  <td><?php echo $result->ip_address; ?></td>
 </tr>
		<?php 	
		$i++;} ?>
		</table>
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>