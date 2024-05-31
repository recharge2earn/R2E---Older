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
        	<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
    </div>
	<![endif]-->
    <!--[if lt IE 9]>
   		<script type="text/javascript" src="js/html5.js"></script>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
	<![endif]-->
    <script language="javascript">
	function test()
	{
		var address = "Maninagar,Ahmedabad ,Gujarat, India";

var geocoder = new google.maps.Geocoder();
geocoder.geocode({ 'address': address }, function (results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
        var mapOptions = { zoom: 8, mapTypeId: google.maps.MapTypeId.ROADMAP };
        var map = new google.maps.Map(document.getElementById('addressMap'), mapOptions);
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
    } else {
        alert("Geocode was not successful for the following reason: " + status);
    }
});
	}
	</script>
</head>
<body id="page5" onLoad="test()">
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
                        	<article class="grid_8">
                            	<h3>Contact Form</h3>
                                <form id="contact-form2" method="post" enctype="multipart/form-data">                    
                                    <fieldset>
                                          <label><span class="text-form">Name:</span><input name="p1" type="text" /></label>
                                          <label><span class="text-form">Email:</span><input name="p2" type="text" /></label>                              
                                          <div class="wrapper">
                                            <div class="text-form">Message:</div>
                                            <div class="extra-wrap">
                                                <textarea></textarea>
                                                <div class="clear"></div>
                                                <div class="buttons2">
                                                    <a href="#" onClick="document.getElementById('contact-form2').reset()">Clear</a>
                                                    <a href="#" onClick="document.getElementById('contact-form2').submit()">Send</a>
                                                </div> 
                                            </div>
                                          </div>                            
                                    </fieldset>						
                                </form>
                            </article>    
                            <article class="grid_4">
                            	<h3>Contact Info</h3>
                                <figure class="img-indent-bot img-border">
                                     <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=D-+721%2FA,+B.+G.+Tower,+Opp.+Delhi+Darwaja,+Sahibaug,+Ahmedabad+-+380+004+Gujarat,+India.&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=36.589577,86.572266&amp;ie=UTF8&amp;hq=D-+721%2FA,+B.+G.+Tower,+Opp.+Delhi+Darwaja,+Sahibaug,+Ahmedabad+-+380+004+Gujarat,+India.&amp;t=m&amp;ll=23.037768,72.587973&amp;spn=0.020536,0.032015&amp;output=embed"></iframe>
                                </figure>
                                <dl>
                                    <dt class="indent-bot">India<br>D- 721/A, B. G. Tower,Opp. Delhi Darwaja, Sahibaug,
Ahmedabad - 380 004 ,Gujarat, India.</dt>
                                    <dd><span>Telephone:</span>  + 91 79 6545 - 6525</dd>
                                    <dd><span>Email:</span><a href="#"> info@mipasolutions.com, contact@mipasolutions.com</a></dd>
                                </dl>
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
