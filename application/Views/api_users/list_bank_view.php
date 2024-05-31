<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bank Details</title>
<?php include("script1.php"); ?>
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
    <script src="<?php echo base_url()."js/external/jquery.bgiframe-2.1.2.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>                    
   <link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>  

<script>	

	function SubmitAction(user_id,id)
	{
		if(document.getElementById('ddlAction_'+id).selectedIndex != 0)
		{
			if(confirm('Are you sure?\nyou want to submit action.'))
			{
			document.getElementById('hidUserID').value= user_id;
			document.getElementById('hidID').value= id;
			document.getElementById('hidAmount').value= document.getElementById('Amount_'+id).innerHTML;
			document.getElementById('hidRemark').value= document.getElementById('txtRemark_'+id).value;
			document.getElementById('hidBankCharge').value= document.getElementById('txtBankcharge_'+id).value;
			document.getElementById('hidStatus').value = document.getElementById('ddlAction_'+id).value;		
			document.getElementById('hidBankID').value = document.getElementById('hidbank_id_'+id).value;
			document.getElementById('hidRemark_details').value = document.getElementById('hidRemark_Details_'+id).value;
			 
			document.getElementById('frmAction').submit();
			}
		}
	}
	</script>
</head>
<body class="twoColFixLtHdr">
<div id="container">

 <?php require_once("apiuser_header.php"); ?>  
 <?php require_once("ApiMenu.php"); ?> 
  
  <div style="margin:20px;">
<h2 class="h2">Bank List</h2>

    <?php
	if($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";}
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>
    <div class="breadcrumb">
<table style="width:100%;font-size:14px;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader">
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Sr No</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Bank Name</th>            
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Branch Name</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >Account Number</th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="120" height="30" >IFSC Code</th>
    
                        
    </tr>
    <?php	$i = 0;foreach($result_bank->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo ($i + 1); ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo $result->bank_name; ?></td> 
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo $result->branch_name; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo $result->account_number; ?>
 </td> 
  <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" style="min-width:120px;width:150px;"><?php echo $result->ifsc_code; ?></td>
 
 </tr>
		<?php 	
		$i++;} ?>
		</table>
      </div>
    

</div>
<div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
</div>

  
</body>
</html>