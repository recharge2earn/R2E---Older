<?php
	$str_query = "select * from tblservice where service_id = '6'";
		
		
		$result_md = $this->db->query($str_query);	
			for($i=0; $i<$result_md->num_rows(); $i++)
		{
		      $status = $result_md->row($i)->service_name;
		      
		      if($status == "expired"){
		      
		      echo "<h1>YOUR SERVER HAS BEEN EXPIRED, PLEASE CONTACT SUPPORT FOR RENEWAL"; exit;
		      }
		}
		?>
		


<div id="menu">
<?php 
$user=$this->session->userdata('auser_type');
if(trim($user) == 'Admin'){?>
        <!-- Promo Area End -->
        <!-- Secondary Menu Start -->
        <nav id="secondaryMenu" class="navbar" data-sticky="true">
            <div class="container">
                <div class="navbar-header">
                    <!-- Logo Start -->
                    <a href="" class="navbar-brand">
                        <img src="images/logo.png" alt="" width="auto" height="55" />
                    </a>
                    <!-- Logo End -->
                </div>
                
                <!-- Off-Canvas Menu Toggle Button Start -->
                <button class="btn menu-toggle-btn">
                    <i class="fa fa-navicon"></i> Menu
                </button>
                <!-- Off-Canvas Menu Toggle Button End -->
                
                <!-- Secondary Menu Links Start -->
                <div id="secondaryNavbar" class="navbar-right reset-padding hidden-sm hidden-xs">
                    <ul class="secondary-menu-links nav navbar-nav">
                        <li><a href=<?php echo base_url()."site_admin";?>>Dashboard</a></li>


           

                         <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Customers<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                         <li><a href="#" data-toggle="modal" data-target="#register">Register</a></li> 
                          <li><a href="#" data-toggle="modal" data-target="#manage">Manage</a></li> 
                           <li><a href="#" data-toggle="modal" data-target="#add_bal">Balance Transfer</a></li> 
                         
                        </ul>
</li>

                    
                       <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                 <li><a href=<?php echo base_url()."upload";?>>Change Logo</a></li>
                                  <li><a href=<?php echo base_url()."update_contact";?>>Update Contact</a></li>
                                <li><a href=<?php echo base_url()."company";?>>Switch API</a></li>
                                <li><a href=<?php echo base_url()."api";?>>API Setting</a></li>
                                <li><a href=<?php echo base_url()."set_commission"?>>Set Commission</a></li>
                                <li><a href=<?php echo base_url()."bank";?>>Add Bank Name</a></li>
                                <li><a href=<?php echo base_url()."admin_bank_details";?>>Add Bank Details</a></li>
                                <li><a href=<?php echo base_url()."retailer_type";?>>Business Type</a></li>
                                <li><a href=<?php echo base_url()."state";?>>Edit State</a></li>
                                </li>
                                
                            </ul>
                        </li>
                        
                       

                            <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Report<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href=<?php echo base_url()."list_recharge_pending";?>>Pending Recharge</a></li>
                                <li><a href=<?php echo base_url()."list_recharge";?>>Recharge history</a></li>
                                <li><a href=<?php echo base_url()."check_transaction"?>>Check Transaction</a></li>
                                <li><a href=<?php echo base_url()."account_report";?>>Account Report</a></li>
                                <li><a href=<?php echo base_url()."masterdistributor_transaction_reoprt";?>>Master Distributor Report</a></li>
                                <li><a href=<?php echo base_url()."distributor_transaction_reoprt";?>>Disributor Report</a></li>
                                <li><a href=<?php echo base_url()."agent_report";?>>Retailer Report</a></li>
                                </li>
                                
                            </ul>
                        </li>


                         <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <span class="caret"></span></a>
                            
                            <ul class="dropdown-menu">
                                <li><a href=<?php echo base_url()."change_password";?>>Change Password</a></li>
                                 
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Support<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href=<?php echo base_url()."list_complain";?>>Support Ticket</a></li>
                                 <li><a href=<?php echo base_url()."alerts";?>>Set Alert</a></li>
                                 
                            </ul>
                        </li>
                         
                       <li><a href=<?php echo base_url()."logout";?>>log Out</a></li>
                       
                    </ul>
                </div>
                <!-- Secondary Menu Links End -->
            </div>
        </nav>
        <!-- Secondary Menu End -->
        
        <!-- Off-Canvas Menu Start -->
        <div class="off-canvas-menu">
            <!-- Off-Canvas Menu Close Button Start -->
            <button type="button" class="off-canvas-menu--close-btn"><i class="fa fa-close"></i></button>
            <!-- Off-Canvas Menu Close Button End -->
            
            <!-- Off-Canvas Menu Logo Start -->
            <div class="off-canvas-menu-logo">
                <a href="">
                    <img src="images/logo.png" alt="" class="img-responsive center-block" />
                </a>
            </div>
            <!-- Off-Canvas Menu Logo End -->
            
            <!-- Off-Canvas Menu Links Start -->
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href=<?php base_url()."site_admin";?>><i class="fa fa-fw fa-home"></i> Home</a></li>
               <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-fw fa-user"></i> Customers <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        
                        <li><a href="#" data-toggle="modal" data-target="#register"><i class="fa fa-fw fa-users"></i>Register</a></li> 
                          <li><a href="#" data-toggle="modal" data-target="#manage"><i class="fa fa-fw fa-users"></i>Manage</a></li> 
                           <li><a href="#" data-toggle="modal" data-target="#add_bal"><i class="fa fa-fw fa-users"></i>Balance Transfer</a></li> 
                        
                    </ul>
                </li>


<li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-fw fa-cog"></i> Settings <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        

                                 <li><a href=<?php echo base_url()."company";?>><i class="fa fa-fw fa-check"></i>Switch API</a></li>
                                 <li><a href=<?php echo base_url()."upload";?>><i class="fa fa-fw fa-check"></i>Change Logo</a></li>
                                  <li><a href=<?php echo base_url()."update_contact";?>><i class="fa fa-fw fa-check"></i>Update Contact</a></li>
                                <li><a href=<?php echo base_url()."api";?>><i class="fa fa-fw fa-check"></i>API Setting</a></li>
                                <li><a href=<?php echo base_url()."set_commission"?>><i class="fa fa-fw fa-check"></i>Set Commission</a></li>
                                <li><a href=<?php echo base_url()."bank";?>><i class="fa fa-fw fa-check"></i>Add Bank Name</a></li>
                                <li><a href=<?php echo base_url()."admin_bank_details";?>><i class="fa fa-fw fa-check"></i>Add Bank Details</a></li>
                                <li><a href=<?php echo base_url()."retailer_type";?>><i class="fa fa-fw fa-check"></i>Business Type</a></li>
                                <li><a href=<?php echo base_url()."state";?>><i class="fa fa-fw fa-check"></i>Edit State</a></li>
                       
                        
                    </ul>
                </li>

                 <li> 
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <i class="fa fa-fw fa-bar-chart"></i> Report <span class="caret"></span></a>

<ul class="dropdown-menu">
 <li><a href=<?php echo base_url()."list_recharge_pending";?>><i class="fa fa-fw fa-check"></i>Pending Recharge</a></li>
                                <li><a href=<?php echo base_url()."list_recharge";?>><i class="fa fa-fw fa-check"></i>Recharge history</a></li>
                                <li><a href=<?php echo base_url()."check_transaction"?>><i class="fa fa-fw fa-check"></i>Check Transaction</a></li>
                                <li><a href=<?php echo base_url()."account_report";?>><i class="fa fa-fw fa-check"></i>Account Report</a></li>
                                <li><a href=<?php echo base_url()."masterdistributor_transaction_reoprt";?>><i class="fa fa-fw fa-check"></i>MD  Report</a></li>
                                <li><a href=<?php echo base_url()."distributor_transaction_reoprt";?>><i class="fa fa-fw fa-check"></i>Disributor Report</a></li>
                                <li><a href=<?php echo base_url()."agent_report";?>><i class="fa fa-fw fa-check"></i>Retailer Report</a></li>
 
 </ul>
  </li>
                

 <li> 
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <i class="fa fa-fw fa-inr"></i> Support <span class="caret"></span></a>

<ul class="dropdown-menu">
 <li><a href=<?php echo base_url()."list_complain";?>><i class="fa fa-fw fa-check"></i>Support Ticket</a></li>
 <li><a href=<?php echo base_url()."alerts";?>><i class="fa fa-fw fa-check"></i>Set Alert</a></li>
  <li><a href=<?php echo base_url()."list_payment_request";?>><i class="fa fa-fw fa-check"></i>Process Payment</a></li>
                                 
 </ul>
  </li>


 <li> 
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <i class="fa fa-fw fa-support"></i> My Account <span class="caret"></span></a>

<ul class="dropdown-menu">
 <li><a href=<?php echo base_url()."change_password";?>><i class="fa fa-fw fa-lock"></i>Change Password</a></li>


                                 
 </ul>
  </li>
            

 




            </ul>
            <!-- Off-Canvas Menu Links End -->

            <a href=<?php echo base_url()."logout";?> class="btn btn-default login-button"><i class="fa fa-user"></i> Log Out</a>
        </div>
        
        <div class="off-canvas-menu-overlay"></div>
        <!-- Off-Canvas Menu End -->
    </div>
    <div id="fakeLoader"></div>
  
    <div id="pageTitle" class="bg--overlay" >
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="section-title">
                       <h2> Hi, Admin</h2>

                    </div>
                </div>
                 <div class="col-md-3">
                     
                 <ul class="breadcrumb">
                        <li><span>N-wallet Balance:</span></li>
                        
                        <li class="active">
<?php 

$this->load->model('Royalcapital_balance_model');		
$RCInfo = $this->Royalcapital_balance_model->get_RoyalInfo('n-wallet');
$username = $RCInfo->row(0)->username;
$pwd = $RCInfo->row(0)->password;
echo file_get_contents("https://www.n-wallet.co.in/apiservice.asmx/GetBalance?apiToken=".$pwd);

?>

</li>
                    </ul>   
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li><span>API Balance:</span></li>
                        
                        <li class="active">
<?php 

$this->load->model('Royalcapital_balance_model');		
$RCInfo = $this->Royalcapital_balance_model->get_RoyalInfo('MYRC');
$username = $RCInfo->row(0)->username;
$pwd = $RCInfo->row(0)->password;
echo $this->common->myrc_balance($username,$pwd);

?>

</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>


<!--model-->

<div class="modal fade" id="register" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Please Select Customer Type</h4>
        </div>
        <div class="modal-body">



                    <div class="form-group">
                   <select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option value="">Select...</option>
    <option value=<?php echo base_url()."admin_md_registration";?>>Master Distributor</option>
    <option value=<?php echo base_url()."admin_d_registration";?>>Distributor</option>
    <option value=<?php echo base_url()."admin_agent_registration";?>>Retailer</option>
    <option value=<?php echo base_url()."reseller_registration";?>>Reseller</option>
</select>
        </div>       
      
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="manage" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Please Select Customer Type</h4>
        </div>
        <div class="modal-body">



                    <div class="form-group">
                   <select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option value="">Select...</option>
    <option value=<?php echo base_url()."md_dealer_list";?>>Master Distributor</option>
    <option value=<?php echo base_url()."distributor_list";?>>Distributor</option>
    <option value=<?php echo base_url()."agent_list";?>>Retailer</option>
    <option value=<?php echo base_url()."reseller_list";?>>Reseller</option>
</select>
        </div>       
      
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>




   <div class="modal fade" id="add_bal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Please Select Customer Type</h4>
        </div>
        <div class="modal-body">



                    <div class="form-group">
                   <select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option value="">Select...</option>
    <option value=<?php echo base_url()."add_fund_md";?>>Master Distributor</option>
    <option value=<?php echo base_url()."add_fund_distributor";?>>Distributor</option>
    <option value=<?php echo base_url()."add_fund_retailer";?>>Retailer</option>
    <option value=<?php echo base_url()."reseller_list";?>>Reseller</option>
</select>
        </div>       
      
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


    <br />

<?php }?>

<style>
body  {
  
  background-color: #cccccc;
}
</style>


