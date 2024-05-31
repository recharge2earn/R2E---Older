<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Commission Received</title>
<?php include("script1.php"); ?>
<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
    <script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
    <script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>

	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>        
   
	 <script>	
$(function () {
    $("#txtSearch_Date").datepicker({
        minDate: "-6",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        onClose: function (selectedDate, instance) {
            if (selectedDate != '') { //added this to fix the issue
                $("#txtSearch_Date").datepicker("option", "minDate", selectedDate);
                var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
                date.setMonth(date.getMonth() + 3);
                console.log(selectedDate, date);
                $("#txtSearch_Date").datepicker("option", "minDate", selectedDate);
                $("#txtSearch_Date").datepicker("option", "maxDate", date);
            }
        }
    });
    $("#txtSearch_Date").datepicker({
        minDate: "dateToday",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        onClose: function (selectedDate) {
            $("#txtSearch_Date").datepicker("option", "maxDate", selectedDate);
        }
    });
});
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
  <div class="bck">

   <h2 class="border shadow"><span id="myLabel">Commission Received</span></h2>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>    
     <form action="<?php echo base_url()."commission_received" ?>" method="post" name="frmSearch" id="frmSearch">
     <fieldset>
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr>
    <td align="right">Date : </td>
    <td align="left"><input type="text" title="Select Date." readonly class="text" name="txtSearch_Date" id="txtSearch_Date" >&nbsp;<input type="submit" class="button" value="Search" name="btnSearch" id="btnSearch" ></td>	
	</tr>
</tr>
</table>     
</fieldset>
<br />
 </form>
 <h2 class="h2">View Received Commission</h2>
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader" style="background: #110303;color: #fff;">
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Sr No</th>
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Date Time</th>                
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Company Name</th>
      <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Amount</th>
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Mobile</th>    
     
         
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Commission Amount</th>        
            
    </tr>
    <?php $total_comm_amount=0;$total_amount=0;$i = 0;foreach($result_commission->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;"><?php echo ($i+1); ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;"><?php echo $result->recharge_date." ".$result->recharge_time; ?></td> 
<td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;"><?php echo $result->company_name; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;"><?php echo $result->amount; ?></td>   
<td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;"><?php echo $result->mobile_no; ?></td> 
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;"><?php echo $result->commission_amount; ?></td> 
 </tr>
		<?php 	
		$i++;$total_comm_amount=$total_comm_amount+$result->commission_amount; $total_amount=$total_amount+$result->amount;} ?>
        <tr class="ColHeader" style="background: #110303;color: #fff;">
            <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" ></th>
   
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" ></th>            
        
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" ></th>
   
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" ><?php echo $total_amount; ?></th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Total Commission Amount</th>             
     <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" ><?php echo $total_comm_amount; ?></th> 
                 
</tr>
		</table>
</div>
<div id="footer">
     <?php require_once("general_footer.php"); ?>
  <!-- end #footer --></div>
  
</div>

</body>
</html>