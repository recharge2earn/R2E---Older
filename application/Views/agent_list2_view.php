<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agent List</title>
<?php include("script1.php"); ?>
  
      
    <script>
	setTimeout(function(){$('div.message').fadeOut(1000);}, 3000);
	function ActionSubmit(value,name)
	{
		if(document.getElementById('action_'+value).selectedIndex != 0)
		{
			var isstatus;
			if(document.getElementById('action_'+value).value == 0)
			{isstatus = 'cancel';}else{isstatus='active';}
			
			if(confirm('Are you sure?\n you want to '+isstatus+' login for - ['+name+']')){
				document.getElementById('hidstatus').value= document.getElementById('action_'+value).value;
				document.getElementById('hiduserid').value= value;				
				document.getElementById('frmCallAction').submit();
				}
		}
	}
	</script>
   
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
</script>
</head>
<body class="twoColFixLtHdr">
<div id="container">
  <div id="header" style="margin:0;padding:0;">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("agent_menu.php"); ?> 
  </div>  
  <div class="bck">
<h2 class="h2">View Agents</h2>  
 
 
 
    <?php
	if ($message != ''){echo "<div class='message'>".$message."</div>"; }
	if($this->session->flashdata('user_message')){echo "<div class='message'>".$this->session->flashdata('user_message')."</div>";}
	
		if($this->session->flashdata('message')){echo "<div class='message'>".$this->session->flashdata('message')."</div>";}	
	
	?>    
    
     
 
<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader">
  
   <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="20" height="64">Id</th>
      <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="40" height="64">User ID <br>
    <div class="input text"><input type="text" id="txtDistributerCode" name="txtDistributerCode" onkeypress="return runScript(event,'distributorcode')" style="width:100%;" id="distributorcode" name="data[distributorcode]"></div></th>
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="40" height="64">Name<br>
    <div class="input text"><input type="text" id="txtDistributerName" name="txtDistributerName" onkeypress="return runScript(event,'name')" style="width:100%;" id="distributorcode" name="data[distributorcode]"></div></th>
 <?php if($this->session->userdata("user_type") == "MasterDealer"){ ?>   
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="40" height="64">Parent Name<br>
    </th>
    <?php } ?>
    
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="40" height="64">Mobile<br>
    <div class="input text"><input type="text" id="txtMobile" name="txtMobile" onkeypress="return runScript(event,'Mobile')" style="width:100%;" id="distributorcode" name="data[distributorcode]"></div></th>
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
	<th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="40" height="64">Password<br>
    <div class="input text"><input type="text" id="txtCity" name="txtCity" onkeypress="return runScript(event,'City')" style="width:100%;" id="distributorcode" name="data[distributorcode]"></div></th> 
   	<th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="40" height="64">Email ID<br>
    <div class="input text"><input type="text" id="txtEmail" name="txtEmail" onkeypress="return runScript(event,'Email')" style="width:100%;" id="distributorcode" name="data[distributorcode]"></div></th>  
    <th class="padding_left_10px box_border_bottom box_border_right background_gray" align="left" width="40" height="64">Balance<br>
    <div class="input text"><input type="text" id="txtbalance" name="txtbalance" onkeypress="return runScript(event,'balance')" style="width:100%;" id="distributorcode" name="data[distributorcode]"></div></th> 
	<th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="40" height="64">Status</th>
	<th class="padding_left_10px box_border_bottom box_border_right background_gray" align="center" width="40" height="64" >Action</th>                 
    </tr>
   <form id="frmfilter" name="frmfilter" action="agent_list" method="post">
   <input type="hidden" id="hidSearchFlag" name="hidSearchFlag" />
   <input type="hidden" id="hidSearchValue" name="hidSearchValue" />
   </form>
                      
       
    <?php	$i = 0;foreach($result_agent->result() as $result) 	{  ?>
    
    <?php
	$parent_id = $result->parent_id;
		$rslt = $this->db->query("select * from tblusers where user_id = '$parent_id'");
		$this->load->model("Common_methods");
		$balance = $this->Common_methods->getAgentbalance($result->user_id);
	 ?>
    
			<tr>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34"><?php echo $i+1; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo $result->username; ?></td>
<td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo $result->business_name; ?></td>
<?php if($this->session->userdata("user_type") == "MasterDealer"){ ?>
<td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo $rslt->row(0)->business_name; ?></td>
<?php } ?>
  <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo $result->mobile_no; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo $result->state_name; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34">****</td>
<td class="padding_left_10px box_border_bottom box_border_right" align="left" height="34"><?php echo $result->emailid; ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="right" height="34"><?php echo $balance; ?></td>
<td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34"><?php if($result->status == 0){echo "<span class='red'>Cancel</span>";}else{echo "<span class='green'>Active</span>";} ?></td>
 <td class="padding_left_10px box_border_bottom box_border_right" align="center" height="34" width="250px"><?php echo '<a title="Transfer Money" href="'.base_url().'common_add_balance/process/'.$this->Common_methods->encrypt($result->user_id).'/'.$this->Common_methods->encrypt('agent_list2').'/'.$this->Common_methods->encrypt('Add').'" class="paging">Credit</a> | <a title="Revert Transaction" href="'.base_url().'common_add_balance/process/'.$this->Common_methods->encrypt($result->user_id).'/'.$this->Common_methods->encrypt('agent_list2').'/'.$this->Common_methods->encrypt('Revert').' " class="paging">Debit</a>'; ?> </td>
 </tr>
		<?php 	
		$i++;} ?>
		</table>
       <?php  echo $pagination; ?>
	<!-- end #mainContent --></div>
	
    <div id="footer">
     <?php require_once("a_footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
  
</body>
</html>