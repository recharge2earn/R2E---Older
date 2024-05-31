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

    <title>Insurance Payment</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">
 <?php include("app_css.php"); ?>
  
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
  <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
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

<script type="text/javascript">
    function ShowHideDiv() {
        var ddlOperator= document.getElementById("ddlOperator");
        var CYCLE= document.getElementById("CYCLE");
        CYCLE.style.display = ddlOperator.value == "71" ? "block" : "none";
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
      <div class="panel-heading">INSURANCE PAYMENT</div>
      <div class="panel-body"> 
      <form action="<?php echo base_url()."electricity"; ?>" method="post" name="frmRecharge" id="frmRecharge" autocomplete="on" onsubmit="return validation();"> 


      <div class="form-group">
      <label for="txtMobileNo">Policy Number :</label>
    <input class="form-control" required="" id="txtMobileNo" name="txtMobileNo" value="txtMobileNo" data-toggle="tooltip" title="Please Enter Policy Number" placeholder="Please Enter Customer Policy Number*"  type = "number"/>
    </div>
     

     <div class="form-group">
     <label for="ddlOperator">Insurance Provider :</label>
       <select class="form-control" onchange = "ShowHideDiv()" required="" id="ddlOperator" name="ddlOperator" onChange="SetParam()" tabindex="1" onchange="CheckSpecial('mob',this.value)"  title="Select Operator.<br />Click on drop down"><option value="0">Select Operator*</option>
 <?php
    $str_query = "select * from tblcompany where service_id='7' and company_id != 34 and company_id != 39  order by company_name";
    $result_mobile = $this->db->query($str_query);    
    for($i=0; $i<$result_mobile->num_rows(); $i++)
    {
      echo "<option path='".$result_mobile->row($i)->logo_path."' serviceid='".$result_mobile->row($i)->service_id."' product_name='".$result_mobile->row($i)->product_name."' operatorcode='".$result_mobile->row($i)->operator_code."'  value='".$result_mobile->row($i)->company_id."'>".    $result_mobile->row($i)->company_name."</option>";
    }
  ?>
    </select>

    </div>
    
     <div class="form-group">
     <label for="txtAmount">Amount :</label>
     <input class="form-control" required="" id="txtAmount" name="txtAmount" value="txtAmount" placeholder="Amount" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "4"/>
     </div>


<div class="form-group">
     <label for="txtAmount">Date of Birth:</label>
     <input class="form-control" required="" id="txtAmount" name="dob" value="dob" placeholder="Date of birth" type = "date" />
     </div>
   

<div class="form-group" id="CYCLE" style="display: none">
     <label for="CYCLE">CYCLE:</label>
     <input class="form-control" required="" id="CYCLE" name="CYCLE" value="CYCLE" placeholder="CYCLE" type = "text" />
     </div>

<input type="submit" id="btnRecharge" name="btnRecharge" class="btn btn-primary" value="Recharge"><span id="wait_tip" style="display:none;"> Processing...<img src="images/ajax-loader2.gif"
           id="loading_img"/></span> 
          </from>
          
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
    <th>Operator</th>
    <th>Number</th>
    <th>Amount</th>
     <th>Status</th>
  <th>Operator Id</th> 
  <th>Recharge By</th>
    <th>Date Time</th>  

    </tr> </thead>
          <tbody>'
    ;
  $str_query_recharge = "select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany where tblcompany.company_id=tblrecharge.company_id and user_id=? order by tblrecharge.recharge_id desc limit 0, 5";
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

    <?php include("footer.php"); ?>
    <!-- Copyright Area End -->

    <!-- Back To Top Button Start -->
    <div id="backToTop">
        <a href="body" data-animate-scroll="true"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- Back To Top Button End -->
<?php include("app_js.php"); ?>

     
</body>
</html>
