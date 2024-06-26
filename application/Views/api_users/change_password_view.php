<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>
   <?php include("script1.php"); ?>
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
    <script src="<?php echo base_url()."js/external/jquery.bgiframe-2.1.2.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>                    
   <link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script> 
    <script>
	$(document).ready(function(){
	//global vars
	var form = $("#frmChangePassword");
	var oldPwd = $("#txtOldPassword");
	var oldPwdInfo = $("#oldpwdInfo");
	var newPwd = $("#txtNewPassword");
	var newPwdInfo = $("#newpwdInfo");
	var cnfPwd = $("#txtCnfPassword");
	var cnfPwdInfo = $("#cnfpwdInfo");	
	oldPwd.focus();
	oldPwd.blur(validatesOld);
	newPwd.blur(validatesNew);
	cnfPwd.blur(validatesCnf);
	form.submit(function(){
		if(validatesOld() & validatesNew() & validatesCnf())
			{				
			return true;
			}
		else
			return false;
	});
	function validatesOld(){
		if(oldPwd.val() == ""){
			oldPwd.addClass("error");
			oldPwdInfo.text("");
			return false;
		}
		else{
			oldPwd.removeClass("error");
			oldPwdInfo.text("");
			return true;
		}
	}
	function validatesNew(){
		if(newPwd.val() == ""){
			newPwd.addClass("error");
			newPwdInfo.text("");
			return false;
		}
		else{
			newPwd.removeClass("error");
			newPwdInfo.text("");
			return true;
		}
	}
	function validatesCnf(){
		if(cnfPwd.val() == ""){
			cnfPwd.addClass("error");
			cnfPwdInfo.text("");
			return false;
		}
		if(cnfPwd.val() != newPwd.val())
		{
			cnfPwd.addClass("error");
			cnfPwdInfo.text("New password and confirm password does not match.");
			return false;
		}
		else{
			cnfPwd.removeClass("error");
			cnfPwdInfo.text("");
			return true;
		}
	}	
	setTimeout(function(){$('div.message').fadeOut(1000);}, 2000);
	
});
	</script>
</head>
<body class="twoColFixLtHdr">
<div id="container">
  
   <?php require_once("apiuser_header.php"); ?>  
 <?php require_once("ApiMenu.php"); ?> 
  <div style="margin:20px;">
   <h2 class="h2"><span id="myLabel">Change Password</span></h2>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
    <div class="breadcrumb">
    <form action="<?php echo base_url()."api_users/change_password"; ?>" method="post" autocomplete="off" name="frmChangePassword" id="frmChangePassword">
    
    <table border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td align="right"><label for="txtOldPassword"><span style="color:#F06">*</span>Old Password :</label></td>
    <td align="left"><input type="password" name="txtOldPassword" title="Enter Old Password." id="txtOldPassword" class="text" />
    <span id="oldpwdInfo"></span>
    </td>
  </tr>
  <tr>
    <td align="right"><label for="txtNewPassword"><span style="color:#F06">*</span>New Password :</label></td>
    <td align="left"><input type="password" name="txtNewPassword" title="Enter New Password." id="txtNewPassword" class="text" />
    <span id="newpwdInfo"></span>
    </td>
  </tr>
  <tr>
    <td align="right"><label for="txtCnfPassword"><span style="color:#F06">*</span>Confirm Password :</label></td>
    <td align="left"><input type="password" name="txtCnfPassword" title="Enter Confirm Password." id="txtCnfPassword" class="text" /><br/>
    <span id="cnfpwdInfo"></span>
    </td>
  </tr>    
  <tr>
    <td align="right">&nbsp;</td>
    <td align="left">
    <input type="submit" class="button" value="Submit" name="btnSubmit" id="btnSubmit" />
    <input type="reset" class="button" value="Cancel" name="btnCancel" id="btnCancel" />
    </td>
    </tr>
</table>
</form>
</div>
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>