<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>State</title>
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                     
    <script>
	$(document).ready(function(){
	//global vars
	var form = $("#frmState");
	var sname = $("#txtState");
	var snameInfo = $("#snameInfo");
	var code = $("#txtCode");
	var codeInfo = $("#codeInfo");
	sname.focus();
	sname.blur(validatesName);
	code.blur(validatesCode);
	form.submit(function(){
		if(validatesName() & validatesCode())
			{				
			return true;
			}
		else
			return false;
	});
	function validatesName(){
		//if it's NOT valid
		if(sname.val() == ""){
			sname.addClass("error");
			snameInfo.text("");
			return false;
		}
		//if it's valid
		else{
			sname.removeClass("error");
			snameInfo.text("");
			return true;
		}
	}
	function validatesCode(){
		//if it's NOT valid
		if(code.val() ==  ""){
			code.addClass("error");			
			codeInfo.text("");
			return false;
		}
		//if it's valid
		else{
			code.removeClass("error");
			codeInfo.text("");
			return true;
		}
	}

	setTimeout(function(){$('div.message').fadeOut(1000);}, 2000);
	
});
	function Confirmation(value)
	{
		var varName = document.getElementById(""+value).innerHTML;
		if(confirm("Are you sure?\nyou want to delete "+varName+" state.") == true)
		{
			document.getElementById('hidValue').value = value;
			document.getElementById('frmDelete').submit();
		}
	}
	function SetEdit(value)
	{
		document.getElementById('txtState').value=document.getElementById(""+value).innerHTML;
		document.getElementById('txtCode').value=document.getElementById("code_"+value).innerHTML;		
		document.getElementById('btnSubmit').value='Update';
		document.getElementById('hidID').value = value;
		document.getElementById('myLabel').innerHTML = "Edit State";
	}
	function SetReset()
	{
		document.getElementById('btnSubmit').value='Submit';
		document.getElementById('hidID').value = '';
		document.getElementById('myLabel').innerHTML = "Add State";
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
  <div id="back-border">
  </div>
  <div id="sidebar1">   
 <?php require_once("a_sidebar.php"); ?> 
  <!-- end #sidebar1 --></div>
  <div id="mainContent">
    <h2><span id="myLabel">Add State</span></h2>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
    <form action="<?php echo base_url()."state"; ?>" method="post" name="frmState" id="frmState">
    <fieldset>
    <table  border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td align="right"><label for="txtState"><span style="color:#F06">*</span>State Name :</label></td>
    <td align="left"><input type="text" title="Enter State Name.<br />e.g Gujarat, Rejasthan" name="txtState" id="txtState" class="text" />
    <span id="snameInfo"></span>
    </td>
  </tr>
    <tr>
    <td align="right"><label for="txtCode"><span style="color:#F06">*</span>Code :</label></td>
    <td align="left"><input type="text" title="Enter State Code.<br />e.g Gujarat - GJ, Maharastra - MH" name="txtCode" id="txtCode" class="text" />
    <span id="codeInfo"></span>
    </td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="left">
    <input type="submit" class="button" value="Submit" name="btnSubmit" id="btnSubmit" />
    <input type="reset" class="button" onClick="SetReset()" value="Cancel" name="btnCancel" id="btnCancel" />
    </td>
    </tr>
</table>
</fieldset>
<input type="hidden" id="hidID" name="hidID" />
</form>
<form action="<?php echo base_url()."state"; ?>" method="post" autocomplete="off" name="frmDelete" id="frmDelete">
    <input type="hidden" id="hidValue" name="hidValue" />
    <input type="hidden" id="action" name="action" value="Delete" />
</form>
<h2>View State</h2>

<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader">
    <th scope="col" align="left" style="width:55px">Delete</th>
    <th scope="col" align="left" style="width:55px;">Edit</th>
    <th scope="col" align="left">State Name</th>
    <th scope="col" align="left">State Codes</th>
    </tr>
<?php	$i = 0;foreach($result_state->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><img src="<?php echo base_url()."images/delete.PNG"; ?>" height="20" width="20" onClick="Confirmation('<?php echo $result->state_id; ?>')" title="Delete Row" /></td>
 <td><img src="<?php echo base_url()."images/Edit.PNG"; ?>" onClick="SetEdit('<?php echo $result->state_id; ?>')" title="Edit Row" /></td>
 <td><span id="<?php echo $result->state_id; ?>"><?php echo $result->state_name; ?></span></td><td><span id="code_<?php echo $result->state_id; ?>"><?php echo $result->codes; ?></span></td></tr>
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