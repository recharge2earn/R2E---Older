<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Insert Bank</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?> 
    <script>
	$(document).ready(function(){
	//global vars
	$('#example').dataTable(); 
	var form = $("#frmBank");
	var sbank = $("#txtBank");
	var sbankInfo = $("#sBankInfo");
	sbank.focus();
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
		if(sbank.val() ==  ""){
			//sbank.addClass("error");
			jAlert('Enter Bank Name. e.g State Bank of India, Bank of Baroda', 'Alert Dialog');
			sbankInfo.text("");
			return false;
		}
		//if it's valid
		else{
			sbank.removeClass("error");
			sbankInfo.text("");
			return true;
		}
	}
	setTimeout(function(){$('div.message').fadeOut(1000);}, 2000);	
});
		function Confirmation(value)
	{
		var varName = document.getElementById("bank_"+value).innerHTML;
		if(confirm("Are you sure?\nyou want to delete "+varName+" bank.") == true)
		{
			document.getElementById('hidValue').value = value;
			document.getElementById('frmDelete').submit();
		}
	}
	function SetEdit(value)
	{
		
		document.getElementById('txtBank').value=document.getElementById("bank_"+value).innerHTML;;
		document.getElementById('btnSubmit').value='Update';
		document.getElementById('hidID').value = value;
		document.getElementById('myLabel').innerHTML = "Edit Bank";
	}
	function SetReset()
	{
		document.getElementById('btnSubmit').value='Submit';
		document.getElementById('hidID').value = '';
		document.getElementById('myLabel').innerHTML = "Add Bank";
	}
	</script>
</head>
<body>

<?php require_once("admin_menu.php"); ?> 


<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading">Insert Bank Name</div>
      <div class="panel-body">

     
    <?php
	if ($message != ''){echo "<div class='alert alert-success'>".$message."</div>"; }
	?>
    <form action="<?php echo base_url()."bank"; ?>" method="post" name="frmBank" id="frmBank">
    
    <div class="from-group">
    <label for="txtBank">Bank Name : </label>
    <input type="text" name="txtBank" title="Enter Bank Name.<br />e.g State Bank of India, Bank of Baroda" id="txtBank" class="form-control" />
    </div>
<br>
    <input type="submit" class="btn btn-primary" value="Submit" name="btnSubmit" id="btnSubmit" />
    <input type="reset" class="btn btn-primary" onClick="SetReset()" value="Cancel" name="btnCancel" id="btnCancel" />    
    

<input type="hidden" id="hidID" name="hidID" />
</form>
    <form action="<?php echo base_url()."bank"; ?>" method="post" autocomplete="off" name="frmDelete" id="frmDelete">
    <input type="hidden" id="hidValue" name="hidValue" />
    <input type="hidden" id="action" name="action" value="Delete" />
</form>

<hr>
<table class="table table-hover">
    <thead> 
        <tr> 
            
             <th>Bank Name</th> 
           
            <th>Edit</th> 
        </tr> </thead>
     <tbody>
    <?php	$i = 0;foreach($result_bank->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
            	<td><span id="bank_<?php echo $result->bank_id; ?>"><?php echo $result->bank_name; ?></span></td>
                 <td>
              

              <img src="<?php echo base_url()."images/Edit.PNG"; ?>" onClick="SetEdit('<?php echo $result->bank_id; ?>')" title="Edit Row" />
              </td>  
 				
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