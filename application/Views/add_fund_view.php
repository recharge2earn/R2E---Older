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

    <title>Payment Request</title>

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
			reqamt.removeClass("error");return true;}		}
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
    
    
    <br />
  <div class="container">
     
   <?php
	if($this->session->flashdata('message')){
	echo "<div class='alert alert-danger fade in'>".$this->session->flashdata('message')."</div>";}	
	if($message != ''){
	echo "<div class='alert alert-danger fade in'>".$message."</div>";}
	?>
    <div class="panel panel-primary">
      <div class="panel-heading">PAYMENT REQUEST</div>
      <div class="panel-body">      <form action="<?php echo base_url()."add_fund"; ?>" method="post" autocomplete="off" name="frmChangePassword" id="frmChangePassword">
     
     <input class="form-control" required="" id="txtReqamt" name="txtReqamt"  placeholder="Request Amount" data-toggle="tooltip" title="Please Enter Amount" placeholder="Amount*" type = "number" /><br />
     
    
      <input class="form-control" required="" id="txtChaqueno" name="txtChaqueno"  placeholder="Bank Ref no." data-toggle="tooltip" title="Please Enter Bank Ref no." placeholder="Bank Ref number*" type = "text" /><br />
      
      <input class="form-control" required="" id="txtPaymentdate" name="txtPaymentdate"  placeholder="Payment Date" data-toggle="tooltip" title="Please enter Date" type = "text"  /><br />
      
      <select class="form-control" required="" id="ddlDepositBank" name="ddlDepositBank" onChange="setAccount()" title="Select Bank.<br />Click on drop down"><option value="0">Payment Mode*</option>
<?php
$str_query = "select tbluser_bank.*,(select bank_name from tblbank where bank_id = tbluser_bank.bank_id) as bank_name from tbluser_bank order by user_bank_id";
		$result = $this->db->query($str_query);		
		foreach($result->result() as $rw)
		{
			echo "<option account_no='".$rw->account_number."' branch_name='".$rw->branch_name."' ifsc_code='".$rw->ifsc_code."' value='".$rw->bank_name."'>".$rw->bank_name."</option>";
		}
?>
</select>

<span id="deposit_account_no" style="font-weight:bold;" class="text-danger"></span>
<br />
      
   <textarea class="form-control" required="" id="txtRemarks" name="txtRemarks"  placeholder="Your Bank Name, Account number , mobile number or remark." data-toggle="tooltip" title="Your Bank Name, Account number , mobile number or remark.." placeholder="Your Bank Name, Account number , mobile number or remark.*" ></textarea><br />
   
<input type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" value="Submit"><span id="wait_tip" style="display:none;"> Please wait...<img src="images/ajax-loader2.gif"
           id="loading_img"/></span>
          </from></div>
    </div></div>
  

 <div class="panel panel-success">
      <div class="panel-heading">Payment History</div>
      <div class="panel-body"> <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Status</th>
        <th>Amount</th>
        <th>Mode</th>
        <th>Bank Ref. No.</th>
        <th>Response</th>
        <th>Date</th>
      </tr>
    </thead>
    <?php	$i = 0;foreach($result_payment->result() as $result) 	{  ?>
			<tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">
    <tbody>
      <tr>
        <td><?php if($result->request_status == "Pending"){echo '<button type="button" class="btn btn-info">In Process</button>';} ?>
  <?php if($result->request_status == "Success"){echo '<button type="button" class="btn btn-success">Success</button>';} ?>
  <?php if($result->request_status == "Cancel"){echo '<button type="button" class="btn btn-danger">Rejected</button>';} ?></td>
        <td><?php echo $result->request_amount; ?></td>
        <td><?php echo $result->payment_mode; ?></td>
        <td><?php echo $result->cheque_no; ?></td>
        <td><?php echo $result->deposit_remark; ?></td>
        <td> <?php echo $result->add_date; ?></td>
      </tr><?php 	
		$i++;} ?>
    </tbody>
  </table>
  </div>
</div></div>
    </div>

    <!-- Copyright Area Start -->
    <?php include("footer.php"); ?>
    <!-- Copyright Area End -->

    <!-- Back To Top Button Start -->
    <div id="backToTop">
        <a href="body" data-animate-scroll="true"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- Back To Top Button End -->
 <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
    <?php include("app_js.php"); ?>
     <script>
            $(document).ready(function(){

                //* boxes animation
                form_wrapper = $('.login_box');
                function boxHeight() {
                    form_wrapper.animate({ marginTop : ( - ( form_wrapper.height() / 2) - 24) },400);
                };
                form_wrapper.css({ marginTop : ( - ( form_wrapper.height() / 2) - 24) });
                $('.linkform a,.link_reg a').on('click',function(e){
                    var target  = $(this).attr('href'),
                    target_height = $(target).actual('height');
                    $(form_wrapper).css({
                        'height'        : form_wrapper.height()
                    });
                    $(form_wrapper.find('form:visible')).fadeOut(400,function(){
                        form_wrapper.stop().animate({
                            height   : target_height,
                            marginTop: ( - (target_height/2) - 24)
                        },500,function(){
                            $(target).fadeIn(400);
                            $('.links_btm .linkform').toggle();
                            $(form_wrapper).css({
                                'height'        : ''
                            });
                        });
                    });
                    e.preventDefault();
                });

                //* validation
                $('#login_form').validate({
                    onkeyup: false,
                    errorClass: 'error',
                    validClass: 'valid',
                    rules: {
                        username: { required: true, minlength: 3 },
                        password: { required: true, minlength: 3 }
                    },
                    highlight: function(element) {
                        $(element).closest('div').addClass("f_error");
                        setTimeout(function() {
                            boxHeight()
                        }, 200)
                    },
                    unhighlight: function(element) {
                        $(element).closest('div').removeClass("f_error");
                        setTimeout(function() {
                            boxHeight()
                        }, 200)
                    },
                    errorPlacement: function(error, element) {
                        $(element).closest('div').append(error);
                    }
                });
            });
        </script>
</body>
</html>
