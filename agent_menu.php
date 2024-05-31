<script>
function get_balance(){$.ajax({type: "GET",url: '<?php echo base_url(); ?>recharge_home/getBalance',cache: false,success: function(html){$("#divbal").html(html);}});$("#divbal").fadeOut(1000);$("#divbal").fadeIn(2000);}	 
$(document).ready(function(){get_balance();window.setInterval(get_balance, 17000);});	 

</script>


 <?php if($this->session->userdata("user_type") == "Agent"){?>
 	
 
<div id="nav-sub-wrap" style="width:100%;"> 
            <ul id="nav-sub"> 
          <li><a href="<?php echo base_url(); ?>recharge_home" title="Home" class="top_link"><span class="down">Home</span></a></li>
           
  			
  <li><a href="#" title="Report" class="top_link"><span class="down">Report</span></a>
    <ul>
        		<li><a href="<?php echo base_url()."all_transaction_report"; ?>" title="All Reports">Recharge History</a></li>
               <li><a href="<?php echo base_url()."agent_account_report"; ?>" title="Account Reports">Account Reports</a></li>
                <li><a href="<?php echo base_url()."md_check_status"; ?>" title="Account Reports">Check Status</a></li>
			
                       
  			</li>                                
	</ul>
	
  </li>
   <li><a href="#" title="Extra" class="top_link"><span class="down">Document &amp; Complain</span></a>
    <ul> 
     
    <!--<li><a href="<?php echo base_url()."commission_rate"; ?>" title="Commission Rate">Commission Rate</a></li>-->
            <li><a href="<?php echo base_url()."commission_received"; ?>" title="Commission Recieved">Commission Recieved</a></li>
  	<li><a href="<?php echo base_url()."sms_format"; ?>" title="SMS Format" target="_blank">SMS Format</a></li>
	<?php if($this->session->userdata('isAPI') == 'yes'){ ?>
  
  <?php } ?>
	<li><a href="<?php echo base_url()."complain"; ?>" title="Complain">Complain</a></li>  
    </ul>
  </li>
  <li><a href="#" title="Profile" class="top_link"><span class="down">Profile</span></a>
    <ul class="sub" id="profilesubmenu">
  			<li><a href="<?php echo base_url()."change_profile" ?>" title="Change Profile">Change Profile</a></li>
			<li><a href="<?php echo base_url()."c_change_password" ?>" title="Change Password">Change Password</a></li>
                       
	</ul>
  </li>  
           <li><a href="#" title="Profile" class="top_link"><span class="down">Downloads</span></a>

<ul>
<li><a href="<?php echo base_url()."sms_format"; ?>" title="SMS Format" target="_blank">SMS Format</a></li>
<li><a href="/m.apk" title="Android app">Android app</a></li>

</li></ul>
           </li>  
           </a></li>      
              
            <li><a href="<?php echo base_url(); ?>payment_request" class="top_link"><span class="down">Payment Request</span></a>
<ul>
<li><a href="<?php echo base_url(); ?>payment_request" class="top_link"><span class="down">Update Payment</span></a></li>
<li><a href="<?php echo base_url()."list_bank"; ?>">Bank List</a></li></ul>
</li>
          </a></li> 
            </ul> 
            
       
        <?php } ?>
        <?php if($this->session->userdata("user_type") == "APIUSER"){?>
 	
 
<div id="nav-sub-wrap" style="width:100%;"> 
            <ul id="nav-sub"> 
          <li><a href="<?php echo base_url(); ?>recharge_home" title="Home" class="top_link"><span class="down">Home</span></a></li>
  			</li>
  <li><a href="#" title="Report" class="top_link"><span class="down">Report</span></a>
    <ul>
        		 <li data-id="785" data-level="2">
                    <a class="" href="<?php echo base_url()."api_users/recharge_history"?>">Recharge History </a>
                    </li>
                    <li data-id="785" data-level="2">
                    <a class="" href="<?php echo base_url()."api_users/accountreport"?>">Account Report</a>
                    </li>
                     <li data-id="785" data-level="2">
                    <a class="" href="<?php echo base_url()."api_users/topuphistory"?>">Balance Topup History </a>
                    </li>
                    <li data-id="786" data-level="2">
                    <a class="" href="<?php echo base_url()."api_users/recharge_refund"?>">Recharge Refund</a>
                    </li>
                     <li data-id="786" data-level="2">
                    <a class="" href="<?php echo base_url()."api_users/list_bank"?>">Bank List</a>
                    </li>
                     <li data-id="786" data-level="2">
                    <a class="" href="<?php echo base_url()."api_users/sms_format"?>" target="_blank">SMS Format</a>
                    </li>
                                 
	</ul>
  </li>
   
    
           <li><a class="" href="<?php echo base_url()."api_users/complain"; ?>">Complain  </a></li>
             <li><a class="" href="<?php echo base_url()."api_users/payment_request"; ?>">Payment Request</a>   <li>
             <li><a class="" href="<?php echo base_url()."api_users/change_password"; ?>">Change Password  </a> <li>     
              
           
            </ul> 
            
       
        <?php } ?>
		<?php if($this->session->userdata("user_type") == "MasterDealer"){?>
 	
 
<div id="nav-sub-wrap" style="width:100%;"> 
            <ul id="nav-sub"> 
            
                <li class="first"><a href="<?php echo base_url()."recharge_home" ?>" title="Home">Home</a> </li> 
              <li><a href="#" title="Payment" class="top_link"><span class="down">Distributor</span></a>
  			<ul>  			
            <li><a href="<?php echo base_url()."d_dealer_form1"; ?>" title="Commission Rate">Add New Distributor</a></li>
            <li><a href="<?php echo base_url()."dealer_home"; ?>" title="Commission Recieved">View Distributor</a></li>            </ul>
  			</li>
            <li><a href="#" title="Payment" class="top_link"><span class="down">Agent</span></a>
  			<ul>  			
            <!--<li><a href="<?php echo base_url()."agent_registration"; ?>" title="Add Agent">Add New Agent</a></li>-->
            <li><a href="<?php echo base_url()."agent_list2"; ?>" title="View Agent">View Agent</a></li> 
             <li><a href="<?php echo base_url()."child_transactions"; ?>" title="Agent transactions">Agent Transactions</a></li>            </ul>
  			</li>
           <li><a href="#" title="Payment" class="top_link"><span class="down">Commission</span></a>
  			<ul>  			
            <li><a href="<?php echo base_url()."earn_comm"; ?>" title="Commission ">Earn Commission </a></li>
            <li><a href="<?php echo base_url()."withdraw_comm"; ?>" title="Commission ">Withdraw Commission</a></li>
<!--<li><a href="<?php echo base_url()."commission_rate"; ?>" title="Commission Rate">My Commission</a></li>-->
           
                
       </ul>
  			</li>
  <li><a href="#" title="Report" class="top_link"><span class="down">Report</span></a>
    <ul>
    			<li><a href="<?php echo base_url()."all_transaction_report"; ?>" title="All Reports">Recharge History</a></li>
        		 <li><a href="<?php echo base_url()."d_accountreport"; ?>" title="Account Reports">Account Reports</a></li>
                <li><a href="<?php echo base_url()."md_check_status"; ?>" title="Account Reports">Check Status</a></li>
                                      
	</ul>
  </li>
   <li><a href="#" title="Extra" class="top_link"><span class="down">Document &amp; Complain</span></a>
    <ul>  
     
    <li><a href="<?php echo base_url()."m.apk"; ?>" title="Android app" target="_blank">Android app</a></li>
  	<li><a href="<?php echo base_url()."sms_format"; ?>" title="SMS Format" target="_blank">SMS Format</a></li>
	<?php if($this->session->userdata('isAPI') == 'yes'){ ?>
  <li><a href="<?php echo base_url()."api.pdf"; ?>" target="_blank" title="API Document">API Document</a></li>
  <?php } ?>
	<li><a href="<?php echo base_url()."complain"; ?>" title="Complain">Complain</a></li>  
    </ul>
  </li>
  <li><a href="#" title="Profile" class="top_link"><span class="down">Profile</span></a>
    <ul class="sub" id="profilesubmenu">
  			<li><a href="<?php echo base_url()."change_profile" ?>" title="Change Profile">Change Profile</a></li>
			<li><a href="<?php echo base_url()."c_change_password" ?>" title="Change Password">Change Password</a></li>
                        
	</ul>
  </li>  
                
              
          <li><a href="<?php echo base_url(); ?>payment_request" class="top_link"><span class="down">Payment Request</span></a>
<ul>
<li><a href="<?php echo base_url(); ?>payment_request" class="top_link"><span class="down">Update Payment</span></a></li>
<li><a href="<?php echo base_url()."list_bank"; ?>">Bank List</a></li></ul>
</li>
          </a></li>             
            </ul> 
      
        <?php } ?>
		
        
        
        
        <?php if($this->session->userdata("user_type") == "Distributor"){?>
 	
 
<div id="nav-sub-wrap" style="width:100%;"> 
            <ul id="nav-sub"> 
                <li class="first"><a href="<?php echo base_url()."recharge_home" ?>" title="Home">Home</a> </li> 
            <li><a href="#" title="Payment" class="top_link"><span class="down">Agent</span></a>
  			<ul>  			
            <li><a href="<?php echo base_url()."agent_registration"; ?>" title="Commission Rate">Add New Agent</a></li>
            <li><a href="<?php echo base_url()."dist_home"; ?>" title="Commission Recieved">View Agent</a></li>
            <li><a href="<?php echo base_url()."child_transactions"; ?>" title="Agent transactions">Agent Transactions</a></li>            </ul>
  			</li>
  			  <li><a href="#" title="Payment" class="top_link"><span class="down">Commission</span></a>
  			<ul>  
<!--<li><a href="<?php echo base_url()."commission_rate"; ?>" title="Commission Rate">My Commission</a></li>-->			
            <li><a href="<?php echo base_url()."earn_comm"; ?>" title="Commission ">Earn Commission </a></li>
            <li><a href="<?php echo base_url()."withdraw_comm"; ?>" title="Withdraw Commission">Withdraw Commission </a></li>
                       </ul>
  			</li>
           
  <li><a href="#" title="Report" class="top_link"><span class="down">Report</span></a>
    <ul>
    			<li><a href="<?php echo base_url()."all_transaction_report"; ?>" title="All Reports">Recharge History</a></li>
        		
               <li><a href="<?php echo base_url()."d_accountreport"; ?>" title="Account Reports">Account Reports</a></li>
                <li><a href="<?php echo base_url()."md_check_status"; ?>" >Check Status</a></li>
          </li>                      
	</ul>
  </li>
   <li><a href="#" title="Extra" class="top_link"><span class="down">Document &amp; Complain</span></a>
    <ul>  
     
    <li><a href="<?php echo base_url()."m.apk"; ?>" title="Android app" target="_blank">Android app</a></li>
  	<li><a href="<?php echo base_url()."sms_format"; ?>" title="SMS Format" target="_blank">SMS Format</a></li>
	<?php if($this->session->userdata('isAPI') == 'yes'){ ?>
  <li><a href="<?php echo base_url()."api.pdf"; ?>" target="_blank" title="API Document">API Document</a></li>
  <?php } ?>
	<li><a href="<?php echo base_url()."complain"; ?>" title="Complain">Complain</a></li>  
    </ul>
  </li>
  <li><a href="#" title="Profile" class="top_link"><span class="down">Profile</span></a>
    <ul class="sub" id="profilesubmenu">
  			<li><a href="<?php echo base_url()."change_profile" ?>" title="Change Profile">Change Profile</a></li>
			<li><a href="<?php echo base_url()."c_change_password" ?>" title="Change Password">Change Password</a></li>
                        
	</ul>
  </li>  
                
           <li><a href="<?php echo base_url(); ?>payment_request" class="top_link"><span class="down">Payment Request</span></a>
<ul>
<li><a href="<?php echo base_url(); ?>payment_request" class="top_link"><span class="down">Update Payment</span></a></li>
<li><a href="<?php echo base_url()."list_bank"; ?>">Bank List</a></li></ul>
</li>
          </a></li>  
                 
            </ul> 
           
        <?php } ?>
        <div id="divbal">
          <span id="spanbal" style="text-align:center;vertical-align:central;padding-top:10px;float:left;position:absolute;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;font-weight:bold;color:#FFF;">processing</span>
          </div>
		 </div>