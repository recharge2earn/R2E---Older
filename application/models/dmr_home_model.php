<?php
class Dmr_home_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($company_id,$amount,$mobile_no,$user_id,$service_id,$description,$recharge_type,$recharge_status,$ApiInfo,$scheme_id,$rechargeBy)
	{
		$commission_countPer = 0.0;
		$this->load->model("Tblrecharge_methods");
		$LOG = "";
		$Log_commission_persentage = "";
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$recharge_date = $this->common->getMySqlDate();
		$recharge_time = $this->common->getMySqlTime();				
		$api_name = $ApiInfo->row(0)->api_name;
		$user_type = $this->Userinfo_methods->getUserType($user_id);
		

			$commission_per = $this->Userinfo_methods->getCommissionInfo($company_id,$user_id);
			$commission_countPer += $commission_per;
			$commission_amount = round($commission_per,4);

		
		if($ApiInfo->num_rows()== 1) 
		{				
			$ExecuteBy = $ApiInfo->row(0)->api_name;
		}									
		
		$str_query = "insert into tblrecharge(company_id,amount,mobile_no,user_id,service_id,recharge_date,recharge_time,recharge_by,description,					 recharge_type,recharge_status,add_date,ipaddress,commission_amount,commission_per,distributer_commission_amount,
distributer_commission_per,ExecuteBy) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				
		$result = $this->db->query($str_query,array($company_id,$amount,$mobile_no,$user_id,$service_id,$recharge_date,$recharge_time,$rechargeBy,$description,$recharge_type,$recharge_status,$date,$ip,$commission_amount,$commission_per,0,0,$ExecuteBy));					
		if($result > 0)
		{			
			$recharge_id=$this->db->insert_id();
//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////// CODE FOR 3 LEVEL PARENT COMMISSION -> ENTRY IN TBLPARENTCOMMISSION ////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
			
			if(trim($user_type) == 'Agent')
			{
				$parent =  $this->GetDistributerID($user_id);
				$schemeD = $this->Userinfo_methods->getSchemeId($parent);
				$schemeD_type = $this->Userinfo_methods->getSchemeType($schemeD);
				if($this->getUserType($parent) == "Distributor")
				{
					if($schemeD_type != "flat" and $schemeD_type != false)
					{
						$dealercomm = $this->Userinfo_methods->getCommissionInfo($company_id,$parent);
						
						$commission_d_per = $commission_per - $dealercomm;
					
						$commission_countPer += $commission_d_per;
						$commission_d_amount = $commission_d_per;
						$this->addParentCommission($parent,$user_id,$commission_d_amount,$commission_d_per,$recharge_id,$company_id);
					}
				$parentOf_d = $this->GetDistributerID($parent); 
				$schemeMD = $this->Userinfo_methods->getSchemeId($parentOf_d);
				$schemeMD_type = $this->Userinfo_methods->getSchemeType($schemeMD);
			
				if($this->getUserType($parentOf_d) == "MasterDealer")
				{
					if($schemeMD_type != "flat" and $schemeD_type != false)
					{
					    if($dealercomm < $commission_per)
					    {
						$mdComm = $this->Userinfo_methods->getCommissionInfo($company_id,$parentOf_d);
						
						
						$commission_MDealer_per = $dealercomm - $mdComm;
					
						$commission_countPer += $commission_MDealer_per;
						$commission_MDealer_amount = $commission_MDealer_per;
						$this->addParentCommission($parentOf_d,$user_id,$commission_MDealer_amount,$commission_MDealer_per,$recharge_id,$company_id);
					    }
					}
					
				}
			}
			
			}
			else if(trim($user_type) == 'Distributor')
			{
				$parent =  $this->GetDistributerID($user_id);
				$schemeM = $this->Userinfo_methods->getSchemeId($parent);
				$schemeM_type = $this->Userinfo_methods->getSchemeType($schemeM);
				if($this->getUserType($parent) == "MasterDealer")
				{
					if($schemeM_type != "flat" and $schemeM_type != false)
					{
						$mdealercomm = $this->Userinfo_methods->getCommissionInfo($company_id,$parent);
						
						$commission_m_per = $commission_per - $mdealercomm;
					
						$commission_countPer += $commission_m_per;
						$commission_m_amount = $commission_d_per;
						$this->addParentCommission($parent,$user_id,$commission_m_amount,$commission_m_per,$recharge_id,$company_id);
					}
				}
			
			}
			$admin_id = $this->Userinfo_methods->getAdminId();
			$totalCommPer = $this->Userinfo_methods->getTotalCommissionPer($company_id,$ExecuteBy);
			$update_query = $this->db->query("update tblrecharge set totalCommissionPer=? where recharge_id = ?",array($totalCommPer,$recharge_id));
			$admin_commissionPer = $totalCommPer - $commission_countPer;
			if($admin_commissionPer > 0)
			{
				$admin_commissionAmount = ($admin_commissionPer * $amount) / 100;
				$this->addParentCommission($admin_id,$user_id,$admin_commissionAmount,$admin_commissionPer,$recharge_id,$company_id);
			}
			else
			{
				$admin_commissionAmount = 0;
			}					
			return $recharge_id;
		}
		else
		{
			return false;
		}		
	}	
	public function GetAPIInfo($company_id)
	{		
	$str_query = "select * from tblapi where tblapi.api_id = (select api_id from tblcompany where tblcompany.company_id = '$company_id')";
	$result = $this->db->query($str_query);		
	return $result;	
	}
	public function GetDistributerID($user_id)
	{		
	$str_query = "select parent_id from tblusers where user_id = ?";
	$result = $this->db->query($str_query,array($user_id));		
	return $result->row(0)->parent_id;	
	}	
	public function CheckStatus($user_id)
	{		
	$str_query = "select status from tblusers where user_id = ?";
	$result = $this->db->query($str_query,array($user_id));		
	if($result->row(0)->status == '1')
	{
		return false;
	}
	else
	{
		return true;
	}
	}	
	
	
	
	
	public function CheckBalance($user_id,$request_amount) 
	{
		$Balance = $this->GetBalanceByUser($user_id);
		
		if($Balance - $request_amount >= 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function GetBalanceByUser($user_id)
	{		
			$str_query = "select IFNULL(sum(amount),0) - (select IFNULL(sum(amount),0) from tblpayment where dr_user_id=?) - (select IFNULL(sum(amount),0) as 'RechargeAmount' from tblrecharge where user_id=? and (recharge_status='Success' or recharge_status='Pending'))+
			(select IFNULL(SUM(OBJDCOM.distributer_commission_amount),0) AS dis_commission_amount from `tblrecharge` OBJDCOM where OBJDCOM.user_id in (select OBJUNDER.user_id FROM `tblusers` OBJUNDER WHERE OBJUNDER.usertype_name !='Agent' and  OBJUNDER.parent_id=?) and (OBJDCOM.recharge_status='Success' or OBJDCOM.recharge_status='Pending'))
			 + (select IFNULL(SUM(commission_amount),0) AS commission_amount from tblrecharge where user_id=? and (recharge_status='Success' or recharge_status='Pending')) +(SELECT IFNULL(SUM(tblparentcommission.amount),0) FROM tblparentcommission
		JOIN tblrecharge ON (tblparentcommission.recharge_id = tblrecharge.recharge_id) 
		where tblrecharge.recharge_status=? and tblparentcommission.user_id=?)  as Balance from tblpayment where cr_user_id=?";
	$result = $this->db->query($str_query,array($user_id,$user_id,$user_id,$user_id,'Success',$user_id,$user_id));		
return round($result->row(0)->Balance,4);	


	}
	public function updateRechargeStatus($recharge_id,$trns_id,$operator_trans_id,$status)
	{
		$str_query = "update tblrecharge set recharge_status=?,transaction_id=?,operator_id=? where recharge_id = ?";
		$rslt = $this->db->query($str_query,array($status,$trns_id,$operator_trans_id,$recharge_id));
		
		return true;
	}
	public function getUserType($user_id)
	{
		$str_query = "select * from tblusers where user_id = ?";
		$result = $this->db->query($str_query,array($user_id));
		return $result->row(0)->usertype_name;
	}
	public function getSworldCircle($circle_code)
	{
		$rslt = $this->db->query("select * from tblstate where circle_code='".$circle_code."'");
		return $rslt->row(0)->sworld_cirle;
	}
	public function addParentCommission($user_id,$given_by,$amount,$commPer,$recharge_id,$company_id)
	{
		$this->load->library('common');
		$add_date = $this->common->getDate();
		$str_pay = "insert into tblparentcommission(user_id,amount,commPer,comm_by,recharge_id,add_date,company_id) values(?,?,?,?,?,?,?)";
		$result = $this->db->query($str_pay,array($user_id,$amount,$commPer,$given_by,$recharge_id,$add_date,$company_id));
	}

}

?>