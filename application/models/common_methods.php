<?php
class Common_methods extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function getCommissionPer($scheme_id,$company_id)
	{
		
			$commission_query = "SELECT tblcommission.*,tblcompany.company_name FROM `tblcommission`,tblcompany where tblcompany.company_id = tblcommission.company_id and tblcommission.company_id=? and scheme_id = ?  order by tblcompany.company_name";
			$result_commission = $this->db->query($commission_query,array($company_id,$scheme_id));		
			if($result_commission->num_rows()== 1)
			{
				return $result_commission->row(0)->commission_per;
			}
			else
			{
				return 0;
			}
		
	}
	public function getParentCommissionPer($commission_per,$user_id,$company_id)
	{
		$this->load->model("userinfo_methods");
		$parent_id = $this->userinfo_methods->getParentId($user_id);
		$parent_type =  $this->userinfo_methods->getUserType($parent_id);
		
		if(trim($parent_type) == 'Retailer' or trim($parent_type) == 'Distributer')
		{
			$parent_scheme_id = $this->userinfo_methods->getSchemeId($parent_id);
			$parent_commission_per =  $this->getCommissionPer($parent_scheme_id,$company_id);
			if($parent_commission_per > $commission_per)
			{
				return ($parent_commission_per - $commission_per);
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
	public function getCommissionAmount($commission_per,$amount)
	{
		return round((($amount * $commission_per) / 100),4);
	}
	public function GetAPIName($company_id,$scheme_id)
	{		
		$str_query = "select tblapi.* FROM `tblcommission`,`tblapi` WHERE tblapi.api_id=tblcommission.api_id
	and tblapi.status=1 and tblcommission.company_id=? and tblcommission.set_prority=1 and tblcommission.scheme_id =?";
		$result = $this->db->query($str_query,array($company_id,$scheme_id));
		if($result->num_rows() == 1)
		{		
			return $result->row(0)->api_name;	
		}
		else 
		{
			return "No Api";
		}
	}
	public function getServiceId($company_id)
	{
		$str_query = "select service_id from tblcompany where company_id = ?";
		$result = $this->db->query($str_query,array($company_id));
		return $result->row(0)->service_id;
	}
	public function getRechargeType($service_id)
	{
		$str_query = "select service_name from  tblservice where service_id = ?";
		$result = $this->db->query($str_query,array($service_id));
		if($result->num_rows() == 1)
		{
			return $result->row(0)->service_name;
		}
		else
		{
			return "";
		}
		
	}
	public function GetAPIInfo($company_id,$scheme_id)
	{		
		$str_query = "select tblapi.* FROM `tblcommission`,`tblapi` WHERE tblapi.api_id=tblcommission.api_id
	and tblapi.status=1 and tblcommission.company_id=? and tblcommission.set_prority=1 and tblcommission.scheme_id =?";
		$result = $this->db->query($str_query,array($company_id,$scheme_id));		
		return $result;	
	}
	public function CheckPendingResult($MobileNo,$Amount)
	{
		$this->load->library("common");
		$recharge_date = $this->common->getMySqlDate();
		$str_query = "select * from  tblrecharge where mobile_no=? and amount=? and recharge_status=? and recharge_date=?";
		$result = $this->db->query($str_query,array($MobileNo,$Amount,'Pending',$recharge_date));		
		if($result->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	
	
	
///////////////////////////////////// BALANCE //////////////////////////////////////////////////////////////

	public function getAgentBalance($user_id)
	{
		$balance = $this->getCurrentBalance($user_id);
		//$pendingRec = $this->getTotalPandingRecharge($user_id);
		$AgentBalance = $balance;
		return $AgentBalance;
		
	}
	public function getTotalPandingRecharge($user_id)
	{
		$str_query = "select IFNULL(Sum(amount),0) as pendingRec from tblrecharge where user_id = '$user_id' and recharge_status = 'Pending'";
		$rslt = $this->db->query($str_query);
		return $rslt->row(0)->pendingRec;
	}
	public function getCurrentBalance($user_id)
	{
		$str_query = "SELECT * FROM `tblewallet` where user_id = ? order by Id desc limit 1";
		$result = $this->db->query($str_query,array($user_id));
		if($result->num_rows() > 0)
		{
			return $result->row(0)->balance;
		}
		else 
		{
			return 0;
		}
		return 0;
	}
	public function getCurrentBalanceArray($user_id)
	{
		
			$str_query = "SELECT tblewallet.*,(select distributer_name from tblusers where user_id = tblewallet.user_id) as distributer_name FROM `tblewallet` where user_id = ? order by Id desc limit 1";
			$result = $this->db->query($str_query,array($user_id));
			return $result;
		
	}
	
	public function CheckBalance($user_id,$Amount)
	{
		$balance = $this->getCurrentBalance($user_id);
		if($balance >= $Amount)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function CheckAgentBalance($user_id,$Amount)
	{
		$balance = $this->getAgentBalance($user_id);
		if($balance >= $Amount)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function getBalanceByUserType($user_id,$usertype)
	{
		if($usertype == "Agent")
		{
			$balance = $this->getCurrentBalance($user_id);
			//$pendingRec = $this->getTotalPandingRecharge($user_id);
			$AgentBalance = $balance;
			return $AgentBalance;	
		}
		else if($usertype == "MasterDealer" or $usertype == "Distributor" )
		{
			$balance = $this->getCurrentBalance($user_id);
			return $balance;	
		}
		else
		{
			return false;
		}
		
		
	}
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


	public function processApiResponse($ExecutedBy,$response,$rechargeId,$user_id)
	{
		$this->load->model("update_methods");
		$this->load->model("userinfo_methods");
		$this->load->model("tblrecharge_methods");
		$this->load->model("Insert_methods");
		
		$rechargeInfor = $this->tblrecharge_methods->getRechargeTblEntry($rechargeId);
		$parent_rech_comm = $rechargeInfor->row(0)->distributer_commission_amount;
		$number = $rechargeInfor->row(0)->mobile_no;
		$company_id = $rechargeInfor->row(0)->company_id;
		$company_name = $this->tblrecharge_methods->getCompanyName($rechargeId);
		$businessName = $this->userinfo_methods->getBusinessName($user_id);
		$amount = $rechargeInfor->row(0)->amount;
		$commission = $rechargeInfor->row(0)->commission_amount;
		$recharge_description = "Recharge Amount = ".$amount." Number =".$number." || ".$company_name." Recharge_id = ".$rechargeId;
		$rec_commission_description = "Recharge Commission, Recharge Amount = ".$amount." Number =".$number." || ".$company_name." Recharge_id = ".$rechargeId;
		$Description_parent = "Parent Recharge Commission, Recharge Amount = ".$amount."  By ".$businessName." Recharge_id = ".$rechargeId;
		$parent_id = $this->userinfo_methods->getParentId($user_id);
		
		if($ExecutedBy = "RoyalCapital")
		{
			if(strpos($response,'#') != false)
			{
				$succ=explode('#',$response);
				$txid = $succ[0];
				$status = $succ[1];
				if($status == "Success")
				{
						if(update_rechargeStatus($rechargeId,$txid,$status) == true)
						{
							//recharge amount debit entry in tblewallet
							//$this->tblewallet_Recharge_DrEntry($user_id,$rechargeId,"Recharge",$amount,$recharge_description);
							//recharge commission  entry in tblewallet
							$this->Insert_methods->tblewallet_Recharge_CrEntry($user_id,$rechargeId,"RecComm",$commission,$rec_commission_description);
							//given parent recharge commission  entry in tblewallet
							$this->Insert_methods->tblewallet_Recharge_CrEntry($parent_id,$rechargeId,"PerRecComm",$parent_rech_comm,$Description_parent);
							return true;
						}
						else
						{
							return false;
						}
				}
				else if($status == "Failure")
				{
					if($this->update_methods->update_rechargeStatus($rechargeId,$txid,"Failure") == true)
						{
							$desc = "Revert - Recharge of Rs .".$amount." | company = ".$company_name." | Mobile Number = ".$number." | recharge Id =".$rechargeId;
							$this->Insert_methods->tblewallet_Recharge_CrEntry($user_id,$rechargeId,"Recharge",$amount,$desc);
							return true;
						}
						else
						{
							return false;
						}
				}
				
			
		}
		else
		{
			if($this->update_methods->update_rechargeStatus($rechargeId,NULL,"Failure") == true)
			{
				$desc = "Revert - Recharge of Rs .".$amount." | company = ".$company_name." | Mobile Number = ".$number." | recharge Id =".$rechargeId;
				$this->Insert_methods->tblewallet_Recharge_CrEntry($user_id,$rechargeId,"Recharge",$amount,$desc);
				return true;
			}
			else
			{
				return false;
			}
		}
									
	}
	
	}
	public function getChild($usertype,$user_id)
	{
		$str_query = "select * from tblusers where referer_id = ? and usertype_name=?";
		$rslt = $this->db->query($str_query,array($user_id,$usertype));
		if($rslt != NULL)
		{
			return $rslt->num_rows();
		}
		else
		{
			return 0;
		}
		return 0;
	}
	public function getChieldCount($user_id)
	{
		$str_query = "select * from tblusers where referer_id = ?";
		$rslt = $this->db->query($str_query,array($user_id));
		if($rslt != NULL)
		{
			return $rslt->num_rows();
		}
		else
		{
			return 0;
		}
		return 0;
	}
	public function encrypt($string)
	{
		$cipher = $this->encrypt->encode($string);
		 return  strtr(
                    $cipher,
                    array(
                        '+' => '.',
                        '=' => '-',
                        '/' => '~'
                    )
                );
		
	}
	public function decrypt($string)
	{
		$url_safe = strtr(
                $string,
                array(
                    '.' => '+',
                    '-' => '=',
                    '~' => '/'
                )
            );
		return $this->encrypt->decode($url_safe);
	
	}
	public function getNewUserId($user_type)
	{
		$str_query = "select * from tblusers where usertype_name = '$user_type' order by username desc limit 1";
		$rslt = $this->db->query($str_query);
		if($rslt->num_rows() > 0)
		{
			return $rslt->row(0)->username + 1;
		}
		else
		{
			if($user_type == "MasterDealer")
			{
				return 300001;
			}
			else if($user_type == "Distributor")
			{
				return 200001;
			}
			else if($user_type == "Agent")
			{
				return 500001;
			}
			else if($user_type == "APIUSER")
			{
				return 110001;
			}
		}
	}
	public function Increment_id($user_type)
	{
		if($user_type == "MasterDealer")
		{
			$str_query = "update tblnew_ids set masterdealer_id=masterdealer_id+1 where Id = 1";
			$rslt  = $this->db->query($str_query);
			return true;
		}
		if($user_type == "Distributor")
		{
			$str_query = "update tblnew_ids set dealer_id=dealer_id+1 where Id = 1";
			$rslt  = $this->db->query($str_query);
			return true;
		}
		if($user_type == "Retailer")
		{
			$str_query = "update tblnew_ids set retailer_id=retailer_id+1 where Id = 1";
			$rslt  = $this->db->query($str_query);
			return true;
		}
		
	}
	public function getPaymentInfo($payment_id)
	{
		$str_query = "select tblpayment.*,(select business_name from tblusers where tblusers.user_id = tblpayment.cr_user_id) as cr_bname,(select username from tblusers where tblusers.user_id = tblpayment.dr_user_id) as dr_usercode,(select username from tblusers where tblusers.user_id = tblpayment.cr_user_id) as cr_usercode,(select usertype_name from tblusers where tblusers.user_id = tblpayment.cr_user_id) as cr_usertype_name,(select usertype_name from tblusers where tblusers.user_id = tblpayment.dr_user_id) as dr_usertype_name from tblpayment where payment_id = '$payment_id'";
		$rslt = $this->db->query($str_query);
		return $rslt;
	}
	
///////////////////////////// FUND TRANSFER ///////////////////////////////////
	public function DealerAddBalance($dr_user_id,$cr_user_id,$amount)
	{
		$this->load->model("common_method_model");
			if($amount < 0)
			{
				return "Invalid Amount";
			}
			$dr_user_info = $this->Userinfo_methods->getUserInfo($dr_user_id);
			$dr_user_type = $dr_user_info->row(0)->usertype_name;
			if($dr_user_type == "MasterDealer" or $dr_user_type == "Distributor")
			{
				$cr_user_info = $this->Userinfo_methods->getUserInfo($cr_user_id);
				$scheme_info = $this->Userinfo_methods->getSchemeInfo($cr_user_id);
					
				if($this->Common_methods->CheckBalance($dr_user_id,$amount)== true)
				{
					if($this->common_method_model->checkChildOf($dr_user_id,$cr_user_id) == true)
					{
						$remark = "";
						$description = $this->Insert_model->getCreditPaymentDescription($cr_user_id, $dr_user_id,$amount);
						$payment_type = "PAYMENT";
						$this->Insert_model->tblewallet_Payment_CrDrEntry($cr_user_id,$dr_user_id,$amount,$remark,$description,$payment_type);
						if($scheme_info->num_rows() == 1)
						{
							$schemeType = $scheme_info->row(0)->scheme_type;
							$flat_commPer = $scheme_info->row(0)->flat_commission;
							if($schemeType == "flat")
							{	
								$payment_status = 'false';
								$flatdescription = "Flat Commission ".$flat_commPer." %  On ".$amount." Rs.";
								
								$flatamount = ($amount * $flat_commPer)/100;
								$this->Insert_model->tblflatcommissionEntry($cr_user_id,$amount,$flatamount,$flat_commPer,$flatdescription,"false");
								return "Fund Transfer Successful";
							}
						}
						
						return "Fund Transfer Successful";
					}
					else
					{
						return "Invalid UserId";
					}
				}
				else
				{
					return "Insufficient Balance";
				}
			}
			else
			{
				return "Invalid User";
			}	
	}
	
	public function DealerRevertBalance($dr_user_id,$cr_user_id,$amount)
	{
		$this->load->model("common_method_model");
		if($amount < 0)
		{
			return "Invalid Amount";
		}
			$cr_user_info = $this->Userinfo_methods->getUserInfo($cr_user_id);
			$cr_user_type = $cr_user_info->row(0)->usertype_name;
			if($cr_user_type == "MasterDealer" or $cr_user_type == "Distributor")
			{
				$dr_user_info = $this->Userinfo_methods->getUserInfo($dr_user_id);
				//if($dr_user_info->row(0)->usertype_name != "Distributor" or $dr_user_info->row(0)->usertype_name != "Agent")
				//{
					//return "Invalid User";
				//}
				if($this->Common_methods->CheckBalance($dr_user_id,$amount)== true)
				{
					
					if($this->common_method_model->checkChildOf($cr_user_id,$dr_user_id) == true)
					{
						$scheme_info = $this->Userinfo_methods->getSchemeInfo($dr_user_id);
						$remark = "";
						$description = $this->Insert_model->getRevertPaymentDescription($cr_user_id, $dr_user_id,$amount);
						$payment_type = "REVERT_PAYMENT";
						$this->Insert_model->tblewallet_Payment_CrDrEntry($cr_user_id,$dr_user_id,$amount,$remark,$description,$payment_type);
						if($scheme_info->num_rows() == 1)
						{
							$schemeType = $scheme_info->row(0)->scheme_type;
							$flat_commPer = $scheme_info->row(0)->flat_commission;
							if($schemeType == "flat")
							{	
								$payment_status = 'false';
								$flatdescription = "Revert Flat Commission ".$flat_commPer." %  On ".$amount." Rs.";
								
								$flatamount = ($amount * $flat_commPer)/100;
								$revFlatComm = -($flatamount);
								$this->Insert_model->tblflatcommissionEntry($cr_user_id,$amount,$revFlatComm,$flat_commPer,$flatdescription,"false");
								return "Revert Fund Transfer Successful";
							}
						}
						
						return "Revert Fund Transfer Successful";
					}
					else
					{
						return "Invalid UserId";
					}
				}
				else
				{
					return "Insufficient Balance";
				}
			
			}
			else
			{
				return "Invalid User";
			}
			
		
	}
	public function getSelectedSmsApi()
	{
		$rslt = $this->db->query("select * from common where param = 'smsapi'");
		return $rslt->row(0)->value;
	}
////////////////////////////////// *** END *** ////////////////////////
	
}

?>