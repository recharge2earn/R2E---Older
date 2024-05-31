<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Retailer Home</title>
<style>
	#Mobilesortable { list-style-type: none; margin: 0; padding: 0;width:441px; }
	#Mobilesortable li { margin: 3px 3px 3px 3px; padding: 1px; float: left; width: 100px; height: 100px; text-align: center; }
	#DTHsortable { list-style-type: none; margin: 0; padding: 0;width:441px; }
	#DTHsortable li { margin: 3px 3px 3px 3px; padding: 1px; float: left; width: 100px; height: 100px; text-align: center; }
	</style>
    <?php require_once("script.php"); ?>
    <script>
 function EnableDiv()
 {
	 if(document.getElementById('radMobile').checked == true)
	 {
		
		 document.getElementById('Mobile').style.display="block";
		 document.getElementById('DTH').style.display="none";		 
	 }
	 else
	 {
		
 		 document.getElementById('DTH').style.display="block";
 		 document.getElementById('Mobile').style.display="none";
	 }
	 
 }
 
	 function get_transaction()
 {	
 		$.ajax({
  type: "GET",
  url: document.getElementById('hidURL').value,
  cache: false,
  success: function(html){	   	
	$("#tabs-report").html(html);
	setTimeout(get_transaction,10000);
  }
});
		$("#tabs-report").fadeOut(1000);
		$("#tabs-report").fadeIn(2000);		
 	 }

	
		$(document).ready(function(){
								   
								   
	
	
	
$(function() {
		$( "#Mobilesortable,#DTHsortable " ).sortable();
		$( "#Mobilesortable,#DTHsortable" ).disableSelection();
	});	
	setTimeout(function(){$('div.message').fadeOut(1000);}, 15000);
	setTimeout(get_transaction,10000)
});
	
	function SetCircleParam()
	{
		if(document.getElementById('ddlCircleName').selectedIndex != 0)
		{
			document.getElementById('hidCircle').value = $("#ddlCircleName")[0].options[document.getElementById('ddlCircleName').selectedIndex].getAttribute('circle_code');
		}
	}
	function SetCircleParam_DTH()
	{
		if(document.getElementById('ddlCircleName_DTH').selectedIndex != 0)
		{
			document.getElementById('hidCircle_DTH').value = $("#ddlCircleName_DTH")[0].options[document.getElementById('ddlCircleName_DTH').selectedIndex].getAttribute('circle_code');
		}
	}			
	function validates_mAmt(){
		var m_amt = $("#txtAmount");
		if(m_amt.val() == ""){m_amt.addClass("error");return false;}
		else{m_amt.removeClass("error");return true;}
	}	
	function validates_mCircle(){
		var m_circle = $("#ddlCircleName");	
		if(m_circle[0].selectedIndex == 0){m_circle.addClass("error");return false;}
		else{m_circle.removeClass("error");return true;}
	}			
	function validates_mNo(){
		var m_no = $("#txtMobileNo");
		if(m_no.val() == ""){m_no.addClass("error");return false;}
		else{			
		var MobileNumberRegEx = /\d{10}/;
		if (MobileNumberRegEx.test(m_no.val())) {m_no.removeClass("error");return true;}
		else{alert("Please enter a valid indian mobile number in the following format: 9898098980");m_no.addClass("error");return false;}
		}
	}
	function compare_amount()
	{
		var cnfAmount = $("#txtCnfAmount");	
		var m_amt = $("#txtAmount");
		var cnfAmountInfo = $("#cnfAmountInfo");
		if(cnfAmount.val() == "")
		{cnfAmount.addClass("error");return false;}
		else if(m_amt.val() != cnfAmount.val())
		{cnfAmount.addClass("error");cnfAmountInfo.text("Confirm Amount is not match.");return false;}
		else {cnfAmount.removeClass("error");cnfAmountInfo.text("");return true}
	}	
	
	function SetParam(id)
	{
		//if(document.getElementById('ddlOperator').selectedIndex != 0)
		{
			document.getElementById('hidProvider').value = $("#"+id)[0].getAttribute('provider');
			document.getElementById('hidServiceId').value = $("#"+id)[0].getAttribute('serviceid');						
			document.getElementById('hidOperatorCode').value = $("#"+id)[0].getAttribute('operatorcode');												
		 document.getElementById('lblCompany').innerHTML =$("#"+id)[0].getAttribute('company_name');
		document.getElementById('lblChangeType').innerHTML = "Mobile No : ";
		document.getElementById('lblRecType').innerHTML = "Confirm Mobile No : ";

$( "#dialog-confirm" ).dialog({
			resizable: false,
			height:300,
			width:350,
			modal: true,
			title:'Recharge Mobile',
			buttons: {
				"Submit Request": function() {
					if(validates_mNo() & compare_amount() & validates_mAmt() & validates_mCircle())
					{
					//document.getElementById('hidSubmitRecharge').value='Success';
					//document.getElementById('frmRecharge').submit();
					return false;
					}
					else{																
								return false;
						}
					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});

		}
	}
	function SetParamDTH(id)
	{
		//if(document.getElementById('ddlOperator').selectedIndex != 0)
		{
			document.getElementById('hidProvider').value = $("#"+id)[0].getAttribute('provider');
			document.getElementById('hidServiceId').value = $("#"+id)[0].getAttribute('serviceid');						
			document.getElementById('hidOperatorCode').value = $("#"+id)[0].getAttribute('operatorcode');												
		 document.getElementById('lblCompany').innerHTML =$("#"+id)[0].getAttribute('company_name');
		document.getElementById('lblChangeType').innerHTML = "Smart No : ";
		document.getElementById('lblRecType').innerHTML = "Confirm Smart No : ";

$( "#dialog-confirm" ).dialog({
			resizable: false,
			height:300,
			width:350,
			modal: true,
			title:'Recharge DTH',
			buttons: {
				"Submit Request": function() {
				if(validates_mNo() & compare_amount() & validates_mAmt() & validates_mCircle())
					{
					
					return false;
					}
					else{								
								document.getElementById('hidSubmitRecharge').value='Success';								
								return false;
						}
					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});

		}
	}

	</script>
</head>

<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("r_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("r_menu.php"); ?> 
  </div>
  <div id="back-border">
  </div>
  <center>
  <div style="height:auto">
        <?php
	if($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";}
	$str_query = "select * from tblmodule_rights where user_id='".$this->session->userdata('id')."'";
	$result_access = $this->db->query($str_query);				
	if($result_access->row(0)->isMobile == "yes")
	{$isMobileRights= true;}
	else{$isMobileRights= false;}	
	if($result_access->row(0)->isDTH == "yes")
	{$isDTHRights= true;}
	else{$isDTHRights= false;}					
	?>    
 
<div id="MainPanel">
<div id="RECHARGE">                          
  <table  cellpadding="3" cellspacing="3" border="0">
  <tr>
  	<td colspan="2" align="left">
    	Recharge :
   		<?php if($isMobileRights == true){ ?><input type="radio" value="Mobile" checked="true"  id="radMobile" onClick="EnableDiv()" name="radRecharge" />Mobile<?php } ?><?php if($isDTHRights == true){ ?> <input type="radio" value="DTH" id="radDTH" onClick="EnableDiv()" name="radRecharge"/>DTH<?php }?>    
</td>
  </tr>
  <tr>
  <td>
  	<div id="Mobile">
    <center>
    <ul id="Mobilesortable">
    	<?php
		$str_query = "SELECT * FROM `tblcompany` WHERE  `service_id`=1";
		$resultMobile = $this->db->query($str_query);		
		for($i=0; $i<$resultMobile->num_rows(); $i++)
		{
			echo "<li onclick='SetParam(".$resultMobile->row($i)->company_id.")' serviceid='".$resultMobile->row($i)->service_id."' operatorcode='".$resultMobile->row($i)->operator_code."' company_name='".$resultMobile->row($i)->company_name."' provider='".$resultMobile->row($i)->provider."' id='".$resultMobile->row($i)->company_id."'  class='ui-state-default'><img src='images/Logo/".$resultMobile->row($i)->logo_path."' height='100' width='100' alt='Mobile Recharge' title='".$resultMobile->row($i)->company_name."' /></li>";
		}
		?>
   		</ul>
        </center>
    </div>
    <div id="DTH" style="display:none;">
    <ul id="DTHsortable">
    <?php
    	$str_query = "SELECT * FROM `tblcompany` WHERE  `service_id`=2";
		$resultDth = $this->db->query($str_query);		
		for($i=0; $i<$resultDth->num_rows(); $i++)
		{
			echo "<li onclick='SetParamDTH(".$resultDth->row($i)->company_id.")' serviceid='".$resultDth->row($i)->service_id."' operatorcode='".$resultDth->row($i)->operator_code."' company_name='".$resultDth->row($i)->company_name."' provider='".$resultDth->row($i)->provider."' id='".$resultDth->row($i)->company_id."' class='ui-state-default'><img src='images/Logo/".$resultDth->row($i)->logo_path."' height='100' width='100' alt='DTH Recharge' title='".$resultDth->row($i)->company_name."' /></li>";
		}		
		?>
        		</ul>
    </div>
  </td>
      <td valign="top">  
	<div id="tabs-report" style="padding-left:0;padding-right:0;">        
    <table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr style="background-color:#060;color:#FFF">
    <th scope="col" align="left">ID</th>
    <th scope="col" align="left">Date Time</th>
    <th scope="col" align="left" >Company</th>
    <th scope="col" align="left">Mobile No</th>
    <th scope="col" align="left" >Amt</th>    
    <th scope="col" align="left" >By</th>
    <th scope="col" align="left">Type</th>    
    <th scope="col" align="left">Status</th>    
    </tr>
    <?php
	$str_query_recharge = "select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany where tblcompany.company_id=tblrecharge.company_id and user_id=".$this->session->userdata('id')." order by tblrecharge.recharge_id desc limit 0, 7";
		$result_recharge = $this->db->query($str_query_recharge);		
	$i = 0;foreach($result_recharge->result() as $resultRecharge) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><?php echo $resultRecharge->ss_id; ?></td>
 <td><?php echo $resultRecharge->recharge_date.'<br/>'.$resultRecharge->recharge_time; ?></td>                         
 <td><?php echo $resultRecharge->company_name; ?></td>
 <td><?php echo $resultRecharge->mobile_no; ?></td>
 <td><?php echo $resultRecharge->amount; ?></td>
 <td><?php echo $resultRecharge->recharge_by; ?></td>
 <td><?php echo $resultRecharge->recharge_type; ?></td>
 <td>
   <?php if($resultRecharge->recharge_status == "Pending"){echo "<span class='orange'>".$resultRecharge->recharge_status."</span>";} ?>
  <?php if($resultRecharge->recharge_status == "Success"){echo "<span class='green'>".$resultRecharge->recharge_status."</span>";} ?>
  <?php if($resultRecharge->recharge_status == "Failure"){echo "<span class='red'>".$resultRecharge->recharge_status."</span>";} ?>
</td> 
		   </tr>

		<?php 	
		$i++;} ?>
		</table>

	</div>   
    <input type="hidden" name="hidURL" id="hidURL" value="<?php echo base_url()."distributer_home/get_ajax_transaction"; ?>" />
    </td>

  </tr>
    <tr>
    <td valign="top">   	
    <form action="<?php echo base_url()."distributer_home"; ?>" method="post" name="frmRecharge" id="frmRecharge" autocomplete="off">
    <input type="hidden" name="hidSubmitRecharge" id="hidSubmitRecharge" />    
    <div id="dialog-confirm" style="display:none" title="Mobile Recharge">
    <table>
    <tr>
    <td align="right">Company Name : </td>
    <td align="left"><span id="lblCompany" style="font-size:18px;font-weight:bold;color:#33F"></span></td>
    </tr>
     <tr>
    <td align="right"><label for="txtMobileNo" id="lblChangeType">Mobile No :</label></td>
    <td align="left"><input type="text" title="Enter 10 digit mobile no." onKeyPress="return isNumeric(event);" name="txtMobileNo" maxlength="13" id="txtMobileNo" class="text" /></td>
  </tr>
    <tr>
    <td align="right"><label for="txtAmount">Amount :</label></td>
    <td align="left"><input type="text" title="Enter recharge amount." onKeyPress="return isNumeric(event);" name="txtAmount" maxlength="4" id="txtAmount" class="text" /></td>
  </tr>
    <tr>
    <td align="right" valign="top"><label for="txtCnfAmount" >Confirm Amount : </label></td>
    <td align="left" valign="top"><input type="text" name="txtCnfAmount" onKeyPress="return isNumeric(event);" maxlength="4" id="txtCnfAmount" title="Enter confirm amount." class="text" /><br />
    <span id="cnfAmountInfo" style="color:#F00;"></span></td>
    </tr>
    <tr>
    <td align="right"><label for="ddlCircleName">Circle Name :</label></td>
    <td align="left">
    <select id="ddlCircleName" title="Select circle name." onChange="SetCircleParam()" name="ddlCircleName" class="select">
    <option>--Select--</option>
    <option circle_code="*" value="All Circles">All Circles</option>
    <?php
		$str_query = "select * from tblstate where circle_code!='' order by state_name";
		$result_circle = $this->db->query($str_query);		
		for($i=0; $i<$result_circle->num_rows(); $i++)
		{
			echo "<option circle_code='".$result_circle->row($i)->circle_code."' value='".$result_circle->row($i)->state_id."'>".$result_circle->row($i)->state_name."</option>";
		}		
	?>
    </select>
    </td>
  </tr>
    </table>        
	</div>
    <input type="hidden" name="hidProvider" id="hidProvider" />
    <input type="hidden" name="hidServiceId" id="hidServiceId" />        
    <input type="hidden" name="hidOperatorCode" id="hidOperatorCode" />            
    <input type="hidden" name="hidCircle" id="hidCircle" />            
</form>
    </td>
    
    </tr>
    </table>
    
    
	</div>
  
</div>
	<!-- end #mainContent --></div>
</center>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
<!-- end #container --></div>
<div class='alertBox'>
<?php require_once("alert_message.php"); ?>
</div>
  <div id="footer">
     <?php require_once("r_footer.php"); ?>
  <!-- end #footer --></div>
</body>
</html>