<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super Dealer Balance Report</title>
<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>                       
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script>	
$(document).ready(function(){
$( "#txtFrom,#txtTo" ).datepicker({dateFormat:'yy-mm-dd'});
	setTimeout(function(){$('div.message').fadeOut(1000);}, 5000);
						   });
	</script>    
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
<h2>Super Dealer Balance Report</h2>
<form action="<?php echo base_url()."sd_dealer_balance_report"; ?>" method="post" name="frmReport" id="frmReport">
<fieldset>
<legend>Search By</legend>
<table>
<tr>
<td>
Super Dealer Name : 
</td>
<td>
<select title="Select Dealer Name." name="ddlUserName" id="ddlUserName" class="select">
    <option value="0">--Select--</option>
    <?php
		echo "<option value='ALL'>ALL</option>";
		$result_dealer = $this->db->query("select * from tblusers where usertype_name='SuperDealer' order by business_name");				
		for($i=0; $i<$result_dealer->num_rows(); $i++)
		{
			echo "<option value='".$result_dealer->row($i)->user_id	."'>".$result_dealer->row($i)->business_name."</option>";
		}
?>
</select>
<input type="submit" value="Submit" class="button" name="btnSearch" id="btnSearch" />
</td>
</tr>
</table>
</fieldset>
</form>
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if(isset($result_balance))
	{
		if($result_balance->num_rows() > 0)
		{
	?>
    <div id="tblMobileReport">
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader" style="background: #110303;color: #fff;">
    <th scope="col" align="left">Sr No</th>
	<th scope="col" align="left">Super Dealer Name</th>    
	<th scope="col" align="left">Current Balance</th>
    </tr>
    <?php	$total_amount=0;$i = 0;foreach($result_balance->result() as $result) 	{  ?>
			<tr id="<?php echo "Print_".$i ?>" class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><?php echo ($i + 1); ?></td>
 <td><?php echo "<span id='db_ssid".$i."'>".$result->business_name."</span>"; ?></td> 
 <td><?php echo "<span id='db_trno".$i."'>".$result->balance."</span>"; ?></td> 
 </tr>
		<?php
		$i++;} ?>         
		</table>
        </div>
       <?php
		}
	   else{
		   echo "<div class='message'>Record Not Found.</div>";
		   }
	   
	   }?>
       <div id="footer">
     <?php require_once("general_footer.php"); ?>
  <!-- end #footer --></div>
</div>

</div>

  
</body>
</html>