<?php
$us_id = $this->session->userdata("id");
$rslt = $this->db->query("select * from tblusers where user_id = '$us_id'");
$state_id = $rslt->row(0)->state_id;
$rslt1 = $this->db->query("select * from tblstate where state_id = '$state_id'");
//$circle_code = $rslt1->row(0)->circle_code;
//echo $circle_code;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recharge Home</title>
	<?php include("script2.php"); ?>
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
    <script src="<?php echo base_url()."js/external/jquery.bgiframe-2.1.2.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script language="javascript">
	function complainadd(recahrge_id)
	{
		
		document.getElementById("hidcomplain").value = "Set";
		document.getElementById("recid").value = recahrge_id;
		document.getElementById("frmcomplain").submit();
	}
	</script>
 <script>
 function get_otp()
{
	 $.ajax({
		 type: "GET",
		 url: document.getElementById('hidURLotp').value,
		 cache: false,
		 success: function(html)
		 {		
			$("#otp").html(html);
		}
	});
	$("#otp").fadeOut(1000);
	$("#otp").fadeIn(2000);	
}	
 function getMobileCompany()
 {document.getElementById('lblCLabel').innerHTML = 'Confirm Mobile No : ';document.getElementById('lblLabel').innerHTML = 'Mobile No : ';document.getElementById('lblChangeLabel').innerHTML = 'Mobile No : ';$.ajax({type: "GET",url: document.getElementById('hidCompanyURL').value,cache: false,success: function(html){$("#ddlOperator").html(html);}});
 }
 function getDTHCompany()
 {document.getElementById('lblCLabel').innerHTML = 'Confirm Smart No : ';document.getElementById('lblLabel').innerHTML = 'Smart No : ';document.getElementById('lblChangeLabel').innerHTML = 'Smart No : ';$.ajax({type: "GET",url: document.getElementById('hidDTHURL').value,cache: false,success: function(html){$("#ddlOperator").html(html);}});	 
 }
  function getLAPUCompany()
 {document.getElementById('lblCLabel').innerHTML = 'Confirm Mobile No : ';document.getElementById('lblLabel').innerHTML = 'Mobile No : ';document.getElementById('lblChangeLabel').innerHTML = 'Mobile No : ';$.ajax({type: "GET",url: document.getElementById('hidLAPUCompanyURL').value,cache: false,success: function(html){$("#ddlOperator").html(html);}});
 }
 function getPOSTPAIDCompany()
 {
 	document.getElementById('lblCLabel').innerHTML = 'Confirm Mobile No : ';document.getElementById('lblLabel').innerHTML = 'Mobile No : ';document.getElementById('lblChangeLabel').innerHTML = 'Mobile No : ';$.ajax({type: "GET",url: document.getElementById('hidPOSTPAIDCompanyURL').value,cache: false,success: function(html){$("#ddlOperator").html(html);}});
 }
  function get_live_data()
 {
	 get_otp();
	 $.ajax({type: "GET",url: document.getElementById('hidURL').value,cache: false,success: function(html){		
	$("#transaction_report").html(html);setTimeout(get_live_data,35000);}});
	$("#transaction_report").fadeOut(1000);$("#transaction_report").fadeIn(2000);
 } 	
$(document).ready(function(){	
	setTimeout(function(){$('div.message').fadeOut(1000);}, 15000);
	setTimeout(get_live_data,35000);							   						   
	//global vars
	var form = $("#frmRecharge");
	var btnRecharge = $("#btnRecharge");
	var m_cname = $("#ddlOperator");
	var m_no = $("#txtMobileNo");
	var cm_no = $("#txtCMobileNo");
	var m_amt = $("#txtAmount");
	var m_circle = $("#ddlCircleName");	
	m_cname.focus();
	m_cname.blur(validates_mName);
	m_no.blur(validates_mNo);
	m_amt.blur(validates_mAmt);
	m_circle.blur(validates_mCircle);
	
	form.submit(function(){
		if(validates_mAmt() & validates_mCircle() & validates_mName() & validates_mNo() & validates_cmNo())
			{	
			document.getElementById("hidSubmitRecharge").value = "Success";			
			return true;
			}
		else
			return false;
	});
								   
function validates_mAmt(){if(m_amt.val() == ""){m_amt.addClass("error");return false;}else{m_amt.removeClass("error");return true;}}	
function validates_mCircle(){if(m_circle[0].selectedIndex == 0){m_circle.addClass("error");return false;}else{m_circle.removeClass("error");return true;}}		
function validates_mName(){if(m_cname[0].selectedIndex == 0){m_cname.addClass("error");return false;}else{m_cname.removeClass("error");return true;}}
function validates_mNo(){if(m_no.val() == ""){m_no.addClass("error");return false;}else{m_no.removeClass("error");return true;}}				
	
	function validates_cmNo()
	{
		if(cm_no.val() == "")
		{
			cm_no.addClass("error");
			return false;
		}
		else
		{
			cm_no.removeClass("error");
			return true;
		}
	}				
	});
function SetCircleParam(){if(document.getElementById('ddlCircleName').selectedIndex != 0){document.getElementById('hidCircle').value = $("#ddlCircleName")[0].options[document.getElementById('ddlCircleName').selectedIndex].getAttribute('circle_code');}}	
function SetParam(){if(document.getElementById('ddlOperator').selectedIndex != 0){document.getElementById('hidServiceId').value = $("#ddlOperator")[0].options[document.getElementById('ddlOperator').selectedIndex].getAttribute('serviceid');document.getElementById('hidOperatorCode').value = $("#ddlOperator")[0].options[document.getElementById('ddlOperator').selectedIndex].getAttribute('operatorcode');document.getElementById('hidProduct_name').value = $("#ddlOperator")[0].options[document.getElementById('ddlOperator').selectedIndex].getAttribute('product_name');}document.getElementById('companyImg').src='images/Logo/'+$("#ddlOperator")[0].options[document.getElementById('ddlOperator').selectedIndex].getAttribute('path');}	
	</script>    
    <script language="javascript">
	function setdefaultcircle()
	{
		document.getElementById("ddlCircleName").value  =<?php echo $state_id; ?>;
		document.getElementById("hidCircle").value = <?php echo $circle_code; ?>
	}
	</script>
    </head>
    

<body class="twoColFixLtHdr" onLoad="setdefaultcircle()">  
 <?php require_once("general_header.php"); ?>  
 <?php require_once("agent_menu.php"); ?>
 <h2 class="h2"><?php require_once("alert_message.php"); ?></h2>
<div id="container"> 
<form id="frmcomplain" action="complain" name="frmcomplain" method="post">
<input type="hidden" id="recid" name="recid">
<input type="hidden" id="hidcomplain" name="hidcomplain">
</form>
<input type="hidden" id="hidURLotp" name="hidURLotp" value="<?php echo base_url()."get_otp"; ?>"/>
  
  <div style="height:auto;" align="left">
    <div style="display:none;" class='message'><?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');} ?></div>
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
	<div id="RECHARGE">      
    <table style="width:100%;" cellpadding="0" cellspacing="0" border="0">
    <tr>
    <td>
    
    <h2 style="margin:-5px;margin-left:-10px;margin-right:-11px;margin-bottom:-20px;" class="border shadow"><b style="color:#000000"></b></h2>
    <div align="left">
    <input type="hidden" name="hidRechargeURL" id="hidRechargeURL" value="<?php echo base_url()."recharge_home"; ?>" /><div id="process" style="display:none;">
 <img src="<?php echo base_url().'images/ajax.gif'; ?>" width="128" height="15" align="middle" alt="Please wait we process your data." title="Please wait we process your data." border="none" />
 </div>
    <form action="<?php echo base_url()."recharge_home"; ?>" method="post" name="frmRecharge" id="frmRecharge" autocomplete="on">
    <input type="hidden" name="hidSubmitRecharge" id="hidSubmitRecharge" />    
    <div id="dialog-confirm" style="display:none" title="Confirm request">
    <table  width="600px">
    <tr>
    <td align="right"><b style="color:#000000">Operator : </b></td>
    <td align="left"><span id="lblCompany" style="font-size:18px;font-weight:bold;color:#33F"></span></td>
    </tr>
    <tr>
    <td align="right"><span id="lblChangeLabel"><b style="color:#000000">Mobile No : </b></span> : </td>
    <td align="left"><span id="lblMobile" style="font-size:18px;font-weight:bold;color:#33F"></span></td>
    </tr>
    <tr>
    <td align="right" valign="top"><label for="txtCnfAmount"><b style="color:#000000">Confirm Amount : </b></label></td>
    <td align="left" valign="top"><input type="text" name="txtCnfAmount" onKeyPress="return isNumeric(event);" maxlength="4" id="txtCnfAmount" title="Enter confirm amount." class="text" /><br />
    <span id="cnfAmountInfo" style="color:#F00;"></span></td>
    </tr>
    </table>        
	</div>
    <table cellpadding="5" cellspacing="5" border="0">
    <tr>
    <td  width="600px">
    <table border="0" cellspacing="3" cellpadding="3">
    <tr>
    <td align="right"><b style="color:#000000">Recharge :</b></td>
    <td align="left">
    <?php if($isMobileRights == true){ ?>
    <input type="radio" name="rbRecharge" value="Mobile" checked="true" id="rbMobile" onClick="getMobileCompany()"/><b style="color:#000000"> Mobile</b>&nbsp;&nbsp;&nbsp; <?php } ?>
   <?php if($isDTHRights == true){ ?> <input type="radio" onChange="getDTHCompany()" name="rbRecharge" id="rbDTH" value="DTH"/><b style="color:#000000"> DTH</b>&nbsp;&nbsp;&nbsp; <?php } ?>
  <!-- <input type="radio" name="rbRecharge" value="LAPU"  id="rbLAPU" onClick="getLAPUCompany()"/> Lapu&nbsp;&nbsp;&nbsp;-->
   <input type="radio" name="rbRecharge" value="POSTPAID"  id="rbPOSTPAID" onClick="getPOSTPAIDCompany()"/> POSTPAID&nbsp;&nbsp;&nbsp;
  
    </td>
    
     <tr>
    <td align="right">
    <label for="ddlOperator"><b style="color:#000000">Operator :</b></label></td>
    <td align="left">    
    <input type="hidden" name="hidServiceId" id="hidServiceId" />        
    <input type="hidden" name="hidOperatorCode" id="hidOperatorCode" />            
    <input type="hidden" name="hidProduct_name" id="hidProduct_name" />            
    <input type="hidden" name="hidCircle" id="hidCircle" />        
    <select id="ddlOperator" tabindex="1" title="Select company name." onChange="SetParam()" style="color:#000000;font-weight:bold;" name="ddlOperator" class="select"><option path='images/Logo/no.GIF'>--Select--</option>
    <?php
		$str_query = "select * from tblcompany where service_id='1' and company_id != 34 and company_id != 39  order by company_name";
		$result_mobile = $this->db->query($str_query);		
		for($i=0; $i<$result_mobile->num_rows(); $i++)
		{
			echo "<option path='".$result_mobile->row($i)->logo_path."' serviceid='".$result_mobile->row($i)->service_id."' product_name='".$result_mobile->row($i)->product_name."' operatorcode='".$result_mobile->row($i)->operator_code."'  value='".$result_mobile->row($i)->company_id."'>".    $result_mobile->row($i)->company_name."</option>";
		}
	?>
    </select>	</td>
    </tr>
    <tr>
    <td align="right"><label for="txtMobileNo"><span id="lblLabel" style="color:#000000;font-weight:bold;"><b style="color:#000000">Mobile No :</b></span></label></td>
    <td align="left"><input type="text" tabindex="2" title="Enter Recharge Number."  name="txtMobileNo" maxlength="15" id="txtMobileNo" class="text" style="color:#000000;font-weight:bold;font-size:22pt;height:32px;font-stretch:extra-expanded;"  /></td>
  </tr>
  <tr>
    <td align="right"><label for="txtCMobileNo"><span id="lblCLabel" style="color:#000000;font-weight:bold;"><b style="color:#000000">Confirm Mobile No :</b></span></label></td>
    <td align="left"><input type="text" tabindex="3" title="Confirm Recharge Number."  name="txtCMobileNo" maxlength="15" id="txtCMobileNo" class="text" style="color:#000000;font-weight:bold;font-size:22pt;height:32px;font-stretch:extra-expanded;"  /></td>
  </tr>
  <tr>
    <td align="right"><label for="txtAmount"><b style="color:#000000">Amount :</b></label></td>
    <td align="left"><input type="text" tabindex="4" title="Enter recharge amount." onKeyPress="return isNumeric(event);" name="txtAmount" maxlength="4" id="txtAmount" class="text" style="color:#000000;font-weight:bold;font-size:22pt;height:32px;font-stretch:extra-expanded;"  />
    </tr>
    
  <tr><td></td><td><input type="submit" tabindex="5" name="btnRecharge" id="btnRecharge" value="Submit" class="button green" /></td></tr>
</table>
</td>
 
    <td bgcolor="white" style="border:0px solid #29A6CB;padding:0;margin:0;margin-top:270px;position:relative;" width="40%;">
    <div style="padding:0px;background:white;height:270px;"><img height="270px;" style="max-height:270px;max-width:2700px;min-width:600px;" src="/images/s2.jpg"; ?></div>
    </td>
</tr>
</table>
</form>
</div>
<div>
   <h2 class="h2">Transaction Report</h2>
    <div id="transaction_report">
    <table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="colHeader" style="background-color: rgb(17, 3, 3); color: rgb(255, 255, 255); background-position: initial initial; background-repeat: initial initial;"><th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Recharge ID</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Operator ID</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Operator</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Mobile No</th>
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Amount</th>
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Mode</th><th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Status</th><th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Date & Time</th><th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Transaction</th>
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Complaint</th>
   </tr>
    <?php
	$str_query_recharge = "select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany where tblcompany.company_id=tblrecharge.company_id and user_id=".$this->session->userdata('id')." order by tblrecharge.recharge_id desc limit 0, 7";
		$result_recharge = $this->db->query($str_query_recharge);		
	$i = 0;foreach($result_recharge->result() as $resultRecharge) 	{  ?>
<tr class="<?php echo $i%2 == 0 ? 'row1':'row2'; ?>">
<td align="left"><?php echo $resultRecharge->recharge_id; ?></td>
<td align="left"><?php echo $resultRecharge->operator_id; ?></td>
<td align="left"><?php echo $resultRecharge->company_name; ?></td><td align="left"><?php echo $resultRecharge->mobile_no; ?></td><td align="left"><?php echo $resultRecharge->amount; ?></td>
<td align="left"><?php echo $resultRecharge->recharge_by; ?></td>
<td align="left"><?php if($resultRecharge->recharge_status == "Pending"){echo "<span class='orange'>Pending</span>";} ?><?php if($resultRecharge->recharge_status == "Success"){echo "<span class='green'>".$resultRecharge->recharge_status."</span>";} ?><?php if($resultRecharge->recharge_status == "Failure"){echo "<span class='red'>".$resultRecharge->recharge_status."</span>";} ?></td>

<td align="left"><?php echo $resultRecharge->recharge_date.' '.$resultRecharge->recharge_time; ?></td>   <td>
  <?php if($resultRecharge->recharge_status == "Success"){echo "<span class='green'>Debit</span>";} ?>
  <?php if($resultRecharge->recharge_status == "Pending"){echo "<span>Wait</span>";} ?>  
  <?php if($resultRecharge->recharge_status == "Failure"){echo "<span class='red' title='Revert Back Amount : ".$resultRecharge->amount."'>Credit</span>";} ?>
  </td> 
  <td align="center"><img src="<?php echo base_url()."images/complain.png" ?>" style="height:15px;width:20px;" onClick="javascript:complainadd('<?php echo $resultRecharge->recharge_id; ?>')" /></td> 
</tr>
		<?php 	
		$i++;} ?>
		</table>      
        </div>
    <input type="hidden" name="hidURL" id="hidURL" value="<?php echo base_url()."recharge_home/get_ajax_transaction"; ?>" />
    <input type="hidden" name="hidCompanyURL" id="hidCompanyURL" value="<?php echo base_url()."recharge_home/getMobileCompany"; ?>" />
    <input type="hidden" name="hidLAPUCompanyURL" id="hidLAPUCompanyURL" value="<?php echo base_url()."recharge_home/getLAPUCompany"; ?>" />
     <input type="hidden" name="hidPOSTPAIDCompanyURL" id="hidPOSTPAIDCompanyURL" value="<?php echo base_url()."recharge_home/getPOSTPAIDCompany"; ?>" />
	<input type="hidden" name="hidDTHURL" id="hidDTHURL" value="<?php echo base_url()."recharge_home/getDTHCompany"; ?>" />   
</div>
    
    </td>
    
    </tr>
    
    </table>                    
  
	</div>    
</div>
 <!-- Added for CR-2424, To disable right click option for the entire site --> 
      <script language="javascript">

               var message="This function is not allowed here.";
               function clickIE4(){

                             if (event.button==2){
                             alert(message);
                             return false;
                             }
               }

               function clickNS4(e){
                             if (document.layers||document.getElementById&&!document.all){
                                            if (e.which==2||e.which==3){
                                                      alert(message);
                                                      return false;
                                            }
                                    }
               }

               if (document.layers){
                             document.captureEvents(Event.MOUSEDOWN);
                             document.onmousedown=clickNS4;
               }

               else if (document.all&&!document.getElementById){
                             document.onmousedown=clickIE4;
               }

               document.oncontextmenu=new Function("alert(message);return false;")
               
               function newPopup(url) {
           		popupWindow = window.open(
           			url,'popUpWindow','height=350,width=810,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
           	}

</script>

<!-- Added for CR-2424, To disable right click option for the entire site: ends here-->
  
<br class="clearfloat" />
</div>
<?php require_once("alert_message.php"); ?>
<?php require_once("a_footer.php"); ?>
</body>
</html>