<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Access Rights</title> 
	<?php include("script1.php");?>
 	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                                     
    <script>
	$(document).ready(function(){
	//global vars
	var form = $("#frmaccess_rights");
	var sname = $("#ddlUserName");
	var serviceName = $("#ddlServiceName");
	sname.focus();
	sname.blur(validatesName);
	serviceName.blur(validatesServiceName);	
	form.submit(function(){
		if(validatesName() & validatesServiceName())
			{				
			return true;
			}
		else
			return false;
	});
	function validatesName(){
		if(sname[0].value ==  "0"){sname.addClass("error");return false;}
		else{sname.removeClass("error");return true;}
	}
	function validatesServiceName(){
		if(serviceName[0].value ==  "0"){serviceName.addClass("error");return false;}
		else{serviceName.removeClass("error");return true;}
	}
	setTimeout(function(){$('div.message').fadeOut(1000);}, 2000);
	
});
	function setStatus()
	{
		if(document.getElementById('chkActive').checked == true)
		{
			document.getElementById('hidActive').value = 'yes';
		}		 
		else
		{
			document.getElementById('hidActive').value = 'no';
		}
	}
	
	function getUserName(urlToSend)
	{	
		if(document.getElementById('ddlUserType').value != "0")
		{			
		$.ajax({
  type: "GET",
  url: urlToSend+"?usertype="+document.getElementById('ddlUserType').value,
  success: function(html){    
	$("#ddlUserName").html(html);
  }
});
		}
	}

	function getStatus(urlToSend)
	{	
		if(document.getElementById('ddlServiceName').value != "0")
		{			
		$.ajax({
  type: "GET",
  url: urlToSend+"?user_id="+document.getElementById('ddlUserName').value+"&module_name="+document.getElementById('ddlServiceName').value,
  success: function(html){    
	var result = html.split("***");
	document.getElementById('hidModuleID').value = result[1];
	if(result[0] == "yes")
	{
		document.getElementById('chkActive').checked = true;
		document.getElementById('hidActive').value ="yes";
	}
	else
	{
		document.getElementById('chkActive').checked = false;
		document.getElementById('hidActive').value ="no";
	}
  }
});
		}
	}
	function setCSS(Spanid,chkID)
	{
		if(document.getElementById(''+chkID).checked == true)
		{
			$("#"+Spanid).removeClass("red");
			$("#"+Spanid).addClass("green");
			$("#"+Spanid).html("yes");
		}
		else
		{
			$("#"+Spanid).removeClass("green");
			$("#"+Spanid).addClass("red");
			$("#"+Spanid).html("no");
		}
	}
	function callAction(id)
	{
		var name = document.getElementById('name'+id).innerHTML;
		if(confirm("Are you sure? you want apply rights for user["+name+"]"))
		{
			if(document.getElementById('isMobile'+id).checked == true)
			{ document.getElementById('hidisMobile').value = "yes"; } 
			else { document.getElementById('hidisMobile').value = "no";}
			if(document.getElementById('isDTH'+id).checked == true)
			{ document.getElementById('hidisDTH').value = "yes"; }
			else { document.getElementById('hidisDTH').value = "no"; }
			
			
			document.getElementById('hiduser_id').value = document.getElementById('user'+id).value;
			document.getElementById('hidmodule_id').value = id;		
			document.getElementById('frmaccess_rights').submit();
		}
	}
	</script>
     
    <script language="javascript">
	function searchRecord()
	{
		 if (e.keyCode == 13) 
		 {
			 document.getElementById("frmsearch").submit();
		 }
		
		
	}
	</script>
    
    <link href="<?php echo base_url()."jquery.dataTables.css"; ?>" rel="stylesheet" type="text/css" />    
    <script src="<?php echo base_url()."js/jquery.dataTables.min.js"; ?>"></script> 
   
   
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
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
    
<h2 class="h2">Access Rights</h2>
<div align="right" style="margin-top:10px;">
<form id="frmsearch" name="frmsearch" action="access_rights" method="post">
Quick Search : &nbsp;&nbsp;&nbsp;<input type="text" id="SewarchBox" name="SewarchBox"/>
</form>
</div>
<table style="width:100%;" id="example" class='dataTable' cellpadding="3" cellspacing="0" border="0">
    <thead> 
        <tr class="ColHeader"> 
             <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Name</th> 
             <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Mobile</th> 
             <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Active</th> 
             <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >DTH</th> 
             <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Active</th> 
             <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Action</th> 
             
        </tr> </thead>
     <tbody>
    <?php	$i = 0;foreach($result_access->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
            	<td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;">			
						<?php echo "<span id='name".$result->module_id."'>".$result->name."</span>"; 
 echo "<input type='hidden' name='user".$result->module_id."' id='user".$result->module_id."' value='".$result->user_id."' />";
 ?>
                </td>
                <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;">			
						<?php if($result->isMobile == 'yes'){ ?>
<input type="checkbox" onClick="setCSS('spanMobile<?php echo $result->module_id; ?>',this.id)" name='isMobile<?php echo $result->module_id; ?>' id='isMobile<?php echo $result->module_id; ?>' checked='checked' />
<?php }else{ ?>
<input type="checkbox" onClick="setCSS('spanMobile<?php echo $result->module_id; ?>',this.id)" name='isMobile<?php echo $result->module_id; ?>' id='isMobile<?php echo $result->module_id; ?>' />
<?php } ?>
                </td>
                <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;">			
						<?php if($result->isMobile == 'yes'){?>
<span id='spanMobile<?php echo $result->module_id; ?>' class='green'>yes</span>
<?php }else{ ?> 
<span id='spanMobile<?php echo $result->module_id; ?>' class='red'>no</span>
<?php } ?>
                </td>
                <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;">			
						<?php if($result->isDTH == 'yes'){ ?> 
<input type="checkbox" onClick="setCSS('spanDTH<?php echo $result->module_id; ?>',this.id)"  name='isDTH<?php echo $result->module_id; ?>' id='isDTH<?php echo $result->module_id; ?>' checked='checked' />
<?php }else{ ?>
<input type="checkbox" onClick="setCSS('spanDTH<?php echo $result->module_id; ?>',this.id)"  name='isDTH<?php echo $result->module_id; ?>' id='isDTH<?php echo $result->module_id; ?>' />
<?php } ?>
                </td>
                <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;">			
						<?php if($result->isDTH == 'yes'){?>
<span id='spanDTH<?php echo $result->module_id; ?>' class='green'>yes</span>
<?php }else{ ?> 
<span id='spanDTH<?php echo $result->module_id; ?>' class='red'>no</span>
<?php } ?>
                </td>
                <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;">			
						<input type="button" onClick="callAction('<?php echo $result->module_id; ?>')" class="button" value="Submit" />
                </td>
               
 </tr>
		<?php 	
		$i++;} ?>
        </tbody>
		</table>
     <?php  echo $pagination; ?>
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>
