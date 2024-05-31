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

    <title>Postpaid Recharge</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">
 <?php include("app_css.php"); ?>
  
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script language="javascript">
  function complainadd(recahrge_id)
  {
    
    document.getElementById("hidcomplain").value = "Set";
    document.getElementById("recid").value = recahrge_id;
    document.getElementById("frmcomplain").submit();
  }
  </script>
  <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>


 <script>
 function get_otp()
{
   $.ajax({
     type: "GET",
     url: document.getElementById('hidURLotp').value,
     cache: false,
     success: function(html)
     {    
      $("#otp").html(html);
    }
  });
  $("#otp").fadeOut(1000);
  $("#otp").fadeIn(2000); 
} 
 function getMobileCompany()
 {document.getElementById('lblCLabel').innerHTML = 'Confirm Mobile No : ';document.getElementById('lblLabel').innerHTML = 'Mobile No : ';document.getElementById('lblChangeLabel').innerHTML = 'Mobile No : ';$.ajax({type: "GET",url: document.getElementById('hidCompanyURL').value,cache: false,success: function(html){$("#ddlOperator").html(html);}});
 }
 function getDTHCompany()
 {document.getElementById('lblCLabel').innerHTML = 'Confirm Smart No : ';document.getElementById('lblLabel').innerHTML = 'Smart No : ';document.getElementById('lblChangeLabel').innerHTML = 'Smart No : ';$.ajax({type: "GET",url: document.getElementById('hidDTHURL').value,cache: false,success: function(html){$("#ddlOperator").html(html);}});  
 }
  function getLAPUCompany()
 {document.getElementById('lblCLabel').innerHTML = 'Confirm Mobile No : ';document.getElementById('lblLabel').innerHTML = 'Mobile No : ';document.getElementById('lblChangeLabel').innerHTML = 'Mobile No : ';$.ajax({type: "GET",url: document.getElementById('hidLAPUCompanyURL').value,cache: false,success: function(html){$("#ddlOperator").html(html);}});
 }
 function getPOSTPAIDCompany()
 {
  document.getElementById('lblCLabel').innerHTML = 'Confirm Mobile No : ';document.getElementById('lblLabel').innerHTML = 'Mobile No : ';document.getElementById('lblChangeLabel').innerHTML = 'Mobile No : ';$.ajax({type: "GET",url: document.getElementById('hidPOSTPAIDCompanyURL').value,cache: false,success: function(html){$("#ddlOperator").html(html);}});
 }
  function get_live_data()
 {
   get_otp();
   $.ajax({type: "GET",url: document.getElementById('hidURL').value,cache: false,success: function(html){   
  $("#transaction_report").html(html);setTimeout(get_live_data,35000);}});
  $("#transaction_report").fadeOut(1000);$("#transaction_report").fadeIn(2000);
 }  
$(document).ready(function(){ 
  setTimeout(function(){$('div.message').fadeOut(1000);}, 15000);
  setTimeout(get_live_data,35000);                               
  //global vars
  var form = $("#frmRecharge");
  var btnRecharge = $("#btnRecharge");
  var m_cname = $("#ddlOperator");
  var m_no = $("#txtMobileNo");
  var cm_no = $("#txtCMobileNo");
  var m_amt = $("#txtAmount");
  var m_circle = $("#ddlCircleName"); 
  m_cname.focus();
  m_cname.blur(validates_mName);
  m_no.blur(validates_mNo);
  m_amt.blur(validates_mAmt);
  m_circle.blur(validates_mCircle);
  
  form.submit(function(){
    if(validates_mAmt() & validates_mCircle() & validates_mName() & validates_mNo() & validates_cmNo())
      { 
      document.getElementById("hidSubmitRecharge").value = "Success";     
      return true;
      }
    else
      return false;
  });
                   
function validates_mAmt(){if(m_amt.val() == ""){m_amt.addClass("error");return false;}else{m_amt.removeClass("error");return true;}}  
function validates_mCircle(){if(m_circle[0].selectedIndex == 0){m_circle.addClass("error");return false;}else{m_circle.removeClass("error");return true;}}    
function validates_mName(){if(m_cname[0].selectedIndex == 0){m_cname.addClass("error");return false;}else{m_cname.removeClass("error");return true;}}
function validates_mNo(){if(m_no.val() == ""){m_no.addClass("error");return false;}else{m_no.removeClass("error");return true;}}        
  
  function validates_cmNo()
  {
    if(cm_no.val() == "")
    {
      cm_no.addClass("error");
      return false;
    }
    else
    {
      cm_no.removeClass("error");
      return true;
    }
  }       
  });
function SetCircleParam(){if(document.getElementById('ddlCircleName').selectedIndex != 0){document.getElementById('hidCircle').value = $("#ddlCircleName")[0].options[document.getElementById('ddlCircleName').selectedIndex].getAttribute('circle_code');}}  
function SetParam(){if(document.getElementById('ddlOperator').selectedIndex != 0){document.getElementById('hidServiceId').value = $("#ddlOperator")[0].options[document.getElementById('ddlOperator').selectedIndex].getAttribute('serviceid');document.getElementById('hidOperatorCode').value = $("#ddlOperator")[0].options[document.getElementById('ddlOperator').selectedIndex].getAttribute('operatorcode');document.getElementById('hidProduct_name').value = $("#ddlOperator")[0].options[document.getElementById('ddlOperator').selectedIndex].getAttribute('product_name');}document.getElementById('companyImg').src='images/Logo/'+$("#ddlOperator")[0].options[document.getElementById('ddlOperator').selectedIndex].getAttribute('path');}  
  </script>    
    <script language="javascript">
  function setdefaultcircle()
  {
    document.getElementById("ddlCircleName").value  =<?php echo $state_id; ?>;
    document.getElementById("hidCircle").value = <?php echo $circle_code; ?>
  }
  </script>
  <script type="text/javascript">
   function getId(id) { 
       return document.getElementById(id); 
   } 
   function validation() { 
       getId("btnRecharge").style.display="none"; 
       getId("wait_tip").style.display=""; 
       return true; 
   } 
</script>
</head>
<body onLoad="setdefaultcircle()"> 
 <?php include("menu.php"); ?>
  
    
    <br />
   
<?php include("service_tab_menu.php"); ?>

<div class="container">

   <?php
  if($this->session->flashdata('message')){
  echo "<div class='alert alert-danger fade in'>".$this->session->flashdata('message')."</div>";} 
  if($message != ''){
  echo "<div class='alert alert-danger fade in'>".$message."</div>";}
  ?>
    <div class="panel panel-primary">
      <div class="panel-heading">POST PAID RECHARGE</div>
      <div class="panel-body">      <form action="<?php echo base_url()."postpaid"; ?>" method="post" name="frmRecharge" id="frmRecharge" autocomplete="on" onsubmit="return validation();"> 
    <input type="hidden" name="hidSubmitRecharge" id="hidSubmitRecharge" /> 
      <input type="hidden" name="hidRechargeURL" id="hidRechargeURL" value="<?php echo base_url()."dth"; ?>
      <input type="hidden" name="hidServiceId" id="hidServiceId" />        
    <input type="hidden" name="hidOperatorCode" id="hidOperatorCode" />            
    <input type="hidden" name="hidProduct_name" id="hidProduct_name" />            
    <input type="hidden" name="hidCircle" id="hidCircle" />      
      
     
     <input class="form-control" required="" id="txtMobileNo" name="txtMobileNo" value="txtMobileNo" data-toggle="tooltip" title="Please Enter Postpaid Number" placeholder="Please Enter Postpaid Number*" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10"/><br />
     
       <select class="form-control" required="" id="ddlState" name="ddlOperator" onChange="SetParam()"  title="Select Operator.<br />Click on drop down"><option value="0">Select Operator*</option>
 <?php
    $str_query = "select * from tblcompany where service_id='4' and company_id != 34 and company_id != 39  order by company_name";
    $result_mobile = $this->db->query($str_query);    
    for($i=0; $i<$result_mobile->num_rows(); $i++)
    {
      echo "<option path='".$result_mobile->row($i)->logo_path."' serviceid='".$result_mobile->row($i)->service_id."' product_name='".$result_mobile->row($i)->product_name."' operatorcode='".$result_mobile->row($i)->operator_code."'  value='".$result_mobile->row($i)->company_id."'>".    $result_mobile->row($i)->company_name."</option>";
    }
  ?>
    </select><br />
     
     <input class="form-control" required="" id="txtAmount" name="txtAmount" value="txtAmount" placeholder="Amount" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "4"/><br />
     
   
<input type="submit" id="btnRecharge" name="btnRecharge" class="btn btn-primary" value="Recharge"><span id="wait_tip" style="display:none;"> Please wait...<img src="images/ajax-loader2.gif"
           id="loading_img"/></span>
          </from></div>
    </div></div>
  
  <div class="container"> <div class="row">
  
  <div class="col-sm-12"><br />
  <?php
  echo '<div class="table-responsive"><table class="table">
  <thead>
          <tr>
    <tr>
    <th>TXID</th>
    <th>Operator</th>
    <th>Number</th>
    <th>Amount</th>
     <th>Status</th>
  <th>Operator Id</th>    
    <th>Date Time</th>  

    </tr> </thead>
          <tbody>'
    ;
  $str_query_recharge = "select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany where tblcompany.company_id=tblrecharge.company_id and user_id=? order by tblrecharge.recharge_id desc limit 0, 4";
  $result_recharge = $this->db->query($str_query_recharge,array($this->session->userdata('id')));   
  $i = 0;
  foreach($result_recharge->result() as $resultRecharge)  { 
    echo '<tr'; 
    if($i%2 == 0){
      echo "row1"; 
      }
      else{ 
      echo "row2";
      }
    echo '">';
    echo '<td>'.$resultRecharge->recharge_id.'</td>';
        echo '<td>'.$resultRecharge->company_name.'</td>';
    echo '<td>'.$resultRecharge->mobile_no.'</td>';
    echo '<td>'.$resultRecharge->amount.'</td>';
          
    echo '<td>';
    if($resultRecharge->recharge_status == "Pending") { echo '<span style="color:orange;">Pending</span>'; }  
    if($resultRecharge->recharge_status == 'Success') { echo '<span style="color:green;">Success</span>'; }  
    if($resultRecharge->recharge_status == 'Failure') { echo '<span style="color:red;">Failure</span>'; }     
    echo '</td>';
    echo '<td>'.$resultRecharge->operator_id.'</td>';
    echo '<td>'.$resultRecharge->recharge_date.'<br/>'.$resultRecharge->recharge_time.'</td>';
     
  echo '</td> ';
  echo '</tr>';   
    $i++;} 
    echo ' </tbody></table></div>'; ?>
  
  </div>
</div>
    </div><br />
    <!-- Login Area End -->

    <!-- Copyright Area Start -->
    <?php include("footer.php"); ?>
    <!-- Copyright Area End -->

    <!-- Back To Top Button Start -->
    <div id="backToTop">
        <a href="body" data-animate-scroll="true"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- Back To Top Button End -->
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
