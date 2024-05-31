<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Registration Form 1</title>
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

	//On blur
	dname.blur(validateDname);postaladdr.blur(validateAddress);landmark.blur(validateLandmark);
	pin.blur(validatePin);conper.blur(validateConper);mobileno.blur(validateMobileno);emailid.blur(validateEmail);
	
	//On Submitting
	form.submit(function(){
		if(validateDname() & validateAddress() & validateLandmark() & validatePin() & validateConper() & validateMobileno() & validateEmail())
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
});
	 
	 function EnableBox()
	 {		
		 if(document.getElementById('ddlArea').value == "0")
		 {
		 document.getElementById('OtherArea').style.display="block";
		 document.getElementById('txtOther').focus();
		 }
		 else
		 {
			 document.getElementById('OtherArea').style.display="none";
		 }
	 }
	 function setValues()
	 {		 
 		 document.getElementById('ddlRetType').value = document.getElementById('hidRetailerType').value;
 		 document.getElementById('ddlState').value = document.getElementById('hidState').value;		 
 	 	 getCityNameOnLoad(document.getElementById('hidCityURL').value);
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
    
<form method="post" action="edit_distributer_form1" name="frmdistributer_form1" id="frmdistributer_form1" autocomplete="off">
<fieldset>
<input type="hidden" name="hiduserid" id="hiduserid" value="<?php echo $user_id; ?>" />
<table cellpadding="3" cellspacing="3" width="80%" border="0">
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
<td align="right" valign="top"><label for="ddlArea">Suburb/ Local Area : </label></td><td align="left"><select class="select" id="ddlArea" name="ddlArea" onChange="EnableBox()" title="Select Local Area.<br />Click on drop down">
<option value="0">Select Area</option>
</select>
<input type="hidden" name="hidAreaCode" id="hidAreaCode" value="<?php echo $result_dist->row(0)->subarea_id; ?>" />

<div id="OtherArea" style="display:none">
<input type="text" class="text" title="Enter Other Local Area Name." id="txtOther" name="txtOther" />
</div>

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
<tr>
<td></td>
<td align="left"><input type="submit" class="button" style="width:160px" id="btnSubmit" name="btnSubmit" value="Submit Details & Next"/> <input type="reset" class="button" id="bttnCancel" name="bttnCancel" value="Cancel"/></td><td></td><td></td>
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
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>




</html>