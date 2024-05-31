<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payworld Transaction Report</title>
<?php include("script1.php"); ?>
<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                         
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script>	
$(document).ready(function(){setTimeout(function(){$('div.message').fadeOut(1000);}, 5000); });
	</script>
</head>
<body class="twoColFixLtHdr">
  <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("admin_menu1.php"); ?> 
  </div>

<div id="main_image">
  <div>
<h2>Transaction Status Report</h2>
<form action="<?php echo base_url()."payworld_transaction_report"; ?>" method="post" name="frmReport" id="frmReport">
<table>
<tr>
<td align="right"> Transaction ID :</td>
<td align="left"><input type="text" name="txtTransactionID" id="txtTransactionID" class="text" title="Enter Starways Transaction ID." maxlength="100" /> <input type="submit" name="btnSearch" id="btnSearch" value="Request" class="button" 
title="Click to starways request." /></td>
<td align="left"></td>
</tr>

<tr>
<td align="center" style="font-size:18px;color:#0C3;" colspan="3">OR</td>
</tr>
<tr>
<td align="right">SS ID :</td>
<td align="left"><input type="text" name="txtGTID" id="txtGTID" class="text" title="Enter SS Transaction ID." maxlength="100" /><input type="submit" name="btnRequest" id="btnRequest" value="Request" class="button" 
title="Click to starways request." /> </td>
<td align="left"></td>
</tr>
<tr>
</tr>
</table>
</form>
<?php if ($message != ''){echo "<div class='message'>".$message."</div>"; }
if($result != '')
{
	if(count($result) == 2)
	{
		echo '<h2>Transaction Result</h2>'.$result[1];
	}
	else
	{
?>
<h2>Transaction Result</h2>
<table style="width:100%" cellpadding="5" cellspacing="0" border="1">
<tr>
<td align="right" width="250">Transaction ID : </td>
<td align="left"><?php echo $result[0]; ?></td>
</tr>
<tr>
<td align="right">Client Transaction ID : </td>
<td align="left"><?php echo $result[1]; ?></td>
</tr>
<tr>
<td align="right">Transaction Response Code : </td>
<td align="left"><?php echo $result[2]; ?></td>
</tr>
<tr>
<td align="right">Transaction Reponse Message : </td>
<td align="left"><?php echo $result[3]; ?></td>
</tr>
<tr>
<td align="right">Status : </td>
<td align="left"><?php echo $result[4]; ?></td>
</tr>
<tr>
<td align="right">Operator Code: </td>
<td align="left"><?php echo $result[5]; ?></td>
</tr>
<tr>
<td align="right">Circle Code: </td>
<td align="left"><?php echo $result[6]; ?></td>
</tr><tr>
<td align="right">Product : </td>
<td align="left"><?php echo $result[7]; ?></td>
</tr><tr>
<td align="right">Mobile : </td>
<td align="left"><?php echo $result[8]; ?></td>
</tr>
<tr>
<td align="right">Amount : </td>
<td align="left"><?php echo $result[9]; ?></td>
</tr>
<tr>
<td align="right">Rate : </td>
<td align="left"><?php echo $result[10]; ?></td>
</tr>
<tr>
<td align="right">Transaction Date Time : </td>
<td align="left"><?php echo $result[11]; ?></td>
</tr>
<tr>
<td align="right">Credit Date Time : </td>
<td align="left"><?php echo $result[12]; ?></td>
</tr>
</table>
<?php }} ?>
</div>



 


<!-- content ends here-->


</div>

<div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
  
</body>
</html>