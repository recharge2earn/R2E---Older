<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>
    <?php include("script1.php"); ?>
    <script>
	$(document).ready(function(){
	//global vars
	var form = $("#frmChangePassword");
	var newPwd = $("#txtNewPassword");
	var newPwdInfo = $("#newpwdInfo");
	var cnfPwd = $("#txtCnfPassword");
	var cnfPwdInfo = $("#cnfpwdInfo");	
	
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
 <?php require_once("general_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("agent_menu.php"); ?> 
  </div>
  </div> 
  <div class="bck">
   <h2 class="h2 shadow"><span id="myLabel">Change Password</span></h2>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
    <form action="<?php echo base_url()."set_otp"; ?>" method="post" autocomplete="off" name="frmChangePassword" id="frmChangePassword">
    <fieldset>
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