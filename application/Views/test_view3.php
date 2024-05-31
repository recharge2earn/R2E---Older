<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Booking Details</title>
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
    <script src="<?php echo base_url()."js/popup.js"; ?>"></script>
   <script language="javascript">
	<?php if($api_name == "ARZOO"){ ?>
	$(document).ready(function(){
		document.getElementById("ajaxprocess").style.display= "block";
		Popup.showModal('ajaxprogress');	
		$.ajax({
			url:'<?php echo base_url()."air_domestic_search/callPricingApi?fare_id=".$fare_id; ?>',
			type:'POST',
			cache:false,
			success:function(msg)
			{
				if(msg)
				
			},
			complete:function(data)
			{
			$("#ajaxprocess").hide();
			Popup.hide('ajaxprogress');
			
			}
			});
		
	
	setTimeout(function(){$('div.message').fadeOut(1000);}, 10000);
	
});
<?php } ?>
	</script>
    <script language="javascript">
	//global vars
	var form = $("#frmBookNow");
	

	//On Submitting
	form.submit(function(){
	alert("hi");
		
		if(validateFirstName() & validateLastName() & validateEmail() & validateMobile())
			{				
			return true;
			}
		else
			return false;
	});
	function validateFirstName()
	{
		
		var firstname = document.getElementById("txtFirstname_0").value;
		if(firstname == "")
		{
			$("#txtFirstname_0").addClass("error");
			return false;
		}
		else
		{
			$("#txtFirstname_0").removeClass("error");
			return true;
		}
	}
	function validateLastName()
	{
		
		var lastname = document.getElementById("txtLastname_0").value;
		if(lastname == "")
		{
			$("#txtLastname_0").addClass("error");
			return false;
		}
		else
		{
			$("#txtLastname_0").removeClass("error");
			return true;
		}
	}
	function validateEmail()
	{
		
		var email = document.getElementById("txtEmail_0").value;
		if(email == "")
		{
			$("#txtEmail_0").addClass("error");
			return false;
		}
		else
		{
			$("#txtEmail_0").removeClass("error");
			return true;
		}
	}
	function validateMobile()
	{
		
		var Mobile = document.getElementById("txtMobileno").value;
		if(Mobile == "")
		{
			$("#txtMobileno").addClass("error");
			return false;
		}
		else
		{
			$("#txtMobileno").removeClass("error");
			return true;
		}
	}
	
	setTimeout(function(){$('div.message').fadeOut(1000);}, 10000);
	</script>
    
</head>
<body class="twoColFixLtHdr">

<div id="container">
  <div id="header">
 <?php require_once("general_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("agent_menu.php"); ?> 
  </div> 
   
  <div class="bck">
    <h2 class="border shadow h2"><span id="myLabel">Booking Details</span></h2>               
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
 <div id="container">
  <div>
  
         <?php if(isset($faredetails)){
		 $Fare_id = $faredetails->row(0)->Id;
		 if($api_name == "ARZOO")
		 {
		 	$rslt_flights = $this->db->query("select * from tblarzooflightsegments where Fare_Id = '$Fare_id'");
			$airLineName = $rslt_flights->row(0)->airLineName;
			$DepartureAirportCode = $rslt_flights->row(0)->DepartureAirportCode;
			$ArrivalAirportCode = $rslt_flights->row(0)->ArrivalAirportCode;
			$FlightNumber = $rslt_flights->row(0)->FlightNumber;
			$DepartureDateTime = $rslt_flights->row(0)->DepartureDateTime;
			$ArrivalDateTime = $rslt_flights->row(0)->ArrivalDateTime;
			$classType = $rslt_flights->row(0)->classType;
			
			$ActualBaseFare = $faredetails->row(0)->ActualBaseFare;
			$Tax = $faredetails->row(0)->Tax;
			$STax = $faredetails->row(0)->STax;
			$SCharge = $faredetails->row(0)->SCharge;
			
			
		 }
		 else if($api_name == "TBO")
		 {
			 $rslt_flights = $this->db->query("select * from  tbltboflightsegments where Fare_Id = '$Fare_id'");
			 $airLineName = $rslt_flights->row(0)->Segment_AirlineName;
			$DepartureAirportCode = $rslt_flights->row(0)->Segment_Origin_AirportCode;
			$ArrivalAirportCode = $rslt_flights->row(0)->Segment_Destination_AirportCode;
			$FlightNumber = $rslt_flights->row(0)->Segment_FlightNumber;
			$DepartureDateTime = $rslt_flights->row(0)->Segment_DepTIme;
			$ArrivalDateTime = $rslt_flights->row(0)->Segment_ArrTime;
			$classType = $rslt_flights->row(0)->Segment_FareClass;
			
			$ActualBaseFare = $faredetails->row(0)->BaseFare;
			$Tax = $faredetails->row(0)->Tax;
			$STax = $faredetails->row(0)->ServiceTax;
			$SCharge = $faredetails->row(0)->AdditionalTxnFee;
			
		 }
		  ?>     
    <form action="<?php echo base_url(); ?>booking_details" method="post" autocomplete="off" name="frmBookNow" id="frmBookNow">    	
     <table style="width:90%" border="0" cellpadding="3" cellspacing="3">
     <tbody><tr>
     <td colspan="2" valign="top">
         <table summary="Flight Information" border="0" bordercolor="#f5f5f5" cellpadding="5" cellspacing="0" width="100%">
    <strong class="row2">Onward Trip Details</strong>
    <tbody><tr class="colHeader">
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Carrier Name</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Flight ID</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Departs</th>    
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Arrives</th>
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Class</th>
    </tr> 
			
        <tr class="background_gray">
	<td align="left"><?php echo $airLineName; ?>    <br><?php echo $DepartureAirportCode; ?>  -&gt; <?php echo $ArrivalAirportCode; ?>   
    </td>
    <td align="left"><?php echo $FlightNumber; ?></td>    
    <td align="left"><?php echo $DepartureDateTime; ?></td>
    <td align="left"><?php echo $ArrivalDateTime; ?></td>
    <td align="left"><?php echo $classType; ?></td>        
    </tr>    
    </tbody></table>      	    

		     </td>
     </tr>
     <tr>
     <td valign="top" class="background_gray" style="padding-top:-20px;">
     <strong style="color:#FFFFFF;background:#0000FF;width:100%;margin-top:-20px;">Onward Fare Details</strong>
        <table summary="Flight Information" border="0" cellpadding="3" cellspacing="0" width="100%">
     
<tbody><tr >
<th scope="col">Basic Fare</th>
<td align="right"><?php echo $ActualBaseFare; ?></td>
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
<td align="right">0</td>
</tr>

<tr>
<td colspan="2"><hr style="border:1px solid #09F;"></td>
</tr>
<tr>
<th scope="col">Grand Total</th>
<td align="right"><?php echo ($ActualBaseFare + $Tax + $STax + $SCharge); ?></td>
</tr>
</tbody></table>	    
	
         </td>
     <td valign="top" style="width:80%;padding-left:100px">
     <div id="EnterData">
    <fieldset>
    <legend>Adult Information</legend>        
    <table>
      <tbody><tr>
       <td align="right">Adult 1 :</td>
    <td align="right"><select id="adult_prefix_0" style="width:60px" name="adult_prefix_0" title="Select Prefix">
    <option selected="selected" value="Mr.">Mr.</option>
    <option value="Ms.">Ms.</option>
    <option value="Mrs.">Mrs.</option>    
    </select> </td>
   
    <td align="right">First Name : <input name="txtFirstname_0" class="text" id="txtFirstname_0" title="Enter Adult First Name" type="text"></td>
    <td align="right">Last Name : <input name="txtLastname_0" class="text" id="txtLastname_0" title="Enter Adult Last Name" type="text"></td>
         
    </tr>    
    
    <tr>
    <td align="right"></td>
    <td align="right"></td>
    <td align="right">Email : <input name="txtEmail_0" class="text" id="txtEmail_0" title="Enter Valid Email ID." type="text"></td>
    <td align="right"> Enter Mobile No : +91-<input name="txtMobileno" class="text" id="txtMobileno" title="Enter 10 Digit Mobile No." type="text"></td>
    
         
    </tr>
    
        </tbody></table>
</fieldset>
<br>

<center>
<br>
<input value="Confirm Book" style="width:140px;" onclick="return validateForm();" class="button" name="btnConfirm" id="btnConfirm" type="submit">
</center>
</div>
     </td>
     </tr>
     </tbody></table>  
     <input type="hidden" id="fare_id" name="fare_id" value="<?php echo $Fare_id; ?>">
     <input type="hidden" id="api_name" name="api_name" value="<?php echo $api_name; ?>">            
</form>
<?php } ?>
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat">
<!-- end #container --></div>

<div id="ajaxprocess"   style="position:absolute;margin-top:-350px;margin-left:500px;display:none;" >
  <center><img width="100px;" src="<?php echo base_url("images/ajax-loader.gif"); ?>" align="middle"/></center>
  </div>


    
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>
