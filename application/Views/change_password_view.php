<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>   
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
<body>

<?php require_once("admin_menu.php"); ?> 


<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading">Change Password</div>
      <div class="panel-body">
          
    <?php
	if ($message != ''){echo "<div class='alert alert-success'>".$message."</div>"; }
	?>
    <form action="<?php echo base_url()."change_password"; ?>" method="post" autocomplete="off" name="frmChangePassword" id="frmChangePassword">
  
     <div class="form-group">
    <label for="txtOldPassword">Old Password :</label>
    <input type="password" name="txtOldPassword" title="Enter Old Password." id="txtOldPassword" class="form-control" required=""  />
    </div>
    
    <div class="form-group">
    <label for="txtNewPassword">New Password :</label>
    <input type="password" name="txtNewPassword" title="Enter New Password." id="txtNewPassword" class="form-control" required=""  />
    </div>

<div class="form-group">
    <label for="txtCnfPassword">Confirm Password :</label>
    <input type="password" name="txtCnfPassword" title="Enter Confirm Password." id="txtCnfPassword" class="form-control" required=""  />
</div>


    <input type="submit" class="btn btn-primary" value="Submit" name="btnSubmit" id="btnSubmit" />
    <input type="reset" class="btn btn-primary" value="Cancel" name="btnCancel" id="btnCancel" />
    
</form>
 </div>
    </div>
</div>

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
 	  
</body>
</html>