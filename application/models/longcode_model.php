<?php
class Longcode_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function LastThreeTransaction($user_id)
	{
		$str_query = "select tblrecharge.*,tblcompany.company_name FROM `tblrecharge`,tblcompany WHERE tblcompany.company_id = tblrecharge.company_id and user_id=? order by recharge_id desc LIMIT 0 , 3";
		$result = $this->db->query($str_query,array($user_id));
		return $result;
	}
	public function GetUserInfo($user_id)
	{
		$str_query = "select * from tblusers where user_id=?";
		$result = $this->db->query($str_query,array($user_id));
		return $result;
	}
	public function CheckPendingResult($mobile,$amount)
	{	
		$this->load->library("common");
		$recharge_date = $this->common->getMySqlDate();
		$str_query = "select * from  tblrecharge where mobile_no=? and amount=? and recharge_status=? and recharge_date=?";
		$result = $this->db->query($str_query,array($mobile,$amount,'Pending',$recharge_date));		
		if($result->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	public function UpdateAPI($Api_name,$transid)
	{
		$str_query = "update tblrecharge set ExecuteBy=? where recharge_id=?";
		$result = $this->db->query($str_query,array($Api_name,$transid));					
		return $result;
	}
	public function UpdateRechargeStatus($Status,$transid,$recharge_id)
	{
		$Txid = 'Tx'.$recharge_id;
		$str_query = "update tblrecharge set recharge_status=?,transaction_id=?,txid=? where recharge_id=?";
		$result = $this->db->query($str_query,array($Status,$transid,$Txid,$recharge_id,));					
		return $result;
	}
	public function GetAPIInfo($company_id,$scheme_id)
	{		
	$str_query = "select tblapi.* FROM `tblcommission`,`tblapi` WHERE tblapi.api_id=tblcommission.api_id
and tblapi.status=1 and tblcommission.company_id=? and tblcommission.set_prority=1 and tblcommission.scheme_id =?";
	$result = $this->db->query($str_query,array($company_id,$scheme_id));		
	return $result;	
	}
	public function getCompanyResult($Key,$Subkey)
	{	
		$lc_format = $Key." ".$Subkey;
		$str_query = "select * from tblcompany where long_code_format=?";
		$result = $this->db->query($str_query,array($lc_format));		
		if($result->num_rows() == 1)
		{
			$data = array('company_id' => $result->row(0)->company_id,'provider' => $result->row(0)->provider,'service_id' => $result->row(0)->service_id,'company_name'=>$result->row(0)->company_name);
			return $data;
		}
		else
		{
			return false;
		}		
	}
	public function getCircleCode($circle)
	{	
		$str_query = "select * FROM `tblstate` WHERE codes=?";
		$result = $this->db->query($str_query,array($circle));		
		if($result->num_rows() == 1)
		{
			return $result->row(0)->circle_code;
		}
		else
		{
			return false;
		}		
	}	
	public function getCircleCodeUserID($userid)
	{	
		$str_query = "select * FROM `tblstate` WHERE state_id=(select state_id from tblusers where user_id=?)";
		$result = $this->db->query($str_query,array($userid));		
		if($result->num_rows() == 1)
		{
			$data = array('circle_code' => $result->row(0)->circle_code);
			return $data;
		}
		else
		{
			$data = array('circle_code' => '*');
			return $data;
		}		
	}	
	public function Find_LongcodeUser($mobile)
	{
		//$mob = substr($mobile,2);
		$str_query = "select * from tblusers where mobile_no = ?";
		$result = $this->db->query($str_query,array($mobile));		
		if($result->num_rows() == 1)
		{			
			if($result->row(0)->status == 0)
			{
				return false;
			}
			else
			{
			return $result;
			}
		}
		else
		{
			return false;
		}		
	}
	public function Find_SenderInfo($Receiver_Id)
	{
		//$mob = substr($mobile,2);
		$str_query = "select * from tblusers where mobile_no = ?";
		$result = $this->db->query($str_query,array($Receiver_Id));		
		if($result->num_rows() == 1)
		{			
			return $result;
		}
		else
		{
			return false;
		}		
	}	
	
	public	function add($company_id,$amount,$mobile_no,$user_id,$service_id,$description,$recharge_type,$recharge_status,$ApiInfo)
	{		
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$recharge_date = $this->common->getMySqlDate();
		$recharge_time = $this->common->getMySqlTime();	
		$user_details = $this->GetUserInfo($user_id);						
		
		$user = $user_details->row(0)->usertype_name;						
		if(trim($user) == 'Agent' or trim($user) == 'MLMAgent' or trim($user) == 'Customer')
		{
		$commission_query = "SELECT tblcommission.*,tblcompany.company_name FROM `tblcommission`,tblcompany where tblcompany.company_id = tblcommission.company_id and tblcommission.company_id=? and scheme_id = ?  order by tblcompany.company_name";
		$result_commission = $this->db->query($commission_query,array($company_id,$user_details->row(0)->scheme_id));		
		if($result_commission->num_rows()== 1)
		{
		$commission_per = $result_commission->row(0)->commission_per;
		$commission_amount =round((($amount * $result_commission->row(0)->commission_per) / 100),4);
		}
		else
		{
		$commission_per = 0;		
		$commission_amount = 0;
		}
		}
		else
		{
		$commission_per = 0;		
		$commission_amount = 0;
		}
		
		if(trim($user) == 'Agent' or trim($user) == 'MLMAgent'){					
		$parent_id = $this->GetDistributerID($user_id);
		$commission_dealer_query = "select commission_per from tblcommission where scheme_id = ( select scheme_id from tblusers where user_id=?) and company_id = ?";
		$result_dealer_commission = $this->db->query($commission_dealer_query,array($parent_id,$company_id));		
		if($result_dealer_commission->num_rows()== 1)
		{
		$commission_dealer_per = $result_dealer_commission->row(0)->commission_per - $commission_per;
		$commission_dealer_amount =round((($amount * $commission_dealer_per) / 100),4);
		}
		else
		{
		$commission_dealer_per = 0;		
		$commission_dealer_amount = 0;
		}				
		}
		else
		{
		$commission_dealer_per = 0;		
		$commission_dealer_amount = 0;
		}
		
		
		if($ApiInfo->num_rows()== 1) 
			{				
				if($ApiInfo->row(0)->api_name == "RoyalCapital")
				{
					$ExecuteBy = 'RoyalCapital';
				}				
			}									
if($description == 'USSD'){$by='USSD';}else{$by='SMS';}
		
		$str_query = "insert into tblrecharge(company_id,amount,mobile_no,user_id,service_id,recharge_date,recharge_time,recharge_by,description,
					 recharge_type,recharge_status,add_date,ipaddress,commission_amount,commission_per,distributer_commission_amount,distributer_commission_per,ExecuteBy) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($company_id,$amount,$mobile_no,$user_id,$service_id,$recharge_date,$recharge_time,$by,$description,$recharge_type,$recharge_status,$date,$ip,$commission_amount,$commission_per,$commission_dealer_amount,$commission_dealer_per,$ExecuteBy));					
		if($result > 0)
		{							
			$Recharge_id=$this->db->insert_id();									
			return $Recharge_id;
		}
		else
		{
			return false;
		}						
	}	
	
	public function getCurrentBalance($user_id)
	{	
	$this->load->model("Recharge_home_model");			
	$result = $this->Recharge_home_model->GetBalanceByUser($user_id);
	return $result;
	}


	public function GetDistributerID($user_id)
	{		
	$str_query = "select parent_id from tblusers where user_id = ?";
	$result = $this->db->query($str_query,array($user_id));		
	return $result->row(0)->parent_id;	
	}
	public function GetBalByUser($user_id)
	{		
	$str_query = "select bal from tblbalance where user_id = ?";
	$result = $this->db->query($str_query,array($user_id));		
	return $result->row(0)->bal;	
	}	
	public function SetNewBal($user_id,$newbal)
	{		
	$str_query = "update tblbalance set bal=? where user_id = ?";
	$result = $this->db->query($str_query,array($newbal, $user_id));				
	}		
	public function GetCommissionParents($user_id)
	{		
		$str_query = "select commission_user from tblusers where user_id = ?";
		$result = $this->db->query($str_query,array($user_id));		
		return explode(',',$result->row(0)->commission_user);
	}	
	
	public function ExecuteLC($Test)
	{
		$str_query = "insert into tbltest(message) values(?)";
		$result = $this->db->query($str_query,array($Test));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	/////////
	// THIS FUNCTION VALIDATES USER BY ITES MOBILE NUMBER
	///////////////////////////////////////////////////
	public function validateUser($userinfo)
	{
		if($userinfo->num_rows() == 1)
		{
			if($userinfo->row(0)->status != '0')
			{
				if($userinfo->row(0)->usertype_name == "Agent" or $userinfo->row(0)->usertype_name == "MasterDealer" or $userinfo->row(0)->usertype_name == "Distributor" or $userinfo->row(0)->usertype_name == "Admin")
				{
					return true;
				}
				else
				{
					return "You are Not Authorized To User This Service";
				}
			}
			else
			{
				return "your account is disable";
			}
		}
		else
		{
			return "Invalid User";
		}
	}
	/////////
	// THIS FUNCTION SEND BALANCE MESSAGE
	///////////////////////////////////////////////////
public function ProcessBalanceForLongcode($userinfo)
	{
	
		$mobile_no = $userinfo->row(0)->mobile_no;
		$usertype = $userinfo->row(0)->usertype_name;
		$user_id = $userinfo->row(0)->user_id;
		$balance = $this->Common_methods->getAgentBalance($user_id);
			$smsMessage='Dear Business Partner Your Current Balance is '.$balance.' ';
$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$mobile_no,$smsMessage);			
			echo $smsMessage;exit(0);
		
		
		
	}
	/////////
	// THIS FUNCTION SEND LAST 3 TRANSACTION MESSAGE
	///////////////////////////////////////////////////
	public function ProcessLSTForLongcode($userinfo)
	{
		$user_id = $userinfo->row(0)->user_id;
		$mobile_no = $userinfo->row(0)->mobile_no;
			$result_transaction  = $this->LastThreeTransaction($user_id);
			if($result_transaction->num_rows() == 3)
			{
$smsMessage	='Your Last Three Transation Details are 1.'.$result_transaction->row(0)->mobile_no.' '.$result_transaction->row(0)->amount.'  '.$result_transaction->row(0)->recharge_status.'  '.$result_transaction->row(0)->company_name.'  2.'.$result_transaction->row(1)->mobile_no.' '.$result_transaction->row(1)->amount.' '.$result_transaction->row(1)->recharge_status.'  '.$result_transaction->row(1)->company_name.'   3.'.$result_transaction->row(2)->mobile_no.'  '.$result_transaction->row(2)->amount.'  '.$result_transaction->row(2)->recharge_status.'  '.$result_transaction->row(2)->company_name.' ';			
					
	$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$mobile_no,$smsMessage);	
			echo $result_sms.'??'.$smsMessage;exit(0);
			}
		
	}	
}
?>