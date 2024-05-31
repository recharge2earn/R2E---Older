<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search customer</title>
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
    <script src="<?php echo base_url()."js/qTip.js"; ?>"></script>   
    <script>
	setTimeout(function(){$('div.message').fadeOut(1000);}, 3000);
	function ActionSubmit(value,name)
	{
		if(document.getElementById('action_'+value).selectedIndex != 0)
		{
			var isstatus;
			if(document.getElementById('action_'+value).value == 0)
			{isstatus = 'cancel';}else{isstatus='active';}
			
			if(confirm('Are you sure?\n you want to '+isstatus+' login for - ['+name+']')){
				document.getElementById('hidstatus').value= document.getElementById('action_'+value).value;
				document.getElementById('hiduserid').value= value;				
				document.getElementById('frmCallAction').submit();
				}
		}
	}
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
  <div id="back-border">
  </div>
  <div>
<h2>Search Customer</h2>   
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if($this->session->flashdata('user_message')){echo "<div class='message'>".$this->session->flashdata('user_message')."</div>";}
	?>    
    
     <form action="<?php echo base_url()."search_customer" ?>" method="post" name="frmSearch" id="frmSearch">
<fieldset>
     <legend>Search Category</legend>
     <table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
     <tr>
    <td align="center">
    Enter 10 Digit Mobile No :     
     <input type="text" title="Enter mobile no." class="text" name="txtSearch_Word" id="txtSearch_Word" />&nbsp;<input type="submit" class="button" value="Search" name="btnSearch" id="btnSearch" ></td>	
	</tr>
</table>     
</fieldset>
<br />
 </form>
 <?php if(isset($result_customer)) {?>
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader">
    <th scope="col" align="left">Add Balance</th>
    <th scope="col" align="left">Customer Name</th>
    <th scope="col" align="left">User Name</th>
	<th scope="col" align="left">Mobile</th>
   	<th scope="col" align="left">Email ID</th>    	
    </tr>
    <?php	$i = 0;foreach($result_customer->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><?php echo '<a href="'.base_url().'customer_add_balance/process/'.$result->user_id.'" class="paging">Add Balance</a>'; ?></td> 
   <td><?php echo $result->business_name; ?></td>
  <td><?php echo $result->username; ?></td>
 <td><?php echo $result->mobile_no; ?></td>
 <td><?php echo $result->emailid; ?></td>
 </tr>
		<?php 	
		$i++;} ?>
		</table>
       <?php  }?>
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
     <div id="footer">
     <?php require_once("general_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
 
</body>
</html>