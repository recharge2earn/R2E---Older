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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <!-- WhatsApp icon styles -->
  <style>
    .whatsapp-icon {
        position: fixed;
        bottom: 25px;
        right: 25px;
        background-color: #25d366;
        color: white;
        border-radius: 50%;
        padding: 5px;
        font-size: 36px;
        height: 50px;
        width: 50px;
        z-index: 999;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: bounceUpDown 1.5s infinite alternate; /* Added animation property */
    }

    @keyframes bounceUpDown {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(-15px); /* Adjust the value based on your preference */
        }
    }
    
  .navbar-fixed-top .nav-link,
    .navbar-fixed-top .navbar-toggler-icon,
    .navbar-fixed-top .nav-btn {
        color: blue !important;

    }

    
</style>

</head>
<body>
    <!-- Add this HTML anywhere you want -->
<a href="https://wa.me/919363622952" target="_blank" class="whatsapp-icon">
  <i class="fa fa-whatsapp"></i>
</a>
<section id="ext_menu-0">

   <nav class="navbar navbar-dropdown navbar-fixed-top" style="background-color:#ffcf48; color: blue;">
        <div class="container" >

            <div class="mbr-table" >
                <div class="mbr-table-cell" >

                     <div class="navbar-brand" >
                        <span class="navbar-logo"><a href="/"><img src="assets/images/logo.png"></a></span>
                        
                    </div>

                </div>
                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon" style="color:blue"></div>
                    </button>

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar" style="background-color:#ffcf48"><li class="nav-item"><a class="nav-link link" href="/">HOME</a></li><li class="nav-item"><a class="nav-link link" href="#testimonials4-5">SERVICES</a></li><li class="nav-item"><a class="nav-link link" href="#msg-box3-6">BUSINESS OPPORTUNITY</a></li><li class="nav-item"><a class="nav-link link" href="/m.apk">DOWNLOAD</a></li><li class="nav-item"><a class="nav-link link" href="/policy/contactus.php">CONTACT US</a></li><li class="nav-item nav-btn"><a class="nav-link btn btn-white btn-white-outline" href="login">LOGIN</a></li></ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon" style="background-color:blue"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>

<section class="engine"><a rel="external" href=""></a></section><section class="mbr-slider mbr-section mbr-section__container carousel slide mbr-section-nopadding mbr-after-navbar" data-ride="carousel" data-keyboard="false" data-wrap="true" data-pause="false" data-interval="4000" id="slider-1">

                <ol class="carousel-indicators">
                    <li data-app-prevent-settings="" data-target="#slider-1" class="active" data-slide-to="0"></li><li data-app-prevent-settings="" data-target="#slider-1" data-slide-to="1"></li><li data-app-prevent-settings="" data-target="#slider-1" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox" style="margin-top:90px;">
                    <div class="mbr-section mbr-section-hero carousel-item dark center mbr-section-full active" data-bg-video-slide="false" style="background-image: url(assets/images/Banner1.png); background-size: cover;  background-position: center;">
                        <div class="mbr-table-cell">
                            
                            <div class="container-slide container">
                                
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2 text-xs-center">
                                        
                                        

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="mbr-section mbr-section-hero carousel-item dark center mbr-section-full" data-bg-video-slide="false" style="background-image: url(assets/images/Banner2.png); background-size: cover; background-position: center;">
                        <div class="mbr-table-cell">
                            
                            <div class="container-slide container">
                                
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-1">
                                        
                                        

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="mbr-section mbr-section-hero carousel-item dark center mbr-section-full" data-bg-video-slide="false" style="background-image: url(assets/images/Banner3.png); background-size: cover; background-position: center;">
                        <div class="mbr-table-cell">
                            
                            <div class="container-slide container">
                                
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-3 text-xs-right">
                                        
                                        

                                        
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

</section>

<section class="mbr-section mbr-section__container article" id="header3-2" style="background-color: rgb(255, 255, 255); padding-bottom: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="mbr-section-title display-2" style="padding: 40px 40px; font-size:40px;">Multi Recharge Business</h3>
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

        <div class="mbr-cards-col col-xs-12 col-lg-6" style="padding-top: 80px; padding-bottom: 80px; background-color:#5B5EA6">
            <div class="container">
                <div class="card cart-block">
                    <div class="card-img"><img src="assets/images/1.svg" class="card-img-top"></div>
                    <div class="card-block">
                        <h4 class="card-title">Mobile Recharge</h4>
                        <h5 class="card-subtitle" style="color:#f7f414;">All Prepaid Mobile Recharge</h5>
                        <p class="card-text">Distributors and Retailers can recharge any operators &nbsp;like Airtel , Vodafone, Reliance Jio, Idea,  BSNL etc..</p>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="mbr-cards-col col-xs-12 col-lg-6" style="padding-top: 80px; padding-bottom: 80px;">
            <div class="container">
                <div class="card cart-block">
                    <div class="card-img"><img src="assets/images/2.svg" class="card-img-top"></div>
                    <div class="card-block">
                        <h4 class="card-title">DTH Recharge</h4>
                        <h5 class="card-subtitle">All DTH Recharge</h5>
                        <p class="card-text"><?php 
                        if($name[0] == 'www'){
                          
                          echo ucfirst($name[1]);  
                        }
                        else echo ucfirst($name[0]); ?> provide recharge for all DTH services like Airtel Digital Tv, Dish Tv, Big Tv Dish TV, Tata Sky, Sun Direct, Tata Sky etc..</p>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="mbr-cards-col col-xs-12 col-lg-6" style="padding-top: 80px; padding-bottom: 80px;  background-color:#5B5EA6">
            <div class="container">
                <div class="card cart-block">
                    <div class="card-img"><img src="assets/images/3.svg" class="card-img-top"></div>
                    <div class="card-block">
                        <h4 class="card-title">Data Card Recharge</h4>
                        <h5 class="card-subtitle" style="color:#f7f414;">All Data card recharge</h5>
                        <p class="card-text"><?php 
                        if($name[0] == 'www'){
                          
                          echo ucfirst($name[1]);  
                        }
                        else echo ucfirst($name[0]); ?> Provide Data Card Payments which saves time and money, Supports all network</p>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="mbr-cards-col col-xs-12 col-lg-6" style="padding-top: 80px; padding-bottom: 80px;>
            <div class="container">
                <div class="card cart-block">
                    <div class="card-img"><img src="assets/images/4.svg" class="card-img-top"></div>
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

<section  id="testimonials4-5" style="background-image: url(assets/images/rc16555-2000x1500.jpg); padding-top: 40px; padding-bottom: 40px; background-color:#CCE3FF">

        <div class="mbr-section mbr-section__container mbr-section__container--middle">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-xs-center" >
                        <h3 class="mbr-section-title display-2" style="color:black; font-size:40px">Our Services</h3>
                        
                    </div>
                </div>
            </div>
        </div>


    <div class="mbr-section mbr-section-nopadding">
        <div class="container">
            <div class="row">

                <div class="col-xs-12">

                    <div class="mbr-testimonial card" >
                        <div class="card-block" ><p><?php 
                        if($name[0] == 'www'){
                          
                          echo ucfirst($name[1]);  
                        }
                        else echo ucfirst($name[0]); ?> focus on Delivering Reliable Value Added Services to Customers in an easiest possible manner which will simplify their utility transactions and requirements. Mobile recharge is an essential service that enables mobile phone users to top up their prepaid or postpaid plans. Prepaid and postpaid mobile recharge are two different types of plans available for mobile phone users.</p></div>
                        <div class="mbr-author card-footer">
                            
                            <div class="mbr-author-name" style="color:#0f66d1">Prepaid & PostPaid Mobile Recharge</div>
                            
                        </div>
                    </div><div class="mbr-testimonial card">
                        <div class="card-block"><p><?php 
                        if($name[0] == 'www'){
                          
                          echo ucfirst($name[1]);  
                        }
                        else echo ucfirst($name[0]); ?> provide easy recharging facility for all prepaid mobile networks available in India with the help of our Instant recharge solutions. Apart from mobile recharge, DTH (Direct-To-Home) and Data Card recharge services are also popular in the telecommunication industry. These services enable users to recharge their DTH or Data Card plans conveniently and quickly.</p></div>
                        <div class="mbr-author card-footer">
                            
                            <div class="mbr-author-name" style="color:#0f66d1">DTH & Data Card Recharge Service</div>
                            
                        </div>
                    </div><div class="mbr-testimonial card">
                        <div class="card-block"><p><?php 
                        if($name[0] == 'www'){
                          
                          echo ucfirst($name[1]);  
                        }
                        else echo ucfirst($name[0]); ?> Provide FASTag and Bill Pay services that have become increasingly popular in India in recent years. These services offer users a convenient and secure way to make payments for tolls and bills, respectively.</p>
                        </div>
                        <div class="mbr-author card-footer">
                            
                            <div class="mbr-author-name" style="color:#0f66d1">FASTag & Bill Pay</div>
                            
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>

<section class="mbr-section article" id="msg-box3-6" style="background-color: rgb(242, 242, 242); padding-top: 40px; padding-bottom: 40px;">

    
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-xs-center">
                <h3 class="mbr-section-title display-2" style="font-size:40px;">Business Opportunity</h3>
                <div class="lead" style="font-family:verdana;"><p>&nbsp;</p><p><?php 
                        if($name[0] == 'www'){
                          
                          echo ucfirst($name[1]);  
                        }
                        else echo ucfirst($name[0]); ?>  Offering a Flexible Business Model and Multiple Business Options.The mobile recharge industry in India has witnessed tremendous growth in recent years, and this trend is expected to continue in the coming years. As a result, there are several business opportunities available in the mobile recharge industry that can be leveraged by entrepreneurs and investors.</p><hr><p><b>RETAILER</b></p><p><span style="font-size: 1.07rem; line-height: 1.5;">If you are looking for a lucrative business opportunity in the mobile recharge industry, becoming a retailer could be a smart choice. As a mobile recharge retailer, you can earn a steady income by offering recharge services to customers in your locality. To become a mobile recharge retailer, you need to sign up with a service provider that offers recharge services. These service providers offer various commission rates to retailers, depending on the volume of transactions. Once you sign up, you can start selling recharge vouchers to customers who visit your shop.</span></p><hr><p><b>DISTRIBUTOR</b></p><p>Role of a Distributor is to create Point Of Sale Units (Retail Outlets) and generate revenue through them. To become a mobile recharge distributor, you need to sign up with a service provider that offers recharge services. These service providers typically offer higher commission rates to distributors compared to retailers. Once you sign up, you can start recruiting retailers to sell recharge under your brand. &nbsp;&nbsp;</p><hr><p><b>MASTER DISTRIBUTOR</b></p><p>Master Distributors are Our Business partners in a Particular State or Territory who takes care of Appointing Distributors and Managing Distributor Network. You get best turnover margin on Recharge Volumes.</p></div>
                
            </div>
        </div>
    </div>

</section>

<section class="mbr-section" id="form1-8" style="background-color: #CCE3FF; padding-top: 40px; padding-bottom: 40px;">
    
    <div class="mbr-section mbr-section__container mbr-section__container--middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-xs-center">
                    <h3 class="mbr-section-title display-2" style="font-size:40px;">CONTACT US</h3>
                    
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

                           <button type="submit" class="btn btn-danger">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
<section class="mbr-section mbr-section-md-padding mbr-footer footer1" id="contacts1-4" style="background-color: #0072B5; padding-top: 90px; padding-bottom: 90px;">
    <div class="container">
        <div class="row">
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><font color="#7c7c7c" face="Montserrat, sans-serif" size="3"><span style="letter-spacing: -1px; line-height: 20px;"><strong style="color:#f7f414;">Business opportunity</strong></span></font><br><br>Wanted distributors and retailers all over India. Hi-speed recharge system with high margin, please contact us to start this business</p>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><strong style="color:#f7f414">Features</strong><br>1-All Mobile/DTH Operators available<br>2-Instant recharge<br>3-Recharge by SMS or web<br>4-One Account for all recharge services<br>5-Profitable Margin</p>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><strong style="color:#f7f414">Multi Services</strong><br>1-Recharge any Mobile Phone<br>2-Top-Up All DTH Services<br>3-Data Card Recharge<br>4-Postpaid bill payment<br>5-Single Wallet multi recharge</p>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><strong style="color:#f7f414">Our Policy</strong><br>
                    <a href="https://rechargetoearn.com/policy/termsandconditions.php" style="color: white; text-decoration: underline;" target="_blank">Terms & Conditions</a><br>
                    <a href="https://rechargetoearn.com/policy/privacypolicy.php" style="color: white; text-decoration: underline;" target="_blank">Privacy Policy</a><br>
                    <a href="https://rechargetoearn.com/policy/refundpolicy.php" style="color: white; text-decoration: underline;" target="_blank">Refund Policy</a>
                </p>
            </div>
        </div>
    </div>
</section>


<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-9" style="background-color: #ffcf48; color:white; padding-top: 1.75rem; padding-bottom: 1.75rem;">
    
    <div class="container" >
        <p class="text-xs-center" style="color:blue">Copyright &copy; <?php echo date("Y"); ?>.  <b style="color:#cc1efc"><?php echo $domain;?></b>. All rights reserved</p>
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
</html>