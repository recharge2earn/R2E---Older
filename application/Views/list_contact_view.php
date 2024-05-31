<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>List of contact enquiry</title>
    <?php include("script1.php");?>   
    <script>
	$(document).ready(function(){
	
	setTimeout(function(){$('div.message').fadeOut(1000);}, 2000);
	
});
	
	</script>
</head>
<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("admin_menu1.php"); ?> 
  </div>
  <div id="back-border">
  </div>
  <div>
<h2 class="h2">List Of Contact Enquiry</h2>  
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>         
<table style="width:100%;" id="example" class='dataTable' cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader" style="background: #110303;color: #fff;">
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Sr No</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Contact Name</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Email ID</th>
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Contact No</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Enquire Subject</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Message</th>    
	<th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Request Date</th>    
    </tr>
    <?php	$i = 0;foreach($result_contact->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo ($i+1); ?></td>            
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo $result->visitorname; ?></td>            
<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo $result->email; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo $result->contact_no; ?></td> 
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo $result->enquire_type; ?></td> 
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo $result->message; ?></td>
<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo $result->request_date; ?></td>
 </tr>
		<?php 	
		$i++;} ?>
		</table>
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>