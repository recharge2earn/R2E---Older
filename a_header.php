<style>

	 h2{font-family:Georgia,"Times New Roman",serif;font-size:20px;color:#383f35;text-decoration:none;margin-left:0px;margin-top:0px;margin-bottom:0px;text-shadow:none;background-color:transparent;background:transparent;vertical-align:text-top;}     

	 </style>

<table width="100%" cellpadding="0" cellspacing="0" border="0">

<tr>

<td align="left" style="padding-top:10px;"><a href="<?php echo base_url().'site_admin'; ?>"><img src="images/logo.png" alt=""></td>      

<td align="right" style="padding-top:0px;width="250px"><p><span style="font-weight:bold;color:#000">Welcome <?php echo $this->session->userdata('abusiness_name');	

	?></span><br /><IFRAME src="/rc24_balance" width="500" height="50" frameBorder="0" scrolling="no"></IFRAME>
</p>
  <p>&nbsp;<a href="<?php echo base_url()."adminlogout"; ?>" class="Paging" style="font-weight:bold;font-size:15px;">Log out</a></p></td></tr></table>
