<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Commission</title>
   <?php include("script1.php"); ?>
    <link href="<?php echo base_url()."jquery.dataTables.css"; ?>" rel="stylesheet" type="text/css" />    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <link rel="stylesheet" href="<?php echo base_url()."js/jquery.alerts.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>               
    <script src="<?php echo base_url()."js/jquery.dataTables.min.js"; ?>"></script> 
    <script src="<?php echo base_url()."js/jquery.alerts.js"; ?>"></script>                
    <script>
	$(document).ready(function(){
	//global vars
	$('#example').dataTable(); 
	var form = $("#frmadmincomm");
	var ddlcomany = $("#ddlcompany");
	var MarsComm = $("#txtMarsComm");
	var RecDunCom = $("#txtRecDunComm");
	var royalcomm = $("#txtRoyalComm");
	var rechargeServerComm = $('#txtRechargeServer');
	ddlcompany.focus();
	
	form.submit(function(){
		if(validateddlcompany() & validateroyalcomm() & validateMarsComm() & validateRecDunCom() & validaterechargeServerComm())
			{				
			return true;
			}
		else
			return false;
	});
	function validaterechargeServerComm(){
		if(rechargeServerComm.val() == ""){
			rechargeServerComm.addClass("error");
			return false;
		}
		else{
			rechargeServerComm.removeClass("error");
			return true;
		}
		
	}
	
	function validateddlcompany(){
		if(ddlcomany.val() == 0){
			ddlcomany.addClass("error");
			return false;
		}
		else{
			ddlcomany.removeClass("error");
			return true;
		}
		
	}
	function validateroyalcomm(){
		if(royalcomm.val() == ""){
			royalcomm.addClass("error");
			return false;
		}
		else{
			royalcomm.removeClass("error");
			return true;
		}
		
	}
	

	function validateMarsComm(){
		if(MarsComm.val() == ""){
			MarsComm.addClass("error");
			return false;
		}
		else{
			MarsComm.removeClass("error");
			return true;
		}
	}
	function validateRecDunCom(){
		if(RecDunCom.val() == ""){
			RecDunCom.addClass("error");
			return false;
		}
		else{
			RecDunCom.removeClass("error");
			return true;
		}
	}
		
	setTimeout(function(){$('div.message').fadeOut(1000);}, 2000);	
});
	function Confirmation(value)
	{
		var varName = document.getElementById("name_"+value).innerHTML;
		if(confirm("Are you sure?\nyou want to delete "+varName+" api.") == true)
		{
			document.getElementById('hidValue').value = value;
			document.getElementById('frmDelete').submit();
		}
	}
	function SetEdit(value)
	{
		document.getElementById('ddlcompany').value=value;
		document.getElementById('txtRoyalComm').value=document.getElementById("royalcomm_"+value).innerHTML;
		document.getElementById('txtRecDunComm').value=document.getElementById("RecDunComm_"+value).innerHTML;
		document.getElementById('txtMarsComm').value=document.getElementById("MarsCom_"+value).innerHTML;
		document.getElementById('txtRechargeServer').value=document.getElementById("RechargeServerComm_"+value).innerHTML;
		
	
	}
	function SetReset()
	{
		document.getElementById('btnSubmit').value='Submit';
		document.getElementById('hidID').value = '';
		document.getElementById('myLabel').innerHTML = "Add API";
	}
	function SetStatus()
	{
		if(document.getElementById("chkApiEnable").checked == true)
		{document.getElementById('hidStatus').value ="1";}
		else{document.getElementById('hidStatus').value ="0";}
	}
	</script>
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
    <h2><span id="myLabel">Admin Commission</span></h2>               
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
<form method="post" action="<?php echo base_url()."admin_commission"; ?>" name="frmadmincomm" id="frmadmincomm" autocomplete="off">
<fieldset>
<table cellpadding="3" cellspacing="3" border="0">
<tr>
<td align="right"><label for="txtAPIName"><span style="color:#F06">*</span> Company :</label></td><td align="left">
<select id="ddlcompany" name="ddlcompany" class="text" title="select Company" style="width:175px;">
<option value="0">select</option>
<?php
	$rslt = $this->db->query("select * from tblcompany order by company_name");
	foreach($rslt->result() as $result)
	{
 ?>
 	<option value="<?php echo $result->company_id; ?>"><?php echo $result->company_name; ?></option>
 <?php }?>
</select>
</td>
</tr>
<tr>
<td align="right"><label for="txtRoyalComm"><span style="color:#F06">*</span> API2 Commission(%) :</label></td><td align="left"><input type="text" id="txtRoyalComm" class="text" title="Enter RoyalCapital Commission.<br>e.g 2.5%" name="txtRoyalComm">
<span id="usernameInfo"></span>
</td>
</tr>
<!--<tr>
<td align="right"><label for="txtRecDunComm"><span style="color:#F06">*</span> RechargeDunia Commission(%) :</label></td><td align="left"><input type="text" class="text" id="txtRecDunComm" title="Enter RechargeDunia Commission.<br>e.g 2.5%." name="txtRecDunComm" maxlength="50"/>
<span id="passwordInfo"></span>
</td>
</tr>
<tr>
<td align="right"><label for="txtMarsComm"><span style="color:#F06">*</span> Mars Commission(%) :</label></td><td align="left"><input type="text" class="text" id="txtMarsComm" title="Enter Mars Commission.<br>e.g 2.5%." name="txtMarsComm" maxlength="50"/>
<span id="passwordInfo"></span>
</td>
</tr>
<tr>
<td align="right"><label for="txtRechargeServer"><span style="color:#F06">*</span> RechargeServer Commission(%) :</label></td><td align="left"><input type="text" class="text" id="txtRechargeServer" title="Enter RechargeServer Commission.<br>e.g 2.5%." name="txtRechargeServer" maxlength="50"/>
<span id="passwordInfo"></span>
</td>
</tr>-->

<tr>
<td></td><td align="left"><input type="submit" class="button" id="btnSubmit" name="btnSubmit" value="Submit"/> <input type="reset" class="button" onClick="SetReset()" id="bttnCancel" name="bttnCancel" value="Cancel"/></td>
</tr>
</table>
</fieldset>
<input type="hidden" id="hidID" name="hidID" />
</form>


    

<h2 class="h2">View Admin Commission</h2>

<table style="width:100%;" id="example" class='dataTable' cellpadding="3" cellspacing="0" border="0">
     <thead> 
        <tr class="ColHeader"> 
        	<th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >SR No.</th> 
            <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Company Name</th> 
            <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >API2 Commission</th> 
            <!--<th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >RechargeDunia Commission</th>
            <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Mars Commission</th>
            <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >RechargeServer Commission</th>-->
           <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Actions</th> 
        </tr> </thead>
    <?php	$i = 0;foreach($result_admin_comm->result() as $result) 	{  ?>
    <tbody> 
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
              <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo $i+1; ?></td>
              <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><span id="company_id_<?php echo $result->company_id; ?>"><?php echo $result->company_name; ?></span></td>
              <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><span id="royalcomm_<?php echo $result->company_id; ?>"><?php echo $result->royalComm; ?></span></td>
                   <!--<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><span id="RecDunComm_<?php echo $result->company_id; ?>"><?php echo $result->RecDunComm; ?></span></td>
                <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><span id="MarsCom_<?php echo $result->company_id; ?>"><?php echo $result->MarsComm; ?></span></td>              
                <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><span id="RechargeServerComm_<?php echo $result->company_id; ?>"><?php echo $result->RechargeServerComm; ?></span></td>  -->            
           <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;">
             
              <img src="<?php echo base_url()."images/Edit.PNG"; ?>" onClick="SetEdit('<?php echo $result->company_id; ?>')" title="Edit Row" />
              </td>  
             </tr></tbody>
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
