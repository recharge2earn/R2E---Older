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

    <title>Recharge Zone</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

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

function statuschecking(value)
	{
		document.getElementById("divstatus"+value).style.display = "none";
		document.getElementById("divprocess"+value).style.display = "block";
		$.ajax({
			url:'<?php echo base_url()."rec_status/test?id=";?>'+value,
			type:'post',
			cache:false,
			success:function(html)
			{
				if(html == "gtid is wrong.")
				{
					document.getElementById("sts"+value).innerHTML = "Failure";
				}
				else
				{
					document.getElementById("sts"+value).innerHTML = html;
				}
				document.getElementById("divstatus"+value).style.display = "block";
				document.getElementById("divprocess"+value).style.display = "none";
			}
			});
		
	}
	function disputechecking(value)
	{
		document.getElementById("divstatus"+value).style.display = "none";
		document.getElementById("divprocess"+value).style.display = "block";
		$.ajax({
			url:'<?php echo base_url()."dispute/test?id=";?>'+value,
			type:'post',
			cache:false,
			success:function(html)
			{
				if(html == "gtid is wrong.")
				{
					document.getElementById("dsp"+value).innerHTML = "Failure";
				}
				else
				{
					document.getElementById("dsp"+value).innerHTML = html;
				}
				document.getElementById("divstatus"+value).style.display = "block";
				document.getElementById("divprocess"+value).style.display = "none";
			}
			});
		
	}
</script>
  <script type="text/javascript">
function copy(value)
{
    var copy = document.getElementById(value);
    var amount = document.getElementById("txtAmount");
    amount.value = copy.value;
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
<script type="text/javascript" src="js/mobile_networks_min.js"></script>
<body> 
 <?php include("menu.php"); ?>
    


  <?php include("service_tab_menu.php"); ?>

 <div class="container">
        <?php
  if($this->session->flashdata('message')){
  echo "<br /><div class='alert alert-danger fade in'>".$this->session->flashdata('message')."</div>";} 
  if($message != ''){
  echo "<div class='alert alert-danger fade in'>".$message."</div><br />";}
  ?>
    <div class="panel panel-primary">
      <div class="panel-heading">MOBILE RECHARGE (Prepaid)</div>
      <div class="panel-body"> 

     

      <form action="<?php echo base_url()."recharge_zone"; ?>" method="post" name="frmRecharge" id="frmRecharge" autocomplete="on" onsubmit="return validation();"> 
    <input type="hidden" name="hidSubmitRecharge" id="hidSubmitRecharge" /> 
      <input type="hidden" name="hidRechargeURL" id="hidRechargeURL" value="<?php echo base_url()."recharge_zone"; ?>
      <input type="hidden" name="hidServiceId" id="hidServiceId" />        
    <input type="hidden" name="hidOperatorCode" id="hidOperatorCode" />            
    <input type="hidden" name="hidProduct_name" id="hidProduct_name" />            
    <input type="hidden" name="hidCircle" id="hidCircle" /> 

 <div class="form-group">
     <label for="txtMobileNo">Mobile Number :</label>
    <input class="form-control" onkeyup="if(this.value.length>3) DetectMobile(this.value,'ddlOperator','mob_circle');" tabindex="2" required="" id="txtMobileNo" name="txtMobileNo" value="txtMobileNo" data-toggle="tooltip" title="Please Enter Mobile Number" placeholder="Please Enter Mobile Number*" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10"/></div>


       <div class="form-group">
     <label for="ddlOperator">Select Operator :</label>
       <select class="form-control" required="" id="ddlOperator" name="ddlOperator" onChange="SetParam()" tabindex="1" onchange="CheckSpecial('mob',this.value)"  title="Select Operator.<br />Click on drop down"><option value="0">Select Operator*</option>
 <?php
    $str_query = "select * from tblcompany where service_id='1' and company_id != 34 and company_id != 39  order by company_name";
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
     
   
<input type="submit" id="btnRecharge" name="btnRecharge" class="btn btn-primary" value="Recharge"><span id="wait_tip" style="display:none;"> Processing...<img src="images/ajax-loader2.gif"
           id="loading_img"/></span>   <!-- |<button type="button" name="search" id="search" class="btn btn-danger">R Offer</button> -->
          </from>



          
          </div>
    </div>
</div>






 <div id="RModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">R OFFER</h4>
      </div>
      <div class="modal-body">
         <div  id="details"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
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
    <th>Operator Id</th> 
    <th>Amount</th>
     <th>Status</th>
 
  
    <th>Date</th>  

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
      echo '<td>'.$resultRecharge->operator_id.'</td>';
    echo '<td>'.$resultRecharge->amount.'</td>';
          
    echo '<td>';
    if($resultRecharge->recharge_status == "Pending") { echo '<span style="color:orange;">Pending</span>'; }  
    if($resultRecharge->recharge_status == 'Success') { echo '<span style="color:green;">Success</span>'; }  
    if($resultRecharge->recharge_status == 'Failure') { echo '<span style="color:red;">Failure</span>'; } 
    ?>
    
 
    
  <?php  
    
    echo '</td>';
  
    
    echo '<td>'.$resultRecharge->recharge_date.'<br><small>'.$resultRecharge->recharge_time.'</small><br><small>Source: '.$resultRecharge->recharge_by.'</small></td>';
     
  echo '</td> ';
  echo '</tr>';   
    $i++;} 
    echo ' </tbody></table></div>'; ?>
  
  </div>
</div>
    </div><br />
    
    
   
    <?php include("footer.php"); ?>
   
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
        
        
 
       
   <script>


//post code

$(document).ready(function(){
 $('#search').click(function(){
  var id= $('#txtMobileNo').val();
  var opcode= $('#ddlOperator').val();
  if(id != '')
  {
   $.ajax({
    url:"offer_search",
    method:"POST",
    data:{id:id,opcode:opcode},
    dataType:"html",
   
    success:function(data)
    {
     $('#RModal').modal();
     $('#details').html(data);
    
    }
   })
  }
  else
  {
   alert("Please enter Number and Select Operator");
   $('#employee_details').css("display", "none");
  }
 });
});
</script>     
        
        
</body>
</html>
