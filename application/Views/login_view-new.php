<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>::Login::</title>
    <?php require_once("script.php"); ?>
<script>   
	function OpenEmail()
	{
		$( "#dialog" ).dialog('open');		
	}
	function OpenUserName()
	{
		$( "#dialogUserName" ).dialog('open');		
	}
	$(function() {
		$( "#dialog, #dialogUserName" ).dialog({modal: true,width:450,
                autoOpen: false});
	});

	$(document).ready(function(){
							   
							   
	var r_form = $("#frmRegister");
	var r_email = $("#txtEmail");
	var r_emailInfo = $("#r_emailInfo");
	var r_userName= $("#txtName");
	var r_userNameInfo= $("#userNameInfo");	
	var r_mobile= $("#txtMobile");
	r_email.blur(validatesr_Email);
	r_userName.blur(validatesr_UserName);
	r_mobile.blur(validatesr_Mobile);
	
	r_form.submit(function(){
		if(validatesr_UserName() & validatesr_Email() & validatesr_Mobile() )
			{				
			return true;
			}
		else
			return false;
	});
	
	function validatesr_UserName(){
				if(r_userName.val() == ""){
			r_userName.addClass("error");
			
			return false;
		}
		else if(r_userName.val().length < 3)
		{
			r_userName.addClass("error");
			r_userNameInfo.text("Minimum 3 Letters Required.");
		}
		else{
			r_userNameInfo.text("");
			r_userName.removeClass("error");
			return true;
		}		
		}
	function validatesr_Email(){
				var a = $("#txtEmail").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		//if it's valid email
		if(filter.test(a)){
			r_email.removeClass("error");
			r_emailInfo.text("");
			return true;
		}
		//if it's NOT valid
		else{
			r_email.addClass("error");
			r_emailInfo.text("Type a valid e-mail please.");
			return false;

		}

		
		}
	function validatesr_Mobile(){
				if(r_mobile.val().length < 10){
			r_mobile.addClass("error");
			alert("Enter 10 digit mobile no.")
			return false;
		}
		else{
			r_mobile.removeClass("error");
			return true;
		}		
		}		
	
	
							   
	//global vars
	var form = $("#frmLogin");
	var uname = $("#txtUserName");	
	var unameInfo = $("#usernameInfo");
	var pwd= $("#txtPassword");
	var pwdInfo = $("#passwordInfo");		
	uname.focus();
	uname.blur(validatesUserName);
	pwd.blur(validatesPassword);
	form.submit(function(){
		if(validatesUserName() & validatesPassword())
			{				
			return true;
			}
		else
			return false;
	});
	function validatesUserName(){
		//if it's NOT valid
		if(uname.val() == ""){
			uname.addClass("error");			
			unameInfo.text("");
						
			return false;
		}
		//if it's valid
		else{
			uname.removeClass("error");
			unameInfo.text("");
			return true;
		}
	}
	function validatesPassword(){
		//if it's NOT valid
		if(pwd.val() == ""){
			pwd.addClass("error");
			pwdInfo.text("");
			return false;
		}
		//if it's valid
		else{
			pwd.removeClass("error");
			pwdInfo.text("");
			return true;
		}
	}
	
	setTimeout(function(){$('div.message').fadeOut(1000);}, 3000);
	
});
		
	function validateForget()
	{
		var uName = $("#txtForgetUserName");
		var uEmail = $("#txtForgerEmail");			
		if(uName.val() == ""){
			uName.addClass("error");			
			return false;
		}		
		else{
			uName.removeClass("error");
			if(uEmail.val() == ""){
			uEmail.addClass("error");			
			return false;
		}
		else{
			uEmail.removeClass("error");
			return true;
		}				
		}				
	}
	function validateUserName()
	{
		var uName = $("#txtForgetMobileNo");
		var uEmail = $("#txtForgerUser_Email");			
		if(uName.val() == ""){			
			return false;
		}		
		else{
			uName.removeClass("error");
			if(uEmail.val() == ""){
			uEmail.addClass("error");			
			return false;
		}
		else{
			uEmail.removeClass("error");
			return true;
		}				
		}				
	}	
	function OpenSecurity(url)
	{
		window.open(url,'Security','location=1,status=1,scrollbars=1,width=500,height=350');
	}
	</script>
    <link href="<?php echo base_url()."style.css";?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css";?>" rel="stylesheet" type="text/css" />
</head>


<body class="twoColFixLtHdr">
<div id="container">
  <div style="height: 140px;padding:5px 0;">
    	<h1>AKASH MOBILE WORLD<h1>
            </div>            
        </div>       
     </div>
<hr />     
<center>
<div id="dialog" title="Forget Password">
	<form method="post" name="frmForget" id="frmForget" action="<?php echo base_url()."login/forget"; ?>">
    <table>
        <tr>
    <td align="right">
    User Name :
    </td>
    <td align="left">
    <input type="text" class="text" name="txtForgetUserName" id="txtForgetUserName" title="Enter User Name." />
    </td>
    </tr>
    <tr>
    <td align="right">
    Email ID :
    </td>
    <td align="left">
    <input type="text" class="text" name="txtForgerEmail" id="txtForgerEmail" title="Enter Email ID." />
    </td>
    </tr>
    <tr>
    <td></td>
    <td align="left"><input type="submit" name="btnOK" onClick="return validateForget()" id="btnOK" value="OK" class="button" /></td>
    </tr>
    </table>
     
    </form>
</div>

<div id="dialogUserName" title="Forget User Name">
	<form method="post" name="frmuserName" id="frmuserName" action="<?php echo base_url()."login/username"; ?>">
    <table>
        <tr>
    <td align="right">
    Mobile No :
    </td>
    <td align="left">
    <input type="text" class="text" name="txtForgetMobileNo" id="txtForgetMobileNo" title="Enter Mobile No." maxlength="10" />
    </td>
    </tr>
    <tr>
    <td align="right">
    Email ID :
    </td>
    <td align="left">
    <input type="text" class="text" name="txtForgerUser_Email" id="txtForgerUser_Email" title="Enter Email ID." />
    </td>
    </tr>
    <tr>
    <td></td>
    <td align="left"><input type="submit" name="btnOK" onClick="return validateUserName()" id="btnOK" value="OK" class="button" /></td>
    </tr>
    </table>
     
    </form>
</div>

  <div style="height:305px;padding-top:40px;border:solid 0px #f5f5f5;background: #FFFFFF;">
  <div id="tabs111" style="width:570px;">	
	<div id="tabs-11">       
    <fieldset style="text-align:left;width:500px;">
    <legend>Login</legend>
        <?php
	if ($message != ''){echo "<div class='message' style='color:#F00;'>".$message."</div>"; }
	if($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";}
	?>

    <center>
    <form action="<?php echo base_url()."login"; ?>" autocomplete="off" method="post" name="frmLogin" id="frmLogin">
    <table border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td align="right"><label for="txtUserName"> * User Name :</label></td>
    <td align="left"><input type="text" title="Enter User Name." maxlength="50" class="text" id="txtUserName" name="txtUserName" />
    <span id="unameInfo"></span>
    </td>
  </tr>
  <tr>
    <td align="right"><label for="txtPassword"> * Password :</label></td>
    <td align="left"><input type="password" title="Enter Password" maxlength="50" class="text" id="txtPassword" name="txtPassword" /></td>
  </tr>
  <tr>
    <td align="right"><label for="txtPassword"> * Security PIN :</label></td>
    <td align="left"><input type="password" maxlength="10" class="text" id="txtPassword1" onKeyPress="return isNumeric(event);" name="txtPassword1" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><input type="submit" class="button" value="Login" name="btnLogin" id="btnLogin" />
        <span id="pwdInfo"></span>
    </td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td align="left">
    
   <a href="#" onClick="OpenEmail()">Forget Password?</a> &nbsp;|&nbsp; </td>
  </tr>
  <tr>
  <td></td>
   </tr>
</table>

</form>

</center>
    </fieldset>
<div>
        <h3>Mobile Application</h3>
        <div align="center" class="hr dotted clearfix">&nbsp;</div>
       
            		<a href="a2z.apk"><b style="color:#8080FF;font-size:12px;">Download Android Application</b></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="PAYGPRS.jar"><b style="color:#8080FF;font-size:12px;">Download Mobile App JAR File</b></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="PAYGPRS.jad"><b style="color:#8080FF;font-size:12px;">Download Mobile App JAD File</b></a>
					<br>
               
        </div>
    
	</div>
	
</div>

	<!-- end #mainContent --></div>
    </center>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
    <div  style="margin-bottom:15px;width:100%">
        		<div>
             		&copy; 2012  <a href="<?php echo base_url(); ?>" target="_blank">AKASH</a> 
       			</div>
    		</div>
                		</div><!-- end #Footer -->
<!-- end #container --></div>
  
</body>
</html>