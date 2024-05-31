<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Account Ledger Report</title>
<?php include("script1.php"); ?>
    <link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                       
   <script>	
$(function () {
    $("#txtFrom").datepicker({
        minDate: "-6",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        onClose: function (selectedDate, instance) {
            if (selectedDate != '') { //added this to fix the issue
                $("#txtTo").datepicker("option", "minDate", selectedDate);
                var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
                date.setMonth(date.getMonth() + 3);
                console.log(selectedDate, date);
                $("#txtTo").datepicker("option", "minDate", selectedDate);
                $("#txtTo").datepicker("option", "maxDate", date);
            }
        }
    });
    $("#txtTo").datepicker({
        minDate: "dateToday",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        onClose: function (selectedDate) {
            $("#txtFrom").datepicker("option", "maxDate", selectedDate);
        }
    });
});
	</script>

<script>	
$(document).ready(function(){
$( "#txtFrom,#txtTo" ).datepicker({dateFormat:'yy-mm-dd'});
	setTimeout(function(){$('div.message').fadeOut(1000);}, 5000);
						   });
	</script>
    <style>
	.disable
	{
		background:#CFD8FA;
	}
	.enabled
	{
	background:#FFFFFF;
	}
	</style>
    <script>
	setTimeout(function(){$('div.message').fadeOut(1000);}, 3000);
	function ActionSubmit(value,name)
	{
		if(document.getElementById('action_'+value).selectedIndex != 0)
		{
			var isstatus;
			if(document.getElementById('action_'+value).value == 0)
			{isstatus = 'cancel';}else{isstatus='active';}
			
			if(confirm('Are you sure?\n you want to '+isstatus+' login for - ['+name+']')){
				document.getElementById('hidstatus').value= document.getElementById('action_'+value).value;
				document.getElementById('hiduserid').value= value;				
				document.getElementById('frmCallAction').submit();
				}
		}
	}
	function test()
	{
		var input = $('#txtRegLimit');
		$('#txtRegLimit').addClass("enabled");
		
	}
	function test2(user_id)
	{
		var ids = $('#txtRegLimit'+user_id).val();
		document.getElementById("process"+user_id).style.display="inline";
		$.ajax(
		{
		type: "GET",
		url: '<?php base_url()?>update_ids/update?ids='+ids+'&user_id='+user_id,
		cache: false,
		success: function(html)
		{

		},
		complete:function(msg)
		{
			document.getElementById("process"+user_id).style.display="none";
		}});
		
		
		
	}
	
	</script>
	<script language=JavaScript>
function ieClicked() {
    if (document.all) {
        return false;
    }
}
function firefoxClicked(e) {
    if(document.layers||(document.getElementById&&!document.all)) {
        if (e.which==2||e.which==3) {
            return false;
        }
    }
}
if (document.layers){
    document.captureEvents(Event.MOUSEDOWN);
    document.onmousedown=firefoxClicked;
}else{
    document.onmouseup=firefoxClicked;
    document.oncontextmenu=ieClicked;
}
document.oncontextmenu=new Function("return false")
function disableselect(e){
    return false
    }
    function reEnable(){
    return true
    }
    document.onselectstart=new Function ("return true")
    if (window.sidebar){
    document.onmousedown=disableselect
    document.onclick=reEnable
    }
</script>
</head>
<body oncopy="return false" oncut="return false" onpaste="return false" ondragstart="return false;" ondrop="return false; class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("general_header.php"); ?> 
  </div>
  <div id="menu">
 
   <?php require_once("agent_menu.php"); ?> 
  
  </div>
  <div id="back-border">
  </div>
  <div class="bck">
<h2>Account Ledger Report</h2>  
 <form action="<?php echo base_url()."d_accountreport" ?>" method="post" name="frmCallAction" id="frmCallAction">
<input type="hidden" id="hidstatus" name="hidstatus" />
<input type="hidden" id="hiduserid" name="hiduserid" />
<input type="hidden" id="hidaction" name="hidaction" value="Set" />
 </form>
 
 
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if($this->session->flashdata('user_message')){echo "<div id='message' class='message'>".$this->session->flashdata('user_message')."</div>";}
	
		if($this->session->flashdata('message')){echo "<div class='message'>".$this->session->flashdata('message')."</div>";}	
	
	?>    
    
     <form action="<?php echo base_url()."d_accountreport" ?>" method="post" name="frmSearch" id="frmSearch">
     <fieldset>
     <table>
<tr>
From Date :<input type="text" name="txtFrom" id="txtFrom" readonly class="text" title="Select Date." maxlength="10" />To Date :<input type="text" name="txtTo" id="txtTo" class="text" readonly title="Select Date." maxlength="10" /><input type="submit" name="btnSearch" id="btnSearch" value="Search" class="button" title="Click to search." />
</fieldset>
<br />
 </form>
 
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader">
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="80" height="30" >Payment Date</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="40" height="30" >Payment Id</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="60" height="30" >Payment To</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="70" height="30" >User type</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="70" height="30" >Transaction type</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="15" height="30" >Description</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Remark</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="70" height="30" >Credit Amount</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="70" height="30" >Debit Amount</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="90" height="30" >Balance</th>
    
    </tr>
    <?php 
	if($result_mdealer->num_rows() > 0){
    if($flagopenclose == 1){?>
     <tr><td colspan="10" class="padding_left_10px box_border_bottom box_border_right" align="right" height="34" style="min-width:50px;width:50px;"><?php echo "Clossing Balance : ".$result_mdealer->row(0)->balance; ?></td></tr>
     <?php } ?> 
    <?php	$i = 0;foreach($result_mdealer->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="width:80px;width:80px;"><?php echo $result->add_date; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:40px;width:40px;"><?php if($result->transaction_type == "Recharge") {echo $result->recharge_id;} else {echo $result->payment_id;}?></td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:50px;width:60px;"><?php echo $result->username; ?></td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:50px;width:50px;"><?php echo $result->usertype; ?></td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:70px;width:70px;"><?php echo $result->transaction_type; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:220px;width:220px;"><?php echo $result->description; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:70px;width:70px;"><?php echo $result->remark; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="right" height="34" style="min-width:50px;width:50px;"><?php echo $result->credit_amount; ?></td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="right" height="34" style="min-width:50px;width:50px;"><?php echo $result->debit_amount; ?></td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="right" height="34" style="min-width:50px;width:50px;"><?php echo $result->balance; ?></td>
 </tr>
		<?php 	
		$i++;} ?>
        <?php if($flagopenclose == 1){?>
      <tr><td colspan="10" class="padding_left_10px box_border_bottom box_border_right" align="right" height="34" style="min-width:50px;width:50px;"><?php 
	  if($result_mdealer->row(1)->openingBalance == "")
	  {
		  echo "Opening Balance : 0";
	 }
	 else
	 {
		  echo "Opening Balance : ".$result_mdealer->row(1)->openingBalance; 
	 }
	 ?></td></tr> 
      <?php } ?>
       <?php } else{?>
       <tr>
       <td colspan="10">
       <div class='message'> No Records Found</div>
       </td>
       </tr>
       <?php  }?>
		</table>
       <?php  echo $pagination; ?>
      
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
     <?php require_once("general_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>

