<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super Admin Home</title>
    <?php require_once("script.php"); ?>
    <link rel="stylesheet" href="<?php echo base_url()."js/dashboard.css"; ?>">
    <script src="<?php echo base_url()."js/dashboard.js"; ?>"></script>
  <style>
	#sortable1 li, #sortable2 li, #sortable3 li, #sortable4 li, #sortable5 li,#sortable6 li{ margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; width: 180px;text-align:left; }
	.demo th{color:#fff;font-size:16px;background-color:#0073ea;}
	</style>
</head>

<body class="twoColFixLtHdr">
<div id="container">
  <div id="header">
 <?php require_once("a_header.php"); ?> 
  </div>
  <div id="menu">
   <?php require_once("a_menu.php"); ?> 
  </div>
  <div id="back-border">
  </div>
  <div style="height:auto;">
    <h1 style="color:#0073ea">Welcome to Super Admin Panel</h1>   
    	<div class="demo">
        <hr />
                   <table style="width:100%" cellpadding="5" cellspacing="0" border="0">
                   <tr>       
                   <th scope="col" align="center">Distributor</th>
                   </tr>
                   <tr>
                   <td align="center" valign="top"><ul id="sortable2" class="connectedSortable ui-helper-reset">
                          <li class="ui-state-default"><a href="d_registration" title="Add New Distributer" style="color:#000;font-weight:bold;font-family:Verdana, Geneva, sans-serif;">Create New Distributer</a></li>
                          <li class="ui-state-default"><a href="list_distributer" title="List of Distributer" style="color:#000;font-weight:bold;font-family:Verdana, Geneva, sans-serif;">List of Distributer</a></li>
                          <li class="ui-state-default"><a href="all_distributer_report" title="Distributer" style="color:#000;font-weight:bold;font-family:Verdana, Geneva, sans-serif;">Transaction</a></li>
                      </ul></td>
                   <td align="center" valign="top"></td>
                          </tr>
                          </table>
                          <hr />
                    <table style="width:100%" cellpadding="5" cellspacing="0" border="0">
                   <tr>
                   <th scope="col" align="center">Customer</th>
                   <th scope="col" align="center">Extra</th>
                   <th scope="col" align="center">Report</th>
                   </tr>
                   
                          <tr>
                   <td align="center" valign="top"><ul id="sortable4" class="connectedSortable ui-helper-reset">
                          <li class="ui-state-default"><a href="list_customer" title="List of Customer" style="color:#000;font-weight:bold;font-family:Verdana, Geneva, sans-serif;">List of Customer</a></li>
                          <li class="ui-state-default"><a href="customer_balance_report" title="Customer Balance" style="color:#000;font-weight:bold;font-family:Verdana, Geneva, sans-serif;">Customer Balance Report</a></li>
                      </ul></td>
                   <td align="center" valign="top"><ul id="sortable5" class="connectedSortable ui-helper-reset">
                          <li class="ui-state-default"><a href="<?php echo base_url()."change_password"; ?>" title="Change Password" style="color:#000;font-weight:bold;font-family:Verdana, Geneva, sans-serif;">Change Password</a></li>
                          <li class="ui-state-default"><a href="<?php echo base_url()."login_history"; ?>" title="Login History" style="color:#000;font-weight:bold;font-family:Verdana, Geneva, sans-serif;">Login History</a></li>
                           <li class="ui-state-default"><a href="<?php echo base_url()."account/account_ledger"; ?>" title="Login History" style="color:#000;font-weight:bold;font-family:Verdana, Geneva, sans-serif;">Account Ledger</a></li>
                      </ul></td>
                      <td align="center" valign="top"><ul id="sortable6" class="connectedSortable ui-helper-reset">
                        	<li class="ui-state-default"><a href="list_recharge_pending" title="Pending Report" style="color:#000;font-weight:bold;font-family:Verdana, Geneva, sans-serif;">Pending Report</a></li>
                            <li class="ui-state-default"><a href="distributer_report" title="Distributer Report" style="color:#000;font-weight:bold;font-family:Verdana, Geneva, sans-serif;">Distributer Report</a></li>
                            <li class="ui-state-default"><a href="distributer_balance_report" title="Distributer Balance Report" style="color:#000;font-weight:bold;font-family:Verdana, Geneva, sans-serif;">Distributer Balance Report</a></li>
                            <li class="ui-state-default"><a href="retailer_report" title="Retailer Report" style="color:#000;font-weight:bold;font-family:Verdana, Geneva, sans-serif;">Retailer Report</a></li>
                            <li class="ui-state-default"><a href="retailer_balance_report" title="Retailer Balance Report" style="color:#000;font-weight:bold;font-family:Verdana, Geneva, sans-serif;">Retailer Balance Report</a></li>
                         </ul></td>
                   </tr>
                   </table>                                                  
		</div><!-- End demo -->
<br class="clearfloat" />
<div id="footer">
     <?php require_once("a_footer.php"); ?>
</div>
</div>


</div>
</body>
</html>