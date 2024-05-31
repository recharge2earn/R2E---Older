<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Set Commission</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">
  	<script type="text/javascript">
   function getId(id) { 
       return document.getElementById(id); 
   } 
   function validation() { 
       getId("btnsubmit").style.display="none"; 
       getId("wait_tip").style.display=""; 
       return true; 
   } 
</script>
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
	var txtPayworldComm = $("#txtPayworldComm");
	var txtCyberComm = $("#txtCyberComm");
	//var commissionInfo = $("#commissionInfo");			
	var scheme = $("#ddlScheme");
	var schemeInfo = $("#schemeInfo");			
	companyname.focus();
	
	form.submit(function(){
		if(validateCompany() & validateRCommssion() & validatePCommssion() & validateCCommssion() & validateScheme())
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
	function validatePCommssion(){
		if(txtPayworldComm.val() == ""){
			txtPayworldComm.addClass("error");
			jAlert('Enter Commssion Percentage. e.g 2.5', 'Alert Dialog');
			return false;}
		else{txtPayworldComm.removeClass("error");return true;}
	}
	function validateCCommssion(){
		if(txtCyberComm.val() == ""){
			txtCyberComm.addClass("error");
			jAlert('Enter Commssion Percentage. e.g 2.5', 'Alert Dialog');
			return false;}
		else{txtCyberComm.removeClass("error");return true;}
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
		document.getElementById('txtPayworldComm').value=document.getElementById("pcomm_"+value).innerHTML;
		document.getElementById('txtCyberComm').value=document.getElementById("ccomm_"+value).innerHTML;
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
    
    <script language="javascript">
	
	function ddlAPIchange()
	{
		document.getElementById('ajaxload').style.display="block";
		document.getElementById('divcomm').style.display="none";
		if(document.getElementById('ddlAPIUSER').selectedIndex != 0)
		{
			document.getElementById('ddlMD').selectedIndex = 0;
			document.getElementById('ddlD').selectedIndex = 0;
			document.getElementById('ddlAGENT').selectedIndex = 0;
			var id = document.getElementById('ddlAPIUSER').value;
			$.ajax({
				  type: "GET",
				  url: '<?php echo base_url(); ?>set_commission/getdealer?id='+""+id,
				  cache:false,
				  success: function(html)
				  	{
						document.getElementById('ajaxload').style.display="none";
		document.getElementById('divcomm').style.display="block";
    					$("#ddlD").html(html);
  					}
				});
				
				getCommission(id);
				
			}
		}
	function ddlmdchange()
	{
		
		if(document.getElementById('ddlMD').selectedIndex != 0)
		{
			var id = document.getElementById('ddlMD').value;
			
				getCommission(id);
				
			}
		}
		function ddldchange()
		{
		
		if(document.getElementById('ddlD').selectedIndex != 0)
		{
			var id = document.getElementById('ddlD').value;
			$.ajax({
				  type: "GET",
				  url: '<?php echo base_url(); ?>set_commission/getretailer?id='+""+id,
				  cache:false,
				  success: function(html)
				  	{

    					$("#ddlAGENT").html(html);
  					}
				});
				
				getCommission(id);
				
			}
		}
		function ddlachange()
		{
			
		if(document.getElementById('ddlAGENT').selectedIndex != 0)
		{
			var id = document.getElementById('ddlAGENT').value;
				getCommission(id);
				
			}
		}
		function getCommission(id)
		{
			$.ajax({
				  type: "GET",
				  url: '<?php echo base_url(); ?>set_commission/getCommission?id='+""+id,
				  cache:false,
				  success: function(html)
				  	{
						document.getElementById('ajaxload').style.display="none";
						document.getElementById('divcomm').style.display="block";
    					$("#divcomm").html(html);
  					}
				});
		}
		function changecommission(id,user_type)
		{
			
			var com = document.getElementById("txtComm"+id).value;
			$.ajax({
				  type: "GET",
				  url: '<?php echo base_url(); ?>set_commission/ChangeCommission?id='+id+"&com="+com,
				  cache:false,
				  success:function(html)
				  	{
						if(user_type == "MasterDealer")
						{
							var id = document.getElementById('ddlMD').value;
							getCommission(id);
						}
						else if(user_type == "Distributor")
						{
							var id = document.getElementById('ddlD').value;
							getCommission(id);
						}
						else if(user_type == "Agent")
						{
							var id = document.getElementById('ddlAGENT').value;
							getCommission(id);
						}
				
  					}
				});
			
		}
			
	</script>
   
</head>
<body>
<?php require_once("admin_menu.php"); ?> 


<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading">Set Commission</div>
      <div class="panel-body">

<form  id="frmsubmit" name="frmsubmit" action="" method="post">

<input type="hidden" id="hidflag" name="hidflag">
<input type="hidden" id="hidid" name="hidid">
<input type="hidden" id="hidcom" name="hidcom">
</form>



<form method="post" action="<?php echo base_url()."commission"; ?>" name="frmcommssion_view" id="frmcommssion_view" autocomplete="off">


<div class="form-group">
<label for="ddlMD">Master Distributor</label>
<select id="ddlMD" name="ddlMD" title="Select Operator Name." class="form-control" onChange="ddlmdchange()"><option>--Select--</option>
    <?php
		$str_query = "select * from tblusers where usertype_name = 'MasterDealer'";
		$result_md = $this->db->query($str_query);		
		for($i=0; $i<$result_md->num_rows(); $i++)
		{
			echo "<option value='".$result_md->row($i)->user_id."'>".$result_md->row($i)->business_name."[".$result_md->row($i)->username."]</option>";
		}
	?>
    </select>
    </div>


<div class="form-group">
<label for="ddlD">Distributor</label>
<select id="ddlD" name="ddlD" title="Select Dealer." class="form-control" onChange="ddldchange()">
<option>--Select--</option>
    <?php
		$str_query = "select * from tblusers where usertype_name = 'Distributor'";
		$result_md = $this->db->query($str_query);		
		for($i=0; $i<$result_md->num_rows(); $i++)
		{
			echo "<option value='".$result_md->row($i)->user_id."'>".$result_md->row($i)->business_name."[".$result_md->row($i)->username."]</option>";
		}
	?>
    </select>
    </div>


<div class="form-group">
<label for="ddlAGENT">Retailer/Reseller/API User</label>
<select id="ddlAGENT" name="ddlAGENT" title="Select AGENT." class="form-control" onChange="ddlachange()">
<option>--Select--</option>
    <?php
		$str_query = "select * from tblusers where usertype_name = 'Agent'";
		$result_md = $this->db->query($str_query);		
		for($i=0; $i<$result_md->num_rows(); $i++)
		{
			echo "<option value='".$result_md->row($i)->user_id."'>".$result_md->row($i)->business_name."[".$result_md->row($i)->username."]</option>";
		}
	?>
    </select>
    </div>


<input type="hidden" id="hidID" name="hidID" />
</form>

<div id="ajaxload" style="display:none">
<img src="<?php echo base_url()."ajax-loader.gif" ?>">
</div>
<div class="table-responsive" id="divcomm">
</div>

</div>
    </div>
</div>

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
 
    
	
</body>
</html>
