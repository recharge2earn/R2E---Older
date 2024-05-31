<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Operator Code</title>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
 <?php include("app_css.php"); ?>
    <link rel="stylesheet" href="<?php echo base_url()."js/jquery.alerts.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>               
    <script src="<?php echo base_url()."js/jquery.dataTables.min.js"; ?>"></script> 
    <script src="<?php echo base_url()."js/jquery.alerts.js"; ?>"></script>                
    <script>
	$(document).ready(function(){
	//global vars
	$('#example').dataTable(); 
	var form = $("#frmapi_view");
	var apiname = $("#txtAPIName");
	var apinameInfo = $("#APINameInfo");
	var username = $("#txtUserName");
	var usernameInfo = $("#usernameInfo");
	var pwd = $("#txtPassword");
	var pwdInfo = $("#passwordInfo");
	apiname.focus();pwd.blur(validatePassword);
	
	form.submit(function(){
		if(validateAPIName() & validateUserName() & validatePassword())
			{				
			return true;
			}
		else
			return false;
	});
	function validateAPIName(){
		if(apiname.val() == ""){
			//apiname.addClass("error");
			apinameInfo.text("");
			jAlert('Enter API Name. e.g RoyalCapital', 'Alert Dialog');
			return false;
		}
		else{
			apiname.removeClass("error");
			apinameInfo.text("");
			return true;
		}
	}
	function validateUserName(){
		if(username.val() == ""){
			//username.addClass("error");
			jAlert('Enter User Name.<br>For Royal Capital : Enter Agent ID.', 'Alert Dialog');
			usernameInfo.text("");
			return false;
		}
		else{
			username.removeClass("error");
			usernameInfo.text("");
			return true;
		}
	}
	function validatePassword(){
		if(pwd.val()== ""){
			//pwd.addClass("error");
			jAlert('Enter API Password. For RoyalCapital : Enter Passward.', 'Alert Dialog');
			
			pwdInfo.text("");
			return false;
		}
		else{
			pwd.removeClass("error");
			pwdInfo.text("");
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
		document.getElementById('A').value=document.getElementById("A_"+value).innerHTML;
		document.getElementById('I').value=document.getElementById("I_"+value).innerHTML;
			document.getElementById('V').value=document.getElementById("V_"+value).innerHTML;
document.getElementById('RC').value=document.getElementById("RC_"+value).innerHTML;
	document.getElementById('BT').value=document.getElementById("BT_"+value).innerHTML;
		document.getElementById('BR').value=document.getElementById("BR_"+value).innerHTML;
	document.getElementById('ATV').value=document.getElementById("ATV_"+value).innerHTML;
		document.getElementById('TTV').value=document.getElementById("TTV_"+value).innerHTML;
			document.getElementById('STV').value=document.getElementById("STV_"+value).innerHTML;
		document.getElementById('VTV').value=document.getElementById("VTV_"+value).innerHTML;
			document.getElementById('STV').value=document.getElementById("STV_"+value).innerHTML;
					document.getElementById('DTV').value=document.getElementById("DTV_"+value).innerHTML;	
		document.getElementById('btnSubmit').value='Update';
		document.getElementById('hidID').value = value;
		document.getElementById('myLabel').value = document.getElementById("name_"+value).innerHTML;
	}
	function SetReset()
	{
		document.getElementById('btnSubmit').value='Submit';
		document.getElementById('hidID').value = '';
		document.getElementById('myLabel').innerHTML = "Add API";
	}
	</script>



    
    
</head>
<body>
   <?php include("admin_menu.php"); ?>  

 
  <div class="well">
      
      
   <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><h2 class="border_bottom"><span id="myLabel">Update Operator code</span></h2>  </h4>
      </div>
      <div class="modal-body">   
      
                 
    <?php
	if ($message != ''){echo "<div class='alert alert-success'>".$message."</div>"; }
	?>
<form method="post" action="<?php echo base_url()."edit_opcode"; ?>" name="frmapi_view" id="frmapi_view" autocomplete="off">

<div class="form-group">
    <label for="A">Airtel :</label>
    
   <input type="text" class="form-control" id="A" title="Enter API Name.<br/>e.g Silver, Gold" name="A" >
</div>


<div class="form-group">
    <label for="RC">JIO :</label>
    
   <input type="text" class="form-control" id="RC" title="Enter API Name.<br/>e.g Silver, Gold" name="RC" >
</div>


<div class="form-group">
    <label for="V">Vodafone :</label>
    
   <input type="text" class="form-control" id="V" title="Enter API Name.<br/>e.g Silver, Gold" name="V" >
</div>



<div class="form-group">
    <label for="I">Idea :</label>
    
   <input type="text" class="form-control" id="I" title="Enter API Name" name="I" >
</div>





<div class="form-group">
    <label for="B">BSNL Topup :</label>
    
   <input type="text" class="form-control" id="BT" title="Enter API Name" name="BT" >
</div>


<div class="form-group">
    <label for="BR">BSNL Special :</label>
    
   <input type="text" class="form-control" id="BR" title="Enter API Name" name="BR" >
</div>




<div class="form-group">
    <label for="ATV">Airtel DTH :</label>
    
   <input type="text" class="form-control" id="ATV" title="Enter API Name" name="ATV" >
</div>





<div class="form-group">
    <label for="TTV">TATA Sky :</label>
    
   <input type="text" class="form-control" id="TTV" title="Enter API Name" name="TTV" >
</div>




<div class="form-group">
    <label for="VTV">Videocon DTH :</label>
    
   <input type="text" class="form-control" id="VTV" title="Enter API Name" name="VTV" >
</div>



<div class="form-group">
    <label for="STV">SUN DTH :</label>
    
   <input type="text" class="form-control" id="STV" title="" name="STV" >
</div>


<div class="form-group">
    <label for="DTV">Dish TV :</label>
    
   <input type="text" class="form-control" id="DTV" title="Enter API Name" name="DTV" >
</div>


<input type="submit" class="button" id="btnSubmit" name="btnSubmit" value="Submit"/> <input type="reset" class="button" onClick="SetReset()" id="bttnCancel" name="bttnCancel" value="Cancel"/>

<input type="hidden" id="hidID" name="hidID" />
</form>


    <form action="<?php echo base_url()."addedit_opcode_api"; ?>" method="post" autocomplete="off" name="frmDelete" id="frmDelete">
    <input type="hidden" id="hidValue" name="hidValue" />
    <input type="hidden" id="action" name="action" value="Delete" />
</form>


</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<h2 class="h2">Operator Code</h2>

<table class="table table-bordered">
     <thead> 
        <tr class="ColHeader"> 
            <th>API Provider</th> 
            <th>Airtel </th> 
            <th>Jio</th>
              <th>Vodafone</th>
                <th>Idea:</th>
                <th>BSNL Topup:</th>
                  <th>BSNL Special:</th>
                  <th>Airtel DTH:</th>
                  <th>Tata Sky:</th>
                  
              <th>Sun DTH</th>
              <th>Dish TV</th>
              <th>Videocon DTH</th>
            <th>Actions</th> 
        </tr> </thead>
    <?php	$i = 0;foreach($result_api->result() as $result) 	{  ?>
    <tbody> 
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
              <td><span id="name_<?php echo $result->api_id; ?>"><?php echo $result->api_name; ?></span></td>
             <td><span id="A_<?php echo $result->api_id; ?>"><?php echo $result->A; ?></span></td>
              <td><span id="RC_<?php echo $result->api_id; ?>"><?php echo $result->RC ?></span></td> 
                   <td><span id="V_<?php echo $result->api_id; ?>"><?php echo $result->V ?></span></td> 
        <td><span id="I_<?php echo $result->api_id; ?>"><?php echo $result->I ?></span></td>
         <td><span id="BT_<?php echo $result->api_id; ?>"><?php echo $result->BT ?></span></td>
          <td><span id="BR_<?php echo $result->api_id; ?>"><?php echo $result->BR ?></span></td>
           <td><span id="ATV_<?php echo $result->api_id; ?>"><?php echo $result->ATV ?></span></td>
            <td><span id="TTV_<?php echo $result->api_id; ?>"><?php echo $result->TTV ?></span></td>
              <td><span id="STV_<?php echo $result->api_id; ?>"><?php echo $result->STV ?></span></td>
                <td><span id="DTV_<?php echo $result->api_id; ?>"><?php echo $result->DTV ?></span></td>
                  <td><span id="VTV_<?php echo $result->api_id; ?>"><?php echo $result->VTV ?></span></td>
                   
                   
                     
            <td>
             <button type="button" class="btn btn-info btn-lg" onClick="SetEdit('<?php echo $result->api_id; ?>')" data-toggle="modal" data-target="#myModal">EDIT</button>
              
              </td>  
             </tr></tbody>
		<?php 	
		$i++;} ?>
		</table> 
	<!-- end #mainContent --></div>



     <?php require_once("footer.php"); ?>
 
  <?php include("app_js.php"); ?>
</body>
</html>
