<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Retailer Business Type</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>                     
    <script>
	$(document).ready(function(){
	//global vars
	$('#example').dataTable(); 
	var form = $("#frmRetailerType");
	var sname = $("#txtRetailer_type");
	var snameInfo = $("#snameInfo");
	sname.focus();
	form.submit(function(){
		if(validatesName())
			{				
			return true;
			}
		else
			return false;
	});
	function validatesName(){
		//if it's NOT valid
		if(sname.val() == ""){
			//sname.addClass("error");
			jAlert('Enter Retailer Type.<br/>e.g Cable &amp; DTH, telecom.', 'Alert Dialog');
			snameInfo.text("");
			return false;
		}
		//if it's valid
		else{
			sname.removeClass("error");
			snameInfo.text("");
			return true;
		}
	}
	setTimeout(function(){$('div.message').fadeOut(1000);}, 2000);
	
});
	function Confirmation(value)
	{
		var varName = document.getElementById(""+value).innerHTML;
		if(confirm("Are you sure?\nyou want to delete "+varName+" retailer.") == true)
		{
			document.getElementById('hidValue').value = value;
			document.getElementById('frmDelete').submit();
		}
	}
	function SetEdit(value)
	{
		document.getElementById('txtRetailer_type').value=document.getElementById(""+value).innerHTML;;
		document.getElementById('btnSubmit').value='Update';
		document.getElementById('hidID').value = value;
		document.getElementById('myLabel').innerHTML = "Edit Retailer Type";
	}
	function SetReset()
	{
		document.getElementById('btnSubmit').value='Submit';
		document.getElementById('hidID').value = '';
		document.getElementById('myLabel').innerHTML = "Add Retailer Type";
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
    
   
</head>
<body>

<?php require_once("admin_menu.php"); ?> 


<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading">Retailer Business Type</div>
      <div class="panel-body">
              
    <?php
	if ($message != ''){echo "<div class='alert alert-danger'>".$message."</div>"; }
	?>
<form action="<?php echo base_url()."retailer_type"; ?>" method="post" name="frmRetailerType" id="frmRetailerType">
    
    <div class="form-group">
    <label for="txtRetailer_type">Retailer Business Name :</label>
    <input type="text" title="Enter Retailer Type.<br/>e.g Cable &amp; DTH, telecom" name="txtRetailer_type" id="txtRetailer_type" class="form-control" />
    </div>

    <input type="submit" class="btn btn-primary" value="Submit" name="btnSubmit" id="btnSubmit" />
    <input type="reset" class="btn btn-primary" onClick="SetReset()" value="Cancel" name="btnCancel" id="btnCancel" />    
    

<input type="hidden" id="hidID" name="hidID" />
</form>
    <form action="<?php echo base_url()."retailer_type"; ?>" method="post" autocomplete="off" name="frmDelete" id="frmDelete">
    <input type="hidden" id="hidValue" name="hidValue" />
    <input type="hidden" id="action" name="action" value="Delete" />
</form>

<hr>

<table class="table table-hover">
    <thead> 
        <tr> 
             <th>Agent Business Name</th> 
           
             <th>Actions</th>
              
        </tr> </thead>
     <tbody>
    <?php	$i = 0;foreach($result_retailer_type->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
            	<td><span id="<?php echo $result->retailer_type_id; ?>"><?php echo $result->retailer_type_name; ?></span></td>
 				<td><img src="<?php echo base_url()."images/delete.PNG"; ?>" height="20" width="20" onClick="Confirmation('<?php echo $result->retailer_type_id; ?>')" title="Delete Row" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <img src="<?php echo base_url()."images/Edit.PNG"; ?>" onClick="SetEdit('<?php echo $result->retailer_type_id; ?>')" title="Edit Row" /></td>
 				
 </tr>
		<?php 	
		$i++;} ?>
        </tbody>
		</table>
    
	   </div>
    </div>
</div>

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
 
  
</body>
</html>
