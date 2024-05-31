<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Distributor Registration Form</title>
<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                       
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
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

function getAreaName(urlToSend)
	{
		if(document.getElementById('ddlCity').selectedIndex != 0)
		{
		$.ajax({
  type: "GET",
  url: urlToSend+""+document.getElementById('ddlCity').value,
  success: function(html){
	  var html = "<option value='0'>Select Area</option>"+html+"<option value='0'>Other</option>";
    $("#ddlArea").html(html);
  }
});
		}
	}


$(document).ready(function(){
	//global vars
	var form = $("#frmdistributer_form1");
	var dname = $("#txtDistname");var dnameInfo = $("#dnameInfo");var postaladdr = $("#txtPostalAddr");
	var postaladdrInfo = $("#postaladdrInfo");var landmark = $("#txtLandmark");var landmarkInfo = $("#landmarkInfo");
	var pin = $("#txtPin");var pinInfo = $("#pinInfo");var conper = $("#txtConPer");var conperInfo = $("#conperInfo");
	var mobileno = $("#txtMobNo");var mobilenoInfo = $("#mobilenoInfo");var emailid = $("#txtEmail");
	var emailidInfo = $("#emailidInfo");
	var ddlbank = $("#ddlBank");
	var ddlbankInfo = $("ddlbankInfo");	
	var acno = $("#txtAcNo");
	var acnoInfo = $("#acnoInfo");
	var ddlorg = $("#ddlOrg");
	var ddlorgInfo = $("#orgInfo");
	var ddlschdesc = $("#ddlSchDesc");
	var ddlschdescInfo = $("#schdescInfo");

	//On blur
	dname.blur(validateDname);postaladdr.blur(validateAddress);landmark.blur(validateLandmark);
	pin.blur(validatePin);conper.blur(validateConper);mobileno.blur(validateMobileno);emailid.blur(validateEmail);
	ddlbank.blur(validateBank);acno.blur(validateAccountno);ddlorg.blur(validateOrganisation);ddlschdesc.blur(validateScheme);
	
	//On Submitting
	form.submit(function(){
		if(validateDname() & validateAddress() & validateLandmark() & validatePin() & validateConper() & validateMobileno() & validateEmail() & validateBank() & validateAccountno() & validateOrganisation() & validateScheme())
			{				
			return true;
			}
		else
			return false;
	});
	//validation functions
	
	function validateDname(){
		//if it's NOT valid
		if(dname.val() == ""){
			dname.addClass("error");
			dnameInfo.text("");
			dnameInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			dname.removeClass("error");
			dnameInfo.text("");
			dnameInfo.removeClass("error");
			return true;
		}		
	}
	
	function validateAddress(){
		//if it's NOT valid
		if(postaladdr.val() == ""){
			postaladdr.addClass("error");
			postaladdrInfo.text("");
			postaladdrInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			postaladdr.removeClass("error");
			postaladdrInfo.text("");
			postaladdrInfo.removeClass("error");
			return true;
		}
		
	}
	function validateLandmark(){
		//if it's NOT valid
		if(landmark.val() == ""){
			landmark.addClass("error");
			landmarkInfo.text("");
			landmarkInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			landmark.removeClass("error");
			landmarkInfo.text("");
			landmarkInfo.removeClass("error");
			return true;
		}
	}
	function validatePin(){
		//if it's NOT valid
		if(pin.val() == ""){
			pin.addClass("error");
			pinInfo.text("");
			pinInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			pin.removeClass("error");
			pinInfo.text("");
			pinInfo.removeClass("error");
			return true;
		}
		
	}
	function validateConper(){
		//if it's NOT valid
		if(conper.val().length < 3){
			conper.addClass("error");
			conperInfo.text("");
			conperInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			conper.removeClass("error");
			conperInfo.text("");
			conperInfo.removeClass("error");
			return true;
		}
		
	}
	function validateMobileno(){
		if(mobileno.val().length < 3){
			mobileno.addClass("error");
			mobilenoInfo.text("Enter 10 digit mobile number");
			return false;
		}
		//if it's valid
		else{
			mobileno.removeClass("error");
			mobilenoInfo.text("");			
			return true;
		}
	}
	function validateEmail(){
		//testing regular expression
		var a = $("#txtEmail").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		//if it's valid email
		if(filter.test(a)){
			emailid.removeClass("error");
			emailidInfo.text("");
			return true;
		}
		//if it's NOT valid
		else{
			emailid.addClass("error");
			emailidInfo.text("Type a valid e-mail please.");
			return false;

		}
	}
	function validateBank(){
		//if it's NOT valid
		if(ddlbank[0].selectedIndex == 0){
			ddlbank.addClass("error");
			ddlbankInfo.text("");
			ddlbankInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			ddlbank.removeClass("error");
			ddlbankInfo.text("");
			ddlbankInfo.removeClass("error");
			return true;
		}
		
	}
	function validateAccountno(){
		//if it's NOT valid
		if(acno.val() == ""){
			acno.addClass("error");
			acnoInfo.text("");
			acnoInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			acno.removeClass("error");
			acnoInfo.text("");
			acnoInfo.removeClass("error");
			return true;
		}
		
	}
	function validateOrganisation(){
		//if it's NOT valid
		if(ddlorg[0].selectedIndex == 0){
			ddlorg.addClass("error");
			ddlorgInfo.text("");
			ddlorgInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			ddlorg.removeClass("error");
			ddlorgInfo.text("");
			ddlorgInfo.removeClass("error");
			return true;
		}
		
	}	
	function validateScheme(){
		//if it's NOT valid
		if(ddlschdesc[0].selectedIndex == 0){
			ddlschdesc.addClass("error");
			ddlschdescInfo.text("");
			ddlschdescInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			ddlschdesc.removeClass("error");
			ddlschdescInfo.text("");
			ddlschdescInfo.removeClass("error");
			return true;
		}
	}
});
function setName()
{
	document.getElementById('hidDistname').value = document.getElementById('txtDistname').options[document.getElementById('txtDistname').selectedIndex].text;
}
	 
	function ChangeAmount()
	{
		if(document.getElementById('ddlSchDesc').selectedIndex != 0)
		{
			document.getElementById('spAmount').innerHTML = 			$("#ddlSchDesc")[0].options[document.getElementById('ddlSchDesc').selectedIndex].getAttribute("amount");

			document.getElementById('hid_scheme_amount').value = document.getElementById('spAmount').innerHTML;
		}
	}
	function SetPaymentMode()
	{
		if(document.getElementById('radCash').checked == true)
		{
			document.getElementById('txtChqDDNo').value="-";
			document.getElementById('txtChqDDDate').value="-";			
			document.getElementById('txtChqDDNo').disabled = true;
			document.getElementById('txtChqDDDate').disabled = true;
		}
		else
		{
			document.getElementById('txtChqDDNo').value="";
			document.getElementById('txtChqDDDate').value="";			
			document.getElementById('txtChqDDNo').disabled = false;
			document.getElementById('txtChqDDDate').disabled = false;
		}		
	}
	   
	function  setAccount()
	{
		if(document.getElementById('ddlDepBank').selectedIndex != 0)
		{
			document.getElementById('deposit_account_no').innerHTML = "Account No : "+$("#ddlDepBank")[0].options[document.getElementById('ddlDepBank').selectedIndex].getAttribute('account_no');
		}
		else{document.getElementById('deposit_account_no').innerHTML="";}
	}
	 function setValues()
	 {		 
 		 document.getElementById('ddlRetType').value = document.getElementById('hidRetailerType').value;
 		 document.getElementById('ddlState').value = document.getElementById('hidState').value;		 
 	 	 getCityNameOnLoad(document.getElementById('hidCityURL').value);
		 document.getElementById('ddlBank').value = document.getElementById('hidBankID').value;		
		 document.getElementById('ddlAcType').value  =document.getElementById('hidAccountType1').value;
		 document.getElementById('ddlOrg').value = document.getElementById('hidOrganisation').value;
		 document.getElementById('ddlPreLang').value = document.getElementById('hidLanguage').value;  
		 document.getElementById('ddlAddBank').value = document.getElementById('hidBankId2').value; 
		 document.getElementById('ddlAcType_2').value = document.getElementById('hidAccountType2').value;  
         document.getElementById('ddlSchDesc').value = document.getElementById('hidSchemeID').value;  		
		  if(document.getElementById('hidPaymode').value == "Cash")
		 {document.getElementById('radCash').checked = true;}
		 else if(document.getElementById('hidPaymode').value == "Cheque"){document.getElementById('radCheque').checked=true;}
		 else if(document.getElementById('hidPaymode').value == "DD/RTGS"){document.getElementById('radDD').checked=true;}
         document.getElementById('ddlDepBank').value = document.getElementById('hidDepBankID').value;
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
	document.getElementById('ddlCity').value=document.getElementById('hidCityCode').value;
		getAreaNameOnLoad(document.getElementById('hidAreaUrl').value);
  }
});
		}
	}
function getAreaNameOnLoad(urlToSend)
	{	
		if(document.getElementById('ddlCity').selectedIndex != 0)
		{			
		$.ajax({
  type: "GET",
  url: urlToSend+""+document.getElementById('ddlCity').value,
  success: function(html){
	  var html = "<option value='0'>Select Area</option>"+html+"<option value='0'>Other</option>";
    $("#ddlArea").html(html);	
			document.getElementById('ddlArea').value=document.getElementById('hidAreaCode').value;		
  }
});
		}
	}	
</script>

</head>

<body class="twoColFixLtHdr" onLoad="setValues()">
<div id="container">
  <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("a_menu.php"); ?> 
  </div>
  <div id="back-border">
  </div>
  <div>
    <h2>Edit Distributer Registration</h2>
    <?php 
	$user_id = $this->uri->segment(3);
	$result_dist = $this->db->query("select * from tblusers where user_id=?",array($user_id));	
	?>
    
<form method="post" action="d_edit_registration" name="frmdistributer_form1" id="frmdistributer_form1" autocomplete="off">
<fieldset>
<legend>Personal Information</legend>
<table cellpadding="5" cellspacing="0" bordercolor="#f5f5f5" width="80%" border="0">
<input type="hidden" name="hiduserid" id="hiduserid" value="<?php echo $user_id; ?>" />
<tr>
<td align="right"><label for="txtDistname"><span style="color:#F06">*</span>Distributor Name :</label></td><td align="left"><input type="text" class="text" value="<?php echo $result_dist->row(0)->business_name; ?>" title="Enter Distributer Name." id="txtDistname" name="txtDistname"  maxlength="100"/>
<span id="dnameInfo"></span>
</td>
<td></td><td></td>
</tr>
<tr>
<td align="right"><label for="txtPostalAddr"><span style="color:#F06">*</span> Postal Address :</label></td><td align="left"><textarea title="Enter Postal Address" id="txtPostalAddr" name="txtPostalAddr" class="text"><?php echo $result_dist->row(0)->postal_address; ?></textarea>
<span id="postaladdrInfo"></span>
</td>
<td align="right"><label for="txtLandmark"><span style="color:#F06">*</span> Landmark :</label></td>
<td align="left"><input type="text" value="<?php echo $result_dist->row(0)->landmark; ?>" title="Enter Lanmark" id="txtLandmark" name="txtLandmark" class="text" />
<span id="landmarkInfo"></span>
</td>
</tr>
<tr>
<td align="right"><label for="txtPin"><span style="color:#F06">*</span>  Pin Code :</label></td><td align="left"><input type="text" class="text" id="txtPin" value="<?php echo $result_dist->row(0)->pincode; ?>" onKeyPress="return isNumeric(event);" name="txtPin" maxlength="8" title="Enter Pin Code." />
<span id="pinInfo"></span>
</td>
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
<input type="hidden" name="hidState" id="hidState" value="<?php echo $result_dist->row(0)->state_id; ?>" />
<input type="hidden" name="hidCityURL" id="hidCityURL" value="<?php echo base_url()."local_area/getCity/" ?>" />
<input type="hidden" name="hidAreaUrl" id="hidAreaUrl" value="<?php echo base_url()."local_area/getArea/"; ?>" />
</td>
<td align="right"><label for="ddlCity">City/District :</label></td><td align="left"><select class="select" id="ddlCity" name="ddlCity" onChange="getAreaName('<?php echo base_url()."local_area/getArea/"; ?>')" title="Select City.<br />Click on drop down"><option value="0">Select City</option>
</select>
<input type="hidden" name="hidCityCode" id="hidCityCode" value="<?php echo $result_dist->row(0)->city_id; ?>" />

</td>
</tr>
<tr>
<td align="right"><label for="txtConPer"><span style="color:#F06">*</span> Contact Person :</label></td><td align="left"><input title="Enter Contact Person Name." value="<?php echo $result_dist->row(0)->contact_person; ?>" type="text" class="text" id="txtConPer" name="txtConPer" maxlength="50"/>
<span id="conperInfo"></span>
</td>
</tr>
<tr>
<td align="right"><label for="txtMobNo"><span style="color:#F06">*</span> Mobile No :</label></td><td align="left">+91<input type="text" class="text" value="<?php echo $result_dist->row(0)->mobile_no; ?>" onKeyPress="return isNumeric(event);" title="Enter Mobile No.<br />e.g. 9898980000" id="txtMobNo" name="txtMobNo" maxlength="10"/>
<span id="mobilenoInfo"></span>
</td>
<td align="right"><label for="txtLandNo">Landline :</label></td><td align="left"><input type="text" class="text" id="txtLandNo" name="txtLandNo" value="<?php echo $result_dist->row(0)->landline; ?>" onKeyPress="return isNumeric(event);" title="Enter Landline No.<br />e.g 07926453647" maxlength="11" /></td>
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
<input type="hidden" name="hidRetailerType" id="hidRetailerType" value="<?php echo $result_dist->row(0)->retailer_type_id; ?>" />
</td>
<td align="right"><label for="txtEmail"><span style="color:#F06">*</span> Email :</label></td><td align="left"><input type="text" class="text" value="<?php echo $result_dist->row(0)->emailid; ?>" id="txtEmail" title="Enter Email ID.<br />e.g some@gmail.com" name="txtEmail"  maxlength="150"/><br />
<span id="emailidInfo"></span>
</td>
</tr>
</table>
</fieldset>
<fieldset>
<legend>Bank Details</legend>
<table cellpadding="5" cellspacing="0" bordercolor="#f5f5f5" width="80%" border="0">
<tr>
<td align="right"><label for="ddlBank"><span style="color:#F06">*</span> Bank :</label></td><td align="left"><select id="ddlBank" name="ddlBank" title="Select Bank Name.<br />Click on drop down" class="select"><option>Select Bank</option>
<?php
$str_query = "select * from tblbank";
		$result = $this->db->query($str_query);		
		for($i=0; $i<$result->num_rows(); $i++)
		{
			echo "<option value='".$result->row($i)->bank_id."'>".$result->row($i)->bank_name."</option>";
		}
?>
</select>
<input type="hidden" name="hidBankID" id="hidBankID" value="<?php echo $result_dist->row(0)->bank_id; ?>" />
<span id="ddlbankInfo"></span>
</td>
<td align="right"><label for="ddlAddBank">Additional Bank :</label></td><td align="left"><select class="select" id="ddlAddBank" name="ddlAddBank" title="Select Additional Bank Name.<br />Click on drop down"><option value="0">--Select--</option>
<?php 
	for($i=0; $i<$result->num_rows(); $i++)
		{
			echo "<option value='".$result->row($i)->bank_id."'>".$result->row($i)->bank_name."</option>";
		}
?>
</select>
<input type="hidden" name="hidBankId2" id="hidBankId2" value="<?php echo $result_dist->row(0)->bank_id_2; ?>" />
</td>
</tr>
<tr>
<td align="right"><label for="ddlAcType">Account Type :</label></td><td align="left"><select class="select" id="ddlAcType" name="ddlAcType" title="Select Account Type.<br />Click on drop down"><option value="SAVING">SAVING</option>
  <option value="CURRENT">CURRENT</option>
  <option value="OD">OD</option>
  </select>
  <input type="hidden" name="hidAccountType1" id="hidAccountType1" value="<?php echo $result_dist->row(0)->account_type; ?>" />
</td>
<td align="right"><label for="ddlAcType_2">Additional A/C Type :</label></td><td align="left"><select class="select" id="ddlAcType_2" name="ddlAcType_2" title="Select Account Type.<br />Click on drop down"><option value="SAVING">SAVING</option>
<option value="CURRENT">CURRENT</option>
<option value="OD">OD</option>
</select>
<input type="hidden" name="hidAccountType2" id="hidAccountType2" value="<?php echo $result_dist->row(0)->account_type_2; ?>" />
</td>
</tr>
<tr>
<td align="right"><label for="txtAcNo"><span style="color:#F06">*</span> Account No :</label></td><td align="left"><input type="text" class="text" value="<?php echo $result_dist->row(0)->account_no; ?>" id="txtAcNo" title="Enter Account No<br />e.g 100000005010" name="txtAcNo" maxlength="50"/>
  <span id="acnoInfo"></span>
</td>
<td align="right"><label for="txtAddAcNo2">Additional A/C No2 :</label></td><td align="left"><input type="text" class="text" id="txtAddAcNo2" value="<?php echo $result_dist->row(0)->account_no_2; ?>" title="Enter Account No 2.<br />e.g 1000002323900" name="txtAddAcNo2" maxlength="30"/></td>
</tr>
<tr>
<tr>
<td align="right"><label for="ddlOrg"><span style="color:#F06">*</span> Organisation :</label></td><td align="left"><select class="select" id="ddlOrg" title="Select Organisation.<br />Click on drop down" name="ddlOrg">
<option>--Select--</option>
<option value="Proprietor">Proprietor</option>
<option value="Partnership">Partnership</option>
<option value="Private LTD">Private LTD</option>
<option value="Public LTD">Public LTD</option>
</select>
<span id="orgInfo"></span>
<input type="hidden" name="hidOrganisation" id="hidOrganisation" value="<?php echo $result_dist->row(0)->ordganisation; ?>" />
</td>
<td align="right"><label for="ddlPreLang">Prefered Language :</label></td><td align="left"><select class="select" id="ddlPreLang" name="ddlPreLang" title="Select Prefered Language.<br />Click on drop down"><option>--Select--</option><option value="English">English</option><option value="Gujarati">Gujarati</option><option value="Hindi">Hindi</option></select>
<input type="hidden" name="hidLanguage" id="hidLanguage" value="<?php echo $result_dist->row(0)->prefered_language; ?>" />
</td>
</tr>
<tr>
<td align="right"><label for="ddlSchDesc"><span style="color:#F06">*</span> Scheme :</label></td><td align="left"><select class="select" id="ddlSchDesc" onChange="ChangeAmount()" title="Select Scheme Name.<br />Click on drop down" name="ddlSchDesc"><option>Select Scheme</option>
<?php
$str_query = "select * from tblscheme where scheme_type='Distributer'";
		$resultScheme = $this->db->query($str_query);		
		for($i=0; $i<$resultScheme->num_rows(); $i++)
		{
			echo "<option amount='".$resultScheme->row($i)->amount."' value='".$resultScheme->row($i)->scheme_id."'>".$resultScheme->row($i)->scheme_name."</option>";
		}
?>

</select>
<input type="hidden" name="hidSchemeID" id="hidSchemeID" value="<?php echo $result_dist->row(0)->scheme_id; ?>" />
<span id="schdescInfo"></span>
</td><td></td>
</tr>
<tr>
<td align="right"><label for="radPayMode">Payment Mode :</label></td><td colspan="2"><input type="radio" onClick="SetPaymentMode()" value="Cash" id="radCash" name="radPayMode"/>Cash <input type="radio" onClick="SetPaymentMode()" value="Cheque" id="radCheque" name="radPayMode" checked="checked"/>Cheque <input type="radio" onClick="SetPaymentMode()" value="DD/RTGS" id="radDD" name="radPayMode"/>DD/NFST/RTGS/Transfer
<input type="hidden" name="hidPaymode" id="hidPaymode" value="<?php echo $result_dist->row(0)->payment_mode; ?>" />
</td>

</tr>
<tr>
<td align="right"><label for="txtChqDDNo">Chq No./DD No. :</label></td><td align="left"><input type="text" class="text" id="txtChqDDNo" name="txtChqDDNo" value="<?php echo $result_dist->row(0)->cheque_dd_no; ?>" title="Enter Cheque No or Demand Draft No." maxlength="30"/></td>
<td align="right"><label for="txtChqDDDate">Cheque/DD Date. :</label></td><td align="left"><input type="text" class="text" id="txtChqDDDate" value="<?php echo $result_dist->row(0)->cheque_dd_date; ?>" title="Enter Cheque Date or Demand Draft No." name="txtChqDDDate" maxlength="50"/></td>
</tr>
<tr>
<td align="right"><label for="ddlDepBank">Depositing Bank :</label></td><td align="left"><select class="select" id="ddlDepBank" onChange="setAccount()" name="ddlDepBank" title="Select Deposit Bank Name.<br />Click on drop down"><option value="0">--Select--</option>
<?php echo $admin_bank;?>
</select>
<span id="deposit_account_no" style="font-weight:bold;"></span>
<input type="hidden" name="hidDepBankID" id="hidDepBankID" value="<?php echo $result_dist->row(0)->depositing_bank_id; ?>" />
</td>
</tr>
<tr>
<td align="right">Amount :</td><td align="left"><span id="spAmount"><?php echo $result_dist->row(0)->scheme_amount; ?></span>
<input type="hidden" id="hid_scheme_amount" name="hid_scheme_amount" value="<?php echo $result_dist->row(0)->scheme_amount; ?>" />
</td><td align="right"><label for="txtWorLimit">Working Limit :</label></td><td align="left"><input type="text" title="Enter Working Limit.<br />e.g 1500,2500" readonly="readonly" value="<?php echo $result_dist->row(0)->working_limit; ?>" onKeyPress="return isNumeric(event);" class="text" id="txtWorLimit" name="txtWorLimit" maxlength="50"/></td>
</tr>
<tr>
<td></td><td align="left"><input type="submit" style="width:180px" class="button" id="btnSubmit" name="btnSubmit" value="Submit Account Details"/> <input type="reset" class="button" id="bttnCancel" name="bttnCancel" value="Cancel"/></td><td></td><td></td>
</tr>
<tr>
<td colspan="4">The field marked with <span style="color:#F06">*</span> are mandatory</td>
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