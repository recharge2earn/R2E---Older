<!DOCTYPE html>
<html class="login_page" lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>

       <!-- Bootstrap framework -->
        <link rel="stylesheet" href="<?php echo base_url()."login_css/bootstrap.css";?>">
        <link rel="stylesheet" href="<?php echo base_url()."login_css/bootstrap-responsive.css";?>">
        <!-- theme color-->
        <link rel="stylesheet" href="<?php echo base_url()."login_css/blue.css";?>">
        <!-- tooltip -->
        <link rel="stylesheet" href="<?php echo base_url()."login_css/jquery.htm";?>">
        <!-- main styles -->
        <link rel="stylesheet" href="<?php echo base_url()."login_css/style.css";?>">

        <!-- favicon -->
        <link rel="shortcut icon" href="">

        <link href="<?php echo base_url()."login_css/css.css";?>" rel="stylesheet" type="text/css">

        <!--[if lt IE 9]>
            <script src="js/ie/html5.js"></script>
                        <script src="js/ie/respond.min.js"></script>
        <![endif]-->

    </head>
    <body style="background-image:url(images/bodybck.jpg);background-repeat:inherit;">

        <div style="margin-top: -173.5px;" class="login_box">

            <form method="post" name="frmForget" id="frmForget" action="<?php echo base_url()."login/forget"; ?>">
                
                <div class="alert alert-info alert-login">
                   <?php

	if ($message != ''){echo "<div class='message' style='color:#F00;'>".$message."</div>"; }

	if($this->session->flashdata('message')){

	echo "<div class='message'>".$this->session->flashdata('message')."</div>";}

	?>                </div>
                <div class="cnt_b">
                    <div class="formRow">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span>
                            <input type="text" class="text" name="txtForgetUserName" id="txtForgetUserName" placeholder="Enter User Name." />
                        </div>
                    </div>
                    <div class="formRow" style="margin-top:10px;">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span>
                            <input type="text" class="text" name="txtForgerEmail" id="txtForgerEmail" placeholder="Enter Email ID." />
                        </div>
                    </div>
                    <div class="formRow clearfix" style="margin-top:20px;">
                        
                    </div>
                </div>
                <div class="btm_b clearfix">
                  <input type="submit" name="btnOK" onClick="return validateForget()" id="btnOK" value="Reset Password" class="button" />
                  
                   
                </div>
             
            </form>

            <form action="#" method="post" id="pass_form" style="display:none">
                <div class="top_b">Can't sign in?</div>
                <div class="alert alert-info alert-login">
                    Please enter your email address. You will receive a link to create a new password via email.
                </div>
                <div class="cnt_b">
                    <div class="formRow clearfix">
                        <div class="input-prepend">
                            <span class="add-on">@</span><input placeholder="Your email address" type="text">
                        </div>
                    </div>
                </div>
                <div class="btm_b tac">
                    <button class="btn btn-inverse" type="submit">Request New Password</button>
                </div>
            </form>

            <form action="#" method="post" id="reg_form" style="display:none">
                <div class="top_b">Sign up to Pay2india</div>
                <div class="alert alert-login">
                    By filling in the form bellow and clicking the "Sign Up" button, you accept and agree to <a data-toggle="modal" href="#terms">Terms of Service</a>.
                </div>
                <div id="terms" class="modal hide fade" style="display:none">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Terms and Conditions</h3>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <a data-dismiss="modal" class="btn" href="#">Close</a>
                    </div>
                </div>
                <div class="cnt_b">

                    <div class="formRow">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span><input placeholder="Username" type="text">
                        </div>
                    </div>
                    <div class="formRow">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span><input placeholder="Password" type="text">
                        </div>
                    </div>
                    <div class="formRow">
                        <div class="input-prepend">
                            <span class="add-on">@</span><input placeholder="Your email address" type="text">
                        </div>
                        <small>The e-mail address is not made public and will only be used if you wish to receive a new password.</small>
                    </div>

                </div>
                <div class="btm_b tac">
                    <button class="btn btn-inverse" type="submit">Sign Up</button>
                </div>
            </form>

            <div class="links_b links_btm clearfix">
                
                <span class="linkform" style="display:none">Never mind, <a href="#login_form">send me back to the sign-in screen</a></span>
            </div>

        </div>

       <script src="<?php echo base_url()."login_css/jquery_002.js";?>"></script>
        <script src="<?php echo base_url()."login_css/jquery.js";?>"></script>
        <script src="<?php echo base_url()."login_css/jquery_003.js";?>"></script>
        <script src="<?php echo base_url()."login_css/bootstrap.js";?>"></script>
        <script>
            $(document).ready(function(){

                //* boxes animation
                form_wrapper = $('.login_box');
                function boxHeight() {
                    form_wrapper.animate({ marginTop : ( - ( form_wrapper.height() / 2) - 24) },400);
                };
                form_wrapper.css({ marginTop : ( - ( form_wrapper.height() / 2) - 24) });
                $('.linkform a,.link_reg a').on('click',function(e){
                    var target	= $(this).attr('href'),
                    target_height = $(target).actual('height');
                    $(form_wrapper).css({
                        'height'		: form_wrapper.height()
                    });
                    $(form_wrapper.find('form:visible')).fadeOut(400,function(){
                        form_wrapper.stop().animate({
                            height	 : target_height,
                            marginTop: ( - (target_height/2) - 24)
                        },500,function(){
                            $(target).fadeIn(400);
                            $('.links_btm .linkform').toggle();
                            $(form_wrapper).css({
                                'height'		: ''
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





</body></html>