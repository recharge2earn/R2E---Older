<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Fund Master Distributor</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <meta name="description" content="Login Area">
    <meta name="author" content="">

  <!-- ==== Favicons ==== -->
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link rel="icon" href="favicon.png" type="image/x-icon">

    <!-- ==== Google Font ==== -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900%7CMontserrat:700' rel='stylesheet' type='text/css'>

    <!-- ==== Font Awesome ==== -->
    <link href="<?php echo base_url().'app_css/font-awesome.min.css';?>" rel="stylesheet">
    
    <!-- ==== Bootstrap ==== -->
    <link href=<?php echo base_url()."app_css/bootstrap.min.css";?> rel="stylesheet">
    
    <!-- ==== jQuery UI ==== -->
    <link href="<?php echo base_url()."app_css/jquery-ui.min.css";?>" rel="stylesheet">

    <!-- ==== Animate CSS Library ==== -->
    <link href="<?php echo base_url().base_url().'app_css/animate.min.css';?>" rel="stylesheet">

    <!-- ==== Owl Carousel Plugin ==== -->
    <link href="<?php echo base_url().'app_css/owl.carousel.css';?>" rel="stylesheet">
    
    <!-- ==== Magnific Popup Plugin ==== -->
    <link href="<?php echo base_url().'app_css/magnific-popup.css';?>" rel="stylesheet" type='text/css'>
    
    <!-- ==== FakeLoader Plugin ==== -->
    <link href="<?php echo base_url().'app_css/fakeLoader.css';?>" rel="stylesheet" type='text/css'>
    
    <!-- ==== Main Stylesheet ==== -->
    <link href="<?php echo base_url().'app_js/style.css';?>" rel="stylesheet">
    
    <!-- ==== Responsive Stylesheet ==== -->
    <link href="<?php echo base_url().'app_css/responsive-style.css';?>" rel="stylesheet">
    
    <!-- ==== Theme Color Stylesheet ==== -->
    <link href="<?php echo base_url().'app_css/colors/theme-color-1.css';?>" rel="stylesheet" id="changeColorScheme">
    
    <!-- ==== Custom Stylesheet ==== -->
    <link href="<?php echo base_url().'app_css/custom.css';?>" rel="stylesheet">
  



      
    <script>
  setTimeout(function(){$('div.message').fadeOut(1000);}, 3000);
  function ActionSubmit(value,name)
  {
    if(document.getElementById('action_'+value).selectedIndex != 0)
    {
      var isstatus;
      if(document.getElementById('action_'+value).value == 0)
      {isstatus = 'cancel';}else{isstatus='active';}
      
      if(confirm('Are you sure?\n you want to '+isstatus+' login for - ['+name+']')){
        document.getElementById('hidstatus').value= document.getElementById('action_'+value).value;
        document.getElementById('hiduserid').value= value;  
        document.getElementById('hidaction').value= "Set";        
        document.getElementById('frmCallAction').submit();
        }
    }
  }
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
   if(value == "ParentName")
   {
    
     document.getElementById("hidSearchFlag").value = value;
     document.getElementById("hidSearchValue").value = document.getElementById("txtParentName").value;
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
  function submitStatusForm()
  {
    
     document.getElementById("hidSearchFlag").value = "Status";
     document.getElementById("hidSearchValue").value = document.getElementById("ddlstatusaction").value;
     document.getElementById("frmfilter").submit();
  }
</script>
</head>
<body>

<?php require_once("admin_menu.php"); ?> 


<div class="container">


<div class="panel panel-primary">
      <div class="panel-heading">Credit/Debit</div>
      <div class="panel-body">

  <?php
    $totalLoad = 0;
    $rslt = $this->db->query("select * from tblusers where usertype_name = 'MasterDealer'");
    foreach($rslt->result() as $row)
    {
      $totalLoad += $this->Common_methods->getAgentBalance($row->user_id);
      
    }
   ?>


  <form id="frmCallAction" action="<?php echo base_url()."md_dealer_list"?>" name="frmCallAction" method="post">
   <input type="hidden" id="hidstatus" name="hidstatus" />
   <input type="hidden" id="hiduserid" name="hiduserid" />
   <input type="hidden" id="startpage" name="startpage" value="<?php echo $this->uri->segment(3); ?>"/>
   <input type="hidden" id="hidaction" name="hidaction"  value="Set"/>
   </form>
  <form id="frmfilter" name="frmfilter" action="md_dealer_list" method="post">
   <input type="hidden" id="hidSearchFlag" name="hidSearchFlag" />
   <input type="hidden" id="hidSearchValue" name="hidSearchValue" />
   </form>
 



    <?php
  if ($message != ''){echo "<div class='alert alert-danger'>".$message."</div>"; }
  if($this->session->flashdata('user_message')){echo "<div class='alert alert-danger'>".$this->session->flashdata('user_message')."</div>";}
  
    if($this->session->flashdata('message')){echo "<div class='alert alert-danger'>".$this->session->flashdata('message')."</div>";}  
  
  ?>    
    
     
 <div class="table-responsive">
<table id="table_id" class="table table-striped table-bordered">
    <tr>
  

      <th>User ID</th>
    <th>Name</th>
   
   
    

   
  <th>Add Balance</th>
  <th>Revert Balance</th>
  <th>Login</th>                
    </tr>

   <form id="frmfilter" name="frmfilter" action="<?php echo base_url()."md_dealer_list"?>" method="post">
   <input type="hidden" id="hidSearchFlag" name="hidSearchFlag" />
   <input type="hidden" id="hidSearchValue" name="hidSearchValue" />
   </form>
                      
       
    <?php $i = 0;foreach($result_dealer->result() as $result)   {  ?>
    
    <?php
  $balance = $this->Common_methods->getAgentBalance($result->user_id);
  $parent_id = $result->parent_id;
    $rslt = $this->db->query("select * from tblusers where user_id = '$parent_id'");
   ?>
    
    <tr class="<?php if($i%2 == 0){echo 'row1';}else{echo 'row2';} ?>">


 <td><?php echo $result->username; ?></td>

<td><?php echo $result->business_name; ?></td>


 
  


 
 



 





<td><?php echo '<a title="Transfer Money" href="'.base_url().'add_balance/process/'.$this->Common_methods->encrypt($result->user_id).'/'.$this->Common_methods->encrypt('md_dealer_list').'/'.$this->Common_methods->encrypt('Add').'" class="btn btn-danger">Add Balance</a> </td>



 <td><a title="Revert Transaction" href="'.base_url().'add_balance/process/'.$this->Common_methods->encrypt($result->user_id).'/'.$this->Common_methods->encrypt('md_dealer_list').'/'.$this->Common_methods->encrypt('Revert').' " class="btn btn-primary">Revert Balance</a></td>



 <td><a href="'.base_url().'directaccess/process/'.$this->Common_methods->encrypt($result->user_id).'" class="btn btn-success" >Login</a>'; ?>
 </td>
 </tr>
    <?php   
    $i++;} ?>
    </table>
    <?php  echo $pagination; ?>
  </div>
  <script>$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
    </div>
</div>
</div>

       <!-- ==== jQuery Library ==== -->
    <script src="<?php echo base_url().'app_js/jquery-3.1.0.min.js';?>"></script>

    <!-- ==== jQuery UI ==== -->
    <script src="<?php echo base_url().'app_js/jquery-ui.min.js';?>"></script>
    
    <!-- ==== jQuery UI Touch Punch Plugin ==== -->
    <script src="<?php echo base_url().'app_js/jquery.ui.touch-punch.min.js';?>"></script>

    <!-- ==== Bootstrap ==== -->
    <script src="<?php echo base_url().'app_js/bootstrap.min.js';?>"></script>

    <!-- ==== FakeLoader Plugin ==== -->
    <script src="<?php echo base_url().'app_js/fakeLoader.min.js';?>"></script>

    <!-- ==== StickyJS Plugin ==== -->
    <script src="<?php echo base_url().'app_js/jquery.sticky.js';?>"></script>

    <!-- ==== Owl Carousel Plugin ==== -->
    <script src="<?php echo base_url().'app_js/owl.carousel.min.js';?>"></script>
    
    <!-- ==== jQuery Tubuler Plugin ==== -->
    <script src="<?php echo base_url().'app_js/jquery.tubular.1.0.js';?>"></script>
    
    <!-- ==== Magnific Popup Plugin ==== -->
    <script src="<?php echo base_url().'app_js/jquery.magnific-popup.min.js';?>"></script>

    <!-- ==== jQuery Validation Plugin ==== -->
    <script src="<?php echo base_url().'app_js/jquery.validate.min.js';?>"></script>

    <!-- ==== Animate Scroll Plugin ==== -->
    <script src="<?php echo base_url().'app_js/animatescroll.min.js';?>"></script>

    <!-- ==== jQuery Waypoints Plugin ==== -->
    <script src="<?php echo base_url().'app_js/jquery.waypoints.min.js';?>"></script>

    <!-- ==== jQuery CounterUp Plugin ==== -->
    <script src="<?php echo base_url().'app_js/jquery.counterup.min.js';?>"></script>
    
    <!-- ==== jQuery CountDown Plugin ==== -->
    <script src="<?php echo base_url().'app_js/jquery.countdown.min.js';?>"></script>
    
    <!-- ==== RetinaJS ==== -->
    <script src="<?php echo base_url().'app_js/retina.min.js';?>"></script>

    <!-- ==== Main JavaScript ==== -->
    <script src="<?php echo base_url().'app_js/main.js';?>"></script>
   
     <?php require_once("a_footer.php"); ?>
</body>
</html>