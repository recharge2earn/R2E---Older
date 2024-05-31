<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Login</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

   
<?php include('app_css.php'); ?>
    
    	<script type="text/javascript">
   function getId(id) { 
       return document.getElementById(id); 
   } 
   function validation() { 
       getId("btnLogin").style.display="none"; 
       getId("wait_tip").style.display=""; 
       return true; 
   } 
</script>
</head>
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
                        
                    </div>
                </div>
                
                <div class="col-md-6">
                    <ul class="breadcrumb">
                        
                       
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Title Area End -->
    
    <!-- Login Area Start --> 
    <div id="login">
        <div class="container">
            <div data-form-validation="true">
                <form novalidate="novalidate" action="<?php echo base_url()."app_login"; ?>" method="post" id="login_form" onsubmit="return validation();">
                
                <div>
                   <?php

    if ($message != ''){echo "<div class='message' style='color:#F00;'>".$message."</div>"; }

    if($this->session->flashdata('message')){

    echo "<div class='message'>".$this->session->flashdata('message')."</div>";}

    ?>   
                  </div>
                <div class="form-group">
                        <label for="loginEmail">User Name *</label> <br />
                        <input id="username" name="username" class="form-control" placeholder="Username" type="text">
                        </div>
                    <div class="form-group">
                        <label for="loginPassword">Password *</label> <br />
                        <input id="password" name="password" class="form-control" placeholder="Password" value="" type="password">
                        </div>
                    <p class="help-block clearfix">
                        <a href="secure/login" class="pull-left"><i class="fa fa-fw fa-key"></i>Forget Password ?</a>
                    </p>
                <input type="submit" class="btn btn-primary" value="Sign In" name="btnLogin" id="btnLogin" /><span id="wait_tip" style="display:none;"> Please wait...<img src="images/ajax-loader2.gif"
           id="loading_img"/></span>
                
                </div>
          </form>

            <form action="#" method="post" id="pass_form" style="display:none">
                <input placeholder="Your email address" type="text">
                                   
                              </form>

            <form action="#" method="post" id="reg_form" style="display:none">
                
                    <input placeholder="Username" type="text">
                       <input placeholder="Password" type="text">
                       <input placeholder="Your email address" type="text">
                        
            </form>
            </div>
        </div>
    </div>
    <!-- Login Area End -->

   
  <div id="pageTitle" class="bg--overlay" >
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="section-title">
                        
                    </div>
                </div>
                
                <div class="col-md-6">
                    <ul class="breadcrumb">
                        
                       
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
   

    <!-- Back To Top Button Start -->
    <div id="backToTop">
        <a href="body" data-animate-scroll="true"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- Back To Top Button End -->

  <?php include('app_js.php'); ?>
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
