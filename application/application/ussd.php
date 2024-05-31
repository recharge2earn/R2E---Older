<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ussd extends CI_Controller {		
	public function index() 
	{							
		header('Content-Type:text/xml'); 
		print '<?xml version="1.0" encoding="UTF-8" ?>';		
		if(isset($_GET['mobile']))
		{
		$mobile = $_GET['mobile'];			
		}
		else{$mobile = 'NO';}
		$this->load->model('Longcode_model');		
		$USER_INFO = $this->Longcode_model->Find_LongcodeUser($mobile);
		if($USER_INFO == false){
		//echo '<ussd><message navigation="false">
//		Your mobile is not register.
//		Register Your mobile in www.royalcapital.in		
//		</message> </ussd>';
		exit(0);}				
		
		$this->load->model('Longcode_model');		
		$USER_INFO = $this->Longcode_model->Find_LongcodeUser($mobile);
		$myBalance = $this->Longcode_model->getCurrentBalance($USER_INFO->row(0)->user_id);	
		if(intval($myBalance) < 0.5)	
		{
			exit(0);
		}
		$user_id = $USER_INFO->row(0)->user_id;
		$str_query = "update tblrecharge set new_bal =(new_bal - 0.05) where user_id='$user_id' Order By recharge_id desc limit 1";
		$this->db->query($str_query);	
			
		echo '<ussd> <message navigation="true" callback="new_step1_ussd?mobile='.$mobile.'">
Enter Recharge Code
</message> 
</ussd>';
		
		
	}	
}