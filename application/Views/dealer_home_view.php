<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mange Distributo</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <?php include('app_css.php'); ?>  
  
    <script language="javascript">
    setTimeout(function(){$('div.message').fadeOut(1000);}, 3000);
    /*function ActionSubmit(value,name)
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
    }*/
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
    function actionDeactivate(value,status)
    {
        
        document.getElementById('hidstatus').value= status;
        document.getElementById('hiduserid').value= value;  
        document.getElementById('frmCallAction').submit();
    }
</script>
  
    <script language="javascript">
     function get_live_data()
 {
     get_balance();
    setTimeout(get_live_data,35000);
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
    </script>
</head>
<body>

<?php require_once("menu.php"); ?> 


<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading">Manage Distributor</div>
      <div class="panel-body">

 <form action="<?php echo base_url()."distributor_list" ?>" method="post" name="frmCallAction" id="frmCallAction">
<input type="hidden" id="hidstatus" name="hidstatus" />
<input type="hidden" id="hiduserid" name="hiduserid" />
<input type="hidden" id="hidaction" name="hidaction" value="Set" />
 </form>
 
 
    <?php
    if ($message != ''){echo "<div class='alert alert-danger'>".$message."</div>"; }
    if($this->session->flashdata('user_message')){echo "<div class='alert alert-danger'>".$this->session->flashdata('user_message')."</div>";}
    
        if($this->session->flashdata('message')){echo "<div class='alert alert-danger'>".$this->session->flashdata('message')."</div>";}   
    
    ?>    
    
     
 <div class="table-responsive">
<table class="table table-hover">
    <tr>
  
   <th>SR.</th>
      <th>User ID</th>
    <th>Name</th>
    <th>Credit</th>
    <th>Debit</th>   
    
    <th>Mobile</th>  
    <th>Balance</th> 
    <th>Status</th>
                     
    </tr>
   <form id="frmfilter" name="frmfilter" action="dist_home" method="post">
   <input type="hidden" id="hidSearchFlag" name="hidSearchFlag" />
   <input type="hidden" id="hidSearchValue" name="hidSearchValue" />
   </form>
                      
       
    <?php   $i = 0;foreach($result_dealer->result() as $result)     {  ?>
    
    <?php
    $balance = $this->Common_methods->getCurrentBalance($result->user_id);
    $parent_id = $result->parent_id;
        $rslt = $this->db->query("select * from tblusers where user_id = '$parent_id'");
     ?>
    
            <tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">

 <td><?php echo $i+1; ?></td>
 <td><?php echo $result->username; ?></td>
<td><?php echo $result->business_name; ?></td>


 <td><?php echo '<a class="btn btn-danger" title="Transfer Money" href="'.base_url().'common_add_balance/process/'.$this->Common_methods->encrypt($result->user_id).'/'.$this->Common_methods->encrypt('dealer_home').'/'.$this->Common_methods->encrypt('Add').'" class="paging">Credit</a>';?></td>
 <td><?php echo '<a class="btn btn-primary" title="Revert Transaction" href="'.base_url().'common_add_balance/process/'.$this->Common_methods->encrypt($result->user_id).'/'.$this->Common_methods->encrypt('dealer_home').'/'.$this->Common_methods->encrypt('Revert').' " class="paging">Debit</a>';?></td>

  <td><?php echo $result->mobile_no; ?></td>
   <td><?php echo $balance; ?></td>
   <td><?php if($result->status == 0){echo "<span class='btn btn-danger'>Deactve</span>";}else{echo "<span class='btn btn-success'>Active</span>";} ?></td>

 </tr>
        <?php   
        $i++;} ?>
        </table>
       <?php  echo $pagination; ?>
    
  </div>
    </div>
</div>
</div>
      <?php include('app_js.php'); ?>
   
     <?php require_once("a_footer.php"); ?>

</body>
</html>