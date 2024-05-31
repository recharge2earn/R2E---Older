<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Register</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">
 <?php include("app_css.php"); ?>
   
</head>
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

function getAreaName(urlToSend)
	{
		if(document.getElementById('ddlCity').selectedIndex != 0)
		{
		$.ajax({
  type: "GET",
  url: urlToSend+""+document.getElementById('ddlCity').value,
  success: function(html){
	  var html = "<option value='0'>Select Area</option>"+html+"<option value='0'>Other</option>";
    $("#ddlArea").html(html);
  }
});
		}
	}


$(document).ready(function(){
	//global vars
	var form = $("#frmdistributer_form1");
	var rname = $("#txtDistname");var postaladdr = $("#txtPostalAddr");
	var pin = $("#txtPin");var mobileno = $("#txtMobNo");var emailid = $("#txtEmail");
	var ddlsch = $("#ddlSchDesc");	var dname = $("#ddlDistname");
	//On Submitting
	form.submit(function(){
		if(validateRname() & validateAddress() & validatePin() & validateMobileno() & validateEmail() & validateScheme() & validateDName())
			{				
			return true;
			}
		else
			return false;
	});
	//validation functions	
	function validateRname(){
		if(rname.val() == ""){
			rname.addClass("error");return false;
		}
		else{
			rname.removeClass("error");return true;
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
	function validateDName(){
		if(dname[0].selectedIndex == 0){
			dname.addClass("error");			
			return false;
		}
		else{
			dname.removeClass("error");		
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
</script>
	<script language="javascript">
	function selectddlvalue()
	{
		var state_id = '<?php echo $regData['state_id']; ?>';
		var city_id = '<?php echo $regData['city_id']; ?>';
		var retailer_type_id = '<?php echo $regData['retailer_type_id']; ?>';
		var scheme_id = '<?php echo $regData['scheme_id']; ?>';
		var parent_id = '<?php echo $regData['parent_id']; ?>';
		document.getElementById("ddlState").value = state_id;
		
		document.getElementById("ddlRetType").value = retailer_type_id;
		document.getElementById("ddlSchDesc").value = scheme_id;
		document.getElementById("ddlDistname").value = parent_id;
		var urlToSend = '<?php echo base_url()."local_area/getCity/"; ?>';
		$.ajax({
  type: "GET",
  url: urlToSend+""+document.getElementById('ddlState').value,
  success: function(html){
    $("#ddlCity").html(html);
	document.getElementById("ddlCity").value = city_id;
  }
});

	}
	
	</script>
	 <style>
 .form-control {
       margin-bottom:-5px;
       width: 100%;
    margin: 0 auto; /* Centers the element horizontally */
    display: block;
   }

  </style>

<body>
  
    <!-- FakeLoader Start -->
    <div id="fakeLoader"></div>
    <!-- FakeLoader End -->
    
    <!-- Menu Area Start -->
    
   
    <!-- Menu Area End -->
    
    <!-- Page Title Area Start -->
    <div id="pageTitle" class="bg--overlay" >
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="section-title">
                        <h2>Account Registration</h2>
                    </div>
                </div>
                
                <div class="col-md-6">
                    
                </div>
            </div>
        </div>
    </div>
    
 <div class="container"  style="margin-top:3%;  padding:0;">
         <div class="col-md-6 col-md-offset-3" >
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
     <input class="form-control" required="" id="txtDistname" name="txtDistname" value="<?php echo $regData['distributer_name']; ?>" placeholder="Full Name" type="text"></div>
     
     <div class="form-group">
                        <label for="txtMobNo">Mobile Number *</label> <br />
         <input class="form-control" required="" onkeypress=return isNumeric(event);" id="txtMobNo" name="txtMobNo" title="Enter Mobile No.<br />e.g. 9898980000" placeholder="Whatsapp Number" value="<?php echo $regData['mobile_no']; ?>" type="tel" maxlength="10"/>
         </div>
         
          <div class="form-group">
                        <label for="txtEmail">Email ID *</label> <br />
          <input class="form-control" required="" name="txtEmail" id="txtEmail" placeholder="Email ID" type="email">
          
          </div>
     
      <div class="form-group">
                        <label for="txtPostalAddr">Address </label> <br />
       <textarea class="form-control" rows="4" id="txtPostalAddr" name="txtPostalAddr" type="text" value "<?php echo $regData['postal_address']; ?>" placeholder="Please enter Full address"></textarea></div>
       
        <div class="form-group">
                        <label for="txtPin">Postal Code </label> <br />
       <input class="form-control" id="txtPin" name="txtPin" value="<?php echo $regData['pincode']; ?>" placeholder="Pin Code" type="number"></div>
       
       
        <div class="form-group">
                        <label for="hidStateCode">State </label> <br />
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
</select></div>


          <input type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" value="Register" style="width:120px">
          </from>
 </div>
        </div>
    </div></div></div>
    </div>
    </div>
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
