<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Reset Password</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

     <?php include("app_css.php"); ?>
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
    <div id="pageTitle" class="bg--overlay" data-bg-img="">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="section-title">
                        <h2>Reset Password</h2>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <ul class="breadcrumb">
                        <li><span>You are here:</span></li>
                        <li><a href="#">Home</a></li>
                        <li class="active">Reset Password</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
   
    <!-- Menu Area End -->
    
    <!-- Page Title Area Start -->
   
    <!-- Page Title Area End -->
    <div class="container" style="margin-top: 2%;">
         <div class="col-md-4 col-md-offset-4">
    <div class="panel panel-primary">
      <div class="panel-heading">Rest Password</div>
      <div class="panel-body"><div class="row">
                    <div class="form-group col-xs-12">
        
            <div data-form-validation="true">
                <form method="post" name="frmForget" id="frmForget" action="<?php echo base_url()."forget"; ?>">
                
                <div>
                   <?php

    if ($message != ''){echo "<div class='alert alert-danger' style='color:#F00;'>".$message."</div>"; }

    if($this->session->flashdata('message')){

    echo "<div class='message'>".$this->session->flashdata('message')."</div>";}

    ?>   
                  </div>
                <div class="form-group">
                        <label for="mobile_no">Registred Mobile no *</label> <br />
                        <input id="mobile_no" name="mobile_no" class="form-control" placeholder="Enter Registred Mobile no" type="text" required >
                        </div>
                   
                    
                <input type="submit" class="btn btn-primary" value="Reset Password" name="btnOK" id="btnOK" /><span id="wait_tip" style="display:none;"> Please wait. Password will be sent to registered mobile/email..<img src="images/ajax-loader2.gif"
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
    </div></div></div>
    </div>
    </div>
    <!-- Login Area End -->

   
  
    
    <!-- Copyright Area Start -->
    <?php include("footer.php"); ?>
    <!-- Copyright Area End -->

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
