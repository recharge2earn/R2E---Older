<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Your Bank Details</title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>   
         
    <script>
	$(document).ready(function(){
	//global vars
	var form = $("#frmBank");
	var sbank = $("#ddlBank");
	var sifsc = $("#txtIfscCode");
	var accountno = $("#txtAccountNo");
	var sbranchname = $("#txtBranchName");	
	sbank.focus();
	sbank.blur(validatesBankname)
	sifsc.blur(validatesIfsc)
	accountno.blur(validatesAccountno)
	sbranchname.blur(validatesBranchName)	
	form.submit(function(){
		if(validatesBankname() & validatesIfsc() & validatesAccountno() & validatesBranchName())
			{				
			return true;
			}
		else
			return false;
	});
	function validatesBankname(){
		if(sbank[0].selectedIndex ==  0){
			sbank.addClass("error");		
			return false;
		}
		else{
			sbank.removeClass("error");
			return true;
		}
	}	
	function validatesIfsc(){
		if(sifsc.val() ==  ""){
			sifsc.addClass("error");		
			return false;
		}
		else{
			sifsc.removeClass("error");
			return true;
		}
	}
	function validatesAccountno(){
		if(accountno.val() ==  ""){
			accountno.addClass("error");		
			return false;
		}
		else{
			accountno.removeClass("error");
			return true;
		}
	}
	function validatesBranchName(){
		if(sbranchname.val() ==  ""){
			sbranchname.addClass("error");		
			return false;
		}
		else{
			sbranchname.removeClass("error");
			return true;
		}
	}
	
	setTimeout(function(){$('div.message').fadeOut(1000);}, 2000);	
});
	function Confirmation(value)
	{
		var varName = document.getElementById(""+value).innerHTML;
		if(confirm("Are you sure?\nyou want to delete "+varName+" bank.") == true)
		{
			document.getElementById('hidValue').value = value;
			document.getElementById('frmDelete').submit();
		}
	}
	function SetEdit(value)
	{
		
		document.getElementById('ddlBank').value=document.getElementById("hidbankid_"+value).value;
		document.getElementById('txtIfscCode').value=document.getElementById("ifsc_"+value).innerHTML;
		document.getElementById('txtAccountNo').value=document.getElementById("accno_"+value).innerHTML;
		document.getElementById('txtBranchName').value=document.getElementById("branch_"+value).innerHTML;
		document.getElementById('btnSubmit').value='Update';
		document.getElementById('hidID').value = value;
		document.getElementById('myLabel').innerHTML = "Edit Bank Details";
	}
	function SetReset()
	{
		document.getElementById('btnSubmit').value='Submit';
		document.getElementById('hidID').value = '';
		document.getElementById('myLabel').innerHTML = "Add Bank Details";
	}
	</script>
</head>
<body>

  <?php require_once("admin_menu.php"); ?> 


<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading">Bank Details</div>
      <div class="panel-body">       
    <?php
	if ($message != ''){echo "<div class='alert alert-success'>".$message."</div>"; }
	?>
    <form action="<?php echo base_url()."admin_bank_details"; ?>" method="post" name="frmBank" id="frmBank">
    
    <div class="form-group">
    <label for="ddlBank">Bank Name : </label>
    <select id="ddlBank" name="ddlBank" title="Select Bank Name.<br />Click on drop down" class="form-control" required="">
    <option>Select Bank</option>
<?php
$str_query = "select * from tblbank";
		$result = $this->db->query($str_query);		
		for($i=0; $i<$result->num_rows(); $i++)
		{
			echo "<option value='".$result->row($i)->bank_id."'>".$result->row($i)->bank_name."</option>";
		}
?>
</select>
</div>

<div class="form-group">
<label for="txtIfscCode">IFSC Code : </label>
<input type="text" name="txtIfscCode" title="Enter IFSC Code" id="txtIfscCode" class="form-control" required="" />
  </div>  

<div class="form-group">
    <label for="txtAccountNo">Account No : </label>
    <input type="text" name="txtAccountNo" title="Enter Bank Account No." id="txtAccountNo" class="form-control" required="" />
    </div>

<div class="form-group">
    <label for="txtBranchName">Branch Name : </label>
    <input type="text" name="txtBranchName" title="Enter Branch Name." id="txtBranchName" class="form-control" required="" />
    </div>

    <input type="submit" class="btn btn-primary" value="Submit" name="btnSubmit" id="btnSubmit" />
    <input type="reset" class="btn btn-primary" onClick="SetReset()" value="Cancel" name="btnCancel" id="btnCancel" />    
    
<input type="hidden" id="hidID" name="hidID" />
</form>
    <form action="<?php echo base_url()."admin_bank_details"; ?>" method="post" autocomplete="off" name="frmDelete" id="frmDelete">
    <input type="hidden" id="hidValue" name="hidValue" />
    <input type="hidden" id="action" name="action" value="Delete" />
</form>



<table class="table table-hover">
    <tr>
   <th>Delete</th>
    <th>Edit</th>
    <th>Bank Name</th>
	<th>IFSC Code</th>    
	<th>Account No</th>
    <th>Branch Name</th>    
    </tr>
    <?php	$i = 0;foreach($result_bank->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><img src="<?php echo base_url()."images/delete.PNG"; ?>" height="20" width="20" onClick="Confirmation('<?php echo $result->user_bank_id; ?>')" title="Delete Row" /></td>
 <td><img src="<?php echo base_url()."images/Edit.PNG"; ?>" onClick="SetEdit('<?php echo $result->user_bank_id; ?>')" title="Edit Row" /></td>
 <td><span id="<?php echo $result->user_bank_id; ?>"><?php echo $result->bank_name; ?></span>
 <input type="hidden" name="hidbankid_<?php echo $result->user_bank_id; ?>" id="hidbankid_<?php echo $result->user_bank_id; ?>" value="<?php echo $result->bank_id; ?>" />
 </td>
 <td><span id="ifsc_<?php echo $result->user_bank_id; ?>"><?php echo $result->ifsc_code; ?></span></td>
 <td><span id="accno_<?php echo $result->user_bank_id; ?>"><?php echo $result->account_number; ?></span></td>
 <td><span id="branch_<?php echo $result->user_bank_id; ?>"><?php echo $result->branch_name; ?></span></td>
 </tr>
		<?php 	
		$i++;} ?>
		</table>
       <?php  echo $pagination; ?>       

	   </div>
    </div>
</div>

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
</body>
</html>