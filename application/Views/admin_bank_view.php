<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Bank(s)</title>
   <?php include("script1.php"); ?>
    <link href="<?php echo base_url()."jquery.dataTables.css"; ?>" rel="stylesheet" type="text/css" />    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <link rel="stylesheet" href="<?php echo base_url()."js/jquery.alerts.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>               
    <script src="<?php echo base_url()."js/jquery.dataTables.min.js"; ?>"></script> 
    <script src="<?php echo base_url()."js/jquery.alerts.js"; ?>"></script>                
    <script>
	$(document).ready(function(){
	//global vars
	$('#example').dataTable(); 
	var form = $("#frmapi_view");
	var apiname = $("#txtAPIName");
	var apinameInfo = $("#APINameInfo");
	var username = $("#txtUserName");
	var usernameInfo = $("#usernameInfo");
	var pwd = $("#txtPassword");
	var pwdInfo = $("#passwordInfo");
	apiname.focus();
	pwd.blur(validatePassword);
	form.submit(function(){
		if(validateAPIName() & validateUserName() & validatePassword())
			{				
			return true;
			}
		else
			return false;
	});
	function validateAPIName(){
		if(apiname.val() == ""){
			//apiname.addClass("error");
			apinameInfo.text("");
			jAlert('Enter API Name. e.g RoyalCapital', 'Alert Dialog');
			return false;
		}
		else{
			apiname.removeClass("error");
			apinameInfo.text("");
			return true;
		}
	}
	function validateUserName(){
		if(username.val() == ""){
			//username.addClass("error");
			jAlert('Enter User Name.<br>For Royal Capital : Enter Agent ID.', 'Alert Dialog');
			usernameInfo.text("");
			return false;
		}
		else{
			username.removeClass("error");
			usernameInfo.text("");
			return true;
		}
	}
	function validatePassword(){
		if(pwd.val()== ""){
			//pwd.addClass("error");
			jAlert('Enter API Password. For RoyalCapital : Enter Passward.', 'Alert Dialog');
			
			pwdInfo.text("");
			return false;
		}
		else{
			pwd.removeClass("error");
			pwdInfo.text("");
			return true;
		}
	}
	setTimeout(function(){$('div.message').fadeOut(1000);}, 2000);	
});
	function Confirmation(value)
	{
		var varName = document.getElementById("name_"+value).innerHTML;
		if(confirm("Are you sure?\nyou want to delete "+varName+" api.") == true)
		{
			document.getElementById('hidValue').value = value;
			document.getElementById('frmDelete').submit();
		}
	}
	function SetEdit(value)
	{
		document.getElementById('txtAPIName').value=document.getElementById("name_"+value).innerHTML;
		document.getElementById('txtUserName').value=document.getElementById("uname_"+value).innerHTML;		
		document.getElementById('txtPassword').value='';
		document.getElementById('btnSubmit').value='Update';
		document.getElementById('hidID').value = value;
		document.getElementById('myLabel').innerHTML = "Edit API";
	}
	function SetReset()
	{
		document.getElementById('btnSubmit').value='Submit';
		document.getElementById('hidID').value = '';
		document.getElementById('myLabel').innerHTML = "Add API";
	}
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
    <h2 class="border_bottom"><span id="myLabel">Bank Details</span></h2>               
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
<form method="post" action="<?php echo base_url()."api"; ?>" name="frmapi_view" id="frmapi_view" autocomplete="off">
<fieldset>
<table cellpadding="3" cellspacing="3" border="0">
<tr>
<td align="right"><label for="txtAPIName"><span style="color:#F06">*</span> API Name :</label></td><td align="left"><input type="text" class="text" id="txtAPIName" title="Enter API Name.<br/>e.g Silver, Gold" name="txtAPIName" maxlength="100"/>
<span id="APINameInfo"></span>
</td>
</tr>
<tr>
<td align="right"><label for="txtUserName"><span style="color:#F06">*</span> User Name :</label></td><td align="left"><input type="text" id="txtUserName" class="text" title="Enter User Name.<br>e.g For Royal Capital : RCGJ12" name="txtUserName">
<span id="usernameInfo"></span>
</td>
</tr>
<tr>
<td align="right"><label for="txtPassword"><span style="color:#F06">*</span> Password :</label></td><td align="left"><input type="password" class="text" id="txtPassword" title="Enter API Password." name="txtPassword" maxlength="50"/>
<span id="passwordInfo"></span>
</td>
</tr>
<tr>
<td></td><td align="left"><input type="submit" class="button" id="btnSubmit" name="btnSubmit" value="Submit"/> <input type="reset" class="button" onClick="SetReset()" id="bttnCancel" name="bttnCancel" value="Cancel"/></td>
</tr>
</table>
</fieldset>
<input type="hidden" id="hidID" name="hidID" />
</form>


    <form action="<?php echo base_url()."api"; ?>" method="post" autocomplete="off" name="frmDelete" id="frmDelete">
    <input type="hidden" id="hidValue" name="hidValue" />
    <input type="hidden" id="action" name="action" value="Delete" />
</form>

<h2 class="h2">View API</h2>

<table style="width:100%;" id="example" class='dataTable' cellpadding="3" cellspacing="0" border="0">
     <thead> 
        <tr class="ColHeader"> 
            <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >API Provider</th> 
            <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >User Name</th> 
            <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Password</th>
            <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Actions</th> 
        </tr> </thead>
    <?php	$i = 0;foreach($result_api->result() as $result) 	{  ?>
    <tbody> 
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
              <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><span id="name_<?php echo $result->api_id; ?>"><?php echo $result->api_name; ?></span></td>
             <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><span id="uname_<?php echo $result->api_id; ?>"><?php echo $result->username; ?></span></td>
              <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><span id="pwd_<?php echo $result->api_id; ?>"><?php echo '*******'; ?></span></td>              
            <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;">
              <img src="<?php echo base_url()."images/delete.PNG"; ?>" height="20" width="20" onClick="Confirmation('<?php echo $result->api_id; ?>')" title="Delete Row" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <img src="<?php echo base_url()."images/Edit.PNG"; ?>" onClick="SetEdit('<?php echo $result->api_id; ?>')" title="Edit Row" />
              </td>  
             </tr></tbody>
		<?php 	
		$i++;} ?>
		</table> 
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>
