<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Extra Income View</title>
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <link rel="stylesheet" href="<?php echo base_url()."js/jquery.alerts.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script> 
    <script src="<?php echo base_url()."js/jquery.alerts.js"; ?>"></script>
    <script src="<?php echo base_url()."js/modernizr-1.7.min .js"; ?>"></script>
    
   	<script>
	$(document).ready(function(){
	//global vars
	var form = $("#frmcompany_view");
	var dname = $("#ddlDistname");
	var amt = $("#txtAmount");
	var percentage = $("#txtPercentage");	
	var rmk = $("#txtRemark")
	form.submit(function(){
		if(validateDName() & validateAmount() & validatePercantage() & validateRemark())
			{				
			return true;
			}
		else
			return false;
	});	
	function validateDName(){
		if(dname[0].selectedIndex == 0){
			dname.addClass("error");			
			return false;
		}
		else{
			dname.removeClass("error");		
			return true;
		}
	}
	function validateAmount(){
		if(amt.val() == ""){
			amt.addClass("error");
			return false;
		}
		else{
			amt.removeClass("error");
			return true;
		}
		
	}
	function validatePercantage(){
		if(percentage.val() == ""){
			percentage.addClass("error");
			return false;
		}
		else{
			percentage.removeClass("error");
			return true;
		}
		
	}
	function validateRemark(){
		if(rmk.val() == ""){
			rmk.addClass("error");
			return false;
		}
		else{
			rmk.removeClass("error");
			return true;
		}
		
	}
	setTimeout(function(){$('div.message').fadeOut(1000);}, 2000);
	
});
	function Confirmation(value)
	{
		var varName = document.getElementById("comp_"+value).innerHTML;
		if(confirm("Are you sure?\nyou want to delete "+varName+" company.") == true)
		{
			document.getElementById('hidValue').value = value;
			document.getElementById('frmDelete').submit();
		}
	}
	function SetEdit(value)
	{
		document.getElementById('txtCompName').value=document.getElementById("comp_"+value).innerHTML;
		document.getElementById('txtPercentage').value=document.getElementById("lc_format_"+value).innerHTML;
		document.getElementById('txtRemark').value=document.getElementById("lc_no_"+value).innerHTML;
		document.getElementById('txtAmount').value=document.getElementById("provider_"+value).innerHTML;		
		document.getElementById('ddlSerName').value=document.getElementById("hidservice_"+value).value;		
		document.getElementById('hidOldPath').value=document.getElementById("hidlogo_"+value).value;				
		document.getElementById('btnSubmit').value='Update';
		document.getElementById('hidID').value = value;
		document.getElementById('myLabel').innerHTML = "Edit Company";
	}
	function SetReset()
	{
		document.getElementById('btnSubmit').value='Submit';
		document.getElementById('hidID').value = '';
		document.getElementById('myLabel').innerHTML = "Add Company";
	}	
	</script>
    
    <style type="text/css">
		
		table {
			width: 100%;
			border-collapse: collapse;
			
			-webkit-box-shadow: 0px 1px 1px rgba(0,0,0,.25);
		}
		
		td, th {
			padding: 5px 10px;
		}
		
		thead th {
			background: #110303; /* Old browsers */
			background: -moz-linear-gradient(top, #110303 0%, #333333 98%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#110303), color-stop(98%,#333333)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top, #110303 0%,#333333 98%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top, #110303 0%,#333333 98%); /* Opera11.10+ */
			background: -ms-linear-gradient(top, #110303 0%,#333333 98%); /* IE10+ */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#110303', endColorstr='#333333',GradientType=0 ); /* IE6-9 */
			background: linear-gradient(top, #110303 0%,#333333 98%); /* W3C */
			
			color: #fff;
		}
		
		tbody tr {
			border-top: 1px dotted #D8D5D5;
		}
		
		tbody td {
			border: 1px dotted #D8D5D5;
			border-width: 0px 1px;
			
			-webkit-transition: background-color .2s linear;
			-moz-transition: background-color .2s linear;
			transition: background-color .2s linear;
		}
		
		tbody tr:first-child {
			border-top: none;
		}
		
		tbody tr.even td {
			background: #fbfbfb;
		}
		
		tbody tr.clickable:hover td {
			background: #ecf2fa;
			cursor: pointer;
		}
	</style>
</head>
<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("a_menu.php"); ?> 
  </div> 
  <div class="bck">
    <h2><span id="myLabel">Extra Income</span></h2>  
    
             
   <?php   
	if($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";}	
	?>
    
    
    
    <form method="post" action="<?php echo base_url()."extra_income"; ?>" name="frmcompany_view" id="frmcompany_view" autocomplete="off">
    <fieldset>
<table cellpadding="3" cellspacing="3" border="0" align="left" style="margin-left:-350px;">
<tr>
<td align="right"><label for="ddlDistname"><span style="color:#F06">*</span>Select User :</label></td><td align="left">
<select id="ddlDistname" name="ddlDistname" class="select" title="Select Dealer Name.">
<option>--Select--</option>
<?php
		$str_query = "select * from tblusers where (usertype_name = ? or usertype_name = ? or usertype_name = ?) order by business_name";
		$result = $this->db->query($str_query,array('Distributor','MLMAgent','Agent'));		
		for($i=0; $i<$result->num_rows(); $i++)
		{
			echo "<option value='".$result->row($i)->user_id	."'>".$result->row($i)->business_name."</option>";
		}
?>
</select>
</td>
</tr>
<tr>
<td align="right"><label for="txtAmount"><span style="color:#F06">*</span>Amount :</label></td><td align="left"><input type="text" class="text" id="txtAmount" title="Enter Amount" name="txtAmount" maxlength="10"/>
</td>
</tr>
<tr>
<td align="right"><label for="txtPercentage"><span style="color:#F06">*</span> Percentage(%) :</label></td><td align="left"><input type="text" class="text" id="txtPercentage" title="Enter Percentage" name="txtPercentage" maxlength="100"/>
</td>
</tr>
<tr>
<td align="right"><label for="txtRemark"><span style="color:#F06">*</span> Remark :</label></td><td align="left"><input type="text" class="text" id="txtRemark" title="Enter Remarks" name="txtRemark" maxlength="100"/>
</td>
</tr>
<tr>
<td></td><td align="left"><input type="submit" class="button" id="btnSubmit" name="btnSubmit" value="Submit"/> <input type="reset" class="button" onClick="SetReset()" id="bttnCancel" name="bttnCancel" value="Cancel"/></td>
</tr>
</table>
</fieldset>
<input type="hidden" id="hidID" name="hidID" />
</form>
      


	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
	</body>
</html>