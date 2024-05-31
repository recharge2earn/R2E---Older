<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Security PIN</title>
   <?php include("script1.php"); ?>
	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <link rel="stylesheet" href="<?php echo base_url()."checkboxstyle/style.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script> 
    <script src="<?php echo base_url()."js/jquery.alerts.js"; ?>"></script>                       
    <link rel="stylesheet" href="<?php echo base_url()."js/jquery.alerts.css"; ?>">  
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
<div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("admin_menu1.php"); ?> 
  </div>
  </div> 
  <div class="bck">
   <h2><span id="myLabel">Change Security PIN</span></h2>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
    <form action="<?php echo base_url()."change_security_pin"; ?>" method="post" autocomplete="off" name="frmChangePassword" id="frmChangePassword">
    <fieldset>
    <table border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td align="right"><label for="txtOldPassword"><span style="color:#F06">*</span>Old Security PIN :</label></td>
    <td align="left"><input type="password"  onKeyPress="return isNumeric(event);" name="txtOldPassword" title="Enter Old Password." id="txtOldPassword" class="text" />
    <span id="oldpwdInfo"></span>
    </td>
  </tr>
  <tr>
    <td align="right"><label for="txtNewPassword"><span style="color:#F06">*</span>New Security PIN :</label></td>
    <td align="left"><input type="password"  onKeyPress="return isNumeric(event);" name="txtNewPassword" title="Enter New Password." id="txtNewPassword" class="text" />
    <span id="newpwdInfo"></span>
    </td>
  </tr>
  <tr>
    <td align="right"><label for="txtCnfPassword"><span style="color:#F06">*</span>Confirm Security PIN :</label></td>
    <td align="left"><input type="password"  onKeyPress="return isNumeric(event);" name="txtCnfPassword" title="Enter Confirm Password." id="txtCnfPassword" class="text" /><br/>
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
</fieldset>
</form>
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
     <?php require_once("general_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>