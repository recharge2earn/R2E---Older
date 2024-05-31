<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>APi User List</title>
     <?php include("script1.php"); ?>
    <link rel="stylesheet" href="<?php echo base_url()."js/themes/base/jquery.ui.all.css"; ?>">
    <script src="<?php echo base_url()."js/jquery-1.4.4.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.core.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.widget.js"; ?>"></script>
	<script src="<?php echo base_url()."js/ui/jquery.ui.datepicker.js"; ?>"></script>    
	<script src="<?php echo base_url()."js/qTip.js"; ?>"></script>   
                        
    <script language="javascript">
	setTimeout(function(){$('div.message').fadeOut(1000);}, 10000);
	function ActionSubmit(value,name)
	{
		if(document.getElementById('action_'+value).selectedIndex != 0)
		{
			var isstatus;
			if(document.getElementById('action_'+value).value == 0)
			{isstatus = 'cancel';}else{isstatus='active';}
			
			if(confirm('Are you sure?\n you want to '+isstatus+' login for - ['+name+']')){
				alert(document.getElementById('action_'+value).value);
				document.getElementById('hidstatus').value= document.getElementById('action_'+value).value;
				document.getElementById('hiduserid').value= value;				
				//document.getElementById('frmCallAction').submit();
				}
		}
	}
	</script>
    <style>
	body
	{
		max-width:98%;
		padding-left:10px;
	}
	.message
	{
		border:1px solid #E4DB2C;
		padding:10px;
		font-size:24px;
		background-color:#B8F35F;
	}
	</style>
    <script type="text/javascript">
    function runScript(e,value) {
    if (e.keyCode == 13) {
     if(value == "distributorcode")
	 {
		
		 document.getElementById("hidSearchFlag").value = value;
		 document.getElementById("hidSearchValue").value = document.getElementById("txtDistributerCode").value;
		 document.getElementById("frmfilter").submit();
	 }
	  if(value == "name")
	 {
		
		 document.getElementById("hidSearchFlag").value = value;
		 document.getElementById("hidSearchValue").value = document.getElementById("txtDistributerName").value;
		 document.getElementById("frmfilter").submit();
	 }
	 if(value == "Mobile")
	 {
		 
		 document.getElementById("hidSearchFlag").value = value;
		 document.getElementById("hidSearchValue").value = document.getElementById("txtMobile").value;
		 document.getElementById("frmfilter").submit();
	 }
	 if(value == "Mobile")
	 {
		
		 document.getElementById("hidSearchFlag").value = value;
		 document.getElementById("hidSearchValue").value = document.getElementById("txtEmail").value;
		 document.getElementById("frmfilter").submit();
	 }
	 if(value == "City")
	 {
		
		 document.getElementById("hidSearchFlag").value = value;
		 document.getElementById("hidSearchValue").value = document.getElementById("txtCity").value;
		 document.getElementById("frmfilter").submit();
	 }
	  if(value == "balance")
	 {
		
		 document.getElementById("hidSearchFlag").value = value;
		 document.getElementById("hidSearchValue").value = document.getElementById("txtbalance").value;
		 document.getElementById("frmfilter").submit();
	 }
    }
    }
	function submitForm()
	{
		 document.getElementById("hidSearchFlag").value = "state";
		 document.getElementById("hidSearchValue").value = document.getElementById("ddlState").value;
		 document.getElementById("frmfilter").submit();
	}
	function actionDeactivate(value,status)
	{
		
		document.getElementById('hidstatus').value= status;
		document.getElementById('hiduserid').value= value;	
		document.getElementById('frmCallAction').submit();
	}
</script>    
    <script src="<?php echo base_url()."js/jquery.dataTables.min.js"; ?>"></script> 
    <link href="<?php echo base_url()."jquery.dataTables.css"; ?>" rel="stylesheet" type="text/css" />    
   
   
</head>
<body class="twoColFixLtHdr">
<div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
<div id="container">
     <?php require_once("admin_menu1.php"); ?>   
  <div >
                   
    <?php
	if($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";}	
	if($message != ''){
	echo "<div class='message'>".$message."</div>";}
	
	?>   
    <div class="">


<form action="<?php echo base_url()."apiuser_list" ?>" method="post" name="frmCallAction" id="frmCallAction">
<input type="hidden" id="hidstatus" name="hidstatus" />
<input type="hidden" id="hiduserid" name="hiduserid" />
  <input type="hidden" id="startpage" name="startpage" value="<?php echo $this->uri->segment(3); ?>"/>
<input type="hidden" id="hidaction" name="hidaction" value="Set" />
 </form>
    
</div>


<div class="row-fluid">
		<div class="span12">
			<div class="span6">
				<span style="color:#023a99;"><h2>List Of ApiUsers</h2></span>
			</div>
		</div>
	</div>

<table style="width:100%;font-size:14px;" cellpadding="3" cellspacing="10" border="0">
    <tr class="ColHeader" style="background-color:#CCCCCC;" >
  
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="64">Id</th>
      <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="40" height="64">D No<br>
    <div class="input text"><input type="text" id="txtDistributerCode" name="txtDistributerCode" onkeypress="return runScript(event,'distributorcode')" style="width:90%;" id="distributorcode" name="data[distributorcode]"></div></th>
    
  
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="40" height="64">D Name<br>
    <div class="input text"><input type="text" id="txtDistributerName" name="txtDistributerName" onkeypress="return runScript(event,'name')" style="width:90%;" id="distributorcode" name="data[distributorcode]"></div></th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="40" height="64">Mobile<br>
    <div class="input text"><input type="text" id="txtMobile" name="txtMobile" onkeypress="return runScript(event,'Mobile')" style="width:90%;" id="distributorcode" name="data[distributorcode]"></div></th>
   	<th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="40" height="64">State<br>
    <div class="input text">
    <select class="select" onChange="submitForm()" id="ddlState" name="ddlState" style="max-width:100px;" title="Select State.<br />Click on drop down"><option value="0">Select State</option>
<?php
$str_query = "select * from tblstate order by state_name";
		$result = $this->db->query($str_query);		
		for($i=0; $i<$result->num_rows(); $i++)
		{
			echo "<option code='".$result->row($i)->codes."' value='".$result->row($i)->state_id."'>".$result->row($i)->state_name."</option>";
		}
?>
</select></td></div></th>   
	<th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="40" height="64">City<br>
    <div class="input text"><input type="text" id="txtCity" name="txtCity" onkeypress="return runScript(event,'City')" style="width:90%;" id="distributorcode" name="data[distributorcode]"></div></th> 
   	<th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="40" height="64">Email ID<br>
    <div class="input text"><input type="text" id="txtEmail" name="txtEmail" onkeypress="return runScript(event,'Email')" style="width:90%;" id="distributorcode" name="data[distributorcode]"></div></th>  
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="40" height="64">Balance<br>
    <div class="input text"><input type="text" id="txtbalance" name="txtbalance" onkeypress="return runScript(event,'balance')" style="width:90%;" id="distributorcode" name="data[distributorcode]"></div></th> 
	<th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="40" height="64">Login</th>
	<th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="40" height="64" >Action</th>                 
    </tr>
   <form id="frmfilter" name="frmfilter" action="distributor_list" method="post">
   <input type="hidden" id="hidSearchFlag" name="hidSearchFlag" />
   <input type="hidden" id="hidSearchValue" name="hidSearchValue" />
   </form>
                      
       
    <?php	$i = 0;foreach($result_dealer->result() as $result) 	{  ?>
    
    <?php
	$balance = $this->Common_methods->getCurrentBalance($result->user_id);
	$parentid = $result->parent_id;
		$rslt = $this->db->query("select * from tblusers where user_id = '$parentid'");
	 ?>
    
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">

 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34"><?php echo $i+1; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo $result->username; ?></td>
<td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><a href="<?php echo base_url()."profile/view/".$this->Common_methods->encrypt("Distributor")."/".$this->Common_methods->encrypt($result->user_id);?>" target="_blank"><?php echo $result->business_name; ?></a></td>
  <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo $result->mobile_no; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo $result->state_name; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo $result->city_name; ?></td>
<td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34" width="100px"><?php echo $result->emailid; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="right" height="34"><?php echo $balance; ?></td>
<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34"><?php if($result->status == 0){echo "<span class='red'><a href='#' onclick='actionDeactivate(".$result->user_id.",1)'>Deactivate</a></span>";}else{echo "<span class='green'><a href='#' onclick='actionDeactivate(".$result->user_id.",0)'>Active</a></span>";} ?></td>
<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" width="180px">
 
 <a href="<?php echo base_url()."_Admin/distributer_edit/process/".$this->Common_methods->encrypt($result->user_id); ?>" title="Edit Franchise"><img src="<?php echo base_url()."images/Edit.PNG"; ?>" border="0" title="Edit Dealer" /></a>   |       


  <?php echo '<a title="Transfer Money" href="'.base_url().'add_balance/process/'.$this->Common_methods->encrypt($result->user_id).'/'.$this->Common_methods->encrypt('apiuser_list').'/'.$this->Common_methods->encrypt('Add').'" class="paging"><img src="'.base_url().'images/money_icon.jpg" style="width:20px;"/></a> | <a title="Revert Transaction" href="'.base_url().'add_balance/process/'.$this->Common_methods->encrypt($result->user_id).'/'.$this->Common_methods->encrypt('apiuser_list').'/'.$this->Common_methods->encrypt('Revert').' " class="paging"><img src="'.base_url().'images/Revert.png" style="width:20px;height:15px;"/></a> | <a href="#" ><img src="'.base_url().'images/file_icon.jpg" style="width:20px;"/></a> | <a href="#" ><img src="'.base_url().'images/transaction_view_detail.png" style="width:20px;"/></a>| <a href="'.base_url().'directaccess/process/'.$this->Common_methods->encrypt($result->user_id).'" target=_blank><img src="'.base_url().'images/Direct_Access_Icon.gif" height=20 width=20/></a>'; ?>
 </td>
 </tr>
		<?php 	
		$i++;} ?>
		</table>
       <?php  echo $pagination; ?>
    
	<!-- end #mainContent --></div>
    
    <a href="#" onClick="scrolltotop()">top</a>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>
