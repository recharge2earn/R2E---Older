<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><title>
	Air Domestic
</title>
<?php include("script1.php"); ?>

        <?php include("airscript.php") ?>
    <script src="<?php echo base_url()."jewria_files/ga.js"?>" async="" type="text/javascript"></script>
	<script src="<?php echo base_url()."jewria_files/jquery-1.js"?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url()."jewria_files/thickbox.js"?>"></script>
    <script type="text/javascript" src="<?php echo base_url()."jewria_files/JewriaFront.js"?>"></script>
      <script src="<?php echo base_url()."aircss/progress_bar.js"?>" type="text/javascript"></script>
    <script src="<?php echo base_url()."jewria_files/imodal.js"?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url()."jewria_files/thickbox.js"?>"></script>
    <script src="<?php echo base_url()."jewria_files/jquery-1.js"?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url()."jewria_files/Common.js"?>"></script>
    <script type="text/javascript" src="<?php echo base_url()."jewria_files/SearchFlight.js"?>"></script>
    <script src="<?php echo base_url()."jewria_files/jquery_006.js"?>" type="text/javascript"></script>
    
    <script language="javascript">
	function booknow()
	{
		var index = document.getElementById("flagvalue").value;
		var fare_id = document.getElementById("flagfare_id"+index).value;
		var api_name = document.getElementById("flagapi_name"+index).value;
		alert(fare_id+"   "+api_name);
		
			document.getElementById("hidFare_id").value = fare_id;
		document.getElementById("hidapi_name").value = api_name;
		document.getElementById("hidtobooking").value = "Set";
		document.getElementById("Tofrmbooking").submit();
	}
	function test(i)
	{
		
		 $.ajax({
				   	url:'<?php echo base_url(); ?>air_domestic_search/getChipestFlight?id='+i,
					type:'post',
					cache:'false',
					success:function(msg){
						var oldindex = document.getElementById("flagvalue").value;
						$('#rw'+oldindex).removeClass("selectRow");
				$('#rw'+i).addClass("selectRow");
				document.getElementById("flagvalue").value = i;
				$('#selectedflight').html(msg);
				 FloatDiv("divTopLeft", 1175, 339).floatIt();
    FloatDiv("viewDetails", 300, 200).floatIt();
						
						}
				   });
	}
	function selectedflight()
	{
		 $.ajax({
				   	url:'<?php echo base_url(); ?>air_domestic_search/getChipestFlight',
					type:'post',
					cache:'false',
					success:function(msg){
				
				
				$('#selectedflight').html(msg);
				 FloatDiv("divTopLeft", 1175, 339).floatIt();
    FloatDiv("viewDetails", 300, 200).floatIt();
						
						}
				   });
	}
	function getSearchData()
			{
				selectedflight();
				
				 $.ajax({
				   	url:'<?php echo base_url(); ?>air_domestic_search/getSearchData',
					type:'post',
					cache:'false',
					success:function(msg){
				
				
				$('#flights').html(msg);
				$('#contents').show();
				$('#example1').hide();
				 FloatDiv("divTopLeft", 1175, 339).floatIt();
    			FloatDiv("viewDetails", 300, 200).floatIt();
						
						}
				   });
			
		
			
			}
			 $(document).ready(function(){
				// callARZOO();
				 callTBO();
				
				 });
				  var arzflag = true;
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
											getSearchData();
									
							}
						
						},
						 statusCode: {
500: function() {
	tboflag = true;
alert("page not found");
if(arzflag == true)
							{
											getSearchData();
									
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

</style>
   
    <link rel="stylesheet" href="<?php echo base_url()."jewria_files/thickbox.css"?>" type="text/css">
    <style type="text/css">
        .universal .sector
        {
            display: inline;
            float: left;
            width: 50%;
        }
        .selectRow
        {
            background-color: #ff9935;
        }
        /* Rule 24 of /styles/flights.v65856.css */
        
        .universal .sector TABLE
        {
            border-top: border-top:1px solid #CCCCCC; /*#e8ecf5 1px solid;*/
        }
        
        .col
        {
            padding-right: 20px;
            padding-left: 20px;
            padding-bottom: 0px;
            padding-top: 0px;
            text-align: left;
        }
        
        /* Rule 36 of /styles/flights.v65856.css */
        
        .universal .sector .searchflight TD
        {
            /*PADDING-RIGHT: 0px;

	BORDER-BOTTOM: #e5e5e5 1px solid;

	PADDING-LEFT: 5px;

	FONT-SIZE: 12px;

	PADDING-BOTTOM: 18px;

	VERTICAL-ALIGN: baseline;

	PADDING-TOP: 0px;

	BACKGROUND-COLOR: #fff*/
            padding: 2px;
            color: #333333;
        }
        .universal .sector .searchflight TD.border
        {
            border-top: 1px solid #c0d8a9;
        }
        .universal .sector TABLE TD.noborder
        {
            border-top: #fff 1px solid;
        }
        
        /* Rule 114 of /styles/flights.v65856.css */
        
        .universal .sector TABLE TD.strike
        {
            color: #aaa;
            text-decoration: line-through;
        }
        
        *
        {
            margin: auto;
            padding: auto;
        }
        .netFare
        {
            color: red;
            text-decoration: line-through;
            font-size: 14px;
        }
        
        #TB_iframeContent
        {
            color: red;
        }
    </style>

    <style type="text/css">
        .body .GridPager_USERAIRGRID
        {
            background: #eaf2e2;
            line-height: 20px;
        }
        
        #previewFooterImg
        {
            position: absolute;
            border: 1px solid #ccc;
            background: #333;
            padding: 1px;
            display: none;
            color: #fff;
        }
    </style>
    <link rel="stylesheet" href="<?php echo base_url()."jewria_files/thickbox.css"?>" type="text/css">
    <link href="<?php echo base_url()."jewria_files/style.css"?>" type="text/css" rel="stylesheet">
    </head>
<body class="body">
<div id="wt_Wrapper">
			<div id="MainCont">
				<div class="wtbgl">&nbsp;</div>
<div class="cont" id="example1"  style="border:1px dotted blue;padding:5px;">
					<div class="logo" style="padding-left:20px;">
						<img src="<?php echo base_url()."images/logo.png"?>" width="200px" alt="rechargeportal.com" title="rechargeportal.com">
					</div><br /><br /><br /><br />
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
										&nbsp;&nbsp;&nbsp;  AHMEDABAD -MUMBAI <br>
										
											
										
									</div>
									<div class="clr">&nbsp;</div>
								
							
						
					</span>
					<div class="banner flL"></div>
					<div style="clear:both;font-size:10px;color:#333; text-align:center"></div>					
				</div>
                </div>
                </div>
	<div id="contents" style="display:none;">
   <div id="header">
 <?php require_once("general_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("agent_menu.php"); ?> 
  </div>
  <form id="Tofrmbooking" name="Tofrmbooking" action="<?php echo base_url()."air_domestic_search/booknow"?>" method="post">
        <input type="hidden" id="hidapi_name" name="hidapi_name">
         <input type="hidden" id="hidFare_id" name="hidFare_id">
          <input type="hidden" id="hidtobooking" name="hidtobooking">
      
        </form>
    <form name="aspnetForm" method="post" id="aspnetForm">

    <div class="contents-inner" id="divLoadingComplated" style="display: block;">
        
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="1000">
            <tbody><tr>
                <td align="left" valign="top">
                <div style="border:1px solid #B3FFB3;border-radius:5px 5px 5px 5px;margin:10px;">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tbody><tr>
                            <td >
                                
                            </td>
                            <td >&nbsp;
                                
                            </td>
                            <td  align="left">
                                
                            </td>
                        </tr>
                        <tr>
                            <td >&nbsp;
                                
                            </td>
                            <td valign="top">
                                <table class="contents-box" align="center" border="0" cellpadding="2" cellspacing="2" width="99%">
                                    <tbody><tr>
                                        <td class="sub-headings" align="center" valign="top">
                                           <?php echo $this->session->userdata("sourcecity"); ?> - <?php echo $this->session->userdata("destinationcity"); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top" width="230">
                                            <span id="ctl00_ContentPlaceHolder1_lblAdults"><?php echo $this->session->userdata("AdultPax"); ?> Adult</span>
                                            <span id="ctl00_ContentPlaceHolder1_lblChild"><?php if($this->session->userdata("ChildPax") > 0){ echo $this->session->userdata("ChildPax")." Child";} ?></span>
                                            <span id="ctl00_ContentPlaceHolder1_lblInfant"><?php if($this->session->userdata("InfantPax") > 0){ echo $this->session->userdata("InfantPax")." Infant";} ?></span>
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top">
                                            
<style type="text/css">
    .ac_input
    {
        width: 200px;
    }
    .departInput img
    {
        padding-left: 5px;
    }
    .departInput input
    {
        vertical-align: top;
    }
    .TblSearch td
    {
    	font-family:Arial, Verdana, Tahoma;
    }
</style>
<script language="javascript" type="text/javascript">

    function onOpenSearch() {
        $("#ctl00_ContentPlaceHolder1_searchPanel_dialog_Search").dialog({ modal: true, height: 500, width: 900 });
    }
    function onCloseSearch() {
        $('#ctl00_ContentPlaceHolder1_searchPanel_dialog_Search').dialog('close');
        return false;
    }
</script>
<a href="javascript:void(0);" onclick="onOpenSearch();">
    <img src="jewria_files/bt-modify-search.gif" alt="" height="25" width="153">
</a>
<div id="ctl00_ContentPlaceHolder1_searchPanel_dialog_Search" class="dialog_content" style="display: none">
    <div class="dialog_closepanel">
        <p>
            <span>[ <a onclick="javascript:$( '#ctl00_ContentPlaceHolder1_searchPanel_dialog_Search').dialog('close');">
                close this window</a> ]</span> <a onclick="javascript:$( '#ctl00_ContentPlaceHolder1_searchPanel_dialog_Search').dialog('close');">
                    <img src="jewria_files/close-ovrly.gif" alt="close"></a>
        </p>
    </div>
    <div id="search_box" class="popup_overlay">
        <span><span style="font-weight: bold">Modify your Search</span></span>
        <div class="hr">
        </div>
        <input id="AirDetails" value="I" type="hidden">
       
        <div class="hr">
        </div>
        <p>
            <input name="ctl00$ContentPlaceHolder1$searchPanel$imgbtnSearch" value="Check Best Fare" onclick="return Validation();" id="ctl00_ContentPlaceHolder1_searchPanel_imgbtnSearch" title="Go for Search Flights" style="height:26px;width:130px;" type="submit">
            &nbsp;&nbsp; &nbsp;&nbsp;<input style="height: 26px" value="Cancel" onclick="javascript:$( '#ctl00_ContentPlaceHolder1_searchPanel_dialog_Search').dialog('close');return false;" title="Cancel" type="submit">
        </p>
    </div>
</div>


                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top">
                                            <div id="DivTC">
                                                <a id="ancCalender" href="" onclick="return showTravelCalender();">
                                                    <img src="jewria_files/bt-view-cal.gif" height="25" width="153">
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top">
                                            <h4 style="padding-right: 20px; padding-left: 20px; padding-bottom: 10px; padding-top: 10px;
                                                cursor: pointer;" class="sub-headings" id="h4Commision" onmouseout=" $('.aToolTip').fadeOut('slow');">
                                                Display</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="welcome-member" align="center" valign="top">
                                            Narrow Your Search
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="search-tabs" align="center" valign="top">
                                            <span class="sub-headings">One-way Price</span><br>
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="PriceSlider">
                                            <div style="left: 0%; width: 100%;" class="ui-slider-range ui-widget-header"></div><a style="left: 0%;" class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a><a style="left: 100%;" class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a></div>
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody><tr>
                                                    <td align="left">
                                                        <b><span id="PriceLeft"><span class="WebRupee"> Rs </span>4,577.00</span></b>
                                                    </td>
                                                    <td align="right">
                                                        <b><span id="PriceRight"><span class="WebRupee"> Rs </span>30,077.00</span></b>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="search-tabs" align="center" valign="top">
                                            <span class="sub-headings">Departure Time</span><br>
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="DepartureSliderRang">
                                            <div style="left: 0%; width: 100%;" class="ui-slider-range ui-widget-header"></div><a style="left: 0%;" class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a><a style="left: 100%;" class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a></div>
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody><tr>
                                                    <td align="left">
                                                        <b><span id="DepartureLeft">00:00</span></b>
                                                    </td>
                                                    <td align="right">
                                                        <b><span id="DepartureRight">24</span></b>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                            <br>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="search-tabs" align="center" valign="top">
                                            <span class="sub-headings">Arrival Time</span><br>
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="ArrivalSliderRang">
                                            <div style="left: 0%; width: 100%;" class="ui-slider-range ui-widget-header"></div><a style="left: 0%;" class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a><a style="left: 100%;" class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a></div>
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody><tr>
                                                    <td align="left">
                                                        <b><span id="ArrivalLeft">00:00</span></b>
                                                    </td>
                                                    <td align="right">
                                                        <b><span id="ArrivalRight">24</span></b>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                            <br>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="search-tabs" align="center" valign="top">
                                            <span class="sub-headings">Stops</span><br>
                                            <table border="0" cellpadding="2" cellspacing="5" width="150">
                                                <tbody><tr>
                                                    <td align="center">
                                                        <input name="checkbox" id="chk0" type="checkbox">
                                                    </td>
                                                    <td align="center">
                                                        <input name="checkbox2" id="chk1" type="checkbox">
                                                    </td>
                                                    <td align="center">
                                                        <input name="checkbox3" id="chk2" type="checkbox">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <b>0</b>
                                                    </td>
                                                    <td align="center">
                                                        <b>1</b>
                                                    </td>
                                                    <td align="center">
                                                        <b>1+</b>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="search-tabs" align="center" valign="top">
                                            <span class="sub-headings">Airlines</span><br>
                                            <br>
                                            <table style="text-align: left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody><tr>
                                                    <td>
                                                        <div id="listAirlines"><input id="chkG8" value="G8" checked="checked" title="Go" air="" type="checkbox"><span>Go Air</span><br><input id="chkSG" value="SG" checked="checked" title="Spice" jet="" type="checkbox"><span>Spice Jet</span><br><input id="chk6E" value="6E" checked="checked" title="Indigo" type="checkbox"><span>Indigo</span><br><input id="chkAI" value="AI" checked="checked" title="Air" india="" type="checkbox"><span>Air India</span><br><input id="chk9W" value="9W" checked="checked" title="Jet" airways="" type="checkbox"><span>Jet Airways</span><br><input id="chkS2" value="S2" checked="checked" title="Jet" lite="" type="checkbox"><span>Jet Lite</span><br></div>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" height="19" valign="top">&nbsp;
                                            
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                            <td>&nbsp;
                                
                            </td>
                        </tr>
                        <tr>
                            <td class="flight-rt-borde-bot">
                                
                            </td>
                            <td class="flight-rt-borde-bot">&nbsp;
                                
                            </td>
                            <td class="flight-rt-borde-bot">
                                
                            </td>
                        </tr>
                    </tbody></table>
                    </div>
                    <br>
                </td>
                <td style="width: 100%;" align="left" valign="top">
                    <br>
                     <div id="selectedflight"></div>
                    
                 
                    <table class="flight-details-bx-two-search" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                        	<tr>
                            	<td valign="top">
                                	<div class="universal">
                                    	<div class="sector" id="outbound_div" style="width: 100%;">
                                      
<!----
//////////////////
//// flights are started here
////////////////////////////////////////////////////////////
-->
                                       
                                        <div id="flights"></div>
                                     
<!--
///////////////////////
//// flights ends here
////////////////////////////////////////////////////////
-->                                        
                                      
                                            
                                     </div>
									</div>
           						</td>
                            </tr>
                         </tbody>
                    </table>
                 </td>
             </tr></tbody>
         </table>
            
                    <div class="clear">
                    </div>
      
       								 <br>
       								 
        
    
    
</div>
    


</form>
	<div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>
    </div>
    
   
</body></html>