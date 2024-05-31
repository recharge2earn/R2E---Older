<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Customer Registration Form</title>
<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
    <script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
    <script src="<?php echo base_url()."js/ui/jquery.ui.position.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.autocomplete.js"; ?>"></script>
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
$(document).ready(function(){
	//global vars
	var form = $("#frmretailer_form1");var fname = $("#txtFranName");var fnameInfo = $("#fnameInfo");
	var postaladdr = $("#txtPostalAddr");
	var postaladdrInfo = $("#postaladdrInfo");var landmark = $("#txtLandmark");var landmarkInfo = $("#landmarkInfo");
	var pin = $("#txtPin");var pinInfo = $("#pinInfo");var conper = $("#txtConPer");var conperInfo = $("#conperInfo");
	var mobileno = $("#txtMobNo");var mobilenoInfo = $("#mobilenoInfo");var emailid = $("#txtEmail");var emailidInfo = $("#emailidInfo");
	var ddlbank = $("#ddlBank");
	var ddlbankInfo=$("ddlbankInfo");
	var acno = $("#txtAcNo");
	var acnoInfo=$("acnoInfo");
	var ddlorg = $("#ddlOrg");
	var ddlorgInfo=$("orgInfo");
	var ddlschdesc = $("#ddlSchDesc");
	var ddlschdescInfo=$("schdescInfo");
	//On blur
	fname.blur(validateFname);postaladdr.blur(validateAddress);landmark.blur(validateLandmark);
	pin.blur(validatePin);conper.blur(validateConper);mobileno.blur(validateMobileno);emailid.blur(validateEmail);
	ddlbank.blur(validateBank);acno.blur(validateAccountno);ddlorg.blur(validateOrganisation);ddlschdesc.blur(validateScheme);
	//On Submitting
	form.submit(function(){
		if(validateFname() & validateAddress() & validateLandmark() & validatePin() & validateConper() & validateMobileno() & validateEmail() & validateBank() & validateAccountno() & validateOrganisation() & validateScheme())
			{				
			return true;
			}
		else
			return false;
	});
	//validation functions
	function validateFname(){
		//if it's NOT valid
		if(fname.val() == ""){
			fname.addClass("error");
			//jAlert('Enter Retailer Name.<br /> e.g Suresh', 'Alert Dialog');
			fnameInfo.text("");
			fnameInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			fname.removeClass("error");
			fnameInfo.text("");
			fnameInfo.removeClass("error");
			return true;
		}		
	}
	
	function validateAddress(){
		//if it's NOT valid
		if(postaladdr.val() == ""){
			postaladdr.addClass("error");
			//jAlert('Enter Postal Address.', 'Alert Dialog');
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
			//jAlert('Enter Lanmark.<br /> e.g Airport Circle', 'Alert Dialog');
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
			//jAlert('Enter Pin Code.<br />e.g 380061', 'Alert Dialog');
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
			//jAlert('Enter Contact Person Name.<br /> e.g Mahesh', 'Alert Dialog');
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
		if(mobileno.val().length < 10){
			mobileno.addClass("error");
			mobilenoInfo.text("Enter 10 digit mobile number");
			//jAlert('Enter 10 digit mobile number.<br />e.g. 9898792545.', 'Alert Dialog');
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
			//jAlert('Select Bank Name.<br />Click on drop down', 'Alert Dialog');
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
			//jAlert('Enter Account No<br />e.g 3120001245412', 'Alert Dialog');
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
			//jAlert('Select Organisation.<br />Click on drop down', 'Alert Dialog');
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
			//jAlert('Select Scheme Name.<br />Click on drop down', 'Alert Dialog');
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
	setTimeout(function(){$('div.message').fadeOut(1000);}, 10000);
});
function setName()
{
	document.getElementById('hidDistname').value = document.getElementById('txtDistname').options[document.getElementById('txtDistname').selectedIndex].text;
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
	function ChangeAmount()
	{
		if(document.getElementById('ddlSchDesc').selectedIndex != 0)
		{
			document.getElementById('spAmount').innerHTML = 			$("#ddlSchDesc")[0].options[document.getElementById('ddlSchDesc').selectedIndex].getAttribute("amount");

			document.getElementById('hid_scheme_amount').value = document.getElementById('spAmount').innerHTML;
		}
	}
	function  setAccount()
	{
		if(document.getElementById('ddlDepBank').selectedIndex != 0)
		{
			var varAccount_no=$("#ddlDepBank")[0].options[document.getElementById('ddlDepBank').selectedIndex].getAttribute('account_no');
			var varBranch_name=$("#ddlDepBank")[0].options[document.getElementById('ddlDepBank').selectedIndex].getAttribute('branch_name');
			var varIfsc_code=$("#ddlDepBank")[0].options[document.getElementById('ddlDepBank').selectedIndex].getAttribute('ifsc_code');			
			document.getElementById('deposit_account_no').innerHTML = "<br />Account No : "+varAccount_no+"<br />IFSC Code : "+varIfsc_code+"<br />Branch Name : "+varBranch_name;
		}
		else{document.getElementById('deposit_account_no').innerHTML="";}
	}
</script>

</head>

<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("general_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("general_menu.php"); ?> 
  </div>
  <div id="back-border">
  </div>
  <div>
    <h2>Customer Registration</h2>
            <?php
	if($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";}
	?>  
<form method="post" action="c_customer_registration" name="frmretailer_form1" id="frmretailer_form1" autocomplete="off">
<fieldset>
<legend>Personal Information</legend>
<table cellpadding="5" cellspacing="0" bordercolor="#f5f5f5" width="80%" border="0">
<tr>
<td align="right"><label for="txtFranName"><span style="color:#F06">*</span>Customer Name :</label></td><td align="left"><input type="text" class="text" title="Enter Customer Name." id="txtFranName" name="txtFranName"  maxlength="100"/>
<span id="fnameInfo"></span>
</td>
<td></td><td></td>
</tr>
<tr>
<td align="right"><label for="txtPostalAddr"><span style="color:#F06">*</span> Postal Address :</label></td><td align="left"><textarea title="Enter Postal Address" id="txtPostalAddr" name="txtPostalAddr" class="text"></textarea>
<span id="postaladdrInfo"></span>
</td>
<td align="right"><label for="txtLandmark"><span style="color:#F06">*</span> Landmark :</label></td>
<td align="left"><input type="text" title="Enter Lanmark" id="txtLandmark" name="txtLandmark" class="text" />
<span id="landmarkInfo"></span>
</td>
</tr>
<tr>
<td align="right"><label for="txtPin"><span style="color:#F06">*</span>  Pin Code :</label></td><td align="left"><input type="text" class="text" id="txtPin" onKeyPress="return isNumeric(event);" name="txtPin" maxlength="8" title="Enter Pin Code." />
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
</select></td>
<td align="right"><label for="ddlCity">City/District :</label></td><td align="left"><select class="select" id="ddlCity" name="ddlCity" title="Select City.<br />Click on drop down"><option value="0">Select City</option>
</select></td>
</tr>
<tr>
<td align="right"><label for="txtConPer"><span style="color:#F06">*</span> Contact Person :</label></td><td align="left"><input title="Enter Contact Person Name." type="text" class="text" id="txtConPer" name="txtConPer" maxlength="50"/>
<span id="conperInfo"></span>
</td>
</tr>
<tr>
<td align="right"><label for="txtMobNo"><span style="color:#F06">*</span> Mobile No :</label></td><td align="left">+91<input type="text" class="text" onKeyPress="return isNumeric(event);" title="Enter Mobile No.<br />e.g. 9898980000" id="txtMobNo" name="txtMobNo" maxlength="10"/>
<span id="mobilenoInfo"></span>
</td>
<td align="right"><label for="txtLandNo">Landline :</label></td><td align="left"><input type="text" class="text" id="txtLandNo" name="txtLandNo" onKeyPress="return isNumeric(event);" title="Enter Landline No.<br />e.g 07926453647" maxlength="11" /></td>
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
</select></td>
<td align="right"><label for="txtEmail"><span style="color:#F06">*</span> Email :</label></td><td align="left"><input type="text" class="text" id="txtEmail" title="Enter Email ID.<br />e.g some@gmail.com" name="txtEmail"  maxlength="150"/><br />
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
<span id="ddlbankInfo"></span>
</td><td align="right">Additional Bank :</td><td align="left"><select class="select" id="ddlAddBank" name="ddlAddBank" title="Select Additional Bank Name.<br />Click on drop down">
  <option value="0">--Select--</option>
  <?php
	for($i=0; $i<$result->num_rows(); $i++)
		{
			echo "<option value='".$result->row($i)->bank_id."'>".$result->row($i)->bank_name."</option>";
		}
?>
</select></td>
</tr>
<tr>
<td align="right"><label for="ddlAcType">Account Type :</label></td><td align="left"><select class="select" id="ddlAcType" name="ddlAcType" title="Select Account Type.<br />Click on drop down"><option>SAVING</option>
<option>CURRENT</option>
<option>OD</option>
</select></td>
<td align="right">Additional A/C Type :</td><td><select class="select" id="ddlAcType_2" name="ddlAcType_2" title="Select Account Type.<br />Click on drop down">
  <option>SAVING</option>
  <option>CURRENT</option>
  <option>OD</option>
</select></td>
</tr>
<tr>
<td align="right"><label for="txtAcNo"><span style="color:#F06">*</span> Account No :</label></td><td align="left"><input type="text" class="text" id="txtAcNo" title="Enter Account No<br />e.g 100000005010" name="txtAcNo" maxlength="50"/>
<span id="acnoInfo"></span>
</td>
<td align="right">Additional A/C No2 :</td><td><input type="text" class="text" id="txtAddAcNo2" title="Enter Account No 2.<br />e.g 1000002323900" name="txtAddAcNo2" maxlength="30"/></td>
</tr>
<tr>
<td align="right"><label for="ddlOrg"><span style="color:#F06">*</span> Organisation :</label></td><td align="left"><select class="select" id="ddlOrg" title="Select Organisation.<br />Click on drop down" name="ddlOrg">
<option>--Select--</option>
<option>Proprietor</option>
<option>Partnership</option>
<option>Private LTD</option>
<option>Public LTD</option>
</select>
<span id="orgInfo"></span>
</td>
<td align="right"></td><td align="left"></td>
</tr>
<tr>
  <td align="right"><label for="ddlSchDesc"><span style="color:#F06">*</span> Scheme :</label></td><td align="left"><select class="select" id="ddlSchDesc" onChange="ChangeAmount()" title="Select Scheme Name.<br />Click on drop down" name="ddlSchDesc"><option>Select Scheme</option>
  <?php
$str_query = "select * from tblscheme where scheme_type='Customer'";
		$resultScheme = $this->db->query($str_query);		
		for($i=0; $i<$resultScheme->num_rows(); $i++)
		{
			echo "<option amount='".$resultScheme->row($i)->amount."' value='".$resultScheme->row($i)->scheme_id."'>".$resultScheme->row($i)->scheme_name."</option>";
		}
?>
    
  </select>
  <span id="schdescInfo"></span>
  </td>
  <td></td><td></td>
</tr>
<tr>
<td align="right"><label for="radPayMode">Payment Mode :</label></td><td colspan="2"><input onClick="SetPaymentMode()" type="radio" value="Cash" id="radCash" name="radPayMode"/>Cash <input type="radio" onClick="SetPaymentMode()" value="Cheque" id="radCheque" name="radPayMode" checked="checked"/>Cheque <input type="radio" onClick="SetPaymentMode()" value="DD/RTGS" id="radDD" name="radPayMode"/>DD/NFST/RTGS/Transfer</td>

</tr>
<tr>
<td align="right"><label for="txtChqDDNo">Chq No./DD No. :</label></td><td align="left"><input type="text" class="text" id="txtChqDDNo" name="txtChqDDNo" title="Enter Cheque No or Demand Draft No." maxlength="30"/></td>
<td align="right"><label for="txtChqDDDate">Cheque/DD Date. :</label></td><td align="left"><input type="text" class="text" id="txtChqDDDate" title="Enter Cheque Date or Demand Draft No." name="txtChqDDDate" maxlength="50"/></td>
</tr>
<tr>
<td align="right" valign="top"><label for="ddlDepBank">Depositing Bank :</label></td><td colspan="3" align="left"><select class="select" id="ddlDepBank" onChange="setAccount()" name="ddlDepBank" title="Select Deposit Bank Name.<br />Click on drop down"><option value="0">--Select--</option>
<?php echo $this->common_value->getBankDetails(); ?>
</select>
<span id="deposit_account_no" style="font-weight:bold;"></span>
</td>
</tr>
<tr>
<td align="right">Amount :</td><td align="left"><span id="spAmount">0</span>
<input type="hidden" id="hid_scheme_amount" name="hid_scheme_amount" />
</td><td align="right"><label for="txtWorLimit">Credit Amount :</label></td><td align="left"><input type="text" title="Enter Working Limit.<br />e.g 1500,2500" onKeyPress="return isNumeric(event);" class="text" id="txtWorLimit" name="txtWorLimit" maxlength="50"/></td>
</tr>
<tr>
<td></td><td align="left"><input type="submit" style="width:180px" class="button" id="btnSubmit" name="btnSubmit" value="Submit Account Details"/> <input type="reset" class="button" id="bttnCancel" name="bttnCancel" value="Cancel"/></td><td></td><td></td>
</tr>
<tr>
<td colspan="4">The field marked with <span style="color:#F06">*</span>  are mandatory.</td>
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