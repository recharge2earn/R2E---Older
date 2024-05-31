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

    <title>Money Transfer </title>

   <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

 <?php include("app_css.php"); ?>
    
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
<?php include("dmr_menu.php"); ?>
    
    



  <div class="container">
        

    <div class="panel panel-primary">
      <div class="panel-heading">Money Transfer</div>
      <div class="panel-body">

      <?php
    if($this->session->flashdata('message')){
    echo "<div class='alert alert-danger'>".$this->session->flashdata('message')."</div>";} 
    if($message != ''){
    echo "<div class='alert alert-danger'>".$message."</div>";}
    ?>


            <form action="<?php echo base_url()."money_transfer"; ?>" method="post" autocomplete="off" name="frmChangePassword" id="frmChangePassword">
     
 <input type="hidden" name="hidSubmitRecharge" id="hidSubmitRecharge" /> 
      <input type="hidden" name="hidRechargeURL" id="hidRechargeURL" value="<?php echo base_url()."money_transfer"; ?>
      <input type="hidden" name="hidServiceId" id="hidServiceId" />        
    <input type="hidden" name="hidOperatorCode" id="hidOperatorCode" />            
    <input type="hidden" name="hidProduct_name" id="hidProduct_name" />            
    <input type="hidden" name="hidCircle" id="hidCircle" /> 
     <div class="form-group">
     <label for="sender_mobile">Sender Mobile:</label>
     <input class="form-control" required="" id="sender_mobile" name="sender_mobile"  placeholder="Please sender mobile " data-toggle="tooltip" title="Please Enter Mobile" type="number" />
     </div>
    
 
      <div class="form-group">
     <label for="ben_id">Beneficiary ID:</label>
     <input class="form-control" required="" id="ben_id" name="ben_id"  placeholder="Please enter Beneficiary ID" data-toggle="tooltip" title="Please enter Beneficiary ID" type="text" />
     </div>
     
          <div class="form-group">
     <label for="ddlOperator">Transfer Mode :</label>
       <select class="form-control" required="" id="ddlOperator" name="ddlOperator" onChange="SetParam()" tabindex="1" onchange="CheckSpecial('mob',this.value)"  title="Select Operator.<br />Click on drop down"><option value="0">Select Provider*</option>
 <?php
    $str_query = "select * from tblcompany where service_id='8' and company_id != 34 and company_id != 39  order by company_name";
    $result_mobile = $this->db->query($str_query);    
    for($i=0; $i<$result_mobile->num_rows(); $i++)
    {
      echo "<option path='".$result_mobile->row($i)->logo_path."' serviceid='".$result_mobile->row($i)->service_id."' product_name='".$result_mobile->row($i)->product_name."' operatorcode='".$result_mobile->row($i)->operator_code."'  value='".$result_mobile->row($i)->company_id."'>".    $result_mobile->row($i)->company_name."</option>";
    }
  ?>
    </select>
     </div>
     
     <div class="form-group">
     <label for="amount">Amount:</label>
     <input class="form-control" required="" id="amount" name="amount"  placeholder="Please enter Transfer Amount" data-toggle="tooltip" title="Please enter Transfer Amount" type="number" />
     </div>
   
<input type="submit" id="btnRecharge" name="btnRecharge" class="btn btn-primary" value="Transfer"><span id="wait_tip" style="display:none;"> Please wait...<img src="images/ajax-loader2.gif"
           id="loading_img"/></span>
          
          </form>

          </div>
    </div>
    </div>


<div class="container">
  <div class="panel panel-primary">
      <div class="panel-heading">Last 5 Transaction</div>
      <div class="panel-body">
  <?php
  echo '<div class="table-responsive"><table class="table">
  <thead>
          <tr>
    <tr>
    <th>TXID</th>
    <th>Mode</th>
    <th>Beneficiary ID</th>
    <th>Amount</th>
     <th>Status</th>
  <th>Bank Ref No</th> 
  <th>By</th>
    <th>Date Time</th>  

    </tr> </thead>
          <tbody>'
    ;
  $str_query_recharge = "select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany where tblcompany.company_id=tblrecharge.company_id and user_id=? and tblrecharge.company_id = '102' order by tblrecharge.recharge_id desc limit 0, 5";
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
    echo '<td>'.$resultRecharge->recharge_by.'</td>';
    echo '<td>'.$resultRecharge->recharge_date.'<br/>'.$resultRecharge->recharge_time.'</td>';
     
  echo '</td> ';
  echo '</tr>';   
    $i++;} 
    echo ' </tbody></table></div>'; ?>
  
  </div>
</div>
    </div><br />




      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>
 
</body>
</html>
