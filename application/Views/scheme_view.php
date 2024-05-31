<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Scheme</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?> 


   <script>
	$(document).ready(function(){
	//global vars
	  $('#example').dataTable(); 
	var form = $("#frmscheme_view");
	var schemename = $("#txtSchemeName");
	var schemenameInfo = $("#SchemeNameInfo");
	var schemedesc = $("#txtSchemeDesc");
	var schemedescInfo = $("#SchemeDescInfo");
	var amount = $("#txtAmount");
	var amountInfo = $("#AmountInfo");
	var schemetype = $("#ddlSchemeType");
	var schemefor = $("#ddlSchemeFor");
	var schemetypeInfo = $("#SchemeTypeInfo");			
	schemename.focus();
	form.submit(function(){
		if(validateAmount() & validateSchemeDesc() & validateSchemeName() & validateSchemeType() & validateSchemeFor())
			{				
			return true;
			}
		else
			return false;
	});
	function validateSchemeName(){
		//if it's NOT valid
		if(schemename.val() == ""){
			schemename.addClass("error");
			jAlert('Enter Scheme Name. e.g Silver, Gold', 'Alert Dialog');
			schemenameInfo.text("");
			return false;
		}
		//if it's valid
		else{
			schemename.removeClass("error");
			schemenameInfo.text("");
			return true;
		}
	}
	function validateSchemeDesc(){
		//if it's NOT valid
		if(schemedesc.val() == ""){
			schemedesc.addClass("error");
			jAlert('Enter Scheme Description. Brief details of your scheme.', 'Alert Dialog');
			schemedescInfo.text("");
			return false;
		}
		//if it's valid
		else{
			schemedesc.removeClass("error");
			schemedescInfo.text("");
			return true;
		}
	}
	function validateAmount(){
		//if it's NOT valid
		if(amount.val()== ""){
			amount.addClass("error");
			jAlert('Enter Amount. e.g.1000, 2000', 'Alert Dialog');
			amountInfo.text("");
			return false;
		}
		//if it's valid
		else{
			amount.removeClass("error");
			amountInfo.text("");
			return true;
		}
	}
	function validateSchemeType(){
		//if it's NOT valid
		if(schemetype[0].selectedIndex == 0){
			schemetype.addClass("error");
			jAlert('Select Scheme Type For. Click on drop down.', 'Alert Dialog');
			schemetypeInfo.text("");
			return false;
		}
		//if it's valid
		else{
			schemetype.removeClass("error");
			schemetypeInfo.text("");
			return true;
		}
	}	
	function validateSchemeFor(){
		//if it's NOT valid
		if(schemefor[0].selectedIndex == 0){
			schemefor.addClass("error");
			jAlert('Select Scheme For For. Click on drop down.', 'Alert Dialog');
			return false;
		}
		//if it's valid
		else{
			schemefor.removeClass("error");
			return true;
		}
	}	
	
	setTimeout(function(){$('div.message').fadeOut(1000);}, 2000);
	
});
	function Confirmation(value)
	{
		var varName = document.getElementById("name_"+value).innerHTML;
		if(confirm("Are you sure?\nyou want to delete "+varName+" scheme.") == true)
		{
			document.getElementById('hidValue').value = value;
			document.getElementById('frmDelete').submit();
		}
	}
	function SetEdit(value)
	{
		document.getElementById('txtSchemeName').value=document.getElementById("name_"+value).innerHTML;
		document.getElementById('txtSchemeDesc').value=document.getElementById("desc_"+value).innerHTML;
		document.getElementById('txtAmount').value=document.getElementById("amt_"+value).innerHTML;
		document.getElementById('ddlSchemeType').value=document.getElementById("type_"+value).innerHTML;
		document.getElementById('btnSubmit').value='Update';
		document.getElementById('hidID').value = value;
		document.getElementById('myLabel').innerHTML = "Edit Scheme";
	}
	function SetReset()
	{
		document.getElementById('btnSubmit').value='Submit';
		document.getElementById('hidID').value = '';
		document.getElementById('myLabel').innerHTML = "Add Scheme";
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
			document.getElementById("txtAmount").value = 0;
		}
	}
	</script>


</head>
<body>

<?php require_once("admin_menu.php"); ?> 


<div  class="container">

 <?php
	if ($message != ''){echo "<div class='alert alert-danger'>".$message."</div>"; }
	?>
<div class="panel panel-primary">
      <div id="top" class="panel-heading">Create Scheme</div>
      <div class="panel-body">
        <form method="post" action="<?php echo base_url()."scheme"; ?>"  name="frmscheme_view" id="frmscheme_view" autocomplete="off">
            
            <div class="form-group">
                <lable for="txtSchemeName">Scheme Name</lable>
                <input type="text" class="form-control" id="txtSchemeName"  required="" title="Enter Scheme Name.<br/>e.g Silver, Gold" name="txtSchemeName" maxlength="100"/>
            </div>  
          
               <div class="form-group">
                <lable for="txtSchemeDesc">Scheme Detail</lable>
                <textarea id="txtSchemeDesc" class="form-control" required="" title="Enter Scheme Description.<br />Brief details of your scheme." name="txtSchemeDesc" rows="5" cols="15" ></textarea>
            </div>  
          
        
          
          
          <div class="form-group">
                <lable for="ddlSchemeFor">Scheme For</lable>
                <select id="ddlSchemeFor" required="" title="Select Scheme Type For.<br />Click on drop down." class="form-control" name="ddlSchemeFor">
<option>Select</option>
<option>MasterDealer</option>
<option>Distributor</option>
<option>Agent</option>
</select>
            </div> 
            <input type="hidden" id="txtAmount" name="txtAmount"  value="0"/>  
                  <input type="hidden" id="ddlSchemeType" name="ddlSchemeType" value="variable"/> 
       <input type="submit" class="btn btn-danger" id="btnSubmit" name="btnSubmit" value="Submit"/> <input type="reset" class="button" onClick="SetReset()" id="bttnCancel" name="bttnCancel" value="Cancel"/>   
        <input type="hidden" id="hidID" name="hidID" />  
      </div>
    </div>
    
    
    
    <div class="panel panel-primary">
      <div class="panel-heading">List Of Scheme</div>
      <div class="panel-body">
          <form action="<?php echo base_url()."scheme"; ?>" method="post" autocomplete="off" name="frmDelete" id="frmDelete">
    <input type="hidden" id="hidValue" name="hidValue" />
    <input type="hidden" id="action" name="action" value="Delete" />
</form>  
          
   <table class="table table-hover">
    <thead> 
        <tr> 
            <th>Scheme Name</th> 
            <th>Scheme Detail</th> 
            <th>Scheme Type</th>
             
           
            <th>Scheme For</th>
           <!-- <th>Action</th> -->
           
             <th>commission</th>
        </tr> </thead>
     <tbody>
    <?php	$i = 0;foreach($result_scheme->result() as $result) 	{  ?>
			<tr>
               <td><span id="name_<?php echo $result->scheme_id; ?>"><?php echo $result->scheme_name; ?></span></td>
               
                <td><span id="desc_<?php echo $result->scheme_id; ?>"><?php echo $result->scheme_description; ?></span></td>
                
                 <td><span id="amt_<?php echo $result->scheme_id; ?>"><?php echo $result->scheme_type; ?></span></td>
                 
                   
                   
               <td><span id="type_<?php echo $result->scheme_id; ?>"><?php echo $result->scheme_for; ?></span></td>  
              
              <!--  <td>
                    <a href="#" class="btn btn-primary" role="button" onClick="SetEdit('<?php echo $result->scheme_id; ?>')">Edit</a>
                    
                
                
              
               </td> -->
               
               <td>
                    <a href="commission" class="btn btn-primary" role="button" )">Set Commission</a>
                    
                
                
              
               </td> 
 </tr>
		<?php 	
		$i++;} ?>
        </tbody>
		</table>
       <?php  echo $pagination; ?>         
          
          
          </div></div>
    
    
</div>

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
	
</body>
</html>