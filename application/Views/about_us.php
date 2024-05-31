<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url()."css_tmplt/reset.css"?>" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url()."css_tmplt/style.css"?>" type="text/css" media="screen">
  	<link rel="stylesheet" href="<?php echo base_url()."css_tmplt/grid.css"?>" type="text/css" media="screen">   
    <script src="<?php echo base_url()."js_tmplt/jquery-1.6.3.min.js"?>" type="text/javascript"></script>
    <script src="<?php echo base_url()."js_tmplt/cufon-yui.js"?>" type="text/javascript"></script>
    <script src="<?php echo base_url()."js_tmplt/cufon-replace.js"?>" type="text/javascript"></script>
    <script src="<?php echo base_url()."js_tmplt/NewsGoth_400.font.js"?>" type="text/javascript"></script>
	<script src="<?php echo base_url()."js_tmplt/NewsGoth_700.font.js"?>" type="text/javascript"></script>
    <script src="<?php echo base_url()."js_tmplt/NewsGoth_Lt_BT_italic_400.font.js"?>" type="text/javascript"></script>
    <script src="<?php echo base_url()."js_tmplt/Vegur_400.font.js"?>" type="text/javascript"></script> 
    <script src="<?php echo base_url()."js_tmplt/FF-cash.js"?>" type="text/javascript"></script>
    <script src="<?php echo base_url()."js_tmplt/jquery.featureCarousel.js"?>" type="text/javascript"></script>  
	<!--[if lt IE 7]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
        	<img src="http://storage.ie6countdown.com/assets/100/images_tmplt/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
    </div>
	<![endif]-->
    <!--[if lt IE 9]>
   		<script type="text/javascript" src="js/html5.js"></script>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
	<![endif]-->
</head>
<body id="page2">
	<div class="extra">
    	<!--==============================header=================================-->
        <header>
        	<div class="row-top">
            	<div class="main">
                	<div class="wrapper">
                    <a href="index.html"><img src="<?php echo base_url()."images/logo.png"; ?>"</a>
                        <form id="search-form" method="post" enctype="multipart/form-data">
                        <fieldset>	
                            <div class="search-field">
                                <input name="search" type="text" value="Search..." onBlur="if(this.value=='') this.value='Search...'" onFocus="if(this.value =='Search...' ) this.value=''" />
                                <a class="search-button" href="#" onClick="document.getElementById('search-form').submit()"></a>	
                            </div>						
                        </fieldset>
                    </form>
                    </div>
                </div>
            </div>
            <div class="menu-row">
            	<div class="menu-bg">
                    <div class="main">
                        <nav class="indent-left">
                            <ul class="menu wrapper">
                                <li class="active"><a href="<?php echo base_url();?>">Home page</a></li>
                                <li><a href="<?php echo base_url();?>about_us">our Company</a></li>
                                <li><a href="#">our services</a></li>
                                <li><a href="#">our projects</a></li>
                                <li><a href="<?php echo base_url();?>contact_us">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row-bot">
            	<div class="center-shadow">
                </div>
            </div>
        </header>
        
        <!--==============================content================================-->
        <section id="content"><div class="ic"></div>
            <div class="content-bg">
                <div class="main">
                    <div class="container_12">
                        <div class="wrapper">
                            <article class="grid_4">
                                <h3>Management Team</h3>
                                <div class="wrapper indent-bot2">
                                    <figure class="img-indent"><a href="#"><img class="img-border" src="<?php echo base_url()."images_tmplt/page2-img1.jpg"?>" alt="" /></a></figure>
                                    <div class="extra-wrap">
                                        <span class="text-2">Director</span>
                                        <h4 class="p1">Mary Ryan</h4>
                                        Ut vero eos et accusamus et iusto odio dignissimos ducimus.
                                    </div>
                                </div>
                                <div class="wrapper indent-bot2">
                                    <figure class="img-indent"><a href="#"><img class="img-border" src="<?php echo base_url()."images_tmplt/page2-img2.jpg"?>" alt="" /></a></figure>
                                    <div class="extra-wrap">
                                        <span class="text-2">Senior Assistant</span>
                                        <h4 class="p1">Thomas dylan</h4>
                                        Ut vero eos et accusamus et iusto odio dignissimos ducimus.
                                    </div>
                                </div>
                                <div class="wrapper indent-bot2">
                                    <figure class="img-indent"><a href="#"><img class="img-border" src="<?php echo base_url()."images_tmplt/page2-img3.jpg"?>" alt="" /></a></figure>
                                    <div class="extra-wrap">
                                        <span class="text-2">Junior Researcher</span>
                                        <h4 class="p1">Markus Smith</h4>
                                        Ut vero eos et accusamus et iusto odio dignissimos ducimus.
                                    </div>
                                </div>
                                <div class="wrapper">
                                    <figure class="img-indent"><a href="#"><img class="img-border" src="<?php echo base_url()."images_tmplt/page2-img4.jpg"?>" alt="" /></a></figure>
                                    <div class="extra-wrap">
                                        <span class="text-2">Analyst</span>
                                        <h4 class="p1">Helen Doe</h4>
                                        Ut vero eos et accusamus et iusto odio dignissimos ducimus.
                                    </div>
                                </div>
                            </article>
                            <article class="grid_8">
                            	<div class="indent-left2">
                                	<h3>We’ll give your business chance to grow!</h3>
                                </div>
                                <div class="wrapper indent-bot">
                                	<article class="grid_4 alpha">
                                    	<div class="indent-left2">
                                            <figure class="p2"><img class="img-border" src="<?php echo base_url()."images_tmplt/page2-img5.jpg"?>" alt="" /></figure>
                                            <h4 class="p1">Lorem ipsum dolor</h4>
                                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesen tium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.
                                        </div>
                                    </article>
                                    <article class="grid_4 omega">
                                    	<div class="indent-left2">
                                            <figure class="p2"><img class="img-border" src="<?php echo base_url()."images_tmplt/page2-img6.jpg"?>" alt="" /></figure>
                                            <h4 class="p1">sit amet consectetur</h4>
                                            Similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi.
                                        </div>
                                    </article>
                                </div>
                                <div class="indent-left2">
                                	<h3>Experience and Professionals</h3>
                                    <p>Vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                                </div>
                                <div class="wrapper">
                                	<article class="grid_4 alpha">
                                    	<div class="indent-left2">
                                        	<ul class="list-1">
                                            	<li><a href="#">At vero eos et accusamus et iusto</a></li>
                                                <li><a href="#">Dignissimos ducimus qui blanditiis prae</a></li>
                                            </ul>
                                        </div>
                                    </article>
                                    <article class="grid_4 omega">
                                    	<div class="indent-left2">
                                        	<ul class="list-1">
                                            	<li><a href="#">At vero eos et accusamus et iusto</a></li>
                                                <li><a href="#">Dignissimos ducimus qui blanditiis prae</a></li>
                                            </ul>
                                        </div>
                                    </article>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
                <div class="block"></div>
            </div>
        </section>
    </div>
	
	<!--==============================footer=================================-->
    <footer>
        <div class="padding">
            <div class="main">
                <div class="container_12">
                    <div class="wrapper">
                        <article class="grid_8">
                            <h4>Contact Form:</h4>
                            <form id="contact-form" method="post">
                                <fieldset>
                                    <label><input name="email" value="Email" onBlur="if(this.value=='') this.value='Email'" onFocus="if(this.value =='Email' ) this.value=''" /></label>
                                    <label><input name="subject" value="Subject" onBlur="if(this.value=='') this.value='Subject'" onFocus="if(this.value =='Subject' ) this.value=''" /></label>
                                    <textarea onBlur="if(this.value=='') this.value='Message'" onFocus="if(this.value =='Message' ) this.value=''">Message</textarea>
                                    <div class="buttons">
                                        <a href="#" onClick="document.getElementById('contact-form').reset()">Clear</a>
                                        <a href="#" onClick="document.getElementById('contact-form').submit()">Send</a>
                                    </div>											
                                </fieldset>           
                            </form>
                        </article>
                        <article class="grid_4">
                        	<h4 class="indent-bot">Link to Us:</h4>
                            <ul class="list-services border-bot img-indent-bot">
                            	<li><a href="#">Facebook</a></li>
                                <li><a class="item-1" href="#">Twitter</a></li>
                                <li><a class="item-2" href="#">Picassa</a></li>
                                <li><a class="item-3" href="#">You Tube</a></li>
                            </ul>
                            <p class="p1">rechargeportal.com &copy; 2013 </p>
                          
                            
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </footer>
	<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
