<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Distributor Registration Form</title>
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

function getAreaName(urlToSend)
    {
        if(document.getElementById('ddlCity').selectedIndex != 0)
        {
        $.ajax({
  type: "GET",
  url: urlToSend+""+document.getElementById('ddlCity').value,
  success: function(html){
      var html = "<option value='0'>Select Area</option>"+html+"<option value='0'>Other</option>";
    $("#ddlArea").html(html);
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
    function ChangeAmount()
    {
        if(document.getElementById('ddlSchDesc').selectedIndex != 0)
        {
            document.getElementById('spAmount').innerHTML = $("#ddlSchDesc")[0].options[document.getElementById('ddlSchDesc').selectedIndex].getAttribute("amount");
            document.getElementById('hid_scheme_amount').value = document.getElementById('spAmount').innerHTML;
        }
    }   
</script>
    <script language="javascript">
    function selectddlvalue()
    {
        var state_id = '<?php echo $regData['state_id']; ?>';
        var city_id = '<?php echo $regData['city_id']; ?>';
        var retailer_type_id = '<?php echo $regData['retailer_type_id']; ?>';
        var scheme_id = '<?php echo $regData['scheme_id']; ?>';
        var parent_id = '<?php echo $regData['parent_id']; ?>';
        document.getElementById("ddlState").value = state_id;
        
        document.getElementById("ddlRetType").value = retailer_type_id;
        document.getElementById("ddlSchDesc").value = scheme_id;
        document.getElementById("ddlDistname").value = parent_id;
        var urlToSend = '<?php echo base_url()."local_area/getCity/"; ?>';
        $.ajax({
  type: "GET",
  url: urlToSend+""+document.getElementById('ddlState').value,
  success: function(html){
    $("#ddlCity").html(html);
    document.getElementById("ddlCity").value = city_id;
  }
});

    }
    
    </script>
</head>

<body onLoad="selectddlvalue()">

<?php require_once("menu.php"); ?> 


<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading">Distributor Registration</div>
      <div class="panel-body">

        <?php
    if($this->session->flashdata('message')){
    echo "<div class='alert alert-danger'>".$this->session->flashdata('message')."</div>";}    
    if($message != ''){
    echo "<div class='alert alert-danger'>".$message."</div>";}
    ?>
<form method="post" action="d_dealer_form1" name="frmdistributer_form1" id="frmdistributer_form1" autocomplete="off">


<div class="form-group">

<label for="txtDistname">Distributor Name :</label>
<input type="text" class="form-control" required="" title="Enter Dealer Name." id="txtDistname" name="txtDistname" value="<?php echo $regData['distributer_name']; ?>"  maxlength="100"/>
</div>


<div class="form-group">
<label for="txtPostalAddr">Postal Address :</label>
<textarea title="Enter Postal Address" id="txtPostalAddr" name="txtPostalAddr" class="form-control" required="" ><?php echo $regData['postal_address']; ?></textarea>
</div>


<div class="form-group">
<label for="txtPin">Pin Code :</label>
<input type="text" class="form-control" required="" id="txtPin" onKeyPress="return isNumeric(event);" name="txtPin" maxlength="8" title="Enter Pin Code." value="<?php echo $regData['pincode']; ?>"/>
</div>

<div class="form-group">
<label for="ddlState">State :</label>
<input type="hidden" name="hidStateCode" id="hidStateCode" />
<select class="form-control" required="" id="ddlState" name="ddlState" onChange="getCityName('<?php echo base_url()."local_area/getCity/"; ?>')" title="Select State.<br />Click on drop down">
<option value="0">Select State</option>
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





<input type="hidden" class="form-control"  id="ddlCity" name="ddlCity" value="0" />

<div class="form-group">
<label for="txtMobNo">Mobile No :</label>
<input type="number" class="form-control" required="" onKeyPress="return isNumeric(event);" title="Enter Mobile No.<br />e.g. 9898980000" id="txtMobNo" name="txtMobNo" maxlength="10"  value="<?php echo $regData['mobile_no']; ?>"/>
</div>

<div class="form-group">
<label for="txtLandNo">Alternate Number :</label>
<input type="number" class="form-control" required="" id="txtLandNo" name="txtLandNo" onKeyPress="return isNumeric(event);" title="Enter Landline No.<br />e.g 07926453647" maxlength="11" value="<?php echo $regData['landline']; ?>"/>
</div>


<div class="form-group">
<label for="ddlRetType">Business Type :</label>
<select class="form-control" required="" id="ddlRetType" name="ddlRetType" title="Select Retailer Type.<br />Click on drop down">
<option>Select Retailer Type</option>
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


<div class="form-group">
<label for="txtEmail">Email :</label>
<input type="email" class="form-control" required="" id="txtEmail" title="Enter Email ID.<br />e.g some@gmail.com" name="txtEmail"  maxlength="150" value="<?php echo $regData['emailid']; ?>"/>
</div>



<div class="form-group">
<label for="txtpanNo">Pan No :</label>
<input type="text" name="txtpanNo" id="txtpanNo" class="form-control" value="<?php echo $regData['pan_no']; ?>"/>
</div>


<div class="form-group">
<label for="txtConPer">Contact Person :</label>
<input type="text" class="form-control" required="" id="txtConPer" title="Enter Contact No." name="txtConPer"  maxlength="150" value="<?php echo $regData['contact_person']; ?>"/>
</div>


<div class="form-group">
<label for="ddlSchDesc">Scheme :</label>
<select class="form-control" required="" id="ddlSchDesc" onChange="ChangeAmount()" title="Select Scheme Name.<br />Click on drop down" name="ddlSchDesc">
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

      <input type="hidden" id="hid_scheme_amount" name="hid_scheme_amount" />
    
  
  <input type="hidden" title="Enter Opening Balance.<br />e.g 1500,2500" onKeyPress="return isNumeric(event);" class="form-control" required="" id="txtWorLimit" name="txtWorLimit" maxlength="50" value="0"/>


    <input type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit" value="Submit Details"/>
      <input type="reset" class="btn btn-primary" id="bttnCancel" name="bttnCancel" value="Cancel"/>
</form>

      </div>
    </div>
</div>

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?> 



</body>




</html>