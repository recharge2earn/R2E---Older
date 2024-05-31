<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super Dealer List</title>
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
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("a_menu.php"); ?> 
  </div>  
  <div class="bck">
<h2>View Super Dealer</h2>  
 <form action="<?php echo base_url()."ms_dealer_list" ?>" method="post" name="frmCallAction" id="frmCallAction">
<input type="hidden" id="hidstatus" name="hidstatus" />
<input type="hidden" id="hiduserid" name="hiduserid" />
<input type="hidden" id="hidaction" name="hidaction" value="Set" />
 </form>
 
 
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if($this->session->flashdata('user_message')){echo "<div class='message'>".$this->session->flashdata('user_message')."</div>";}
	
		if($this->session->flashdata('message')){echo "<div class='message'>".$this->session->flashdata('message')."</div>";}	
	
	?>    
    
     <form action="<?php echo base_url()."ms_dealer_list" ?>" method="post" name="frmSearch" id="frmSearch">
     <fieldset>
     <legend>Search Category</legend>
     <table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
     <tr>
    <td align="center">
    Search By :<select id="ddlSearchBy" name="ddlSearchBy" class="select" title="Select Search By">
    <option value="Mobile">Mobile No</option>
    <option value="Dealer">Dealer Name</option>
    <option value="UserID">User ID</option>
    </select>
    
     <input type="text" title="Enter Search Word." class="text" name="txtSearch_Word" id="txtSearch_Word" />&nbsp;<input type="submit" class="button" value="Search" name="btnSearch" id="btnSearch" ></td>	
	</tr>
</table>     
</fieldset>
<br />
 </form>
 
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader" style="background: #110303;color: #fff;">
    <th scope="col" align="left"></th>
    <th scope="col" align="left">Balance</th>
    <th scope="col" align="left">Super Dealer Name</th>
    <th scope="col" align="left">User Name</th>
     <th scope="col" align="left">Password</th>
	<th scope="col" align="left">Address</th>    
	<th scope="col" align="left">City</th>
   	<th scope="col" align="left">State</th>    
	<th scope="col" align="left">Mobile</th>
   	<th scope="col" align="left">Email ID</th>  
    <th scope="col" align="left">Parent</th>  
	<th scope="col" align="left">Login</th>
	<th scope="col" align="left">Action</th>                 
    </tr>
    <?php	$i = 0;foreach($result_dealer->result() as $result) 	{  ?>
    <?php
	$parent_id = $result->parent_id;
		$rslt = $this->db->query("select * from tblusers where user_id = '$parent_id'");
	 ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
<td><a href="<?php echo base_url()."ms_dealer_edit/process/".$result->user_id; ?>" title="Edit Franchise"><img src="<?php echo base_url()."images/Edit.PNG"; ?>" border="0" title="Edit Dealer" /></a></td>            

 <td>
 <?php echo '<a href="'.base_url().'add_balance/process/'.$result->user_id.'/ms/Add" class="paging">Add </a>&nbsp; | &nbsp; <a href="'.base_url().'add_balance/back/'.$result->user_id.'/ms/Revert" class="paging">Revert </a>'; ?>
 </td>
 <td><?php echo $result->business_name; ?></td>
  <td><?php echo $result->username; ?></td>
   <td><?php echo $result->password; ?></td>
 <td><?php echo $result->postal_address; ?></td>
 <td><?php echo $result->city_name; ?></td>
 <td><?php echo $result->state_name; ?></td>
 <td><?php echo $result->mobile_no; ?></td>
 <td><?php echo $result->emailid; ?></td>
 <td><?php echo $rslt->row(0)->business_name; ?></td>
 <td><?php if($result->status == 0){echo "<span class='red'>Cancel</span>";}else{echo "<span class='green'>Active</span>";} ?></td>
 <td>
 <select id="action_<?php echo $result->user_id; ?>" onChange="ActionSubmit('<?php echo $result->user_id; ?>','<?php echo $result->business_name; ?>')"><option value="Select">Select</option><option value="1">Active</option><option value="0">Cancel</option></select>
 </td>
 </tr>
		<?php 	
		$i++;} ?>
		</table>
       <?php  echo $pagination; ?>
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>