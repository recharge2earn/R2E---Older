<?php
$us_id = $this->session->userdata("id");
$rslt = $this->db->query("select * from tblusers where user_id = '$us_id'");
$state_id = $rslt->row(0)->state_id;
$rslt1 = $this->db->query("select * from tblstate where state_id = '$state_id'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Profile Edit</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">
 <?php include("app_css.php"); ?>
  
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
      <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                       
       <script type="text/javascript" language="javascript">					
		function getCityName(urlToSend)
	{
		if(document.getElementById('ddlState').selectedIndex != 0)
		{
			document.getElementById('hidStateCode').value = $("#ddlState")[0].options[document.getElementById('ddlState').selectedIndex].getAttribute('code');					
		$.ajax({
  type: "GET",
  url: urlToSend+""+document.getElementById('ddlState').value,
  success: function(html){
    $("#ddlCity").html(html);
  }
});
		}
	}


function getCityNameOnLoad(urlToSend)
	{
		if(document.getElementById('ddlState').selectedIndex != 0)
		{
			document.getElementById('hidStateCode').value = $("#ddlState")[0].options[document.getElementById('ddlState').selectedIndex].getAttribute('code');					
		$.ajax({
  type: "GET",
  url: urlToSend+""+document.getElementById('ddlState').value,
  success: function(html){
    $("#ddlCity").html(html);
	document.getElementById('ddlCity').value = document.getElementById('hidCityID').value;		
  }
});
		}
	}

$(document).ready(function(){
	//global vars
	var form = $("#frmchange_profile");
	var dname = $("#txtDistname");var postaladdr = $("#txtPostalAddr");
	var pin = $("#txtPin");var mobileno = $("#txtMobNo");var emailid = $("#txtEmail");
	//On Submitting
	form.submit(function(){
		if(validateDname() & validateAddress() & validatePin() & validateMobileno() & validateEmail())
			{				
			return true;
			}
		else
			return false;
	});
	//validation functions	
	function validateDname(){
		if(dname.val() == ""){
			dname.addClass("error");return false;
		}
		else{
			dname.removeClass("error");return true;
		}		
	}	
	function validateAddress(){
		if(postaladdr.val() == ""){
			postaladdr.addClass("error");return false;
		}
		else{
			postaladdr.removeClass("error");return true;
		}		
	}
	function validatePin(){
		if(pin.val() == ""){
			pin.addClass("error");
			return false;
		}
		else{
			pin.removeClass("error");
			return true;
		}
		
	}
	function validateMobileno(){
		if(mobileno.val().length < 10){
			mobileno.addClass("error");return false;
		}
		else{
			mobileno.removeClass("error");return true;
		}
	}
	function validateEmail(){
		var a = $("#txtEmail").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		if(filter.test(a)){
			emailid.removeClass("error");
			return true;
		}
		else{
			emailid.addClass("error");			
			return false;
		}
	}
	function validateScheme(){
		if(ddlsch[0].selectedIndex == 0){
			ddlsch.addClass("error");			
			return false;
		}
		else{
			ddlsch.removeClass("error");		
			return true;
		}
	}
	setTimeout(function(){$('div.message').fadeOut(1000);}, 10000);
	
	
});
	function ChangeAmount()
	{
		if(document.getElementById('ddlSchDesc').selectedIndex != 0)
		{
			document.getElementById('spAmount').innerHTML = $("#ddlSchDesc")[0].options[document.getElementById('ddlSchDesc').selectedIndex].getAttribute("amount");
			document.getElementById('hid_scheme_amount').value = document.getElementById('spAmount').innerHTML;
		}
	}	
	function setLoadValues()
	{		
		document.getElementById('ddlRetType').value = document.getElementById('hidRetType').value;		
		document.getElementById('ddlState').value = document.getElementById('hidStateID').value;				
		getCityNameOnLoad('<?php echo base_url()."local_area/getCity/"; ?>');				
	}	
</script>
 

</head>
<body onLoad="setdefaultcircle()"> 
 <?php include("menu.php"); ?>
   
   <div class="container">
     
   <?php
	if($this->session->flashdata('message')){
	echo "<div class='alert alert-danger fade in'>".$this->session->flashdata('message')."</div>";}	
	if($message != ''){
	echo "<div class='alert alert-danger fade in'>".$message."</div>";}
	?>
    <div class="panel panel-primary">
      <div class="panel-heading">Profile Edit</div>
      <div class="panel-body">
    <?php
$str_query = "select * from tblusers where user_id=".$this->session->userdata('id')."";
$result_user = $this->db->query($str_query);		
?>    
<form method="post" action="my_profile" name="frmchange_profile" id="frmchange_profile" autocomplete="off">

<div class="form-group">
<label for="txtDistname">Legal Name :</label>
<input type="text" class="form-control" readonly='true' title="Enter Distributer Name." value="<?php echo $result_user->row(0)->business_name; ?>" id="txtDistname" name="txtDistname"  maxlength="100"/>
</div>

<div class="form-group">
<label for="txtPostalAddr">Postal Address :</label>
<textarea title="Enter Postal Address" id="txtPostalAddr" name="txtPostalAddr" class="form-control"><?php echo $result_user->row(0)->postal_address; ?></textarea>
</div>

<div class="form-group">
<label for="txtPin">Pin Code :</label>
<input type="text" class="form-control" id="txtPin" onKeyPress="return isNumeric(event);" value="<?php echo $result_user->row(0)->pincode; ?>" name="txtPin" maxlength="8" title="Enter Pin Code." />
</div>

<div class="form-group">
<label for="ddlCity">City/District :</label>
<input type="text" class="form-control" title="Enter City Name" id="ddlCity" name="ddlCity" value="<?php echo $result_user->row(0)->city_id; ?>"/>
</div>

<div class="form-group">
<label for="ddlState">State :</label>
<input type="hidden" name="hidStateCode" id="hidStateCode" />
<select class="form-control" id="ddlState" name="ddlState" onChange="getCityName('<?php echo base_url()."local_area/getCity/"; ?>')" title="Select State.<br />Click on drop down"><option value="0">Select State</option>
<?php
$str_query = "select * from tblstate order by state_name";
		$result = $this->db->query($str_query);		
		for($i=0; $i<$result->num_rows(); $i++)
		{
			echo "<option code='".$result->row($i)->codes."' value='".$result->row($i)->state_id."'>".$result->row($i)->state_name."</option>";
		}
?>
</select>
<input type="hidden" id="hidStateID" value="<?php echo $result_user->row(0)->state_id; ?>" /> 
</div>

<div class="form-group">
<label for="txtMobNo">Mobile No :</label>
<input type="text" class="form-control" readonly='true'  onKeyPress="return isNumeric(event);" title="Enter Mobile No.<br />e.g. 9898980000" id="txtMobNo" name="txtMobNo" value="<?php echo $result_user->row(0)->mobile_no; ?>" maxlength="10"/>
</div>

<div class="form-group">
<label for="txtLandNo">Alternate Number :</label>
<input type="text" class="form-control" id="txtLandNo" name="txtLandNo" value="<?php echo $result_user->row(0)->landline; ?>" onKeyPress="return isNumeric(event);" title="Enter Landline No.<br />e.g 07926453647" maxlength="11" />
</div>
<div class="form-group">
<label for="txtEmail">Email :</label>
<input type="text" class="form-control" id="txtEmail" value="<?php echo $result_user->row(0)->emailid; ?>" title="Enter Email ID.<br />e.g some@gmail.com" name="txtEmail"  maxlength="150"/><br />
<span id="emailidInfo"></span>
</div>

<div class="form-group">
<label for="ddlRetType">GSTIN or PAN Number :</label>
<input type="text" class="form-control" id="ddlRetType" name="ddlRetType" value="<?php echo $result_user->row(0)->retailer_type_id; ?>" title="Enter GSTIN or Pan Number No.<br />e.g 07926453647" />
</div>



   <input type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit" value="Update Details"/>
      <input type="reset" class="btn btn-default" id="bttnCancel" name="bttnCancel" value="Cancel"/>
</form>
</div>
  
  <div class="container"> <div class="row">
  
  <div class="col-sm-12">
      
   
      <br />
	
	
	</div>
</div></div>
    </div><br /></div>
    <!-- Login Area End -->

    <!-- Copyright Area Start -->
    <?php include("footer.php"); ?>
    <!-- Copyright Area End -->

    <!-- Back To Top Button Start -->
    <div id="backToTop">
        <a href="body" data-animate-scroll="true"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- Back To Top Button End -->

  <?php include("app_js.php"); ?>
     <script>
            $(document).ready(function(){

                //* boxes animation
                form_wrapper = $('.login_box');
                function boxHeight() {
                    form_wrapper.animate({ marginTop : ( - ( form_wrapper.height() / 2) - 24) },400);
                };
                form_wrapper.css({ marginTop : ( - ( form_wrapper.height() / 2) - 24) });
                $('.linkform a,.link_reg a').on('click',function(e){
                    var target  = $(this).attr('href'),
                    target_height = $(target).actual('height');
                    $(form_wrapper).css({
                        'height'        : form_wrapper.height()
                    });
                    $(form_wrapper.find('form:visible')).fadeOut(400,function(){
                        form_wrapper.stop().animate({
                            height   : target_height,
                            marginTop: ( - (target_height/2) - 24)
                        },500,function(){
                            $(target).fadeIn(400);
                            $('.links_btm .linkform').toggle();
                            $(form_wrapper).css({
                                'height'        : ''
                            });
                        });
                    });
                    e.preventDefault();
                });

                //* validation
                $('#login_form').validate({
                    onkeyup: false,
                    errorClass: 'error',
                    validClass: 'valid',
                    rules: {
                        username: { required: true, minlength: 3 },
                        password: { required: true, minlength: 3 }
                    },
                    highlight: function(element) {
                        $(element).closest('div').addClass("f_error");
                        setTimeout(function() {
                            boxHeight()
                        }, 200)
                    },
                    unhighlight: function(element) {
                        $(element).closest('div').removeClass("f_error");
                        setTimeout(function() {
                            boxHeight()
                        }, 200)
                    },
                    errorPlacement: function(error, element) {
                        $(element).closest('div').append(error);
                    }
                });
            });
        </script>
</body>
</html>
