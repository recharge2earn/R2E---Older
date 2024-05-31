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

    <title>Retailer Registration</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">
 <?php include("app_css.php"); ?>
  
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
 <div class="container" style="margin-top: 2%;">
         <div class="col-md-4 col-md-offset-4">
    <div class="panel panel-primary">
      <div class="panel-heading">Registration</div>
      <div class="panel-body"><div class="row">
                    <div class="form-group col-xs-12">
      <?php
      if($this->session->flashdata('message')){
    echo "<br /><div class='alert alert-danger fade in'>".$this->session->flashdata('message')."</div>";}
    if($message != ''){
    echo "<div class='alert alert-danger fade in'>".$message."</div>";}
    ?>
    
      <form method="post" action="register" name="frmdistributer_form1" id="frmdistributer_form1" autocomplete="off">
          
          <div class="form-group">
                        <label for="txtDistname">Name *</label> <br />
     <input class="form-control" required="" id="txtDistname" name="txtDistname" value="<?php echo $regData['distributer_name']; ?>" placeholder="Full Name*" type="text"></div>
     
     <div class="form-group">
                        <label for="txtMobNo">Mobile Number *</label> <br />
         <input class="form-control" required="" onkeypress=return isNumeric(event);" id="txtMobNo" name="txtMobNo" title="Enter Mobile No.<br />e.g. 9898980000" placeholder="Mobile Number*" value="<?php echo $regData['mobile_no']; ?>" type="tel" maxlength="10"/>
         </div>
         
          <div class="form-group">
                        <label for="txtEmail">Email ID *</label> <br />
          <input class="form-control" required="" name="txtEmail" id="txtEmail" placeholder="Email ID*" type="email">
          
          </dv>
     
      <div class="form-group">
                        <label for="txtPostalAddr">Address *</label> <br />
       <textarea class="form-control" rows="4" required="" id="txtPostalAddr" name="txtPostalAddr" type="text" value "<?php echo $regData['postal_address']; ?>" placeholder="Please enter Full address"></textarea></div>
       
        <div class="form-group">
                        <label for="txtPin">Postal Code *</label> <br />
       <input class="form-control" required="" id="txtPin" name="txtPin" value="<?php echo $regData['pincode']; ?>" placeholder="Pin Code" type="number"></div>
       
       
        <div class="form-group">
                        <label for="hidStateCode">State *</label> <br />
       <input type="hidden" name="hidStateCode" id="hidStateCode" />
        <select class="form-control" required="" id="ddlState" name="ddlState" onChange="getCityName('<?php echo base_url()."local_area/getCity/"; ?>')" title="Select State.<br />Click on drop down"><option value="0">Select State*</option>
<?php
$str_query = "select * from tblstate order by state_name";
        $result = $this->db->query($str_query);     
        for($i=0; $i<$result->num_rows(); $i++)
        {
            echo "<option code='".$result->row($i)->codes."' value='".$result->row($i)->state_id."'>".$result->row($i)->state_name."</option>";
        }
?>
</select></div>

 
          <br />

          <input type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" value="Register">
          </from>
 </div>
        </div>
    </div></div></div>
    </div>
    </div>

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
