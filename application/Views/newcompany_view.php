<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Scheme</title>
   <?php include("script1.php");?>    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <link rel="stylesheet" href="<?php echo base_url()."js/jquery.alerts.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>  
    <script src="<?php echo base_url()."js/jquery.alerts.js"; ?>"></script>                        
    <script>
	$(document).ready(function(){
	//global vars
	 $('#example').dataTable(); 
	var form = $("#frmcompany_view");
	var cname = $("#txtCompName");
	var sname = $("#ddlSerName");
	var provider = $("#txtProvider");			
	var long_code_format = $("#txtLong_Code_Format");
	var long_code_no = $("#txtLong_Code_No");
	
	cname.focus();
	form.submit(function(){
		if(validatesName() & validatecName() & validatesLong_code_format() & validatesLong_code_no() & validateProvider())
			{				
			return true;
			}
		else
			return false;
	});	
	function validatecName(){
		if(cname.val() == ""){
			//cname.addClass("error");
			jAlert('Enter Company Name. e.g. Airtel,Vodafone', 'Alert Dialog');
			return false;
		}
		else{
			cname.removeClass("error");
			return true;
		}
	}
	
	function validatesName(){
		if(sname[0].selectedIndex == 0){
			//sname.addClass("error");
			jAlert('Select Service. Click on drop down.', 'Alert Dialog');			
			return false;
		}
		else{
			sname.removeClass("error");
			return true;
		}
	}	
	function validateProvider()
	{
		if(provider.val() == ""){
			//provider.addClass("error");
			jAlert('Enter Provider Code. e.g. For Vadafone RV', 'Alert Dialog');			
			return false;
		}
		else{
			provider.removeClass("error");
			return true;
		}
	}
		
	function validatesLong_code_format(){
		if(long_code_format.val() == ""){
			//long_code_format.addClass("error");
			jAlert('Enter Long Code Format. e.g. For Vodafone <strong>EG VF', 'Alert Dialog');			
			return false;
		}
		else{
			long_code_format.removeClass("error");
			return true;
		}
	}		
	function validatesLong_code_no(){
		if(long_code_no.val() == ""){
			//long_code_no.addClass("error");
			jAlert('Enter Long Code No. e.g. 9020501501', 'Alert Dialog');	
			return false;
		}
		else{
			long_code_no.removeClass("error");
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
		document.getElementById('txtLong_Code_Format').value=document.getElementById("lc_format_"+value).innerHTML;
		document.getElementById('txtLong_Code_No').value=document.getElementById("lc_no_"+value).innerHTML;
		document.getElementById('txtProvider').value=document.getElementById("provider_"+value).innerHTML;	
		document.getElementById('txtPProvider').value=document.getElementById("payworld_provider_"+value).innerHTML;		
		document.getElementById('txtCProvider').value=document.getElementById("cyberplate_provider_"+value).innerHTML;		
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
    
    <script language="javascript">
	function enableValue()
	{
		var str = document.getElementById("ddlSchemeType").value;
		if(str == "flat")
		{
			document.getElementById("txtAmount").disabled = false;
		}
		else
		{
			document.getElementById("txtAmount").disabled = true;
		}
	}
	</script>
    
      <link href="<?php echo base_url()."jquery.dataTables.css"; ?>" rel="stylesheet" type="text/css" />    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <link rel="stylesheet" href="<?php echo base_url()."js/jquery.alerts.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>               
    <script src="<?php echo base_url()."js/jquery.dataTables.min.js"; ?>"></script> 
    <script src="<?php echo base_url()."js/jquery.alerts.js"; ?>"></script>     
   
</head>
<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("admin_menu1.php"); ?> 
  </div>  
  <div class="bck">
    <h2><span id="myLabel">Add New Scheme</span></h2>               
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
 <form method="post" action="<?php echo base_url()."company"; ?>" name="frmcompany_view" id="frmcompany_view" autocomplete="off" enctype="multipart/form-data" >
    <fieldset>
    <table align="center" style="border:1px solid green;padding:15px;margin:15px;">
    <tr>
    <td>
    	<table cellpadding="3" cellspacing="3" border="0" align="left">
			<tr>
<td align="right"><label for="txtCompName"><span style="color:#F06">*</span> Operator Name :</label></td><td align="left"><input type="text" class="text" id="txtCompName" title="Enter Company Name.<br />e.g. Airtel,Vodafone" name="txtCompName" maxlength="100"/>
</td>
</tr>
			<tr>
<td align="right"><label for="txtProvider"><span style="color:#F06">*</span>Royal Provider :</label></td><td align="left"><input type="text" class="text" id="txtProvider" title="Enter Royal Provider Code.<br />e.g. For Vadafone RV" name="txtProvider" maxlength="10"/>
</td>
</tr>
			<tr>
<td align="right"><label for="txtPProvider"><span style="color:#F06">*</span>PayWorld Provider :</label></td><td align="left"><input type="text" class="text" id="txtPProvider" title="Enter PayWorld Provider Code.<br />e.g. For Vadafone RV" name="txtPProvider" maxlength="10"/>
</td>
</tr>
			<tr>
<td align="right"><label for="txtCProvider"><span style="color:#F06">*</span>CyberPlate Provider :</label></td><td align="left"><input type="text" class="text" id="txtCProvider" title="Enter CyberPlate Provider Code.<br />e.g. For Vadafone RV" name="txtCProvider" maxlength="10"/>
</td>
</tr>
		</table>
    </td>
    <td>
    	<table cellpadding="3" cellspacing="3" border="0" align="left">
			<tr>
<td align="right"><label for="txtLong_Code_Format"><span style="color:#F06">*</span> Long Code Format :</label></td><td align="left"><input type="text" class="text" id="txtLong_Code_Format" title="Enter Long Code Format.<br />e.g. For Vodafone <strong>EG VF</strong>" name="txtLong_Code_Format" maxlength="100"/>
</td>
</tr>
			<tr>
<td align="right"><label for="txtLong_Code_No"><span style="color:#F06">*</span> Long Code No :</label></td><td align="left"><input type="text" class="text" id="txtLong_Code_No" title="Enter Long Code No.<br />e.g. 9020501501" name="txtLong_Code_No" maxlength="100"/>
</td>
</tr>
			<tr>
<td align="right"><label for="file_Logo">Operator Logo :</label></td><td align="left"><input type="file" class="text" id="file_Logo" title="Select Company Logo." name="file_Logo" />
<input type="hidden" name="hidOldPath" id="hidOldPath" />
</td>
</tr>
			<tr>
<td align="right"><label for="ddlSerName"><span style="color:#F06">*</span> Service Name :</label></td><td align="left"><select id="ddlSerName" name="ddlSerName" title="Select Service<br/>Click on drop down." class="select">
<option>Select Service</option>
<?php
echo $this->common_value->getServiceName();
?>
</select>
</td>
</tr>
			<tr>
<td></td><td align="left"><input type="submit" class="button" id="btnSubmit" name="btnSubmit" value="Submit"/> <input type="reset" class="button" onClick="SetReset()" id="bttnCancel" name="bttnCancel" value="Cancel"/></td>
</tr>
		</table>
    </td>
    </tr>
    </table>

</fieldset>
<input type="hidden" id="hidID" name="hidID" />
</form>

<form action="<?php echo base_url()."company"; ?>" method="post" autocomplete="off" name="frmDelete" id="frmDelete">
    <input type="hidden" id="hidValue" name="hidValue" />
    <input type="hidden" id="action" name="action" value="Delete" />
</form>

<h2 class="h2">View Companys</h2>

<table style="width:100%;" id="example" class='dataTable' cellpadding="3" cellspacing="0" border="0">
    <thead> 
        <tr class="ColHeader"> 
             <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Operator Name</th> 
            <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Provider</th>
             <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >PayWorld Provider</th>
              <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >CyberPlate Provider</th>
             <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Long Code Format</th>
             <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Long Code No</th>
             <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Service</th>
             <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Logo</th>
             <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Actions</th> 
        </tr> </thead>
     <tbody>
    <?php	$i = 0;foreach($result_company->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
            	<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><span id="comp_<?php echo $result->company_id; ?>"><?php echo $result->company_name; ?></span></td>
 				<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><span id="provider_<?php echo $result->company_id; ?>"><?php echo $result->provider; ?></span></td>
 				<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><span id="payworld_provider_<?php echo $result->company_id; ?>"><?php echo $result->payworld_provider; ?></span></td>
                <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><span id="cyberplate_provider_<?php echo $result->company_id; ?>"><?php echo $result->cyberplate_provider; ?></span></td>
 				<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><span id="lc_format_<?php echo $result->company_id; ?>"><?php echo $result->long_code_format; ?></span></td>
 				<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><span id="lc_no_<?php echo $result->company_id; ?>"><?php echo $result->long_code_no; ?></span></td>
 				<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;">
  <input type="hidden" id="hidservice_<?php echo $result->company_id; ?>" value="<?php echo $result->service_id; ?>" name="hidservice_<?php echo $result->company_id; ?>" />
  <?php echo $result->service_name; ?></td>
 				<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;">
 <input type="hidden" id="hidlogo_<?php echo $result->company_id; ?>" value="<?php echo $result->logo_path; ?>" />
 <img width="40px" height="40px" id="logo_<?php echo $result->company_id; ?>" src="<?php echo base_url()."images/Logo/".$result->logo_path; ?>" alt="Company Logo" title="Company Logo" />
 </td>
 				<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><img src="<?php echo base_url()."images/delete.PNG"; ?>" height="20" width="20" onClick="Confirmation('<?php echo $result->company_id; ?>')" title="Delete Row" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src="<?php echo base_url()."images/Edit.PNG"; ?>" onClick="SetEdit('<?php echo $result->company_id; ?>')" title="Edit Row" />
</td>
 </tr>
		<?php 	
		$i++;} ?>
        </tbody>
		</table>
    
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
    <div id="footer" style="min-height:200px;">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>
