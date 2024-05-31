<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>State</title>
     
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>  

    <script>
	$(document).ready(function(){
	//global vars
	 $('#example').dataTable(); 
	var form = $("#frmState");
	var sname = $("#txtState");
	var snameInfo = $("#snameInfo");
	var code = $("#txtCode");
	var codeInfo = $("#codeInfo");
	var circlecode = $("#txtCircleCode");
	var circlecodeInfo = $("#circlecodeInfo");	
	sname.focus();
	form.submit(function(){
		if(validatesName() & validatesCode() & validatesCircleCode())
			{				
			return true;
			}
		else
			return false;
	});
	function validatesName(){
		//if it's NOT valid
		if(sname.val() == ""){
			sname.addClass("error");
			jAlert('Enter State Name. e.g Gujarat, Rejasthan', 'Alert Dialog');
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
	function validatesCode(){
		//if it's NOT valid
		if(code.val() ==  ""){
			code.addClass("error");			
			jAlert('Enter State Code. e.g Gujarat - GJ, Maharastra - MH.', 'Alert Dialog');
			codeInfo.text("");
			return false;
		}
		//if it's valid
		else{
			code.removeClass("error");
			codeInfo.text("");
			return true;
		}
	}
	function validatesCircleCode(){
		//if it's NOT valid
		if(circlecode.val() ==  ""){
			circlecode.addClass("error");	
			jAlert('Enter Circle Code.', 'Alert Dialog');
			circlecodeInfo.text("");
			return false;
		}
		//if it's valid
		else{
			circlecode.removeClass("error");
			circlecodeInfo.text("");
			return true;
		}
	}

	setTimeout(function(){$('div.message').fadeOut(1000);}, 2000);
	
});
	function Confirmation(value)
	{
		var varName = document.getElementById("name_"+value).innerHTML;
		if(confirm("Are you sure?\nyou want to delete "+varName+" state.") == true)
		{
			document.getElementById('hidValue').value = value;
			document.getElementById('frmDelete').submit();
		}
	}
	function SetEdit(value)
	{
		document.getElementById('txtState').value=document.getElementById("name_"+value).innerHTML;
		document.getElementById('txtCode').value=document.getElementById("code_"+value).innerHTML;
		document.getElementById('txtCircleCode').value=document.getElementById("circlecode_"+value).innerHTML;		
		document.getElementById('btnSubmit').value='Update';
		document.getElementById('hidID').value = value;
		document.getElementById('myLabel').innerHTML = "Edit State";
	}
	function SetReset()
	{
		document.getElementById('btnSubmit').value='Submit';
		document.getElementById('hidID').value = '';
		document.getElementById('myLabel').innerHTML = "Add State";
	}
	
	
	</script>
     
    
    
   
</head>
<body>
<?php require_once("admin_menu.php"); ?> 


<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading">State Name/State code/insert/Edit</div>
      <div class="panel-body">

       
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
<form action="<?php echo base_url()."state"; ?>" method="post" name="frmState" id="frmState">
   
   <label for="txtState">State Name :</label>
   <input type="text" title="Enter State Name.<br />e.g Gujarat, Rejasthan" name="txtState" id="txtState" required="" class="form-control" />
   

   <label for="txtCode">State Code :</label>
   <input type="text" title="Enter State Code.<br />e.g Gujarat - GJ, Maharastra - MH" name="txtCode" id="txtCode" class="form-control" />
    
    <label for="txtCircleCode">Circle Code :</label>
    <input type="text" title="Enter Circle Code." name="txtCircleCode" id="txtCircleCode" class="form-control" />


    <input type="submit" class="btn btn-primary" value="Submit" name="btnSubmit" id="btnSubmit" />
    <input type="reset" class="btn btn-primary" onClick="SetReset()" value="Cancel" name="btnCancel" id="btnCancel" />
   
<input type="hidden" id="hidID" name="hidID" />
</form>
<form action="<?php echo base_url()."state"; ?>" method="post" autocomplete="off" name="frmDelete" id="frmDelete">
    <input type="hidden" id="hidValue" name="hidValue" />
    <input type="hidden" id="action" name="action" value="Delete" />
</form>



<table class="table table-hover">
    <thead> 
        <tr> 
             <th>State Name</th> 
            <th>State Code</th>
             <th>Circle Code</th>
            
             <th>Actions</th>
              
        </tr> </thead>
     <tbody>
    <?php	$i = 0;foreach($result_state->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
            	<td><span id="name_<?php echo $result->state_id; ?>"><?php echo $result->state_name; ?></span>
              	<input type="hidden" id="hidname_<?php echo $result->state_id; ?>" value="<?php echo $result->state_id; ?>" /></td>
 				<td><span id="code_<?php echo $result->state_id; ?>"><?php echo $result->codes; ?></span></td>
 				<td><span id="circlecode_<?php echo $result->state_id; ?>"><?php echo $result->circle_code; ?></span>
              <input type="hidden" id="hidapi_<?php echo $result->state_id; ?>" value="<?php echo $result->state_id; ?>" /></td>
               
 				<td><img src="<?php echo base_url()."images/delete.PNG"; ?>" height="20" width="20" onClick="Confirmation('<?php echo $result->state_id; ?>')" title="Delete Row" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <img src="<?php echo base_url()."images/Edit.PNG"; ?>" onClick="SetEdit('<?php echo $result->state_id; ?>')" title="Edit Row" /></td>
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
