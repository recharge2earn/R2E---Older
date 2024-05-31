<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>State</title>
     <?php include("script1.php");?>    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <link rel="stylesheet" href="<?php echo base_url()."js/jquery.alerts.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>  
    <script src="<?php echo base_url()."js/jquery.alerts.js"; ?>"></script>  
    <link href="<?php echo base_url()."jquery.dataTables.css"; ?>" rel="stylesheet" type="text/css" />    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <link rel="stylesheet" href="<?php echo base_url()."js/jquery.alerts.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>               
    <script src="<?php echo base_url()."js/jquery.dataTables.min.js"; ?>"></script> 
    <script src="<?php echo base_url()."js/jquery.alerts.js"; ?>"></script>                            
    <script>
	$(document).ready(function()
	{							   							   
	//global vars
	 $('#example').dataTable(); 
	var form = $("#frmcity_view");
	var cname = $("#txtCityName");
	var cnameInfo = $("#cnameInfo");
	var sname = $("#ddlStateName");
	var snameInfo = $("#snameInfo");		
	form.submit(function(){
		if(validatesName() & validatecName())
			{				
			return true;
			}
		else
			return false;
	});
	function validatecName(){
		if(cname.val() == ""){
			//cname.addClass("error");
			jAlert('Enter City Name.<br />e.g Ahmedabad, Baroda.', 'Alert Dialog');
			cnameInfo.text("");
			return false;
		}
		else{
			cname.removeClass("error");
			cnameInfo.text("");
			return true;
		}
	}
	function validatesName(){
		if(sname[0].selectedIndex == 0){
			//sname.addClass("error");
			jAlert('Select State Name. Click on drop down', 'Alert Dialog');
			snameInfo.text("");
			return false;
		}
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
		var varName = document.getElementById("cname_"+value).innerHTML;
		if(confirm("Are you sure?\nyou want to delete "+varName+" city.") == true)
		{
			document.getElementById('hidValue').value = value;
			document.getElementById('frmDelete').submit();
		}
	}
	function SetEdit(value)
	{
		document.getElementById('txtCityName').value=document.getElementById("cname_"+value).innerHTML;
		document.getElementById('ddlStateName').value=document.getElementById("hidstate_"+value).value;
		document.getElementById('btnSubmit').value='Update';
		document.getElementById('hidID').value = value;
		document.getElementById('myLabel').innerHTML = "Edit City";
	}
	function SetReset()
	{
		document.getElementById('btnSubmit').value='Submit';
		document.getElementById('hidID').value = '';
		document.getElementById('myLabel').innerHTML = "Add City";
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
    <h2 class="border_bottom"><span id="myLabel">Add New City</span></h2>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
     <form method="post" action="<?php echo base_url()."city"; ?>" name="frmcity_view" id="frmcity_view" autocomplete="off">
    <fieldset>
<table cellpadding="3" cellspacing="3" border="0">
<tr>
<td align="right"><label for="txtCityName"><span style="color:#F06">*</span> City Name :</label></td><td align="left"><input type="text" class="text" id="txtCityName" title="Enter City Name.<br />e.g Ahmedabad, Baroda" name="txtCityName" maxlength="100"/>
<span id="cnameInfo"></span>
</td>
</tr>
<tr>
<td align="right"><label for="ddlStateName"><span style="color:#F06">*</span> State Name :</label></td><td align="left"><select id="ddlStateName" name="ddlStateName" title="Select State Name.<br />Click on drop down" class="select">
<option>Select State</option>
<?php
$str_query = "select * from tblstate";
		$result = $this->db->query($str_query);		
		for($i=0; $i<$result->num_rows(); $i++)
		{
			echo "<option value='".$result->row($i)->state_id	."'>".$result->row($i)->state_name."</option>";
		}
?>
</select>
<span id="snameInfo"></span>
</td>
</tr>
<tr>
<td></td><td align="left"><input type="submit" class="button" id="btnSubmit" name="btnSubmit" value="Submit"/>  <input type="reset" class="button" onClick="SetReset()" value="Cancel" name="btnCancel" id="btnCancel" /></td>
</tr>
</table>
</fieldset>
<input type="hidden" id="hidID" name="hidID" />
</form>


    <form action="<?php echo base_url()."city"; ?>" method="post" autocomplete="off" name="frmDelete" id="frmDelete">
    <input type="hidden" id="hidValue" name="hidValue" />
    <input type="hidden" id="action" name="action" value="Delete" />
</form>
<h2 class="h2">View Existing City</h2>

<table style="width:100%;" id="example" class='dataTable' cellpadding="3" cellspacing="0" border="0">
    <thead> 
        <tr class="ColHeader"> 
             <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >City Name</th> 
            <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >State Name</th>
              <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Actions</th>
            
        </tr> </thead>
<?php	$i = 0;foreach($result_city->result() as $result) 	{  ?>
<tbody>
			<tr>
 
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;"><span id="name_<?php echo $result->city_id; ?>"><?php echo $result->city_name; ?></span>
              	<input type="hidden" id="hidname_<?php echo $result->city_id; ?>" value="<?php echo $result->city_id; ?>" /></td>
 				<td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;"><span id="code_<?php echo $result->city_id; ?>"><?php echo $result->state_name; ?></span></td>
 				
               
 				<td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;"><img src="<?php echo base_url()."images/delete.PNG"; ?>" height="20" width="20" onClick="Confirmation('<?php echo $result->city_id; ?>')" title="Delete Row" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <img src="<?php echo base_url()."images/Edit.PNG"; ?>" onClick="SetEdit('<?php echo $result->city_id; ?>')" title="Edit Row" /></td>
 

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