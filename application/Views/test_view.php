<html><head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        <title> rechargeportal</title>
        <?php include("script1.php"); ?>
        <?php include("airscript.php") ?>
        <script src="<?php echo base_url()."aircss/progress_bar.js"?>" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()."aircss/colorbox.css"?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()."aircss/dropdown.css"?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()."aircss/jquery.css"?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()."aircss/stylesheet_002.css"?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()."aircss/stylesheet.css"?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()."aircss/stylesheet_003.css"?>">
        <script type="text/javascript" src="<?php echo base_url()."aircss/tooltip.js"?>"></script>
<script type="text/javascript">
            function tooltip(){
                $(".tooltip-target").ezpz_tooltip({
                    contentPosition: 'belowRightFollow',
                    showContent: function(content) {
                        content.fadeIn('slow');
                    },
                    hideContent: function(content) {
                        // if the showing animation is still running, be sure to stop it
                        // and clear the animation queue. otherwise, repeatedly hovering will
                        // cause the content to blink.
                        content.stop(true, true).fadeOut('slow');
                    }
                });
               $(".example3").colorbox({width:"40%", height:"320px", iframe:true });
            }
			 $(document).ready(function(){
				 callARZOO();
				 callTBO();
				
				 });
				  var arzflag = false;
				 var tboflag = false;
			function callTBO()
			{
				
				
				 $.ajax({
				   	url:'<?php echo base_url(); ?>air_domestic_search/getTBOFlights',
					type:'post',
					cache:'false',
					success:function(msg){
							tboflag = true;
							
							if(arzflag == true)
							{
											getdata();
									
							}
						
						},
						 statusCode: {
500: function() {
	tboflag = true;
alert("page not found");
if(arzflag == true)
							{
											getdata();
									
							}
							}
						 }
				 
					
				   });
			
			}
			function callARZOO()
			{
				
				
				 $.ajax({
				   	url:'<?php echo base_url(); ?>air_domestic_search/getArzooFlights',
					type:'post',
					cache:'false',
					success:function(msg){
				arzflag = true;
				if(tboflag == true)
				{
								getdata();
						
				}
						
						},
						 statusCode: {
500: function() {
	arzflag = true;
alert("page not found");
if(tboflag == true)
				{
								getdata();
						
				}
}
						 }
				   });
			
		
			
			}
				 
			function getdata()
			{	 
			
$.ajax({
				   	url:'<?php echo base_url(); ?>air_domestic_search/getSearchData',
					type:'post',
					cache:'false',
					success:function(msg){
						$('#data').html(msg);
						$('#wt_Wrapper').hide();
						$('#divflights').show();
						tooltip();
						}
					
				   });
			
			}
	function booknow(fare_id,api_name)
	{
		alert(fare_id+" "+api_name);
		document.getElementById("hidFare_id").value = fare_id;
		document.getElementById("hidapi_name").value = api_name;
		document.getElementById("hidtobooking").value = "Set";
		document.getElementById("Tofrmbooking").submit();
		
	}
        </script>
        <style type="text/css">
		.flightcontainer:hover {
		background: #f8f8f8;
	}
	.flightcontainer1 {
		background: #f8f8f8;
	}
	.flightcontainer2 {
		background: #FFF;
	}
		#example1 {
-moz-box-shadow: 10px 10px 5px #888;
-webkit-box-shadow: 10px 10px 5px #888;
box-shadow: 10px 10px 5px #888;
}
			body{background-color:#fff; font:normal 12px Arial, Helvetica, sans-serif;}
			#wt_Wrapper {margin:0 auto; width: 100%;}
			#MainCont{position:relative; height: 100%;margin: 0 auto;width: 725px !important;}
			.logo{text-align:center;width:705px;} 
			.cont{ text-align:center;width:705px;float:left; z-index:10;^width:600px; position:absolute; left:8px;box-shadow: 8px 0px 4px -6px #717171,-8px 0px 4px -6px #b6b6b6; border-left:#b6b6b6 2px solid\9;border-right:#b6b6b6 2px solid\9; //border-right:#b6b6b6 1px solid://border-left:#b6b6b6 1px solid}
			.skyblue{color:#00939d;}
			.prel{position:relative;}
			.oneWayFltIcon{background: url("../../resources/images/int/ico-RightFlt.gif") no-repeat scroll 0 4px transparent;padding:0 7px; position:absolute; top:0px;}
			.oneWayRetFltIcon{background: url("../../resources/images/int/ico-LeftFlt.gif") no-repeat scroll 0 4px transparent;padding:0 10px; position:absolute; top:0px; left:35px;}
			.rndWayFltIcon{background: url("../resources/images/ico-RightFlt.gif") no-repeat scroll 0 4px transparent;padding:0 10px; position:absolute; top:0px; left:35px;}
			.cont .stxt{ padding: 10px 85px 30px;color:#0097c4; font-size:18px;width:auto;}
			.cont .stxt h1{padding:0;font-size:18px; width:530px;} 
			.cont .tab{margin:40px 0 20px;_margin-left:30px}
			.cont .tab .txt{margin:auto;padding:0 34px;color:#707070;float:left;font-size:18px;text-align:left}
			.rbdr{border:#707070 1px; border-right-style:dotted;}
			.cont .banner{width:620px;padding:25px 44px;}
			.cont .banner .first{margin-right:20px;float:left;}
			.cont .banner .sec{float:left;}
			.f32{font-size:30px;}
			.clr{clear:both;}
			.flL{float:left;}
			.wfull{width:100%;float:left}
			.progressBar {height: 10px; margin: 0 auto;width: 700px;}
			.cont .tab .oneway {color: #707070;margin:0 auto;padding:0 0 5px;font-size:18px;text-align:left;_margin-left:30px;width:225px}
			.round-trip-detail{padding-left:65px;float:left}
			.ml70{margin-left:70px !important;}
		</style>
    <style type="text/css" charset="utf-8">/* See license.txt for terms of usage */

/** reset styling **/

.firebugResetStyles {

    z-index: 2147483646 !important;

    top: 0 !important;

    left: 0 !important;

    display: block !important;

    border: 0 none !important;

    margin: 0 !important;

    padding: 0 !important;

    outline: 0 !important;

    min-width: 0 !important;

    max-width: none !important;

    min-height: 0 !important;

    max-height: none !important;

    position: fixed !important;

    transform: rotate(0deg) !important;

    transform-origin: 50% 50% !important;

    border-radius: 0 !important;

    box-shadow: none !important;

    background: transparent none !important;

    pointer-events: none !important;

    white-space: normal !important;

}



.firebugBlockBackgroundColor {

    background-color: transparent !important;

}



.firebugResetStyles:before, .firebugResetStyles:after {

    content: "" !important;

}

/**actual styling to be modified by firebug theme**/

.firebugCanvas {

    display: none !important;

}



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

.firebugLayoutBox {

    width: auto !important;

    position: static !important;

}



.firebugLayoutBoxOffset {

    opacity: 0.8 !important;

    position: fixed !important;

}



.firebugLayoutLine {

    opacity: 0.4 !important;

    background-color: #000000 !important;

}



.firebugLayoutLineLeft, .firebugLayoutLineRight {

    width: 1px !important;

    height: 100% !important;

}



.firebugLayoutLineTop, .firebugLayoutLineBottom {

    width: 100% !important;

    height: 1px !important;

}



.firebugLayoutLineTop {

    margin-top: -1px !important;

    border-top: 1px solid #999999 !important;

}



.firebugLayoutLineRight {

    border-right: 1px solid #999999 !important;

}



.firebugLayoutLineBottom {

    border-bottom: 1px solid #999999 !important;

}



.firebugLayoutLineLeft {

    margin-left: -1px !important;

    border-left: 1px solid #999999 !important;

}



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

.firebugLayoutBoxParent {

    border-top: 0 none !important;

    border-right: 1px dashed #E00 !important;

    border-bottom: 1px dashed #E00 !important;

    border-left: 0 none !important;

    position: fixed !important;

    width: auto !important;

}



.firebugRuler{

    position: absolute !important;

}



.firebugRulerH {

    top: -15px !important;

    left: 0 !important;

    width: 100% !important;

    height: 14px !important;

   

    border-top: 1px solid #BBBBBB !important;

    border-right: 1px dashed #BBBBBB !important;

    border-bottom: 1px solid #000000 !important;

}

.IntResultBox .IntResultView .TotalPrice ul li span {
}
* {
    margin: 0;
    padding: 0;
}
.IntResultBox .IntResultView .TotalPrice .price {
    font-size: 24px;
}
ol, ul {
    list-style: none outside none;
}
.IntResultBox .IntResultView .TotalPrice {
    color: #FF7B02;
    font-weight: bold;
    text-align: right;
}
.IntResultBox .IntResultView .ResultContainer .cont {
    cursor: default;
}
element.style {
    cursor: pointer;
}
.IntResultBox .IntResultView {
    font-size: 90%;
    text-align: left;
}



.firebugRulerV {

   

}

.div1 hover
{
	background:#CCCCCC;
}

.overflowRulerX > .firebugRulerV {

   

}



.overflowRulerY > .firebugRulerH {

   

}



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

.fbProxyElement {

    position: fixed !important;

    pointer-events: auto !important;

}

</style></head>
<body >
<div id="wt_Wrapper">
			<div id="MainCont">
				<div class="wtbgl">&nbsp;</div>
			
				<div class="cont" id="example1"  style="border:1px dotted blue;padding:5px;">
					<div class="logo" style="padding-left:20px;">
						<img src="<?php echo base_url()."images/logo.png"?>" width="200px" alt="rechargeportal.com" title="rechargeportal.com">
					</div>
					<div class="stxt"><h1 style="color:#0099CC;">We are searching the best flight combinations for you.<br>This will take only a few seconds.</h1><!-- CMS:dom_waitpage_top_msg --></div>
					<div class="progressBar">
						<center>
						<script type="text/javascript">
							var bar1= createBar(450,12,'white',1,'#8BC2EB','#1F65A1',85,10,3,"");
						</script>
						</center>
					</div>
					<div class="clr"></div>
					<span class="tab wfull">
						
						
							
								
								
									<div class="oneway prel" style="width:50%;text-align:center">
										<span class="oneWayFltIcon">&nbsp;</span>							
										&nbsp;&nbsp;&nbsp; <?php echo $this->session->userdata("sourcecity"); ?> - <?php echo $this->session->userdata("destinationcity"); ?> <br>
										
											<!--<script type="text/javascript">
												var myDt = "14/05/2013";
												nDt = myDt.split("/");
												myDt = new Date(nDt[2], nDt[1] - 1, nDt[0]);
												document.write(myDt.format("E dd NNN,yy"));
											</script>Tue 14 May,13-->
										
									</div>
									<div class="clr">&nbsp;</div>
								
							
						
					</span>
					<div class="banner flL"></div>
					<div style="clear:both;font-size:10px;color:#333; text-align:center"></div>					
				</div>
				
			</div>
		
		</div>
        <form id="Tofrmbooking" name="Tofrmbooking" action="<?php echo base_url()."air_domestic_search/booknow"?>" method="post">
        <input type="hidden" id="hidapi_name" name="hidapi_name">
         <input type="hidden" id="hidFare_id" name="hidFare_id">
          <input type="hidden" id="hidtobooking" name="hidtobooking">
      
        </form>
<div style="display:none" id="divflights">
 <div id="header">
 <?php require_once("general_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("agent_menu.php"); ?> 
  </div>
 
  <div style="margin-left:50px;" id="round-container-left">
                                    <div id="round-contr-in">
                                        <div>
                                            <div>
                                                <div>
                                                    <div  class="city-ti-txt-big"><?php echo $this->session->userdata("Origin"); ?> to <?php echo $this->session->userdata("Destination"); ?><div class="date-ti-txt"><?php echo $this->session->userdata("DepartDate"); ?></div></div>
<div id="data">
</div>
</div>
                                            </div>
                                        </div>
                                        <!--singl-rout-trip-box-1-close-->
                                    </div>
                                </div>
  
								<?php include("general_footer.php"); ?>
                                </div>
</body>
</html>