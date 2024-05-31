<?php
    $scheme_info = $this->Userinfo_methods->getSchemeInfo($this->Common_methods->decrypt($this->uri->segment(3)));
    if($scheme_info->num_rows() == 1)
    {
      $schemeType = $scheme_info->row(0)->scheme_type;
      $flat_commission = $scheme_info->row(0)->flat_commission;
    }
    else
    {
      $schemeType = '';
    }
    
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->Common_methods->decrypt($this->uri->segment(5)); ?> Balance</title>
 
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>   
 

    <script>
$(document).ready(function(){
  //global vars
  var form = $("#frmBalance");
  var amount = $("#txtAmount");
  var remark = $("#txtRemark");

  amount.focus();
  amount.blur(validatesAmount);
  form.submit(function(){
    if(validatesAmount() & validatesRemark() & validateCheckbox())
      {
        if(Check() == false)
        {
          return false;
        }
      }
    else
      return false;
  });
  function validatesAmount(){
    if(amount.val() == ""){
      amount.addClass("error");
      return false;
    }
    //if it's valid
    else{
      amount.removeClass("error");
      return true;
    }
  }
  function validatesRemark(){
    if(remark.val() == ""){
      remark.addClass("error");
      return false;
    }
    //if it's valid
    else{
      remark.removeClass("error");
      return true;
    }
  }
  function validateCheckbox()
  {
    
        var chkBox = document.getElementById('credit');
      if (chkBox.checked)
    {
      document.getElementById("hidpaymentType").value = "credit";
    }
    else
    {
      document.getElementById("hidpaymentType").value = "cash";
    }
    return true;
        
  }
});
  function Check()
  {   
    if(confirm("are you sure? you want to process balance for ["+document.getElementById('dname').innerHTML+"]") == true)
    {
  document.getElementById("frmBalance").submit();
  
    }
    else
    {
      return false;
    }
  }
  $(".checkbox").change(function() {
    if(this.checked) {
        alert("hi");
    }
});
  </script>
    <script language="javascript">
  function getFlatCommission()
  {
    var amount = document.getElementById("txtAmount").value; 
    var comPer = '<?php echo $flat_commission; ?>';
    var commAmount = (amount * comPer) / 100;
    document.getElementById("txtFlatComm").innerHTML = commAmount; 
    
  }
  function clear()
  {
    document.getElementById("txtFlatComm").innerHTML = 0; 
    document.getElementById("txtAmount").innerHTML = 0; 
  }
  </script>
</head>
<body onLoad="clear()">
<?php include("admin_menu.php"); ?>
<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading"><?php echo $this->Common_methods->decrypt($this->uri->segment(5)); ?> Balance</div>
      <div class="panel-body">

    <?php
  if ($message != ''){echo "<div class='alert alert-danger'>".$message."</div>"; }
  if(isset($result_users))
  {
  if($result_users->num_rows() == 1)
  {
  ?>    
   


    <form action="" method="post" name="frmBalance" id="frmBalance">
    <input type="hidden" value="<?php echo $result_users->row(0)->user_id; ?>" name="hidUserID" id="hidUserID" />
    <input type="hidden" value="<?php echo $this->uri->segment(4); ?>" name="hidRetailer" id="hidRetailer" />
     <input type="hidden" id="hidpaymentType" name="hidpaymentType" />
    
<table class="table table-hover">
    <tr>
    <td>Current Balance :</td> 
    <td><?php  echo $BalanceAmount;?></td>
    </tr>

    <tr>
    <td> Name :</td> <td id="dname"><?php echo $result_users->row(0)->business_name; ?></td>
    </tr>
    <?php if($result_users->row(0)->usertype_name == ('Distributor' or 'MasterDealer')) {?>
    <tr>
  <td>Postal Address :</td>    
    <td><?php echo $result_users->row(0)->postal_address; ?></td>
    </tr>    
    <?php } ?>
    <tr>
  <td>Mobile :</td>
     <td><?php echo $result_users->row(0)->mobile_no; ?></td>
    </tr>
    <tr>
    <td>Email ID :</td>    
     <td><?php echo $result_users->row(0)->emailid; ?></td>
    </tr>
     
    <?php if($this->Common_methods->decrypt($this->uri->segment(5)) == "Add" and $schemeType =="flat"){ ?>
        <tr>
        <td><?php echo $this->Common_methods->decrypt($this->uri->segment(5)); ?> Amount :</td>    
         <td><input type="number" maxlength="10" onKeyPress="return isNumeric(event);" title="Enter Amount." class="form-control" name="txtAmount" id="txtAmount" onKeyUp="getFlatCommission()"/></td>
        </tr>
        <tr> 
         <td>Flat Commission :</td>      
         <td><span id="txtFlatComm"></span> </td>
        </tr>
    <?php }else{ ?>
      <tr>
      <td><?php echo $this->Common_methods->decrypt($this->uri->segment(5)); ?> Amount :</td>    
      <td><input type="number" placeholder="Please enter Transfer amount" maxlength="6" onKeyPress="return isNumeric(event);" title="Enter Amount." class="form-control" name="txtAmount" id="txtAmount"/></td>
      </tr>
    <?php }?>
    <tr>
    <td>Remark</td>    
     <td><input type="text" title="Enter Remark." placeholder="Please enter comment" class="form-control" name="txtRemark" id="txtRemark" /></td>
    </tr>
   
    
     
<tr>
<td><input type="submit" class="btn btn-primary" name="btnSubmit" id="btnSubmit" value="<?php echo $this->Common_methods->decrypt($this->uri->segment(5)); ?>" />
    </td>
    </tr>
    </table>     
        </form>
       
        <?php }else{echo "No Data Found.";} }?>
  </div>
    </div>
</div>

      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>

</body>
</html>