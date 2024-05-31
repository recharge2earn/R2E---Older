<!-- agent menu -->
<?php
if ($this->session->userdata('alogged_in') == TRUE) 
        { ?>
             <div id="primaryMenu" class="alert">

            
                
            
        
            <div class="container">
                <b> Logged in as Admin ! </b> <a href="<?php echo base_url().'site_admin';?>" class="btn btn-info" role="button">Back To Admin </a> 

                
            </div>
        </div>
<?php }?>
<?php 
$user=$this->session->userdata('user_type');
if(trim($user) == 'Agent'){?>


<div id="menu">
<?php
    if ($this->session->userdata('is_first_time') == "0") 
        { ?>
      <!-- Promo Area Start -->
        <div id="promo" class="alert">

            
                
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        
            <div class="container">
                '<p><strong>Welcome, <?php echo $this->session->userdata('business_name');?>! </strong>Your Current Account Balance is Rs <?php  $balance = $this->Common_methods->getCurrentBalance($this->session->userdata("id"));
            echo $balance; ?></p>

                
            </div>
        </div>
<?php }?>
        <!-- Promo Area End -->
        <!-- Secondary Menu Start -->
        <nav id="secondaryMenu" class="navbar" data-sticky="true">
            <div class="container">
                <div class="navbar-header">
                    <!-- Logo Start -->
                    <a href="<?php echo base_url();?>" class="navbar-brand">
                        <img src=<?php echo base_url()."images/logo.png";?> alt="" width="auto" height="55" />
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
                        <li><a href=<?php echo base_url()."dashboard";?>>Dashboard</a></li>                    
                       <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Report<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href=<?php echo base_url()."recharge_history";?>>Mini Statement</a></li>
                                <li><a href=<?php echo base_url()."recharge_report";?>>Recharge History</a></li>
                                <li><a href=<?php echo base_url()."billing_summary";?>>Ledger</a></li>
                                <li><a href=<?php echo base_url()."refund_report";?>>Refund Report</a></li>
                                <li><a href=<?php echo base_url()."my_earning";?>>My Earning</a></li>
                                <li><a href=<?php echo base_url()."status_check";?>>Search Transaction</a></li>
                                <li><a href=<?php echo base_url()."search_plan";?>>Search Plan</a></li>
                                </li>
                                
                            </ul>
                        </li>
                        
                       
                         <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <span class="caret"></span></a>
                            
                            <ul class="dropdown-menu">
                                <li><a href=<?php echo base_url()."change_pass";?>>Change Password</a></li>
                                 <li><a href=<?php echo base_url()."my_profile";?>>Edit Profile</a></li>
                                <li><a href=<?php echo base_url()."my_commission";?>>My Commission</a></li>
                                 <li><a href=<?php echo base_url()."set_ip";?>>SET IP</a></li>
                                 <li><a href=<?php echo base_url()."call_back_url";?>>SET call back url</a></li>
                                
                                
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Support<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href=<?php echo base_url()."support_ticket";?>>Support Ticket</a></li>
                                 <li><a href=<?php echo base_url()."bank_details";?>>Bank Details</a></li>
                                 
                                 <li><a href=<?php echo base_url()."contact_details";?>>Contact Details</a></li>
                                 
                                  <li><a href=<?php echo base_url()."add_fund";?>>Add Fund</a></li>
                                  <li><a href=<?php echo base_url()."m.apk";?>>Download App</a></li>
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
                    <img src=<?php echo base_url()."images/logo.png";?> alt="" width="auto" height="55" />
                </a>
            </div>
            <!-- Off-Canvas Menu Logo End -->
            
            <!-- Off-Canvas Menu Links Start -->
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href=<?php echo base_url()."dashboard";?>><i class="fa fa-fw fa-home"></i> Dashboard</a></li>
               <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-fw fa-mobile"></i> Recharge <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href=<?php echo base_url()."recharge_zone";?>><i class="fa fa-fw fa-mobile"></i>Mobile Recharge</a></li>
                        <li><a href=<?php echo base_url()."dth";?>><i class="fa fa-fw fa-tv"></i>DTH Recharge</a></li>
                        <li><a href=<?php echo base_url()."postpaid";?>><i class="fa fa-fw fa-phone"></i>Post Paid Bill</a></li>
                        
                    </ul>
                </li>
                 <li> 
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <i class="fa fa-fw fa-bar-chart"></i> Report <span class="caret"></span></a>

<ul class="dropdown-menu">
 <li><a href="recharge_history"><i class="fa fa-fw fa-bar-chart"></i>Mini Statement</a></li>
                <li><a href=<?php echo base_url()."recharge_report";?>><i class="fa fa-fw fa-history"></i>Recharge history</a></li>
                
                   <li><a href=<?php echo base_url()."billing_summary";?>><i class="fa fa-fw fa-history"></i>Ledger</a></li>
                <li><a href=<?php echo base_url()."refund_report";?>><i class="fa fa-fw fa-recycle"></i>Refund Report</a></li>
                <li><a href=<?php echo base_url()."my_earning";?>><i class="fa fa-fw fa-inr"></i>My Earning</a></li>
                <li><a href=<?php echo base_url()."status_check";?>><i class="fa fa-fw fa-search-plus"></i>Search TX iD</a></li>
                <li><a href=<?php echo base_url()."search_plan";?>><i class="fa fa-fw fa-search-plus"></i>Search Plan</a></li>
 
 </ul>
  </li>
   <li> 
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <i class="fa fa-fw fa-code"></i>Developer API <span class="caret"></span></a>

<ul class="dropdown-menu">
 <li><a href="developer_api"><i class="fa fa-fw fa-folder-open-o"></i>Developer API</a></li>
<li><a href="set_ip"><i class="fa fa-fw fa-globe"></i>White List IP</a></li>
<li><a href="call_back_url"><i class="fa fa-fw fa-mail-forward"></i>Set call back URL</a></li>
 
                                 
 </ul>
  </li>              

 <li> 
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <i class="fa fa-fw fa-inr"></i> Payment <span class="caret"></span></a>

<ul class="dropdown-menu">
 <li><a href=<?php echo base_url()."billing_summary";?>><i class="fa fa-fw fa-history"></i>Billing History</a></li>
<li><a href=<?php echo base_url()."bank_details";?>><i class="fa fa-fw fa-bank"></i>Bank list</a></li>
<li><a href=<?php echo base_url()."add_fund";?>><i class="fa fa-fw fa-inr"></i>Payment Request</a></li>
                                 
 </ul>
  </li>


 <li> 
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <i class="fa fa-fw fa-user"></i> My Account <span class="caret"></span></a>

<ul class="dropdown-menu">
 <li><a href=<?php echo base_url()."change_pass";?>><i class="fa fa-fw fa-lock"></i>Change Password</a></li>
 <li><a href=<?php echo base_url()."my_profile";?>><i class="fa fa-fw fa-wrench"></i>Edit Profile</a></li>
 <li><a href=<?php echo base_url()."my_commission";?>><i class="fa fa-fw fa-calculator"></i>My Commission</a></li>

                                 
 </ul>
  </li>
            

<li> 
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <i class="fa fa-fw fa-support"></i>Support <span class="caret"></span></a>

<ul class="dropdown-menu">
 <li><a href=<?php echo base_url()."support_ticket";?>><i class="fa fa-fw fa-support"></i>Support Ticket</a></li>
 <li><a href=<?php echo base_url()."contact_details";?>><i class="fa fa-fw fa-support"></i>Contact Details</a></li>
 
                                 
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
                       <h2> Hi, <?php echo $this->session->userdata('business_name');?></h2>

                    </div>
                </div>
                 <div class="col-md-3">
                     
                  
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb"><a href="add_fund" class="btn btn-warning" role="button">Add Fund</a>
                        <li><span>Balance:</span></li>
                        
                        <li class="active"><?php $this->load->model('Recharge_home_model');
        if($this->session->userdata("user_type") == "Agent")
        {
            $balance = $this->Common_methods->getAgentBalance($this->session->userdata("id"));
            echo $balance;
        }
        else
        {
            $balance = $this->Common_methods->getCurrentBalance($this->session->userdata("id"));
            echo $balance;
        }
        
        ?></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <br />

<?php }?>
<!-- end agent menu -->





<!-- Distributor menu start -->
<?php 
$user=$this->session->userdata('user_type');
if(trim($user) == 'Distributor'){?>


<div id="menu">
<?php
    if ($this->session->userdata('is_first_time') == "0") 
        { ?>
      <!-- Promo Area Start -->
        <div id="promo" class="alert">

            
                
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        
            <div class="container">
                '<p><strong>Welcome, <?php echo $this->session->userdata('business_name');?>! </strong>Your Current Account Balance is Rs <?php  $balance = $this->Common_methods->getCurrentBalance($this->session->userdata("id"));
            echo $balance; ?></p>

                
            </div>
        </div>
<?php }?>
        <!-- Promo Area End -->
        <!-- Secondary Menu Start -->
        <nav id="secondaryMenu" class="navbar" data-sticky="true">
            <div class="container">
                <div class="navbar-header">
                    <!-- Logo Start -->
                    <a href="" class="navbar-brand">
                        <img src=<?php echo base_url()."images/logo.png";?> alt="" width="auto" height="55" />
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
                        <li><a href=<?php echo base_url()."recharge_zone";?>>Dashboard</a></li>                    
                       <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Report<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href=<?php echo base_url()."recharge_history";?>>Mini Statement</a></li>
                                <li><a href=<?php echo base_url()."recharge_report";?>>Recharge History</a></li>
                                <li><a href=<?php echo base_url()."billing_summary";?>>Billing Summary</a></li>
                                <li><a href=<?php echo base_url()."refund_report";?>>Refund Report</a></li>
                                <li><a href=<?php echo base_url()."my_earning";?>>My Earning</a></li>
 <li><a href=<?php echo base_url()."withdraw_comm";?>>Withdraw Commission</a></li>
                                <li><a href=<?php echo base_url()."status_check";?>>Search Transaction</a></li>
                                <li><a href=<?php echo base_url()."search_plan";?>>Search Plan</a></li>
                                </li>
                                
                            </ul>
                        </li>



                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Retailer<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href=<?php echo base_url()."agent_registration";?>>Add Retailer</a></li>
                                <li><a href=<?php echo base_url()."dist_home";?>>Manage Retailer</a></li>
                                <li><a href=<?php echo base_url()."child_transactions";?>>Retailer Report</a></li>
                               
                                </li>
                                
                            </ul>
                        </li>
                        






                       
                         <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <span class="caret"></span></a>
                            
                            <ul class="dropdown-menu">
                                <li><a href=<?php echo base_url()."change_pass";?>>Change Password</a></li>
                                 <li><a href=<?php echo base_url()."my_profile";?>>Edit Profile</a></li>
                                <li><a href=<?php echo base_url()."my_commission";?>>My Commission</a></li>
                                
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Support<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href=<?php echo base_url()."support_ticket";?>>Support Ticket</a></li>
                                 <li><a href=<?php echo base_url()."bank_details";?>>Bank Details</a></li>
                                 <li><a href=<?php echo base_url()."contact_details";?>>Contact Details</a></li>
                                  <li><a href=<?php echo base_url()."add_fund";?>>Add Fund</a></li>
                                  <li><a href=<?php echo base_url()."m.apk";?>>Download App</a></li>
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
                    <img src=<?php echo base_url()."images/logo.png";?> alt="" width="auto" height="55" />
                </a>
            </div>
            <!-- Off-Canvas Menu Logo End -->
            
            <!-- Off-Canvas Menu Links Start -->
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href=<?php echo base_url()."recharge_zone";?>><i class="fa fa-fw fa-home"></i> Home</a></li>
               <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-fw fa-mobile"></i> Recharge <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href=<?php echo base_url()."recharge_zone";?>><i class="fa fa-fw fa-mobile"></i>Mobile Recharge</a></li>
                        <li><a href=<?php echo base_url()."dth";?>><i class="fa fa-fw fa-tv"></i>DTH Recharge</a></li>
                        <li><a href=<?php echo base_url()."postpaid";?>><i class="fa fa-fw fa-phone"></i>Post Paid Bill</a></li>
                        
                    </ul>
                </li>


<li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-fw fa-user"></i> Retailer <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                         <li><a href=<?php echo base_url()."agent_registration";?>><i class="fa fa-fw fa-check"></i>Add Retailer</a></li>
                                <li><a href=<?php echo base_url()."dist_home";?>><i class="fa fa-fw fa-check"></i>Manage Retailer</a></li>
                                <li><a href=<?php echo base_url()."child_transactions";?>><i class="fa fa-fw fa-check"></i>Retailer Report</a></li>
                        
                    </ul>
                </li>

                 <li> 
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <i class="fa fa-fw fa-bar-chart"></i> Report <span class="caret"></span></a>

<ul class="dropdown-menu">
 <li><a href="recharge_history"><i class="fa fa-fw fa-bar-chart"></i>Mini Statement</a></li>
                <li><a href=<?php echo base_url()."recharge_report";?>><i class="fa fa-fw fa-history"></i>Recharge history</a></li>
                
                 
                <li><a href=<?php echo base_url()."refund_report";?>><i class="fa fa-fw fa-recycle"></i>Refund Report</a></li>
                <li><a href=<?php echo base_url()."my_earning";?>><i class="fa fa-fw fa-inr"></i>My Earning</a></li>
<li><a href=<?php echo base_url()."withdraw_comm";?>><i class="fa fa-fw fa-inr"></i>Withdraw commission</a></li>
                <li><a href=<?php echo base_url()."status_check";?>><i class="fa fa-fw fa-search-plus"></i>Search TX iD</a></li>
                <li><a href=<?php echo base_url()."search_plan";?>><i class="fa fa-fw fa-search-plus"></i>Search Plan</a></li>
 
 </ul>
  </li>
                

 <li> 
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <i class="fa fa-fw fa-inr"></i> Payment <span class="caret"></span></a>

<ul class="dropdown-menu">
 <li><a href=<?php echo base_url()."billing_summary";?>><i class="fa fa-fw fa-history"></i>Billing History</a></li>
<li><a href=<?php echo base_url()."bank_details";?>><i class="fa fa-fw fa-bank"></i>Bank list</a></li>
<li><a href=<?php echo base_url()."add_fund";?>><i class="fa fa-fw fa-inr"></i>Payment Request</a></li>
                                 
 </ul>
  </li>


 <li> 
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <i class="fa fa-fw fa-user"></i> My Account <span class="caret"></span></a>

<ul class="dropdown-menu">
 <li><a href=<?php echo base_url()."change_pass";?>><i class="fa fa-fw fa-lock"></i>Change Password</a></li>
 <li><a href=<?php echo base_url()."my_profile";?>><i class="fa fa-fw fa-wrench"></i>Edit Profile</a></li>
 <li><a href=<?php echo base_url()."my_commission";?>><i class="fa fa-fw fa-calculator"></i>My Commission</a></li>

                                 
 </ul>
  </li>
            

<li> 
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <i class="fa fa-fw fa-support"></i>Support <span class="caret"></span></a>

<ul class="dropdown-menu">
 <li><a href=<?php echo base_url()."support_ticket";?>><i class="fa fa-fw fa-support"></i>Support Ticket</a></li>
 <li><a href=<?php echo base_url()."contact_details";?>><i class="fa fa-fw fa-support"></i>Contact Details</a></li>
 
                                 
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
                       <h2> Hi, <?php echo $this->session->userdata('business_name');?></h2>

                    </div>
                </div>
                 <div class="col-md-3">
                     
                  
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb"><a href="add_fund" class="btn btn-warning" role="button">Add Fund</a>
                        <li><span>Balance:</span></li>
                        
                        <li class="active"><?php $this->load->model('Recharge_home_model');
        if($this->session->userdata("user_type") == "Agent")
        {
            $balance = $this->Common_methods->getAgentBalance($this->session->userdata("id"));
            echo $balance;
        }
        else
        {
            $balance = $this->Common_methods->getCurrentBalance($this->session->userdata("id"));
            echo $balance;
        }
        
        ?></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <br />

<?php }?>
<!-- Ditributor Menu end -->









<!-- MD menu start -->
<?php 
$user=$this->session->userdata('user_type');
if(trim($user) == 'MasterDealer'){?>


<div id="menu">
<?php
    if ($this->session->userdata('is_first_time') == "0") 
        { ?>
      <!-- Promo Area Start -->
        <div id="promo" class="alert">

            
                
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        
            <div class="container">
                '<p><strong>Welcome, <?php echo $this->session->userdata('business_name');?>! </strong>Your Current Account Balance is Rs <?php  $balance = $this->Common_methods->getCurrentBalance($this->session->userdata("id"));
            echo $balance; ?></p>

                
            </div>
        </div>
<?php }?>
        <!-- Promo Area End -->
        <!-- Secondary Menu Start -->
        <nav id="secondaryMenu" class="navbar" data-sticky="true">
            <div class="container">
                <div class="navbar-header">
                    <!-- Logo Start -->
                    <a href="" class="navbar-brand">
                        <img src=<?php echo base_url()."images/logo.png";?> alt="" width="auto" height="55" />
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
                        <li><a href=<?php echo base_url()."recharge_zone";?>>Dashboard</a></li>                    
                       <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Report<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href=<?php echo base_url()."recharge_history";?>>Mini Statement</a></li>
                                <li><a href=<?php echo base_url()."recharge_report";?>>Recharge History</a></li>
                                <li><a href=<?php echo base_url()."billing_summary";?>>Billing Summary</a></li>
                                <li><a href=<?php echo base_url()."refund_report";?>>Refund Report</a></li>
                                <li><a href=<?php echo base_url()."my_earning";?>>My Earning</a></li>
 <li><a href=<?php echo base_url()."withdraw_comm";?>>Withdraw Commission</a></li>
                                <li><a href=<?php echo base_url()."status_check";?>>Search Transaction</a></li>
                                <li><a href=<?php echo base_url()."search_plan";?>>Search Plan</a></li>
                                </li>
                                
                            </ul>
                        </li>



                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Distributor<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href=<?php echo base_url()."d_dealer_form1";?>>Add Distributor</a></li>
                                <li><a href=<?php echo base_url()."dealer_home";?>>Manage Distributor</a></li>
                                <li><a href=<?php echo base_url()."child_transactions";?>>Retailer Report</a></li>
                               
                                </li>
                                
                            </ul>
                        </li>
                        






                       
                         <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <span class="caret"></span></a>
                            
                            <ul class="dropdown-menu">
                                <li><a href=<?php echo base_url()."change_pass";?>>Change Password</a></li>
                                 <li><a href=<?php echo base_url()."my_profile";?>>Edit Profile</a></li>
                                <li><a href=<?php echo base_url()."my_commission";?>>My Commission</a></li>
                                
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Support<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href=<?php echo base_url()."support_ticket";?>>Support Ticket</a></li>
                                 <li><a href=<?php echo base_url()."bank_details";?>>Bank Details</a></li>
                                 <li><a href=<?php echo base_url()."contact_details";?>>Contact Details</a></li>
                                  <li><a href=<?php echo base_url()."add_fund";?>>Add Fund</a></li>
                                  <li><a href=<?php echo base_url()."m.apk";?>>Download App</a></li>
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
                    <img src=<?php echo base_url()."images/logo.png";?> alt="" width="auto" height="55" />
                </a>
            </div>
            <!-- Off-Canvas Menu Logo End -->
            
            <!-- Off-Canvas Menu Links Start -->
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href=<?php echo base_url()."recharge_zone";?>><i class="fa fa-fw fa-home"></i> Home</a></li>
               <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-fw fa-mobile"></i> Recharge <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href=<?php echo base_url()."recharge_zone";?>><i class="fa fa-fw fa-mobile"></i>Mobile Recharge</a></li>
                        <li><a href=<?php echo base_url()."dth";?>><i class="fa fa-fw fa-tv"></i>DTH Recharge</a></li>
                        <li><a href=<?php echo base_url()."postpaid";?>><i class="fa fa-fw fa-phone"></i>Post Paid Bill</a></li>
                        
                    </ul>
                </li>


<li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-fw fa-user"></i> Distributors<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                    <li><a href=<?php echo base_url()."d_dealer_form1";?>><i class="fa fa-fw fa-check"></i>Add Distributor</a></li>
                                
                    <li><a href=<?php echo base_url()."dealer_home";?>><i class="fa fa-fw fa-check"></i>Manage Distributor</a></li>
                     <li><a href=<?php echo base_url()."child_transactions";?>><i class="fa fa-fw fa-check"></i>Retailer Report</a></li>   
                    </ul>
                </li>

                 <li> 
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <i class="fa fa-fw fa-bar-chart"></i> Report <span class="caret"></span></a>

<ul class="dropdown-menu">
 <li><a href="recharge_history"><i class="fa fa-fw fa-bar-chart"></i>Mini Statement</a></li>
                <li><a href=<?php echo base_url()."recharge_report";?>><i class="fa fa-fw fa-history"></i>Recharge history</a></li>
                
                 
                <li><a href=<?php echo base_url()."refund_report";?>><i class="fa fa-fw fa-recycle"></i>Refund Report</a></li>
                <li><a href=<?php echo base_url()."my_earning";?>><i class="fa fa-fw fa-inr"></i>My Earning</a></li>
<li><a href=<?php echo base_url()."withdraw_comm";?>><i class="fa fa-fw fa-inr"></i>Withdraw commission</a></li>
                <li><a href=<?php echo base_url()."status_check";?>><i class="fa fa-fw fa-search-plus"></i>Search TX iD</a></li>
                <li><a href=<?php echo base_url()."search_plan";?>><i class="fa fa-fw fa-search-plus"></i>Search Plan</a></li>
 
 </ul>
  </li>
                

 <li> 
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <i class="fa fa-fw fa-inr"></i> Payment <span class="caret"></span></a>

<ul class="dropdown-menu">
 <li><a href=<?php echo base_url()."billing_summary";?>><i class="fa fa-fw fa-history"></i>Billing History</a></li>
<li><a href=<?php echo base_url()."bank_details";?>><i class="fa fa-fw fa-bank"></i>Bank list</a></li>
<li><a href=<?php echo base_url()."add_fund";?>><i class="fa fa-fw fa-inr"></i>Payment Request</a></li>
                                 
 </ul>
  </li>


 <li> 
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <i class="fa fa-fw fa-lock"></i> My Account <span class="caret"></span></a>

<ul class="dropdown-menu">
 <li><a href=<?php echo base_url()."change_pass";?>><i class="fa fa-fw fa-lock"></i>Change Password</a></li>
 <li><a href=<?php echo base_url()."my_profile";?>><i class="fa fa-fw fa-wrench"></i>Edit Profile</a></li>
 <li><a href=<?php echo base_url()."my_commission";?>><i class="fa fa-fw fa-calculator"></i>My Commission</a></li>

                                 
 </ul>
  </li>
            

<li> 
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <i class="fa fa-fw fa-support"></i>Support <span class="caret"></span></a>

<ul class="dropdown-menu">
 <li><a href=<?php echo base_url()."support_ticket";?>><i class="fa fa-fw fa-support"></i>Support Ticket</a></li>
  <li><a href=<?php echo base_url()."contact_details";?>><i class="fa fa-fw fa-support"></i>Contact Details</a></li>
 
                                 
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
                       <h2> Hi, <?php echo $this->session->userdata('business_name');?></h2>

                    </div>
                </div>
                 <div class="col-md-3">
                     
                  
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb"><a href="add_fund" class="btn btn-warning" role="button">Add Fund</a>
                        <li><span>Balance:</span></li>
                        
                        <li class="active"><?php $this->load->model('Recharge_home_model');
        if($this->session->userdata("user_type") == "Agent")
        {
            $balance = $this->Common_methods->getAgentBalance($this->session->userdata("id"));
            echo $balance;
        }
        else
        {
            $balance = $this->Common_methods->getCurrentBalance($this->session->userdata("id"));
            echo $balance;
        }
        
        ?></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <br />

<?php }?>
<!-- MD Menu end -->


