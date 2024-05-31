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

    <title>Change Password</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">
 <?php include("app_css.php"); ?>
  
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script language="javascript">
	function complainadd(recahrge_id)
	{
		
		document.getElementById("hidcomplain").value = "Set";
		document.getElementById("recid").value = recahrge_id;
		document.getElementById("frmcomplain").submit();
	}
	</script>
	<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
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
	<script type="text/javascript">
   function getId(id) { 
       return document.getElementById(id); 
   } 
   function validation() { 
       getId("btnSubmit").style.display="none"; 
       getId("wait_tip").style.display=""; 
       return true; 
   } 
</script>
</head>
<body onLoad="setdefaultcircle()"> 
 <?php include("menu.php"); ?>
    
    
    <br />
  <div class="container">
     
   <?php
	if($this->session->flashdata('message')){
	echo "<div class='alert alert-danger fade in'>".$this->session->flashdata('message')."</div>";}	
	if($message != ''){
	echo "<div class='alert alert-danger fade in'>".$message."</div>";}
	?>
    <div class="panel panel-primary">
      <div class="panel-heading">Change Password</div>
      <div class="panel-body">      <form action="<?php echo base_url()."change_pass"; ?>" method="post" autocomplete="off" name="frmChangePassword" id="frmChangePassword">
     
     <input class="form-control" required="" id="txtOldPassword" name="txtOldPassword"  placeholder="Old Password" data-toggle="tooltip" title="Please Enter Old Password" placeholder="Old Password*" type = "password" /><br />
     
    
      <input class="form-control" required="" id="txtNewPassword" name="txtNewPassword"  placeholder="New Password" data-toggle="tooltip" title="Please Enter New Password" placeholder="New Password*" type = "password" /><br />
      
      <input class="form-control" required="" id="txtCnfPassword" name="txtCnfPassword"  placeholder="Confirm Password" data-toggle="tooltip" title="Please Enter Confirm Password" placeholder="Confirm Password*" type = "password" /><br />
   
<input type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" value="Submit"><span id="wait_tip" style="display:none;"> Please wait...<img src="images/ajax-loader2.gif"
           id="loading_img"/></span>
          </from></div>
    </div></div>
  

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
