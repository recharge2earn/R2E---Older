<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Commission Rate</title>
<?php include("script1.php"); ?>
</head>
<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("general_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("agent_menu.php"); ?> 
  </div>
  <div class="bck">

   <h2 class="border shadow"><span id="myLabel">Commission Rate</span></h2>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>    

<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader" style="background: #110303;color: #fff;">
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Sr No</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Company Name</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="120" height="30" >Commission Rate(%)</th>        
    </tr>
    <?php	$i = 0;foreach($result_commission->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;"><?php echo ($i+1); ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;"><?php echo $result->company_name; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" style="min-width:120px;width:150px;"><span class="padding_left_10px box_border_bottom box_border_right" style="min-width:50px;width:50px;"><?php echo $dist_com_rslt->row(0)->commission;?></span></td> 
 </tr>
		<?php 	
		$i++;} ?>
		</table>
        
</div>
<div id="footer">
     <?php require_once("general_footer.php"); ?>
  <!-- end #footer --></div>
  
</div>

</body>
</html>