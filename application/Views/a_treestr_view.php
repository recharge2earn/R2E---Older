<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>View User Tree Structure</title>
    <link rel="stylesheet" href="<?php echo base_url()."css_tree/jquery.jOrgChart.css"?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."css_tree/tooltip.css"?>"/>
 
    <!-- jQuery includes -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script src="<?php echo base_url()."js_tree/tooltip.js"?>" type="text/javascript"></script>
    <script language="javascript" src="js_tree/jOrgChart2.js"> </script>
    <script src="<?php echo base_url()."js_tree/jquery.jOrgChart.js"?>"></script>
<script type="text/javascript">
$(document).ready(function(){$('.tTip').betterTooltip({speed: 150, delay: 300});});
</script>
<script language="javascript">
function validate()
{
	var e = document.getElementById("ddlUser");
   document.getElementById("hidName").value = e.options[e.selectedIndex].text;
   document.getElementById("hidid").value = document.getElementById("ddlUser").value;
   
}
</script>
    
<style>
.tip {
	width: 250px;
	padding-top:18px;
	overflow: hidden;
	display: none;
	position: absolute;
	color:#00F;
	z-index: 500;
	background: transparent url(images_tree/tipTop.png) no-repeat top;}
.tipMid {background: transparent url(images_tree/tipMid.png) repeat-y; padding: 0 15px 10px 15px;}
.tipBtm {background: transparent url(images_tree/tipBtm.png) no-repeat bottom; height: 32px;}
a:link
{
text-decoration:none;
color:#FFF;
}
a:visited
{
	color:#FFF;
}
a:active
{
	color:#FFF;
}
		 
</style>
<link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
  </head>

<body class="twoColFixLtHdr">
  <div id="container">
   <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("a_menu.php"); ?> 
  </div>
  
  <div class="bck">

   <h2><span id="myLabel">View Tree Structure of Particular User</span></h2>           
       
    <form method="post" name="frmBalance" action="a_treestr" style="padding-left:30px;">
<select id="ddlUser" name="ddlUser" title="Select user." style="width:300px;height:20px;">
<option value="-1">--Select--</option>
<?php
		$str_query = "select * from tblusers where (usertype_name = ? or usertype_name = ? or usertype_name = ?) order by business_name";
		$result = $this->db->query($str_query,array('Admin','Distributor','MLMAgent'));		
		for($i=0; $i<$result->num_rows(); $i++)
		{
			echo "<option value='".$result->row($i)->user_id."'>".$result->row($i)->business_name . ' -> '.$result->row($i)->usertype_name."</option>";
			
		}
?>
</select>
<input type="hidden" name="hidName" id="hidName"/>
<input type="hidden" name="hidid" id="hidid"/>
<input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" onClick="validate();" />
</form>

<div>

</div>
<table">
<tr>
<td>
<div id="chart" align="center" style="padding-top:10px;margin-top:-10px;max-width:500px;"><?php echo $this->view_data['tree'];?> </div>
</td>
</tr>
</table>

</div>
    
    <div id="footer" style="margin-top:10px;">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
    </div>
</body>
</html>