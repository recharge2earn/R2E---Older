<?php
class Sms extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function receiveBalance($user_info,$amount)
	{
		
		$user_id = $user_info->row(0)->user_id;
		$bal = $this->Common_methods->getAgentBalance($user_id);
		$rsltparent = $this->db->query("select user_id,business_name,parent_id,usertype_name,mobile_no from tblusers where user_id = ?",array($user_info->row(0)->parent_id));
		$parent_id = $user_info->row(0)->parent_id;
		$parent_bal = $this->Common_methods->getAgentBalance($parent_id);
		$this->load->library("common");				
$smsMessageSENDER = "Dear Business Partner, Your Transfered Amount to ".$user_info->row(0)->business_name." is ".$amount.", Your Updated Balance is ".($parent_bal).", ";
$message  = $smsMessageSENDER;


$smsMessageCUSTOMER = "Dear Business Partner, Your Received Amount is ".$amount.", Your Updated Balance is ".($bal).", ";
$message2  = $smsMessageCUSTOMER;				
				$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$user_info->row(0)->mobile_no,$smsMessageCUSTOMER);
					
				$result_sms1 = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$rsltparent->row(0)->mobile_no,$message);
			//	echo $result_sms .'?'. $result_sms1 ;	
	}
	public function revertBalance($mobile,$amount,$bal)
	{
		$user_name = $this->common_value->getSMSUserName();
		$password = $this->common_value->getSMSPassword();
		$smsMessage = 
'Dear 
Your Revert Amount is '.$amount.', 
Your Updated Balance is '.$bal.', 
';	
$this->common->ExecuteSMSApi($user_name,$password,$mobile,$smsMessage);	
	}
}

?>