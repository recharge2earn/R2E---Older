<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Binary Tree</title>
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
   	<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <link rel="stylesheet" href="<?php echo base_url()."js/jquery.alerts.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script> 
    <script src="<?php echo base_url()."js/jquery.alerts.js"; ?>"></script>
    <script src="<?php echo base_url()."js/modernizr-1.7.min .js"; ?>"></script>
    
   	<style type="text/css">
td.center {text-align:center}
</style>

</head>
<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("general_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("general_menu.php"); ?> 
  </div>
  <div id="back-border">
  </div>
  <?php
$this->load->model('c_client_binary_tree_model');				
$res = $this->c_client_binary_tree_model->display_btree($this->session->userdata("id"));
?>
<script type="text/javascript">
//var testArray = new Array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29")
var testArray = new Array(<?php echo '"'.$this->session->userdata('business_name').'",'.$res; ?>)
var i, j
var content =""
content += "<h2>Client Binary Tree Display</h2><br>"
function writeArray(){
var array_size = ((testArray.length/2)+1)*2
i = 1
do {
i = i*2
}
while (i < array_size)
array_size = i
for (i = 1; i <= array_size; i++){
if (!testArray[i]){
testArray[i] = "null"
}}
content += "<div align='center'><table border='1' cellpadding='5' cellspacing='5' width='1000'>"
i = 2
while (i <= array_size) {
content += "<tr>"
for (var j = i-i/2 ; j < i; j++){
content += "<td class='center' style='background-color:#717171;color:#fff;' colspan='" + array_size/i + "'>" + testArray[j-1] + "</td>"
}
i = i*2
content += "</tr>"
}
content += "</table></div>"
document.write(content)
}

writeArray()
</script>
  
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
     <?php require_once("general_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
	</body>
</html>