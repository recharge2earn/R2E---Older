<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Enable API</title>
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
    <script src="<?php echo base_url()."js/external/jquery.bgiframe-2.1.2.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
    <script src="<?php echo base_url()."js/ui/jquery.ui.tabs.js"; ?>"></script>
    <script src="<?php echo base_url()."js/ui/jquery.ui.mouse.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.button.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.draggable.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.position.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.dialog.js"; ?>"></script>    
    <script src="<?php echo base_url()."js/qTip.js"; ?>"></script>   
    <script>
	setTimeout(function(){$('div.message').fadeOut(1000);}, 3000);
	function ActionSubmit(value,name)
	{
		if(document.getElementById('action_'+value).selectedIndex != 0)
		{
			var isstatus;
			if(document.getElementById('action_'+value).value == 0)
			{isstatus = 'cancel';
						if(confirm('Are you sure?\n you want to '+isstatus+' api for - ['+name+']')){
				document.getElementById('hidstatus').value= 'no';
				document.getElementById('hiduserid').value= value;				
				document.getElementById('frmCallAction').submit();				
				}			
			}
			else{
				isstatus='active';
				$( "#dialog-api" ).dialog({
			resizable: false,
			height:290,
			width:570,
			modal: true,
			buttons: {
				"Enable API": function() {
					var APIUrl = $("#txtAPIUrl");
					if(APIUrl.val() == "")
					{
						APIUrl.addClass("error");
						return false;
					}
					else{
				APIUrl.removeClass("error");								
				document.getElementById('hidstatus').value= 'yes';
				document.getElementById('hiduserid').value= value;				
				document.getElementById('hidapiurl').value= APIUrl.val();								
				document.getElementById('frmCallAction').submit();
						}
					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});								
				document.getElementById('lblDistName').innerHTML= name;				
				}			
		}
	}
	</script>
</head>
<body class="twoColFixLtHdr">
<div id="container">
<div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("a_menu.php"); ?> 
  </div>
   <div id="back-border">
  </div>
<div class="form-container ui-helper-clearfix ui-corner-all">
  <div>
<h1>Enable API</h1>  
 <form action="<?php echo base_url()."enable_api" ?>" method="post" name="frmCallAction" id="frmCallAction">
<input type="hidden" id="hidstatus" name="hidstatus" />
<input type="hidden" id="hiduserid" name="hiduserid" />
<input type="hidden" id="hidapiurl" name="hidapiurl" />
<input type="hidden" id="hidaction" name="hidaction" value="Set" />
 </form>
 
 
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if($this->session->flashdata('user_message')){echo "<div class='message'>".$this->session->flashdata('user_message')."</div>";}
	?>    
    
     <form action="<?php echo base_url()."enable_api" ?>" method="post" name="frmSearch" id="frmSearch">
     <fieldset>
     <legend>Search Category</legend>
     <table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
     <tr>
    <td align="center">
    Search By :<select id="ddlSearchBy" name="ddlSearchBy" class="select" title="Select Search By">
    <option value="Mobile">Mobile No</option>
    <option value="MasterDealer">MasterDealer Name</option>
    <option value="UserName">User Name</option>
    </select>
    
     <input type="text" title="Enter Search Word." class="text" name="txtSearch_Word" id="txtSearch_Word" />&nbsp;<input type="submit" class="button" value="Search" name="btnSearch" id="btnSearch" ></td>	
	</tr>
</table>     
</fieldset>
<br />
 </form>
 <div id="dialog-api" style="display:none" title="Enable API">
    <table>
    <tr>
    <td align="right">Status : </td>
    <td align="left"><span style="font-size:18px;font-weight:bold;color:#090">Active</span></td>
    </tr>
    <tr>
    <td align="right" width="200px">MasterDealer Name : </td>
    <td align="left"><span id="lblDistName" style="font-size:18px;font-weight:bold;color:#33F"></span></td>
    </tr>
    <tr>
    <td align="right" valign="top"><label for="txtAPIUrl">User Reponse URL : </label></td>
    <td align="left" valign="top"><input type="text" title="Enter Response URL." name="txtAPIUrl" id="txtAPIUrl" class="text" />
   <br /> URL FORMAT :<br /><strong>http://www.yourdomain.com/yourresponsepage.php</strong>
    </td>
    </tr>
    </table>        
	</div>
 
 
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr style="background-color:#033;color:#FFF">    
    <th scope="col" align="left"></th>
    <th scope="col" align="left">MasterDealer Name</th>
    <th scope="col" align="left">User Name</th>	
	<th scope="col" align="left">Address</th> 
	<th scope="col" align="left">Mobile</th>
   	<th scope="col" align="left">Email ID</th>    
    <th scope="col" align="left">API URL</th>
	<th scope="col" align="left">API</th>
	<th scope="col" align="left">Action</th>                 
    </tr>   
    <?php	$i = 0;foreach($result_distributer->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
<td></td>            
 <td><?php echo $result->business_name; ?></td>
  <td><?php echo $result->username; ?></td> 
 <td><?php echo $result->postal_address; ?></td>
 <td><?php echo $result->mobile_no; ?></td>
 <td><?php echo $result->emailid; ?></td>
 <td><?php echo $result->api_execution_url; ?></td>
 <td><?php if($result->isAPIEnable == 'no'){echo "<span class='red'>Cancel</span>";}else{echo "<span class='green'>Active</span>";} ?></td>
 <td>
 <select id="action_<?php echo $result->user_id; ?>" onChange="ActionSubmit('<?php echo $result->user_id; ?>','<?php echo $result->business_name; ?>')"><option value="Select">Select</option><option value="1">Active</option><option value="0">Cancel</option></select>
 </td>
 </tr>
		<?php 	
		$i++;} ?>
		</table>
       <?php  echo $pagination; ?>
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
<!-- end #container --></div>
  <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
  </div>
</body>
</html>