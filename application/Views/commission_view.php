<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Set Scheme Commission</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?> 


      <script>
	$(document).ready(function(){
	$('#example').dataTable();
	//global vars
	var form = $("#frmcommssion_view");
	var companyname = $("#ddlCompanyName");
	var companyInfo = $("#companyInfo");
	//var apiname = $("#txtAPIName");
	//var apiInfo = $("#apiInfo");
	var priority = $("#ddlPriority");
	var priorityInfo = $("#priorityInfo");
	var txtRoyalComm = $("#txtRoyalComm");

	//var commissionInfo = $("#commissionInfo");			
	var scheme = $("#ddlScheme");
	var schemeInfo = $("#schemeInfo");			
	companyname.focus();
	
	form.submit(function(){
		if(validateCompany() & validateRCommssion() & validateScheme())
			{				
			return true;
			}
		else
			return false;
	});
	function validateCompany(){
		if(companyname[0].selectedIndex == 0)
		{
			companyname.addClass("error");
			jAlert('Select Company Name.', 'Alert Dialog');
			companyInfo.text("");
			return false;
		}
		else{companyname.removeClass("error");companyInfo.text("");return true;}
	}
	
	function validateProirity(){
		if(priority[0].selectedIndex == 0){priority.addClass("error");priorityInfo.text("");return false;}
		else{priority.removeClass("error");priorityInfo.text("");return true;}
	}
	function validateRCommssion(){
		if(txtRoyalComm.val() == ""){
			txtRoyalComm.addClass("error");
			jAlert('Enter Commssion Percentage. e.g 2.5', 'Alert Dialog');
			return false;}
		else{txtRoyalComm.removeClass("error");return true;}
	}
	function validateScheme(){
		if(scheme[0].selectedIndex == 0){
		scheme.addClass("error");
		jAlert('Select Scheme Name.', 'Alert Dialog');
		schemeInfo.text("");
		return false;
		}
		else{scheme.removeClass("error");schemeInfo.text("");return true;}
	}	
	
	setTimeout(function(){$('div.message').fadeOut(1000);}, 2000);
	
});
	function Confirmation(value)
	{
		var varName = document.getElementById("name_"+value).innerHTML;
		if(confirm("Are you sure?\nyou want to delete "+varName+" commission.") == true)
		{
			document.getElementById('hidValue').value = value;
			document.getElementById('frmDelete').submit();
		}
	}
	function SetEdit(value)
	{
		document.getElementById('ddlCompanyName').value=document.getElementById("hidname_"+value).value;
		document.getElementById('txtRoyalComm').value=document.getElementById("rcomm_"+value).innerHTML;
		document.getElementById('ddlScheme').value=document.getElementById("hidscheme_"+value).value;		
		document.getElementById('btnSubmit').value='Update';
		document.getElementById('hidID').value = value;
		document.getElementById('myLabel').innerHTML = "Edit Commission";
	}
	function SetReset()
	{
		document.getElementById('btnSubmit').value='Submit';
		document.getElementById('hidID').value = '';
		document.getElementById('myLabel').innerHTML = "Add Commission";
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


<div  class="container">

 <?php
	if ($message != ''){echo "<div class='alert alert-danger'>".$message."</div>"; }
	?>
<div class="panel panel-primary">
      <div id="top" class="panel-heading">Set Scheme Commission</div>
      <div class="panel-body">
       <form method="post" action="<?php echo base_url()."commission"; ?>" name="frmcommssion_view" id="frmcommssion_view" autocomplete="off">
           
           <div class="form-group">
    <label for="ddlCompanyName">Operator Name :</label>
    <select id="ddlCompanyName" name="ddlCompanyName" title="Select Operator Name." class="form-control"><option>--Select--</option>
    <?php
		$str_query = "select * from tblcompany order by company_name";
		$result_mobile = $this->db->query($str_query);		
		for($i=0; $i<$result_mobile->num_rows(); $i++)
		{
			echo "<option value='".$result_mobile->row($i)->company_id."'>".$result_mobile->row($i)->company_name."</option>";
		}
	?>
    </select>
  </div>
  
  
  <div class="form-group">
    <label for="txtRoyalComm">Commission:</label>
    <input type="text" class="form-control" id="txtRoyalComm" title="Enter Commssion Percentage.<br />e.g 2.5" name="txtRoyalComm" maxlength="10"/>
  </div>
  
  
    <div class="form-group">
    <label for="ddlScheme">Scheme Name:</label>
    <select id="ddlScheme" name="ddlScheme" title="Select Scheme Name." class="form-control"><option>--Select--</option>
    <?php
		$str_query = "select * from tblscheme order by scheme_name";
		$result_scheme = $this->db->query($str_query);		
		for($i=0; $i<$result_scheme->num_rows(); $i++)
		{
			echo "<option value='".$result_scheme->row($i)->scheme_id."'>".$result_scheme->row($i)->scheme_name." - ".$result_scheme->row($i)->scheme_type."</option>";
		}
	?>
    </select>
  </div>
           <input type="submit" class="btn btn-danger" id="btnSubmit" name="btnSubmit" value="Submit"/> <input type="reset" class="btn btn-warning" onClick="SetReset()" id="bttnCancel" name="bttnCancel" value="Cancel"/>
          <input type="hidden" id="hidID" name="hidID" />
      </div>
    </div>
    
    
    
    <div class="panel panel-primary">
      <div class="panel-heading">List Of Operator Comission</div>
      <div class="panel-body">
          <form action="<?php echo base_url()."commission"; ?>" method="post" autocomplete="off" name="frmDelete" id="frmDelete">
    <input type="hidden" id="hidValue" name="hidValue" />
    <input type="hidden" id="action" name="action" value="Delete" />
</form>


<table class="table table-hover">
    <thead> 
        <tr> 
             <th>Operator Name</th> 
            <th>Commssion(%)</th>
          
              <th>Scheme</th>
             <th>Actions</th>
              
        </tr> </thead>
     <tbody>
    <?php	$i = 0;foreach($result_commission->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
            	<td><span id="name_<?php echo $result->commission_id; ?>"><?php echo $result->company_name; ?></span>
              	<input type="hidden" id="hidname_<?php echo $result->commission_id; ?>" value="<?php echo $result->company_id; ?>" /></td>
              	
 				<td><span id="rcomm_<?php echo $result->commission_id; ?>"><?php echo $result->royalComm; ?></span></td>
 				
                <td><span id="scheme_<?php echo $result->commission_id; ?>"><?php echo $result->scheme_name; ?></span>
                
                <input type="hidden" id="hidscheme_<?php echo $result->commission_id; ?>" value="<?php echo $result->scheme_id; ?>" /></td>
 				<td>
 				    <a href="#" class="btn btn-info" onClick="SetEdit('<?php echo $result->commission_id; ?>')" role="button">Edit</a>
 				    
 				    </td>
 </tr>
		<?php 	
		$i++;} ?>
        </tbody>
		</table>

          
          </div></div>
    
    
</div>

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
	
</body>
</html>