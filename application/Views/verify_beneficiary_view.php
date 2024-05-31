<?php
$us_id = $this->session->userdata("id");
$rslt = $this->db->query("select * from tblusers where user_id = '$us_id'");
$state_id = $rslt->row(0)->state_id;
$rslt1 = $this->db->query("select * from tblstate where state_id = '$state_id'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Verify Beneficiary </title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

   <?php include("app_css.php"); ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="txtPaymentdate"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'dd/mm/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>
   <script>
    $(document).ready(function(){
    //global vars
    $( "#txtPaymentdate,#txtChaquedate" ).datepicker({dateFormat:'yy-mm-dd'});
    var form = $("#frmPayment");
    var reqamt = $("#txtReqamt");   
    var paymentdate = $("#txtPaymentdate");
    var ddlpaymod = $("#ddlPaymod");
    var chaqueno = $("#txtChaqueno");
    var chaquedate = $("#txtChaquedate");                       
    var depositBank = $("#ddlDepositBank");
    var depositTime = $("#ddlDeptime");                     
    //On Submitting
    form.submit(function(){
        if(validateRequestamount() & validatePaymentdate() & validatePaymentmod() & validatesDepositBankName() & validatesChaqueNumber() & validatesChaqueDate())
            {               
            return true;
            }
        else
            return false;
    });
    //validation functions
    function validateRequestamount(){
        if(reqamt.val() == ""){reqamt.addClass("error");return false;}
        else{
            if(reqamt.val() < 1000){alert("Minimum amount require 1000.");reqamt.addClass("error");}
            else{
            reqamt.removeClass("error");return true;}       }
    }
    function validatePaymentdate(){
        if(paymentdate.val() == ""){paymentdate.addClass("error");return false;}
        else{paymentdate.removeClass("error");return true;}     
    }
    function validatePaymentmod(){
        if(ddlpaymod[0].selectedIndex == 0){ddlpaymod.addClass("error");return false;}
        else{ddlpaymod.removeClass("error");return true;
        }
    }       
    function validatesDepositBankName(){    
        if(depositBank[0].selectedIndex == 0){depositBank.addClass("error");return false;}
        else{depositBank.removeClass("error");return true;}
    }   
    function validatesChaqueNumber(){
        if(chaqueno.val() == ""){chaqueno.addClass("error");return false;}
        else{chaqueno.removeClass("error");return true;}
    }
    function validatesChaqueDate(){ 
        if(chaquedate.val() == ""){chaquedate.addClass("error");return false;}
        else{chaquedate.removeClass("error");return true;}
    }           
});
        function  setAccount()
    {
        if(document.getElementById('ddlDepositBank').selectedIndex != 0)
        {
            var varAccount_no=$("#ddlDepositBank")[0].options[document.getElementById('ddlDepositBank').selectedIndex].getAttribute('account_no');
            var varBranch_name=$("#ddlDepositBank")[0].options[document.getElementById('ddlDepositBank').selectedIndex].getAttribute('branch_name');
            var varIfsc_code=$("#ddlDepositBank")[0].options[document.getElementById('ddlDepositBank').selectedIndex].getAttribute('ifsc_code');            
            document.getElementById('deposit_account_no').innerHTML = "<br />Account No : "+varAccount_no+"<br />IFSC Code : "+varIfsc_code+"<br />Branch Name : "+varBranch_name;
        }
        else{document.getElementById('deposit_account_no').innerHTML="";}
    }

    function ChangeForm()
    {
        if(document.getElementById('ddlPaymod').value == 'Cash')
        {
            document.getElementById('txtChaquedate').disabled = true;
            document.getElementById('txtChaqueno').disabled = true;
            document.getElementById('txtChaqueno').value = '-';
            document.getElementById('txtChaquedate').value = '-';   
            document.getElementById("ddlClientBank").disabled = true;       
        }
        else
        {
            document.getElementById('txtChaquedate').disabled = false;
            document.getElementById('txtChaqueno').disabled = false;
            document.getElementById("ddlClientBank").disabled = false;
            document.getElementById('txtChaqueno').value = '';
            document.getElementById('txtChaquedate').value = '';                        
        }
    }
    </script>
</head>
<body onLoad="setdefaultcircle()"> 
<?php include("menu.php"); ?>
 <?php include("dmr_menu.php"); ?>
    
    



  <div class="container">
        
    <div class="panel panel-primary">
      <div class="panel-heading">Verify Beneficiay </div>
      <div class="panel-body">

      <?php
    if($this->session->flashdata('message')){
    echo "<div class='alert alert-danger'>".$this->session->flashdata('message')."</div>";} 
    if($message != ''){
    echo "<div class='alert alert-danger'>".$message."</div>";}
    ?>


            <form action="<?php echo base_url()."verify_beneficiary"; ?>" method="post" autocomplete="off" name="frmChangePassword" id="frmChangePassword">
     

     <div class="form-group">
     <label for="sender_mobile">Sender Mobile:</label>
     <input class="form-control" required="" id="sender_mobile" name="sender_mobile"  placeholder="Please sender mobile " data-toggle="tooltip" title="Please Enter Mobile" type="number" />
     </div>
    
 
      <div class="form-group">
     <label for="ben_id">Beneficiary ID:</label>
     <input class="form-control" required="" id="ben_id" name="ben_id"  placeholder="Please enter Beneficiary ID" data-toggle="tooltip" title="Please enter Beneficiary ID" type="text" />
     </div>
     
   
     
     <div class="form-group">
     <label for="otp">OTP:</label>
     <input class="form-control" required="" id="otp" name="otp"  placeholder="Please enter OTP Code" data-toggle="tooltip" title="Please enter OTP Code" type="text" />
     </div>
   
<input type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" value="Submit"><span id="wait_tip" style="display:none;"> Please wait...<img src="images/ajax-loader2.gif"
           id="loading_img"/></span>
          
          </form>

          </div>
    </div>
    </div>


      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
 
</body>
</html>
