<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Api User Registration</title>
   <?php include("script1.php"); ?>
    <link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>    
    
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
	var rname = $("#txtDistname");var postaladdr = $("#txtPostalAddr");
	var pin = $("#txtPin");var mobileno = $("#txtMobNo");var emailid = $("#txtEmail");
	var ddlsch = $("#ddlSchDesc");	var dname = $("#ddlDistname");
	//On Submitting
	form.submit(function(){
		if(validateRname() & validateAddress() & validatePin() & validateMobileno() & validateEmail())
			{				
			return true;
			}
		else
			return false;
	});
	//validation functions	
	function validateRname(){
		if(rname.val() == ""){
			rname.addClass("error");return false;
		}
		else{
			rname.removeClass("error");return true;
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
</script>
	<script language="javascript">
	function selectddlvalue()
	{
		var state_id = '<?php echo $regData['state_id']; ?>';
		var city_id = '<?php echo $regData['city_id']; ?>';
		var retailer_type_id = '<?php echo $regData['retailer_type_id']; ?>';
		var scheme_id = '<?php echo $regData['scheme_id']; ?>';
		var parentid = '<?php echo $regData['parentid']; ?>';
		document.getElementById("ddlState").value = state_id;
		
		document.getElementById("ddlRetType").value = retailer_type_id;
		document.getElementById("ddlSchDesc").value = scheme_id;
		var urlToSend = '<?php echo base_url()."_Admin/city/getCity/"; ?>';
		$.ajax({
  type: "GET",
  url: urlToSend+""+document.getElementById('ddlState').value,
  success: function(html){
    $("#ddlCity").html(html);
	document.getElementById("ddlCity").value = city_id;
  }
});

	}
	
	</script>
    <script type="text/javascript">
var checkflag = "false";
function check(field) {
  if (checkflag == "false") {
    for (i = 0; i < field.length; i++) {
      field[i].checked = true;
    }
    checkflag = "true";
    return "Uncheck All";
  } else {
    for (i = 0; i < field.length; i++) {
      field[i].checked = false;
    }
    checkflag = "false";
    return "Check All";
  }
}

</script>
    <style>
	.message
	{
		font-size:16px;
		background-color:#D3DC32;
		padding:10px;
	}
	.checkbox, .radio {
    width: 19px;
    height: 25px;
    padding: 0px; /* Removed padding to eliminate color bleeding around image
       you could make the image wider on the right to get the padding back */
    background: url(checkbox2.png) no-repeat;
    display: inline;

 }
	</style>
    
    <script src="<?php echo base_url()."js/jquery.dataTables.min.js"; ?>"></script> 
    <link href="<?php echo base_url()."jquery.dataTables.css"; ?>" rel="stylesheet" type="text/css" />    
   
   
</head>
<body class="twoColFixLtHdr">
<div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
<div id="container">
     <?php require_once("admin_menu1.php"); ?>   
  <div>
  <div class="row-fluid">
		<div class="span12">
			<div class="span6">
				<span style="color:#023a99;"><h2>Add New Api User</h2></span>
			</div>
		</div>
	</div>                 
    <?php
	if ($message != '')
	{
		echo "<div class='message'>".$message."</div>"; 
	}
	else if($this->session->flashdata("message") != '')
	{
		echo "<div class='message'>".$this->session->flashdata("message")."</div>"; 
	}
	?>
    <div class="breadcrumb">
<form method="post" action="<?php echo base_url()."api_user_registration";?>" name="frmdistributer_form1" id="frmdistributer_form1" autocomplete="off">
<fieldset>
<legend>Personal Information</legend>
<table cellpadding="5" cellspacing="0" bordercolor="#f5f5f5" width="80%" border="0">
<tr>
<td align="right"><label for="txtDistname"><span style="color:#F06">*</span>User Name :</label></td><td align="left"><input type="text" class="text" title="Enter Agent Name." id="txtDistname" name="txtDistname" value="<?php echo $regData['distributer_name']; ?>"  maxlength="100"/>
</td>
<td align="right"><label for="ddlDistname"></label></td><td align="left">

</td>
</tr>
<tr>
<td align="right"><label for="txtPostalAddr"><span style="color:#F06">*</span> Postal Address :</label></td><td align="left"><textarea title="Enter Postal Address" id="txtPostalAddr" name="txtPostalAddr" class="text"><?php echo $regData['postal_address']; ?></textarea>
</td>
<td align="right"><label for="txtPin"><span style="color:#F06">*</span>  Pin Code :</label></td><td align="left"><input type="text" class="text" id="txtPin" onKeyPress="return isNumeric(event);" name="txtPin" maxlength="8" title="Enter Pin Code." value="<?php echo $regData['pincode']; ?>"/>
</td>
</tr>
<tr>
</tr>
<tr>
<td align="right"><label for="ddlState">State :</label></td><td align="left">
<input type="hidden" name="hidStateCode" id="hidStateCode" />
<select class="select" id="ddlState" name="ddlState" onChange="getCityName('<?php echo base_url()."_Admin/city/getCity/"; ?>')" title="Select State.<br />Click on drop down"><option value="0">Select State</option>
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
<td align="right"><label for="txtMobNo"><span style="color:#F06">*</span> Mobile No :</label></td><td align="left">+91<input type="text" class="text" onKeyPress="return isNumeric(event);" title="Enter Mobile No.<br />e.g. 9898980000" id="txtMobNo" name="txtMobNo" maxlength="10" value="<?php echo $regData['mobile_no']; ?>"/>
</td>
<td align="right"><label for="txtLandNo">Landline :</label></td><td align="left"><input type="text" class="text" id="txtLandNo" name="txtLandNo" onKeyPress="return isNumeric(event);" title="Enter Landline No.<br />e.g 07926453647" maxlength="11" value="<?php echo $regData['landline']; ?>"/></td>
</tr>
<tr>
<td align="right"><label for="ddlRetType">Agent Business Name :</label></td><td align="left"><select class="select" id="ddlRetType" name="ddlRetType" title="Select Retailer Type.<br />Click on drop down"><option>Select Agent Business Name</option>
<?php
$str_query = "select * from tblratailertype order by retailer_type_name";
		$result = $this->db->query($str_query);		
		for($i=0; $i<$result->num_rows(); $i++)
		{
			echo "<option value='".$result->row($i)->retailer_type_id."'>".$result->row($i)->retailer_type_name."</option>";
		}
?>
</select></td>
<td align="right"><label for="txtEmail"><span style="color:#F06">*</span> Email :</label></td><td align="left"><input type="text" class="text" id="txtEmail" title="Enter Email ID.<br />e.g some@gmail.com" name="txtEmail"  maxlength="150" value="<?php echo $regData['emailid']; ?>"/><br />
<span id="emailidInfo"></span>
</td>
</tr>
<tr>
<td align="right"><label for="txtpanNo">Pan No :</label></td><td align="left"><input type="text" name="txtpanNo" id="txtpanNo" value="<?php echo $regData['pan_no']; ?>"/></td>
<td align="right"><label for="txtConPer"><span style="color:#F06">*</span> Contact Person :</label></td><td align="left"><input type="text" class="text" id="txtConPer" title="Enter Contact No." name="txtConPer"  maxlength="150" value="<?php echo $regData['contact_person']; ?>"/><br />
<span id="emailidInfo"></span>
</td>
</tr>
</table>
</fieldset>

<fieldset>
<legend>Scheme Details</legend>
<table cellpadding="5" cellspacing="0" bordercolor="#f5f5f5" width="80%" border="0">
<tbody>
  <tr>
    <td align="right"><label for="ddlSchDesc"><span style="color:#F06">*</span> Scheme :</label></td>
    <td align="left"><select class="select" id="ddlSchDesc" onChange="ChangeAmount()" title="Select Scheme Name.<br />Click on drop down" name="ddlSchDesc">
      <option>Select Scheme</option>
      <?php
$str_query = "select * from tblscheme where scheme_for='APIUSER'";
		$resultScheme = $this->db->query($str_query);		
		for($i=0; $i<$resultScheme->num_rows(); $i++)
		{
			echo "<option  value='".$resultScheme->row($i)->scheme_id."'>".$resultScheme->row($i)->scheme_name."</option>";
		}
?>
      </select>
</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Amount :</td>
    <td align="left"><span id="spAmount">0</span>
      <input type="hidden" id="hid_scheme_amount" name="hid_scheme_amount" /></td>
    <td align="right"><label for="txtWorLimit">Opening Balance :</label></td>
    <td align="left"><input type="text" title="Enter Opening Balance.<br />e.g 1500,2500" onKeyPress="return isNumeric(event);" class="text" id="txtWorLimit" name="txtWorLimit" maxlength="50" value="<?php echo $regData['working_limit']; ?>"/></td>
  </tr>
  <tr>
    <td></td>
    <td align="left"><input type="submit" style="width:140px" class="button" id="btnSubmit" name="btnSubmit" value="Submit Details"/>
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
</div>





    
	<!-- end #mainContent --></div>
    
    <a href="#" onClick="scrolltotop()">top</a>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>
