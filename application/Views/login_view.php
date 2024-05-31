<!--<?php
	$str_query = "select * from tblservice where service_id = '6'";
		
		
		$result_md = $this->db->query($str_query);	
			for($i=0; $i<$result_md->num_rows(); $i++)
		{
		      $status = $result_md->row($i)->service_name;
		      
		      if($status == "expired"){
		      
		      echo "<h1>YOUR SERVER HAS BEEN EXPIRED, PLEASE CONTACT SUPPORT FOR RENEWAL"; exit;
		      }
		}
		?>

<!DOCTYPE html>
<html>
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
  <meta name="description" content="mobile recharge business, mobile recharge software, mobile recharge agency">
  <title>Welcome to <?php
  $domain = $_SERVER['SERVER_NAME'];
  $name = (explode(".",$domain));
  echo ucfirst($name[0]); ?></title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&amp;subset=latin">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
  <link rel="stylesheet" href="assets/bootstrap-material-design-font/css/material.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/animate.css/animate.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/theme/css/mbr-additional.css" type="text/css">
  
  
  
</head>
<body>
<section id="ext_menu-0">

    <nav class="navbar navbar-dropdown navbar-fixed-top">
        <div class="container">

            <div class="mbr-table">
                <div class="mbr-table-cell">

                     <div class="navbar-brand">
                        <span class="navbar-logo"><a href="/"><img src="images/logo.png"></a></span>
                        
                    </div>

                </div>
                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar"><li class="nav-item"><a class="nav-link link" href="/">HOME</a></li><li class="nav-item"><a class="nav-link link" href="#testimonials4-5">SERVICES</a></li><li class="nav-item"><a class="nav-link link" href="#msg-box3-6">BUSINESS OPPORTUNITY</a></li><li class="nav-item"><a class="nav-link link" href="/m.apk">DOWNLOAD</a></li><li class="nav-item"><a class="nav-link link" href="#form1-8">CONTACT US</a></li><li class="nav-item nav-btn"><a class="nav-link btn btn-white btn-white-outline" href="login">LOGIN</a></li></ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>

<section class="engine"><a rel="external" href=""></a></section><section class="mbr-slider mbr-section mbr-section__container carousel slide mbr-section-nopadding mbr-after-navbar" data-ride="carousel" data-keyboard="false" data-wrap="true" data-pause="false" data-interval="4000" id="slider-1">
    <div>
        <div>
            <div>
                <ol class="carousel-indicators">
                    <li data-app-prevent-settings="" data-target="#slider-1" class="active" data-slide-to="0"></li><li data-app-prevent-settings="" data-target="#slider-1" data-slide-to="1"></li><li data-app-prevent-settings="" data-target="#slider-1" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="mbr-section mbr-section-hero carousel-item dark center mbr-section-full active" data-bg-video-slide="false" style="background-image: url(assets/images/rcpanel-bannel1-2000x1125.jpg);">
                        <div class="mbr-table-cell">
                            
                            <div class="container-slide container">
                                
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2 text-xs-center">
                                        
                                        

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="mbr-section mbr-section-hero carousel-item dark center mbr-section-full" data-bg-video-slide="false" style="background-image: url(assets/images/rcpanel-banner2-2000x1125.jpg);">
                        <div class="mbr-table-cell">
                            
                            <div class="container-slide container">
                                
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-1">
                                        
                                        

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="mbr-section mbr-section-hero carousel-item dark center mbr-section-full" data-bg-video-slide="false" style="background-image: url(assets/images/rcpanel-banner3-2000x1125.jpg);">
                        <div class="mbr-table-cell">
                            
                            <div class="container-slide container">
                                
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-3 text-xs-right">
                                        
                                        

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a data-app-prevent-settings="" class="left carousel-control" role="button" data-slide="prev" href="#slider-1">
                    <span class="icon-prev" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a data-app-prevent-settings="" class="right carousel-control" role="button" data-slide="next" href="#slider-1">
                    <span class="icon-next" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="mbr-section mbr-section__container article" id="header3-2" style="background-color: rgb(255, 255, 255); padding-top: 20px; padding-bottom: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="mbr-section-title display-2">Start All In One Recharge Business</h3>
                <small class="mbr-section-subtitle"><?php 
                        if($name[0] == 'www'){
                          
                          echo ucfirst($name[1]);  
                        }
                        else echo ucfirst($name[0]); ?> Provide latest concepts in Mobile/DTH Top-up by the way of SMS Recharge and Online Recharge. Our Multi-Recharge platform allows retailers to recharge any Mobile or DTH instantly from anywhere in India by just sending a simple SMS to our recharge server. Our Recharge Services includes all Telecom/DTH Operators Functioning in India.  <?php 
                        if($name[0] == 'www'){
                          
                          echo ucfirst($name[1]);  
                        }
                        else echo ucfirst($name[0]); ?> provide well organized services to its subscribers, and with its manifold functionalities it enables Point of sale units or retailers to offer multiple services to their customers and earn additional income</small>
            </div>
        </div>
    </div>
</section>

<section class="mbr-cards mbr-section mbr-section-nopadding" id="features1-3" style="background-color: rgb(255, 255, 255);">

        

    <div class="mbr-cards-row row striped">

        <div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 80px; padding-bottom: 80px;">
            <div class="container">
                <div class="card cart-block">
                    <div class="card-img"><img src="assets/images/300-600x600.png" class="card-img-top"></div>
                    <div class="card-block">
                        <h4 class="card-title">Mobile Recharge</h4>
                        <h5 class="card-subtitle">All Prepaid Mobile Recharge</h5>
                        <p class="card-text">Distributors and Retailers can recharge any operators &nbsp;like airtel , vodafone, Relience, Idea etc..</p>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 80px; padding-bottom: 80px;">
            <div class="container">
                <div class="card cart-block">
                    <div class="card-img"><img src="assets/images/dth-600x537.png" class="card-img-top"></div>
                    <div class="card-block">
                        <h4 class="card-title">DTH Recharge</h4>
                        <h5 class="card-subtitle">All DTH Recharge</h5>
                        <p class="card-text"><?php 
                        if($name[0] == 'www'){
                          
                          echo ucfirst($name[1]);  
                        }
                        else echo ucfirst($name[0]); ?> provide recharge for all DTH services like airtel, Big Tv Dish TV, Tata Sky, Sun Direct, Tata Sky etc..</p>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 80px; padding-bottom: 80px;">
            <div class="container">
                <div class="card cart-block">
                    <div class="card-img"><img src="assets/images/datacardd-600x346.png" class="card-img-top"></div>
                    <div class="card-block">
                        <h4 class="card-title">Data Card Recharge</h4>
                        <h5 class="card-subtitle">All Data card recharge</h5>
                        <p class="card-text"><?php 
                        if($name[0] == 'www'){
                          
                          echo ucfirst($name[1]);  
                        }
                        else echo ucfirst($name[0]); ?> Provide Data Card Payments which saves time and money, Supports all network</p>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 80px; padding-bottom: 80px;">
            <div class="container">
                <div class="card cart-block">
                    <div class="card-img"><img src="assets/images/post-paid-600x598.jpg" class="card-img-top"></div>
                    <div class="card-block">
                        <h4 class="card-title">Postpaid Bill payment</h4>
                        <h5 class="card-subtitle">All post paid recharge</h5>
                        <p class="card-text">Our Recharge portal supports all pospaid network all over india</p>
                        
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</section>

<section class="mbr-section mbr-parallax-background" id="testimonials4-5" style="background-image: url(assets/images/rc6555-2000x1500.jpg); padding-top: 120px; padding-bottom: 120px;">

    <div class="mbr-overlay" style="opacity: 0.2; background-color: rgb(34, 34, 34);">
    </div>

        <div class="mbr-section mbr-section__container mbr-section__container--middle">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-xs-center">
                        <h3 class="mbr-section-title display-2">Our Services</h3>
                        
                    </div>
                </div>
            </div>
        </div>


    <div class="mbr-section mbr-section-nopadding">
        <div class="container">
            <div class="row">

                <div class="col-xs-12">

                    <div class="mbr-testimonial card">
                        <div class="card-block"><p><?php 
                        if($name[0] == 'www'){
                          
                          echo ucfirst($name[1]);  
                        }
                        else echo ucfirst($name[0]); ?> focus on Delivering Reliable Value Added Services to Customers in an easiest possible manner which will simplify their utility transactions and requirements. Bringing various common services like Mobile Top-Up/DTH Recharge etc under one roof will significantly reduce the inventory of agents/dealers/retail outlets and also boost their business growth in several ways.</p></div>
                        <div class="mbr-author card-footer">
                            
                            <div class="mbr-author-name">Prepaid/PostPaid Mobile Recharge</div>
                            
                        </div>
                    </div><div class="mbr-testimonial card">
                        <div class="card-block"><p><?php 
                        if($name[0] == 'www'){
                          
                          echo ucfirst($name[1]);  
                        }
                        else echo ucfirst($name[0]); ?> provide easy recharging facility for all prepaid mobile networks available in India with the help of our Instant recharge solutions. Our Single Sim Recharge facility works on any Normal Mobile Handset and provides an easy way to earn additional revenue for shopkeepers and retailers.</p></div>
                        <div class="mbr-author card-footer">
                            
                            <div class="mbr-author-name">DTH/Data Card Recharge Service</div>
                            
                        </div>
                    </div><div class="mbr-testimonial card">
                        <div class="card-block"><p><?php 
                        if($name[0] == 'www'){
                          
                          echo ucfirst($name[1]);  
                        }
                        else echo ucfirst($name[0]); ?> Provide Data card recharge facility for all operators available in India with the help of our Instant recharge solutions. Our Single Sim Recharge facility works on any Normal Mobile Handset and provides an easy way to earn additional revenue for shopkeepers and retailers</p>
                        </div>
                        <div class="mbr-author card-footer">
                            
                            <div class="mbr-author-name"></div>
                            
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>

<section class="mbr-section article" id="msg-box3-6" style="background-color: rgb(242, 242, 242); padding-top: 120px; padding-bottom: 40px;">

    
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-xs-center">
                <h3 class="mbr-section-title display-2">Business opportunity</h3>
                <div class="lead"><p>&nbsp;</p><p><?php 
                        if($name[0] == 'www'){
                          
                          echo ucfirst($name[1]);  
                        }
                        else echo ucfirst($name[0]); ?>  Offering a Flexible Business Model and Multiple Business Options. <?php echo ucfirst($name[0]); ?> <?php 
                        if($name[0] == 'www'){
                          
                          echo ucfirst($name[1]);  
                        }
                        else echo ucfirst($name[0]); ?> welcome Enterprising Individuals/Firms from all parts of India who would like to join this revolutionary Utility Services Business.</p><p>Retailer</p><p><span style="font-size: 1.07rem; line-height: 1.5;">Any Shop small or big, Grocery stores, Mobile stores, Recharge outlets, Internet Café or Utility Kiosks can become our Retailers and earn additional income.</span></p><p>Distributor</p><p>Role of a Distributor is to create Point Of Sale Units (Retail Outlets) and generate revenue through them. Distributor is the Point of contact for retailers to get their Service activated and also Retailers purchase daily recharge balance from Our Distributors. This is a Unique and Rewarding Business opportunity with very small investment. Distributors get best commissions on retailer recharge volumes. &nbsp;&nbsp;</p><p>Master Distributor</p><p>Master Distributors are Our Business partners in a Particular State or Territory who takes care of Appointing Distributors and Managing Distributor Network. You get best turnover margin on Recharge Volumes.</p></div>
                
            </div>
        </div>
    </div>

</section>

<section class="mbr-section" id="form1-8" style="background-color: rgb(255, 255, 255); padding-top: 120px; padding-bottom: 120px;">
    
    <div class="mbr-section mbr-section__container mbr-section__container--middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-xs-center">
                    <h3 class="mbr-section-title display-2">CONTACT US</h3>
                    
                    <?php
		$str_query = "select * from contact";
		$result = $this->db->query($str_query);		
		
		echo html_entity_decode($result->row(0)->contact);
	?>
                    
                    <small class="mbr-section-subtitle">For quick response please fill up the form below</small>
                   <marquee scrolldelay="5" direction="left" behavior="scroll" onmouseover="this.stop()" onmouseout="this.start()">
<?php
		$result_alert = $this->db->query("select * from tblalerts");				
		echo html_entity_decode($result_alert->row(0)->alert_name);
	?>
</marquee>
                </div>
            </div>
        </div>
    </div>
    <div class="mbr-section mbr-section-nopadding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-10 col-lg-offset-1" >



                    <form action="forget/test" method="post" data-form-title="CONTACT US">

                        

                        <div class="row row-sm-offset">

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-8-name">Name<span class="form-asterisk">*</span></label>
                                    <input type="text" class="form-control" name="name" required="" data-form-field="Name" id="form1-8-name">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-8-email">Email<span class="form-asterisk">*</span></label>
                                    <input type="email" class="form-control" name="email" required="" data-form-field="Email" id="form1-8-email">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-8-phone">Phone</label>
                                    <input type="tel" class="form-control" name="phone" data-form-field="Phone" id="form1-8-phone">
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="form1-8-message">Message</label>
                            <textarea class="form-control" name="message" rows="7" data-form-field="Message" id="form1-8-message"></textarea>
                        </div>

                           <button type="submit" class="btn btn-warning">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mbr-section mbr-section-md-padding mbr-footer footer1" id="contacts1-4" style="background-color: rgb(46, 46, 46); padding-top: 90px; padding-bottom: 90px;">
    
    <div class="container">
        <div class="row">
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <div><img src="assets/images/ls1b-128x92.png"></div>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><font color="#7c7c7c" face="Montserrat, sans-serif" size="3"><span style="letter-spacing: -1px; line-height: 20px;"><strong>Business opportunity</strong></span></font><br><br>Wanted distributors and retailers all over india. Hi speed recharge system with high margin, please contact us to start this business</p>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><strong>Features</strong><br>1-All Mobile/DTH Operators available                     <br>2-Instant recharge                                                 <br>3-Recharge by SMS or web                                                                                         <br>4-One Account for all recharge services<br>5-Profitable Margin</p>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><strong>Multi Services</strong><br>1-Recharge any Mobile Phone<br>2-Top-Up All DTH Services<br>3-Data Card Recharge<br>4-Postpaid bill payment<br>5-Single Wallet multi recharge</p>
            </div>

        </div>
    </div>
</section>

<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-9" style="background-color: rgb(50, 50, 50); padding-top: 1.75rem; padding-bottom: 1.75rem;">
    
    <div class="container">
        <p class="text-xs-center">Copyright &copy; <?php echo date("Y"); ?>,  <?php echo $domain;?>, All rights reserved</p>
    </div>
</footer>


  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smooth-scroll/SmoothScroll.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touchSwipe/jquery.touchSwipe.min.js"></script>
  <script src="assets/viewportChecker/jquery.viewportchecker.js"></script>
  <script src="assets/bootstrap-carousel-swipe/bootstrap-carousel-swipe.js"></script>
  <script src="assets/jarallax/jarallax.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/formoid/formoid.min.js"></script>
  
  
  <input name="animation" type="hidden">
  </body>
</html>-->


<?php
	$str_query = "select * from tblservice where service_id = '6'";
		
		
		$result_md = $this->db->query($str_query);	
			for($i=0; $i<$result_md->num_rows(); $i++)
		{
		      $status = $result_md->row($i)->service_name;
		      
		      if($status == "expired"){
		      
		      echo "<h1>YOUR SERVER HAS BEEN EXPIRED, PLEASE CONTACT SUPPORT FOR RENEWAL"; exit;
		      }
		}
		?>

<?php $this->load->library('encrypt');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Login</title>

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

<style>
body  {
background: linear-gradient(90deg, #cafce8, #7ae5fa);
}

    /* CSS for the clock */
        .clock {
            font-size: 18px;
            font-family: Arial, sans-serif;
            color: #333;
            text-align: center;
        }
        
        /* CSS for the element in bottom left corner */
        .element {
            position: absolute;
            bottom: 0;
            left: 0;
            padding: 10px; /* Optional, to add some spacing */
            color: #fff;
        }
</style>
</head>
<body>
        <div class="element">
  <div class="clock" id="clock"></div>
    <script>
        // JavaScript for the clock
        function updateClock() {
            var now = new Date().toLocaleString("en-US", { timeZone: "Asia/Kolkata" }); // Set the time zone to India (Asia/Kolkata)
            document.getElementById("clock").innerHTML = now;
        }
        setInterval(updateClock, 1000);
    </script>
      </div>
    <!-- FakeLoader Start -->
    <div id="fakeLoader"></div>
    <!-- FakeLoader End -->
    
    <!-- Menu Area Start -->
    
   
    <!-- Menu Area End -->


  
  
    <!-- Page Title Area Start -->
   
    <!-- Page Title Area End -->
    <div class="container">
        <br />
   <br />

        
         <div class="col-md-6 col-md-offset-3 " style="margin-top:-20px">
             
        <div class="text-center">
                        <a href=""><img src="images/logo.png" class="rounded" width="auto" height="70"></a>
                    </div>
         
    <div class="panel">
      <div class="panel-heading" style="background-color:#0159DE; color:white;">Welcome to RechargeToEarn Login Panel</div>
      <div class="panel-body"><div class="row">
                    <div class="form-group col-xs-12">
        
            <div data-form-validation="true">
                <form novalidate="novalidate" action="<?php echo base_url()."login"; ?>" method="post" id="login_form" onsubmit="return validation();">
                
                <div>
                   <?php
                   if($this->session->flashdata('message')){
  echo "<br /><div class='alert alert-danger fade in'>".$this->session->flashdata('message')."</div>";} 

    if ($message != ''){echo "<div class='alert alert-danger' style='color:#F00;'>".$message."</div>"; }?>

    
                  </div>
                <div class="form-group">
                             <label for="loginEmail">Mobile Number *</label> <br />
                        <input id="username" name="username" class="form-control" placeholder="Whatsapp Number" type="text" value="<?php if(isset($_COOKIE['username'])) echo $_COOKIE['username']; ?>">
                        </div>
                    <div class="form-group">
                        <label for="loginPassword">Password *</label> <br />
                        <input id="password" name="password" class="form-control" placeholder="Password" value="<?php  $this->load->library('encrypt');
                         $pass = $_COOKIE['password'];
                        
                        $pass3 = $this->encrypt->decode($pass);
                        if(isset($_COOKIE['username'])) echo "$pass3"; ?>" type="password">
                        </div>
                    <div class="checkbox">
    <label><input type="checkbox" name="remember_me" <?php if(isset($_COOKIE['remember_me'])) {
		echo 'checked="checked"';
	}
	else {
		echo '';
	}
	?> >Remember</label>
    </div>
             <div style="padding-left:8px;">   <input type="submit" class="btn btn-success" value="Login" name="btnLogin" id="btnLogin" style="width:49%; font-weight:bold;"/><span id="wait_tip" style="display:none;"> Please wait...<img src="images/ajax-loader2.gif"
           id="loading_img"/></span> <a href="forget" class="btn btn-warning" role="button" style="width:49%; font-weight:bold;">Reset Password</a>
           <br />
           </div>
              <hr style="border: none; height: 1px; background-color: #000;">
             <div style="padding:0 30px 0 30px;">

                 <span>If you don't have account? <br></span>
                
                 <a href="register" class="btn btn-primary" role="button" style="width:100%; font-size:15px; font-weight:bold; margin:15px 10px 0 0; "> <!-- This Unicode character points right -->Sign up</a>
           <br />
           </div>
          
                
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
