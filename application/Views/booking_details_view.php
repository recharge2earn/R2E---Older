<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Booking Details</title>
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>        
    <style type="text/css">.caption{color:#f44a56;font-weight:bold;font-size:16px;text-align:left;}</style>
    <script src="<?php echo base_url()."js/qTip.js"; ?>"></script>   
    <script>	
	function getCityName(urlToSend)
	{
		if(document.getElementById('ddlState').selectedIndex != 0)
		{			
		$.ajax({
  type: "GET",
  url: urlToSend+""+$("#ddlState")[0].options[document.getElementById('ddlState').selectedIndex].getAttribute('statid'),
  success: function(html){
    $("#ddlCity").html(html);
  }
});
		}
	}

	$(function() {		
		$( ".dob" ).datepicker({dateFormat:'dd-MM-yy', maxDate: -1 });
	});
	$(document).ready(function(){
	
	setTimeout(function(){$('div.message').fadeOut(1000);}, 15000);
	
});
	
	function validateForm()
	{				
		$(".text").each(function(index) {
    	if($('#'+this.id)[0].value == ""){$('#'+this.id).addClass("error")}	
		else{$('#'+this.id).removeClass("error");}
		});				
		if($(".text").hasClass("error") == false)
		{
			if(confirm("Are you sure? you want to confirm booking!\nPlease verify all bookong details before click on OK button.\nBooking Request Send After Click on OK Button."))
			{
			return true;
			}
			else
			{return false;}
		}
		else
		{return false;}
	}
	</script>
</head>
<body class="twoColFixLtHdr">
 <?php require_once("general_header.php"); ?> 
   <?php require_once("general_menu.php"); ?> 

<div id="container">
<h2><span><?php if(isset($bresp)){echo $bresp;} ?></span></h2>
  <div>
   <h2><span id="myLabel">Booking Details</span></h2>                  
    <form action="<?php echo base_url()."booking_details"; ?>" method="post" autocomplete="off" name="frmBookNow" id="frmBookNow">    	
     <table style="width:100%" cellpadding="3" cellspacing="3" border="0">
     <tr>
     <td valign="top" colspan="2">
         <table border="0" bordercolor="#f5f5f5" summary="Flight Information" cellspacing="0" cellpadding="5" width="100%">
    <caption class="caption">Onward Trip Details</caption>
    <tr class="colHeader">
    <th>Carrier Name</th>
    <th>Flight ID</th>
    <th>Departs</th>    
    <th>Arrives</th>
    <th>Class</th>
    </tr>
    <?php for($j=0;$j<count($AllFligths);$j++){ ?>
    <tr class="<?php if($j%2 == 0){echo 'row1';}else{echo 'row2';}?>">
	<td align="left"><?php echo $AllFligths['flights'.$j]['airLineName']; ?>
    <?php echo '<br/>'.$AllFligths['flights'.$j]['DepartureAirportCode'].' -> '.$AllFligths['flights'.$j]['ArrivalAirportCode']; ?>
    
    </td>
    <td align="left"><?php echo $AllFligths['flights'.$j]['FlightNumber']; ?></td>    
    <td align="left"><?php echo $AllFligths['flights'.$j]['DepartureDateTime']; ?></td>
    <td align="left"><?php echo $AllFligths['flights'.$j]['ArrivalDateTime']; ?></td>
    <td align="left"><?php echo $AllFligths['flights'.$j]['classType']; ?></td>        
    </tr>    
    <?php } ?>
</table>      	    

		<?php if($Trip_Type == 'ROUND') { ?>
        <table border="0" bordercolor="#f5f5f5" summary="Flight Information" cellspacing="0" cellpadding="5" width="100%">
    <caption class='caption'>Round Trip Details</caption>
    <tr class='colHeader'>
    <th>Carrier Name</th>
    <th>Flight ID</th>
    <th>Departs</th>    
    <th>Arrives</th>
    <th>Class</th>
    </tr>
        <?php for($j=0;$j<count($return['R_AllFligths']);$j++){
			$return_flight = $return['R_AllFligths']['r_flights'.$j];
			?>
    <tr class="<?php if($j%2 == 0){echo 'row1';}else{echo 'row2';}?>">
	<td align="left"><?php echo $return_flight['R_airLineName']; ?>
    <?php echo '<br/>'.$return_flight['R_DepartureAirportCode'].' -> '.$return_flight['R_ArrivalAirportCode']; ?>
    
    </td>
    <td align="left"><?php echo $return_flight['R_FlightNumber']; ?></td>    
    <td align="left"><?php echo $return_flight['R_DepartureDateTime']; ?></td>
    <td align="left"><?php echo $return_flight['R_ArrivalDateTime']; ?></td>
    <td align="left"><?php echo $return_flight['R_classType']; ?></td>        
    </tr>    
    <?php } ?>
</table>
        <?php } ?>
     </td>
     </tr>
     <tr>
     <td valign="top">
        <table border="0" summary="Flight Information" cellspacing="0" cellpadding="3" width="100%">
     <caption class="row2">Onward Fare Details</caption>
<tr>
<th scope="col">Basic Fare</th>
<td align="right"><?php echo $ActualBaseFare; ?>
</td>
</tr>
<tr>
<th scope="col">Tax</th>
<td align="right"><?php echo $Tax; ?></td>
</tr>
<tr>
<th scope="col">STax</th>
<td align="right"><?php echo $STax; ?></td>
</tr>
<tr>
<th scope="col">SCharge</th>
<td align="right"><?php echo $SCharge; ?></td>
</tr>
<tr>
<th scope="col">OCharge</th>
<td align="right"><?php 
$result_cm = $this->db->query("select * from tblclient_markup where user_id=?",array($this->session->userdata("id")));  
if($result_cm->num_rows() == 0)
{
$cmTotal = 0;
}
else
{
$cmTotal = $result_cm->row(0)->dom_markup;
}
echo $Markup + $cmTotal;
 ?></td>
</tr>

<?php if($Trip_Type == 'ONE') { ?>
<tr>
<td colspan="2"><hr style="border:1px solid #09F;" /></td>
</tr>
<tr>
<th scope="col">Grand Total</th>
<td align="right"><?php echo $GrossAmount + $cmTotal; ?></td>
</tr>
<?php }?>
</table>	    
	
    <?php if($Trip_Type == 'ROUND') {?> 
    
    <table border="0" summary="Flight Information" cellspacing="0" cellpadding="3" width="100%">
     <caption class="row2">Round Fare Details</caption>
<tr>
<th scope="col">Basic Fare</th>
<td align="right"><?php echo $return['R_ActualBaseFare']; ?></td>
</tr>
<tr>
<th scope="col">Tax</th>
<td align="right"><?php echo $return['R_Tax']; ?></td>
</tr>
<tr>
<th scope="col">STax</th>
<td align="right"><?php echo $return['R_STax']; ?></td>
</tr>
<tr>
<th scope="col">SCharge</th>
<td align="right"><?php echo $return['R_SCharge']; ?></td>
</tr>
<tr>
<th scope="col">OCharge</th>
<td align="right"><?php echo $return['R_Markup']; ?></td>
</tr>

<tr>
<td colspan="2"><hr style="border:1px solid #09F;" /></td>
</tr>

<tr>
<th scope="col">Onward Flight : </th>
<td align="right"><?php echo $GrossAmount; ?></td>
</tr>
<tr>
<th scope="col">Return Flight :</th>
<td align="right"><?php echo $return['R_GrossAmount']; ?></td>
</tr>
<tr>
<td colspan="2"><hr style="border:1px solid #09F;" /></td>
</tr>
<tr>
<th scope="col">Grand Total</th>
<td align="right"><?php echo $GrossAmount + $return['R_GrossAmount']; ?></td>
</tr>
</table>            
<?php }?>
     </td>
     <td valign="top">
     <div id="EnterData">
      <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if(isset($ResponseMessage)){
	if ($ResponseMessage != ''){echo $ResponseMessage; }}
	?>
     
     <?php if($NoOfAdult > 0) { ?>
     <div style="text-align:left;padding:15px">
      Enter Mobile No : +91-<input type="text" name="txtMobileno" class="text" id="txtMobileno" title="Enter 10 Digit Mobile No." />
     </div>
     
    <fieldset>
    <legend>Adult Information</legend>        
    <table border="1" bordercolor="#f5f5f5" cellspacing="0" cellpadding="5" width="100%">
    <?php for($i=0;$i<$NoOfAdult;$i++){ if($i == 0) {?>
  <tr>
    <td align="right"><select id="adult_prefix_<?php echo $i; ?>" name="adult_prefix_<?php echo $i; ?>"  title="Select Prefix">
    <option value="Mr.">Mr.</option>
    <option value="Ms.">Ms.</option>
    <option value="Mrs.">Mrs.</option>    
    </select> </td>
    <td align="right">Adult 1 :</td>
    <td align="right">First Name : <input type="text" name="txtFirstname_<?php echo $i; ?>" class="text" id="txtFirstname_<?php echo $i; ?>" title="Enter Adult First Name" /></td>
    <td align="right">Last Name : <input type="text" name="txtLastname_<?php echo $i; ?>" class="text" id="txtLastname_<?php echo $i; ?>" title="Enter Adult Last Name" /></td>
    <td align="right">Primary Details</td>     
    </tr>    
    <tr>
    <td align="right"></td>
    <td align="right"></td>
    <td align="right">State : <select title="Select State." class="select" onChange="getCityName('<?php echo base_url()."local_area/getCity/"; ?>')" name="ddlState" id="ddlState"><option>--Select--</option>
    <?php
$str_query = "select * from tblstate order by state_name";
		$result = $this->db->query($str_query);		
		for($j=0; $j<$result->num_rows(); $j++)
		{			
			echo "<option statid='".$result->row($j)->state_id."' value='".$result->row($j)->state_name."'>".$result->row($j)->state_name."</option>";
		}
?>    
    </select></td>
    <td align="right">City : <select title="Select City." class="select" name="ddlCity" id="ddlCity"><option value="0">--Select--</option></select></td>
    <td align="right"></td>     
    </tr>
    <tr>
    <td align="right"></td>
    <td align="right"></td>
    <td align="right">Email : <input type="text" name="txtEmail_<?php echo $i; ?>" class="text" id="txtEmail_<?php echo $i; ?>" title="Enter Valid Email ID." /></td>
    <td align="right">Gender : Male <input type="radio" checked="true" name="rbGender" value="M" /> Female <input type="radio" name="rbGender" value="F" /></td>
    <td align="right"></td>     
    </tr>
    <tr>
    <td align="right"></td>
    <td align="right"></td>
    <td align="right">Pincode : <input type="text" name="txtPincode_<?php echo $i; ?>" class="text" id="txtPincode_<?php echo $i; ?>" title="Enter Pincode No." /></td>
    <td align="right" valign="top">Address : <textarea title="Enter Address." name="txtAddress" id="txtAddress" class="listbox" rows="5" cols="3"></textarea></td>
    <td align="right"></td>     
    </tr>
    <?php }else{ ?>        
      <tr>
    <td align="right"><select id="adult_prefix_<?php echo $i; ?>" name="adult_prefix_<?php echo $i; ?>" title="Select Prefix">
    <option value="Mr.">Mr.</option>
    <option value="Ms.">Ms.</option>
    <option value="Mrs.">Mrs.</option>    
    </select> </td>
    <td align="right">Adult <?php echo ($i+1); ?> :</td>
    <td align="right">First Name : <input type="text" name="txtFirstname_<?php echo $i; ?>" class="text" id="txtFirstname_<?php echo $i; ?>" title="Enter Adult First Name" /></td>
    <td align="right">Last Name : <input type="text" name="txtLastname_<?php echo $i; ?>" class="text" id="txtLastname_<?php echo $i; ?>" title="Enter Adult Last Name" /></td>
    <td align="right"></td>     
    </tr>        
        <?php } ?>
    <?php } ?>
</table>
</fieldset>
<br />
<?php } ?>
<?php if($NoOfChild > 0) { ?>
    <fieldset>
    <legend>Children Information</legend>
    <table border="1" bordercolor="#f5f5f5" cellspacing="0" cellpadding="5" width="100%">
    <?php for($i=0;$i<$NoOfChild;$i++){ ?>
  <tr>
    <td align="right"><select id="child_prefix_<?php echo $i; ?>" name="child_prefix_<?php echo $i; ?>" title="Select Prefix">
    <option value="Mstr.">Mstr.</option>
    <option value="Miss.">Miss.</option>
    </select> </td>
    <td align="right">Child <?php echo ($i+1); ?> : </td>
    <td align="right">First Name : <input type="text" name="txtChild_Firstname_<?php echo $i; ?>" class="text" id="txtChild_Firstname_<?php echo $i; ?>" title="Enter Child First Name" /></td>
    <td align="right">Last Name :<input type="text" name="txtChild_Lastname_<?php echo $i; ?>" class="text" id="txtChild_Lastname_<?php echo $i; ?>" title="Enter Child Last Name" /></td>
    </tr>
      <tr>
    <td align="right"></td>
    <td align="right"></td>
    <td align="right">Date of Birth : <input type="text" name="txtChild_DOB_<?php echo $i; ?>" class="text dob" id="txtChild_DOB_<?php echo $i; ?>" title="Enter Child Date of Birth" /></td>
    <td align="right"></td>
    </tr>
    <?php } ?>
</table>
</fieldset>
<br />
<?php } ?>
<?php if($NoOfInfant > 0) { ?>
    <fieldset>
    <legend>Infants Information</legend>
    <table border="1" bordercolor="#f5f5f5" cellspacing="0" cellpadding="5" width="100%">
    <?php for($i=0;$i<$NoOfInfant;$i++){ ?>
  <tr>
    <td align="right"><select id="infants_prefix_<?php echo $i; ?>" name="infants_prefix_<?php echo $i; ?>" title="Select Prefix">
    <option value="Mstr.">Mstr.</option>
    <option value="Miss.">Miss.</option>
    </select> </td>
    <td align="right">Infants <?php echo ($i+1); ?> : </td>
    <td align="right">First Name : <input type="text" name="txtInfants_Firstname_<?php echo $i; ?>" class="text" id="txtInfants_Firstname_<?php echo $i; ?>" title="Enter Infants First Name" /></td>
    <td align="right">Last Name : <input type="text" name="txtInfants_Lastname_<?php echo $i; ?>" class="text" id="txtInfants_Lastname_<?php echo $i; ?>" title="Enter Infants Last Name" /></td>
    </tr>
      <tr>
    <td align="right"></td>
    <td align="right"></td>
    <td align="right">Date of Birth : <input type="text" name="txtInfants_DOB_<?php echo $i; ?>" class="text dob" id="txtInfants_DOB_<?php echo $i; ?>" title="Enter Infants Date of Birth" /></td>
    <td align="right"></td>
    </tr>
    <?php } ?>
</table>
</fieldset>
<?php } ?>

<center>
<br />
<input type="submit" value="Confirm Book" style="width:140px;" onClick="return validateForm();" class="button" name="btnConfirm" id="btnConfirm" />
</center>
</div>
     </td>
     </tr>
     </table>              
</form>
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
<!-- end #container --></div>

     <?php require_once("general_footer.php"); ?>


</body>
</html>