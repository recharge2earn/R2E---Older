<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Distributor</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>   
       
    <script type="text/javascript" language="javascript">         
      
  function getCityName(urlToSend)
  {
    if(document.getElementById('ddlState').selectedIndex != 0)
    {
      document.getElementById('hidStateCode').value = $("#ddlState")[0].options[document.getElementById('ddlState').selectedIndex].getAttribute('code');          
    $.ajax({
  type: "GET",
  url: urlToSend+""+document.getElementById('ddlState').value,
  success: function(html){
    $("#ddlCity").html(html);
  }
});
    }
  }


function getCityNameOnLoad(urlToSend)
  {
    if(document.getElementById('ddlState').selectedIndex != 0)
    {
      document.getElementById('hidStateCode').value = $("#ddlState")[0].options[document.getElementById('ddlState').selectedIndex].getAttribute('code');          
    $.ajax({
  type: "GET",
  url: urlToSend+""+document.getElementById('ddlState').value,
  success: function(html){
    $("#ddlCity").html(html);
  document.getElementById('ddlCity').value = document.getElementById('hidCityID').value;    
  }
});
    }
  }

$(document).ready(function(){
  //global vars
  var form = $("#frmdistributer_form1");
  var dname = $("#txtDistname");var postaladdr = $("#txtPostalAddr");
  var pin = $("#txtPin");var mobileno = $("#txtMobNo");var emailid = $("#txtEmail");
  var ddlsch = $("#ddlSchDesc");
  //On Submitting
  form.submit(function(){
    if(validateDname() & validateAddress() & validatePin() & validateMobileno() & validateEmail() & validateScheme())
      {       
      return true;
      }
    else
      return false;
  });
  //validation functions  
  function validateDname(){
    if(dname.val() == ""){
      dname.addClass("error");return false;
    }
    else{
      dname.removeClass("error");return true;
    }   
  } 
  function validateAddress(){
    if(postaladdr.val() == ""){
      postaladdr.addClass("error");return false;
    }
    else{
      postaladdr.removeClass("error");return true;
    }   
  }
  function validatePin(){
    if(pin.val() == ""){
      pin.addClass("error");
      return false;
    }
    else{
      pin.removeClass("error");
      return true;
    }
    
  }
  function validateMobileno(){
    if(mobileno.val().length < 10){
      mobileno.addClass("error");return false;
    }
    else{
      mobileno.removeClass("error");return true;
    }
  }
  function validateEmail(){
    var a = $("#txtEmail").val();
    var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
    if(filter.test(a)){
      emailid.removeClass("error");
      return true;
    }
    else{
      emailid.addClass("error");      
      return false;
    }
  }
  function validateScheme(){
    if(ddlsch[0].selectedIndex == 0){
      ddlsch.addClass("error");     
      return false;
    }
    else{
      ddlsch.removeClass("error");    
      return true;
    }
  }
  setTimeout(function(){$('div.message').fadeOut(1000);}, 10000);
  
  
});
function setName()
{
  document.getElementById('ddlDistname').value = document.getElementById('ddlDistname').options[document.getElementById('ddlDistname').selectedIndex].text;
}
  function ChangeAmount()
  {
    if(document.getElementById('ddlSchDesc').selectedIndex != 0)
    {
      document.getElementById('spAmount').innerHTML = $("#ddlSchDesc")[0].options[document.getElementById('ddlSchDesc').selectedIndex].getAttribute("amount");
      document.getElementById('hid_scheme_amount').value = document.getElementById('spAmount').innerHTML;
    }
  } 
  function setLoadValues()
  {
    document.getElementById('ddlSchDesc').value = document.getElementById('hidScheme').value;   
    document.getElementById('ddlRetType').value = document.getElementById('hidRetType').value;    
    document.getElementById('ddlDistname').value = document.getElementById('hidParentID').value;        
    document.getElementById('ddlState').value = document.getElementById('hidStateID').value;        
    getCityNameOnLoad('<?php echo base_url()."local_area/getCity/"; ?>');       
  } 
</script>

</head>

<body onLoad="setLoadValues()">
<?php require_once("admin_menu.php"); ?> 


<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading">Edit Profile</div>
      <div class="panel-body">

        <?php
  if($this->session->flashdata('message')){
  echo "<div class='alert alert-danger'>".$this->session->flashdata('message')."</div>";}  
  if($message != ''){
  echo "<div class='alert alert-danger'>".$message."</div>";}
  $user_id = intval($this->Common_methods->decrypt($this->uri->segment(3)));

  if($user_id > 0)
  {
    $result_user = $this->db->query("select * from tblusers where user_id=?",array($user_id));  
  ?>

<form method="post" action="distributer_edit" name="frmdistributer_form1" id="frmdistributer_form1" autocomplete="off">
<input type="hidden" name="hiduserid" id="hiduserid" value="<?php echo $user_id; ?>" />



<div class="form-group">
<label for="txtDistname">Distibutor Name :</label>
<input type="text" class="form-control" title="Enter txtDistname Name." value="<?php echo $result_user->row(0)->business_name; ?>" id="txtDistname" name="txtDistname"  maxlength="100"/>
</div>

<div class="form-group">
<label for="ddlDistname">Under Master Distributor Name :</label>
<select id="ddlDistname" name="ddlDistname" class="form-control" title="Select Dealer Name.">
<option>--Select--</option>
<?php
    $str_query = "select * from tblusers where usertype_name = ? order by business_name";
    $result = $this->db->query($str_query,array('MasterDealer'));    
    for($i=0; $i<$result->num_rows(); $i++)
    {
      echo "<option value='".$result->row($i)->user_id  ."'>".$result->row($i)->business_name."</option>";
    }
?>
</select>
</div>

<input type="hidden" name="hidParentID" id="hidParentID" value="<?php echo $result_user->row(0)->parent_id; ?>" />

<div class="form-group">
<label for="txtPostalAddr">Postal Address :</label>
<textarea title="Enter Postal Address" id="txtPostalAddr" name="txtPostalAddr" class="form-control"><?php echo $result_user->row(0)->postal_address; ?></textarea>
</div>


<div class="form-group">
<label for="txtPin">Pin Code :</label>
<input type="text" class="form-control" id="txtPin" onKeyPress="return isNumeric(event);" value="<?php echo $result_user->row(0)->pincode; ?>" name="txtPin" maxlength="8" title="Enter Pin Code." />
</div>


<div class="form-group">
<label for="ddlState">State :</label>
<input type="hidden" name="hidStateCode" id="hidStateCode" />
<select class="form-control" id="ddlState" name="ddlState" onChange="getCityName('<?php echo base_url()."local_area/getCity/"; ?>')" title="Select State.<br />Click on drop down"><option value="0">Select State</option>
<?php
$str_query = "select * from tblstate order by state_name";
    $result = $this->db->query($str_query);   
    for($i=0; $i<$result->num_rows(); $i++)
    {
      echo "<option code='".$result->row($i)->codes."' value='".$result->row($i)->state_id."'>".$result->row($i)->state_name."</option>";
    }
?>
</select>
</div>



<input type="hidden" id="hidStateID" value="<?php echo $result_user->row(0)->state_id; ?>" /> 

<div class="form-group">
<label for="ddlCity">City/District :</label>
<select class="form-control" id="ddlCity" name="ddlCity" title="Select City.<br />Click on drop down"><option value="0">Select City</option>
</select>
<input type="hidden" id="hidCityID" value="<?php echo $result_user->row(0)->city_id; ?>" /> 
</div>

<div class="form-group">
<label for="txtMobNo">Mobile No :</label>
<input type="number" class="form-control" onKeyPress="return isNumeric(event);" title="Enter Mobile No.<br />e.g. 9898980000" id="txtMobNo" name="txtMobNo" value="<?php echo $result_user->row(0)->mobile_no; ?>" maxlength="10"/>
</div>



<div class="form-group">
<label for="txtLandNo">Alternate Number :</label>
<input type="text" class="form-control" id="txtLandNo" name="txtLandNo" value="<?php echo $result_user->row(0)->landline; ?>" onKeyPress="return isNumeric(event);" title="Enter Landline No.<br />e.g 07926453647" maxlength="11" />
</div>


<div class="form-group">
<label for="ddlRetType">Distributor Type :</label>
<select class="form-control" id="ddlRetType" name="ddlRetType" title="Select Distributor Type.<br />Click on drop down">
<option>Select Distributor Type</option>
<?php
$str_query = "select * from tblratailertype order by retailer_type_name";
    $result = $this->db->query($str_query);   
    for($i=0; $i<$result->num_rows(); $i++)
    {
      echo "<option value='".$result->row($i)->retailer_type_id."'>".$result->row($i)->retailer_type_name."</option>";
    }
?>
</select>
</div>


 <input type="hidden" id="hidRetType" value="<?php echo $result_user->row(0)->retailer_type_id; ?>" /> 



<div class="form-group">
<label for="txtEmail">Email :</label>
<input type="email" class="form-control" id="txtEmail" value="<?php echo $result_user->row(0)->emailid; ?>" title="Enter Email ID.<br />e.g some@gmail.com" name="txtEmail"  maxlength="150"/>

</div>



<div class="form-group">
<label for="txtpanNo">Pan No :</label>
<input type="text" name="txtpanNo" id="txtpanNo" class="form-control" value="<?php echo $result_user->row(0)->pan_no; ?>"/>
</div>


<div class="form-group">
<label for="txtConPer">Contact Person :</label>
<input type="text" class="form-control" id="txtConPer" title="Enter Contact No." name="txtConPer"  maxlength="150" value="<?php echo $result_user->row(0)->contact_person; ?>"/>
</div>



<div class="form-group">
<label for="ddlSchDesc">Scheme :</label>
<select class="form-control" id="ddlSchDesc" onChange="ChangeAmount()" title="Select Scheme Name.<br />Click on drop down" name="ddlSchDesc">
      <option>Select Scheme</option>
      <?php
$str_query = "select * from tblscheme where scheme_for='Distributor'";
    $resultScheme = $this->db->query($str_query);   
    for($i=0; $i<$resultScheme->num_rows(); $i++)
    {
      echo "<option amount='".$resultScheme->row($i)->amount."' value='".$resultScheme->row($i)->scheme_id."'>".$resultScheme->row($i)->scheme_name."</option>";
    }
?>
      </select>
</div>


     <input type="hidden" id="hidScheme" value="<?php echo $result_user->row(0)->scheme_id; ?>" /> 

      <input type="hidden" id="hid_scheme_amount" name="hid_scheme_amount" value="<?php echo $result_user->row(0)->scheme_amount;?>" />


      <input type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit" value="Update Details"/>

      <input type="reset" class="btn btn-primary" id="bttnCancel" name="bttnCancel" value="Cancel"/>
    
</form>
<?php }?>
  

 </div>
    </div>
</div>

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
 

</body>
</html>