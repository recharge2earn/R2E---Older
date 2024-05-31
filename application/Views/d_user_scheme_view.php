<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Scheme View</title>
<link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
    <script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
    <script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>        
    <script>
	$(function() {
		$( "#txtSearch_Date" ).datepicker({dateFormat:'yy-mm-dd'});
	});
	</script>
               
    <link href="<?php echo base_url()."style.css"; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()."controls.css"; ?>" rel="stylesheet" type="text/css" />    
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body class="twoColFixLtHdr">
 <?php require_once("general_header.php"); ?> 
 <?php require_once("general_menu.php"); ?> 
   <div class="bck">
  <div>
   <h1><span id="myLabel">User Scheme</span></h1>           
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	?>    
     <form action="<?php echo base_url()."d_user_scheme" ?>" method="post" name="frmSearch" id="frmSearch">
     <fieldset>
     <legend>Search By</legend>
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
     <tr>
    <td align="right">User Name : </td>
    <td align="left">
    <select id="txtname" name="txtname" class="select" title="Select User Name.">
<option>--Select--</option>
<?php
		$parent_id=$this->session->userdata("id");
		$str_query = "select CASE usertype_name WHEN 'SuperDealer' THEN business_name WHEN 'Admin' THEN business_name WHEN 'MasterDealer' THEN business_name WHEN 'Distributor' THEN business_name WHEN 'Agent' THEN business_name END as name,user_id from tblusers where parent_id = ?";
		$result = $this->db->query($str_query,array($parent_id));		
		for($i=0; $i<$result->num_rows(); $i++)
		{
			echo "<option value='".$result->row($i)->user_id	."'>".$result->row($i)->name."</option>";
		}
?>
</select>
<input type="submit" class="button" value="View" name="btnView" id="btnView" />
   </td>	
	</tr>
    
    <tr>
    <td align="right">Scheme Name : </td>
    <td align="left">
    <select id="txtscheme" name="txtscheme" class="select" title="Select Scheme.">
<option>--Select--</option>
<?php		
		$str_query = "select * from tblscheme where scheme_type='MasterDealer'";
		$result = $this->db->query($str_query);		
		for($i=0; $i<$result->num_rows(); $i++)
		{
			echo "<option value='".$result->row($i)->scheme_id."'>".$result->row($i)->scheme_name.' - '.$result->row($i)->scheme_type."</option>";
		}
?>
</select>
<input type="submit" class="button" value="View" name="btnSchemeView" id="btnSchemeView" />
<input type="submit" class="button" style="width:230px" value="Change Commission" name="btnChange" id="btnChange" />
   </td>	
	</tr>

</tr>
</table>     
</fieldset>
<br />
 </form>
 
 <?php if(isset($result_commission)) { ?>
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class='colHeader' style="background: #110303;color: #fff;">
    <th scope="col" align="left">Sr No</th>
    <th scope="col" align="left">Company Name</th>                
    <th scope="col" align="left">Commission Percent(%)</th>        
    </tr>
    <?php $i = 0;foreach($result_commission->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
 <td><?php echo ($i+1); ?></td>
 <td><?php echo $result->company_name; ?></td>
 <td><?php echo $result->commission_per; ?></td> 
 </tr>
		<?php 	
		$i++;} ?>
		</table>
        <?php } ?>
</div>
</div>
 <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
</body>
</html>