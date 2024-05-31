<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MLM Income</title>
<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
    <script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
    <script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>

	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>        
    <script>	
$(document).ready(function(){
$( "#txtFrom,#txtTo" ).datepicker({dateFormat:'yy-mm-dd'});
	setTimeout(function(){$('div.message').fadeOut(1000);}, 5000);
						   });
	

	</script>
               
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("general_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("general_menu.php"); ?> 
  </div>
  <div class="bck">

   <h2><span id="myLabel">MLM Income</span></h2>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>    
     <form action="<?php echo base_url()."user_mlmincome" ?>" method="post" name="frmSearch" id="frmSearch">
     <fieldset>
     <legend>Search By</legend>
<table>
    <tr>
<td align="right">From Date :</td>
<td align="left"><input type="text" name="txtFrom" id="txtFrom" class="text" title="Select From Date." maxlength="10" /> </td>
<td>To Date :</td>
<td align="left"><input type="text" name="txtTo" id="txtTo" class="text" title="Select From To." maxlength="10" /></td>&nbsp;&nbsp;&nbsp;
<td align="left" style="padding-left:20px;"><input type="submit" name="btnSearch" id="btnSearch" value="Search" class="button" title="Click to search." /></td>
</tr>
</tr>
</table>     
</fieldset>
<br />
 </form>
 
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader" style="background: #110303;color: #fff;">
    <th scope="col" align="left">Sr No</th>
    <th scope="col" align="left">Date Time</th>
     <th scope="col" align="left">Name</th>
     <th scope="col" align="left">Refral Name</th>
    <th scope="col" align="left">Amount</th>
    </tr>
   <?php	$total_amount=0;$i = 0;foreach($result_commission->result() as $result) 	{  ?>
			<tr id="<?php echo "Print_".$i ?>" class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><?php echo ($i + 1); ?></td>
 <td><?php echo "<span id='db_ssid".$i."'>".$result->add_date."</span>"; ?></td>
 <td><?php echo "<span id='db_trno".$i."'>".$result->name_user."</span>"; ?></td> 
  <td><?php echo "<span id='db_trno".$i."'>".$result->name_ref."</span>"; ?></td> 
 <td><?php echo "<span id='db_trno".$i."'>".$result->amount."</span>"; ?></td> 
 </tr>
		<?php
		$total_amount= $total_amount + $result->amount;
		$i++;} ?>    
         <tr class="ColHeader" style="background: #110303;color: #fff;">
    <th scope="col" align="left"></th>
    <th scope="col" align="left"></th>  
     <th scope="col" align="left"></th>   
    <th scope="col" align="right">Total Balace : </th>
    <th scope="col" align="left"><?php echo $total_amount; ?></th>        	          
    </tr>    
		</table>
</div>
<div id="footer">
     <?php require_once("general_footer.php"); ?>
  <!-- end #footer --></div>
  
</div>

</body>
</html>