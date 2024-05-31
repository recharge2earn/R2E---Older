<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Super Dealer Registration Form</title>
	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script> 
    <script src="<?php echo base_url()."js/jquery.alerts.js"; ?>"></script>                       
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" /> 
    <link rel="stylesheet" href="<?php echo base_url()."js/jquery.alerts.css"; ?>"> 
       
    <script type="text/javascript" language="javascript">					
		function getCityName(urlToSend)
	{
		if(document.getElementById('ddlState').selectedIndex != 0)
		{
			document.getElementById('hidStateCode').value = $("#ddlState")[0].options[document.getElementById('ddlState').selectedIndex].getAttribute('code');					
		$.ajax({
  type: "GET",
  url: urlToSend+""+document.getElementById('ddlState').value,
  success: function(html){
    $("#ddlCity").html(html);
  }
});
		}
	}


function getCityNameOnLoad(urlToSend)
	{
		if(document.getElementById('ddlState').selectedIndex != 0)
		{
			document.getElementById('hidStateCode').value = $("#ddlState")[0].options[document.getElementById('ddlState').selectedIndex].getAttribute('code');					
		$.ajax({
  type: "GET",
  url: urlToSend+""+document.getElementById('ddlState').value,
  success: function(html){
    $("#ddlCity").html(html);
	document.getElementById('ddlCity').value = document.getElementById('hidCityID').value;		
  }
});
		}
	}

$(document).ready(function(){
	//global vars
	var form = $("#frmdistributer_form1");
	var dname = $("#txtDistname");var postaladdr = $("#txtPostalAddr");
	var pin = $("#txtPin");var mobileno = $("#txtMobNo");var emailid = $("#txtEmail");
	var ddlsch = $("#ddlSchDesc");
	//On Submitting
	form.submit(function(){
		if(validateDname() & validateAddress() & validatePin() & validateMobileno() & validateEmail() & validateScheme())
			{				
			return true;
			}
		else
			return false;
	});
	//validation functions	
	function validateDname(){
		if(dname.val() == ""){
			dname.addClass("error");return false;
		}
		else{
			dname.removeClass("error");return true;
		}		
	}	
	function validateAddress(){
		if(postaladdr.val() == ""){
			postaladdr.addClass("error");return false;
		}
		else{
			postaladdr.removeClass("error");return true;
		}		
	}
	function validatePin(){
		if(pin.val() == ""){
			pin.addClass("error");
			return false;
		}
		else{
			pin.removeClass("error");
			return true;
		}
		
	}
	function validateMobileno(){
		if(mobileno.val().length < 10){
			mobileno.addClass("error");return false;
		}
		else{
			mobileno.removeClass("error");return true;
		}
	}
	function validateEmail(){
		var a = $("#txtEmail").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		if(filter.test(a)){
			emailid.removeClass("error");
			return true;
		}
		else{
			emailid.addClass("error");			
			return false;
		}
	}
	function validateScheme(){
		if(ddlsch[0].selectedIndex == 0){
			ddlsch.addClass("error");			
			return false;
		}
		else{
			ddlsch.removeClass("error");		
			return true;
		}
	}
	setTimeout(function(){$('div.message').fadeOut(1000);}, 10000);
	
	
});
	function ChangeAmount()
	{
		if(document.getElementById('ddlSchDesc').selectedIndex != 0)
		{
			document.getElementById('spAmount').innerHTML = $("#ddlSchDesc")[0].options[document.getElementById('ddlSchDesc').selectedIndex].getAttribute("amount");
			document.getElementById('hid_scheme_amount').value = document.getElementById('spAmount').innerHTML;
		}
	}	
	function setLoadValues()
	{
		document.getElementById('ddlSchDesc').value = document.getElementById('hidScheme').value;		
		document.getElementById('ddlRetType').value = document.getElementById('hidRetType').value;		
		document.getElementById('ddlState').value = document.getElementById('hidStateID').value;		
		getCityNameOnLoad('<?php echo base_url()."local_area/getCity/"; ?>');				
	}	
</script>

</head>

<body class="twoColFixLtHdr" onLoad="setLoadValues()">
<div id="container">
  <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("a_menu.php"); ?> 
  </div>  
  <div class="bck">
  <h2>Edit Super Dealer Registration</h2>
        <?php
	if($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";}	
	if($message != ''){
	echo "<div class='message'>".$message."</div>";}
	$user_id = $this->uri->segment(3);
	$result_user = $this->db->query("select * from tblusers where user_id=?",array($user_id));	
	?>

<form method="post" action="md_dealer_edit" name="frmdistributer_form1" id="frmdistributer_form1" autocomplete="off">
<input type="hidden" name="hiduserid" id="hiduserid" value="<?php echo $user_id; ?>" />
<fieldset>
<legend>Personal Information</legend>
<table cellpadding="5" cellspacing="0" bordercolor="#f5f5f5" width="80%" border="0">
<tbody>
<tr>
<td align="right"><label for="txtDistname"><span style="color:#F06">*</span>Super Dealer Name :</label></td><td align="left"><input type="text" class="text" title="Enter Master Dealer Name." value="<?php echo $result_user->row(0)->business_name; ?>" id="txtDistname" name="txtDistname"  maxlength="100"/>
</td>
<!--<td align="right"><label for="ddlDistname"><span style="color:#F06">*</span>Under Parent Name :</label></td><td align="left">
<select id="ddlDistname" name="ddlDistname" class="select" title="Select Master Dealer Name.">
<option>--Select--</option>
<?php
		$str_query = "select * from tblusers where usertype_name = ? order by business_name";
		$result = $this->db->query($str_query,array('SuperDealer'));		
		for($i=0; $i<$result->num_rows(); $i++)
		{
			echo "<option value='".$result->row($i)->user_id	."'>".$result->row($i)->business_name."</option>";
		}
?>
</select>
<input type="hidden" name="hidParentID" id="hidParentID" value="<?php echo $result_user->row(0)->parent_id; ?>" />
</td>
</tr>--></tbody>
<tr>
<td align="right"><label for="txtPostalAddr"><span style="color:#F06">*</span> Postal Address :</label></td><td align="left"><textarea title="Enter Postal Address" id="txtPostalAddr" name="txtPostalAddr" class="text"><?php echo $result_user->row(0)->postal_address; ?></textarea>
</td>
<td align="right"><label for="txtPin"><span style="color:#F06">*</span>  Pin Code :</label></td><td align="left"><input type="text" class="text" id="txtPin" onKeyPress="return isNumeric(event);" value="<?php echo $result_user->row(0)->pincode; ?>" name="txtPin" maxlength="8" title="Enter Pin Code." />
</td>
</tr>
<tr>
</tr>
<tr>
<td align="right"><label for="ddlState">State :</label></td><td align="left">
<input type="hidden" name="hidStateCode" id="hidStateCode" />
<select class="select" id="ddlState" name="ddlState" onChange="getCityName('<?php echo base_url()."local_area/getCity/"; ?>')" title="Select State.<br />Click on drop down"><option value="0">Select State</option>
<?php
$str_query = "select * from tblstate order by state_name";
		$result = $this->db->query($str_query);		
		for($i=0; $i<$result->num_rows(); $i++)
		{
			echo "<option code='".$result->row($i)->codes."' value='".$result->row($i)->state_id."'>".$result->row($i)->state_name."</option>";
		}
?>
</select>
<input type="hidden" id="hidStateID" value="<?php echo $result_user->row(0)->state_id; ?>" /> 
</td>
<td align="right"><label for="ddlCity">City/District :</label></td><td align="left"><select class="select" id="ddlCity" name="ddlCity" title="Select City.<br />Click on drop down"><option value="0">Select City</option>
</select>
<input type="hidden" id="hidCityID" value="<?php echo $result_user->row(0)->city_id; ?>" /> 
</td>
</tr>
<tr>
<td align="right"><label for="txtMobNo"><span style="color:#F06">*</span> Mobile No :</label></td><td align="left">+91<input type="text" class="text"  onKeyPress="return isNumeric(event);" title="Enter Mobile No.<br />e.g. 9898980000" id="txtMobNo" name="txtMobNo" value="<?php echo $result_user->row(0)->mobile_no; ?>" maxlength="10"/>
</td>
<td align="right"><label for="txtLandNo">Landline :</label></td><td align="left"><input type="text" class="text" id="txtLandNo" name="txtLandNo" value="<?php echo $result_user->row(0)->landline; ?>" onKeyPress="return isNumeric(event);" title="Enter Landline No.<br />e.g 07926453647" maxlength="11" /></td>
</tr>
<tr>
<td align="right"><label for="ddlRetType">Retailer Type :</label></td><td align="left"><select class="select" id="ddlRetType" name="ddlRetType" title="Select Retailer Type.<br />Click on drop down"><option>Select Retailer Type</option>
<?php
$str_query = "select * from tblratailertype order by retailer_type_name";
		$result = $this->db->query($str_query);		
		for($i=0; $i<$result->num_rows(); $i++)
		{
			echo "<option value='".$result->row($i)->retailer_type_id."'>".$result->row($i)->retailer_type_name."</option>";
		}
?>
</select>
 <input type="hidden" id="hidRetType" value="<?php echo $result_user->row(0)->retailer_type_id; ?>" /> 
</td>
<td align="right"><label for="txtEmail"><span style="color:#F06">*</span> Email :</label></td><td align="left"><input type="text" class="text" id="txtEmail" value="<?php echo $result_user->row(0)->emailid; ?>" title="Enter Email ID.<br />e.g some@gmail.com" name="txtEmail"  maxlength="150"/><br />
<span id="emailidInfo"></span>
</td>
</tr>
<tr>
<td align="right"><label for="txtpanNo">Pan No :</label></td><td align="left"><input type="text" name="txtpanNo" id="txtpanNo"  value="<?php echo $result_user->row(0)->pan_no; ?>"/></td>
<td align="right"><label for="txtConPer"><span style="color:#F06">*</span> Contact Person :</label></td><td align="left"><input type="text" class="text" id="txtConPer" title="Enter Contact No." name="txtConPer" value="<?php echo $result_user->row(0)->contact_person; ?>"  maxlength="150"/><br />
<span id="emailidInfo"></span>
</td>
</tr>
</table>
</fieldset>
<fieldset>
<legend>Scheme Details</legend>
<table cellpadding="5" cellspacing="0" bordercolor="#f5f5f5" width="80%" border="0">
  <tr>
    <td align="right"><label for="ddlSchDesc"><span style="color:#F06">*</span> Scheme :</label></td>
    <td align="left"><select class="select" id="ddlSchDesc" onChange="ChangeAmount()" title="Select Scheme Name.<br />Click on drop down" name="ddlSchDesc">
      <option>Select Scheme</option>
      <?php
$str_query = "select * from tblscheme where scheme_type='SuperDealer'";
		$resultScheme = $this->db->query($str_query);		
		for($i=0; $i<$resultScheme->num_rows(); $i++)
		{
			echo "<option amount='".$resultScheme->row($i)->amount."' value='".$resultScheme->row($i)->scheme_id."'>".$resultScheme->row($i)->scheme_name."</option>";
		}
?>
      </select>
     <input type="hidden" id="hidScheme" value="<?php echo $result_user->row(0)->scheme_id; ?>" /> 
</td>
    <td align="right">Amount :</td>
    <td align="left"><span id="spAmount"><?php echo $result_user->row(0)->scheme_amount;?></span>
      <input type="hidden" id="hid_scheme_amount" name="hid_scheme_amount" value="<?php echo $result_user->row(0)->scheme_amount;?>" /></td>    
  </tr>
  <tr>
    <td></td>
    <td align="left"><input type="submit" style="width:140px" class="button" id="btnSubmit" name="btnSubmit" value="Update Details"/>
      <input type="reset" class="button" id="bttnCancel" name="bttnCancel" value="Cancel"/></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="4">The field marked with <span style="color:#F06">*</span> are mandatory.</td>
  </tr>
  
</table>
</fieldset>
</form>
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>