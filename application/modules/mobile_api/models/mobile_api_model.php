<?php
class Mobile_api_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}	
	
function search_agent($parent_id,$mobile_no)
	{
		$str_query = "select * from tblusers where parent_id=? and mobile_no=?";
		$result = $this->db->query($str_query,array($parent_id,$mobile_no));		
		if($result->num_rows() == 1)
		{
			
			if($result->row(0)->status == '1')
			{
				return $result;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}		
	}
	
	
	
public	function profile_update($postal_address,$pincode,$emailid,$user_id,$username)
	{	
		$str_query = "update tblusers set postal_address=?,pincode=?,emailid=? where user_id=? and username=?";
		$result = $this->db->query($str_query,array($postal_address,$pincode,$emailid,$user_id,$username));		
		if($result > 0)
		{
			return "Profile Update Successfully";
		}
		else
		{
			return "Oops ! Somthing Went Wrong, Try Again";
		}		
	}


	
public function add_fund($request_amount,$payment_date,$payment_mode,$deposite_time,$cheque_no,$cheque_date,$bank_id,$client_bank_id,$remarks,$user_id)
{
    
    
   					
				$str_query = "select * from tblpaymentrequest where `tblpaymentrequest`.cheque_no=?";

		$result = $this->db->query($str_query,array($cheque_no));	
		
		if($result->num_rows() == 1)
		{
			return "Dublicate Bank ref no"; exit;
		}
	           	$this->load->model('Payment_request_model');
				if($this->Payment_request_model->addRequest($request_amount,$payment_date,$payment_mode,$deposite_time,$cheque_no,$cheque_date,$bank_id,$client_bank_id,$remarks,$user_id) == true)
				{
					return "Your Request has been submitted, Will be updated as soon as possbile";
										
				}	
}


	
	
	public function get_ledger($user_id)
	{
	    $today_date = $this->common->getMySqlDate();
				$from_date = "2015-01-01";
	    	$str_query = "select tblewallet.* from tblewallet where user_id = '$user_id' and DATE(add_date) >= '$from_date' and DATE(add_date) <= '$today_date' order by tblewallet.Id desc limit 0, 100";
	return	$rslt = $this->db->query($str_query);
	}
	
	
		public function get_commission($user_id)
	{
	$str_query = "select tblcommission.royalComm as commission, tblcompany.company_name from tblcommission, tblcompany , tblusers where tblcompany.company_id = tblcommission.company_id and tblusers.scheme_id = tblcommission.scheme_id and tblusers.user_id = ?";
return	$rslt = $this->db->query($str_query,array($user_id));
	}
	
	
		public function mobile_no($mobile_no,$user_id)
	{
	$str_query = "select tblrecharge.*,tblcompany.company_name,tblusers.business_name from tblrecharge,tblcompany,tblusers where tblusers.user_id = tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id and tblrecharge.`mobile_no` = ? and tblrecharge.`user_id` = ? ORDER BY tblrecharge.recharge_id DESC limit 0,2";
		$result = $this->db->query($str_query,array($mobile_no,$user_id));
		return $result;
	}
	
	public function getrecharge($username,$pwd)
	{
		$str_query = "SELECT tblcompany.company_name,tblrecharge.* FROM `tblrecharge`,tblcompany where tblcompany.company_id=tblrecharge.company_id and user_id=(select tu.user_id from tblusers tu where tu.username=? and tu.password = ?) order by recharge_id desc limit 0,25";
		$result = $this->db->query($str_query,array($username,$pwd));				
		return $result;
	}
	public function CheckTimeInterval($mobile,$amount)
	{
		$this->load->library("common");
		$recharge_date = $this->common->getMySqlDate();
		$str_query = "SELECT recharge_time FROM `tblrecharge` where mobile_no=? and amount=? and recharge_status=? and recharge_date=?";
		$result = $this->db->query($str_query,array($mobile,$amount,'Success',$recharge_date));				
		if($result->num_rows() == 1)
		{
			putenv("TZ=Asia/Calcutta");
			date_default_timezone_set('Asia/Calcutta');
			$stime = date("h:i:s A");		
			$etime = $result->row(0)->recharge_time;
			if( (( strtotime($stime)  - strtotime($etime)) / 60) > 20)
			{return true;}
			else
			{return false;}
		}
		else
		{
			return true;
		}					
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
	function check_login($username,$password)
	{
		$str_query = "select * from tblusers where username=? and password=?";
		$result = $this->db->query($str_query,array($username,$password));		
		if($result->num_rows() == 1)
		{
			
			if($result->row(0)->status == '1')
			{
				return $result;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}		
	}
	
	function check_login_app($username,$password)
	{
		$str_query = "select * from tblusers where mobile_no=? and password=?";
		$result = $this->db->query($str_query,array($username,$password));		
		if($result->num_rows() == 1)
		{
			
			if($result->row(0)->status == '1')
			{
				return $result;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}		
	}	
	function check_login1($username,$password)
	{
		$str_query = "select * from tblusers where username=? and password=?";
		$result = $this->db->query($str_query,array($username,($password)));		
		if($result->num_rows() == 1)
		{
			if($result->row(0)->status == '1')
			{
				echo $result->row(0)->usertype_name;exit;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}		
	}
	public function GetRechargeStatus($user_id,$gtid)
	{
		$str_query = "select * from tblrecharge where user_id=? and orderid=?";
		$result = $this->db->query($str_query,array($user_id,$gtid));		
		if($result->num_rows() == 1)
		{
			return $result->row(0)->recharge_status.",".$result->row(0)->operator_id;
		}
		else
		{
			echo 'Recharge ID is wrong.';
		}		
	}
	public function GetUserInfo($username, $pwd)
	{		
	$str_query = "select * FROM `tblusers` WHERE username=? and password = ?";
	$result = $this->db->query($str_query,array($username, $pwd));		
	return $result;	
	}
	public function getCompanyResult($OperatorCode)
	{
		
		$lc_format = "SW ".$OperatorCode;
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
	public function GetAPIInfo($company_id,$scheme_id)
	{		
			$commission_query = "select tblapi.* FROM `tblcommission`,`tblapi` WHERE tblapi.api_id=tblcommission.api_id
and tblapi.status=1 and tblcommission.company_id=? and tblcommission.set_prority=1 and tblcommission.scheme_id =?";
		$result = $this->db->query($commission_query,array($company_id,$scheme_id));						
return $result;
	}
	public function GetDistributerID($user_id)
	{		
	$str_query = "select parent_id from tblusers where user_id = ?";
	$result = $this->db->query($str_query,array($user_id));		
	return $result->row(0)->parent_id;	
	}	
	public	function add($company_id,$amount,$mobile_no,$user_id,$service_id,$description,$recharge_type,$recharge_status,$ApiInfo)
	{
		$this->load->model("Tblrecharge_methods");
		
		$LOG = "";
		$Log_commission_persentage="";
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$recharge_date = $this->common->getMySqlDate();
		$recharge_time = $this->common->getMySqlTime();								
		$APIName = '';
		if($ApiInfo->row(0)->api_name == "RoyalCapital")
		{
			$APIName = 'RoyalCapital';
		}	
		if($ApiInfo->row(0)->api_name == "IndiaEtop")
		{
			$APIName = 'IndiaEtop';
		}				
		$str_query = "select * FROM `tblusers` WHERE user_id=?";
		$user_details = $this->db->query($str_query,array($user_id));
		$user = $user_details->row(0)->usertype_name;
		$scheme_id = $user_details->row(0)->scheme_id;		
	
		if(trim($user) == 'SuperDealer' or  trim($user) == 'MasterDealer' or trim($user) == 'Agent' or trim($user) == 'Distributor' or trim($user) == 'Customer')
		{
		$commission_query = "SELECT tblcommission.*,tblcompany.company_name FROM `tblcommission`,tblcompany where tblcompany.company_id = tblcommission.company_id and tblcommission.company_id=? and scheme_id = ?  order by tblcompany.company_name ";
		$result_commission = $this->db->query($commission_query,array($company_id,$scheme_id));		
		if($result_commission->num_rows()== 1)
		{
			$Log_commission_persentage .="Current Users Commission ".$result_commission->row(0)->commission_per." %";
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
		
		/*if(trim($user) == 'MasterDealer' or trim($user) == 'Agent' or trim($user) == 'Distributor'){					
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
		}*/
		$str_query = "insert into tblrecharge(company_id,amount,mobile_no,user_id,service_id,recharge_date,recharge_time,recharge_by,description,					 recharge_type,recharge_status,add_date,ipaddress,commission_amount,commission_per,distributer_commission_amount,
distributer_commission_per,ExecuteBy) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				
		$result = $this->db->query($str_query,array($company_id,$amount,$mobile_no,$user_id,$service_id,$recharge_date,$recharge_time,'GPRS',$description,$recharge_type,$recharge_status,$date,$ip,$commission_amount,$commission_per,0,0,$APIName));	
		if($result > 0)
		{			
			$recharge_id=$this->db->insert_id();
//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////// CODE FOR 3 LEVEL PARENT COMMISSION -> ENTRY IN TBLPARENTCOMMISSION ////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
	
			if(trim($user) == 'Agent')
			{
				$parent =  $this->GetDistributerID($user_id);

				if($this->getUserType($parent) == "Distributor")
				{
				$commission_d_query = "select commission_per from tblcommission where scheme_id = ( select scheme_id from tblusers where user_id=?) and company_id = ? ";
				$result_d_commission = $this->db->query($commission_d_query,array($parent,$company_id));		

				if($result_d_commission->num_rows()== 1)
				{
					$Log_commission_persentage .=" || Distributer ".$result_d_commission->row(0)->commission_per." %";
					$commission_d_per = $result_d_commission->row(0)->commission_per - $commission_per;
					if($commission_d_per > 0)
					{
						$commission_d_amount =round((($amount * $commission_d_per) / 100),4);
					}
					else 
					{
						$commission_d_amount = 0;
					}
					$LOG .="||  Distributor : ".$commission_d_per."% --> ".$commission_d_amount;
					echo "<br>Distributor : ".$commission_d_per;
				}
				
				$this->addParentCommission($parent,$user_id,$commission_d_amount,$recharge_id,$company_id);
				$parentOf_d = $this->GetDistributerID($parent); 
			
				if($this->getUserType($parentOf_d) == "MasterDealer")
				{
				
					$commission_MDealer_query = "select commission_per from tblcommission where scheme_id = ( select scheme_id from tblusers where user_id=?) and company_id = ?";
					$result_MDealer_commission = $this->db->query($commission_MDealer_query,array($parentOf_d,$company_id));		
			
					if($result_MDealer_commission->num_rows()== 1)
					{
						$Log_commission_persentage .=" || MasterDealer ".$result_MDealer_commission->row(0)->commission_per." %";
						$commission_MDealer_per = $result_MDealer_commission->row(0)->commission_per - $result_d_commission->row(0)->commission_per;
						if($commission_MDealer_per > 0)
						{
							$commission_MDealer_amount =round((($amount * $commission_MDealer_per) / 100),4);
						}
						else
						{
							$commission_MDealer_amount=0;
						}
						$LOG .="||  Master Dealer : ".$commission_MDealer_per." % --> ".$commission_MDealer_amount;
						echo "<br>Master Dealer : ".$commission_MDealer_per;
						
					}
					
					$this->addParentCommission($parentOf_d,$user_id,$commission_MDealer_amount,$recharge_id,$company_id);
					$parent_ofMDealer = $this->GetDistributerID($parentOf_d);
					if($this->getUserType($parent_ofMDealer) == "SuperDealer")
					{
						$commission_SDealer_query = "select commission_per from tblcommission where scheme_id = ( select scheme_id from tblusers where user_id=?) and company_id = ?";
						$result_SDealer_commission = $this->db->query($commission_SDealer_query,array($parent_ofMDealer,$company_id));		
						if($result_SDealer_commission->num_rows()== 1)
						{
							$Log_commission_persentage .=" || SuperDealer ".$result_SDealer_commission->row(0)->commission_per." %";
							$commission_SDealer_per = $result_SDealer_commission->row(0)->commission_per - $result_MDealer_commission->row(0)->commission_per;
							if($commission_SDealer_per > 0)
							{
								$commission_SDealer_amount =round((($amount * $commission_SDealer_per) / 100),4);
							}
							else
							{
								$commission_SDealer_amount=0;
							}
							$LOG .="||  Super Dealer : ".$commission_SDealer_per." % --> ".$commission_SDealer_amount;
							echo "<br>Super Dealer : ".$commission_SDealer_per;
						}
						
						$this->addParentCommission($parent_ofMDealer,$user_id,$commission_SDealer_amount,$recharge_id,$company_id);
					}
					
					
				}
				else if($this->getUserType($parentOf_d) == "SuperDealer")
				{
				
					$commission_SDealer_query = "select commission_per from tblcommission where scheme_id = ( select scheme_id from tblusers where user_id=?) and company_id = ?";
					$result_SDealer_commission = $this->db->query($commission_SDealer_query,array($parentOf_d,$company_id));		
					if($result_SDealer_commission->num_rows()== 1)
					{
						$Log_commission_persentage .=" || SuperDealer ".$result_SDealer_commission->row(0)->commission_per." %";
						$commission_SDealer_per = $result_SDealer_commission->row(0)->commission_per - $commission_per - $commission_d_per;
						if($commission_SDealer_per > 0)
						{
							$commission_SDealer_amount =round((($amount * $commission_SDealer_per) / 100),4);
						}
						else
						{
							$commission_SDealer_amount = 0;
						}
						$LOG .="||  Super Dealer : ".$commission_SDealer_per." % --> ".$commission_SDealer_amount;
						echo "<br>SuperDealer : ".$commission_SDealer_per;
					}
					
					//$this->addParentCommission($parentOf_retailer,$user_id,$commission_MDealer_amount,$recharge_id,$company_id);
				}
				
				
			}
				else if($this->getUserType($parent) == "MasterDealer")
				{
				$commission_MDealer_query = "select commission_per from tblcommission where scheme_id = ( select scheme_id from tblusers where user_id=?) and company_id = ?";
				$result_MDealer_commission = $this->db->query($commission_MDealer_query,array($parent,$company_id));		
				if($result_MDealer_commission->num_rows()== 1)
				{
					$Log_commission_persentage .=" || MasterDealer ".$result_MDealer_commission->row(0)->commission_per." %";
					$commission_MDealer_per = $result_MDealer_commission->row(0)->commission_per - $commission_per;
					if($commission_MDealer_per > 0)
						{
							$commission_MDealer_amount =round((($amount * $commission_MDealer_per) / 100),4);
						}
						else
						{
							$commission_MDealer_amount = 0;
						}
						$LOG .="||  MasterDealer : ".$commission_MDealer_per."% --> ".$commission_MDealer_amount;
					echo "<br>MasterDealer = ".$commission_MDealer_per;
				}
				
				$this->addParentCommission($parent,$user_id,$commission_MDealer_amount,$recharge_id,$company_id);
				$parent_of_Mdealer = $this->GetDistributerID($parent);
				if($this->getUserType($parent_of_Mdealer) == "SuperDealer")
				{
					$commission_SDealer_query = "select commission_per from tblcommission where scheme_id = ( select scheme_id from tblusers where user_id=?) and company_id = ?";
					$result_SDealer_commission = $this->db->query($commission_SDealer_query,array($parent_of_Mdealer,$company_id));		
					if($result_SDealer_commission->num_rows()== 1)
					{
						$Log_commission_persentage .=" || SuperDealer ".$result_SDealer_commission->row(0)->commission_per." %";
						$commission_SDealer_per = $result_SDealer_commission->row(0)->commission_per - $result_MDealer_commission->row(0)->commission_per;
						if($commission_SDealer_per > 0)
						{
							$commission_SDealer_amount =round((($amount * $commission_SDealer_per) / 100),4);
						}
						else
						{
							$commission_SDealer_amount = 0;
						}
						$LOG .="||  Super Dealer : ".$commission_SDealer_per." % --> ".$commission_SDealer_amount;
						echo "<br>SuperDealer = ".$commission_SDealer_per;
						
					}
				
					$this->addParentCommission($parent_of_Mdealer,$user_id,$commission_SDealer_amount,$recharge_id,$company_id);
				}
				
			}
				else if($this->getUserType($parent) == "SuperDealer")
				{
				$commission_SDealer_query = "select commission_per from tblcommission where scheme_id = ( select scheme_id from tblusers where user_id=?) and company_id = ?";
				$result_SDealer_commission = $this->db->query($commission_SDealer_query,array($parent,$company_id));		
				if($result_SDealer_commission->num_rows()== 1)
				{
					$Log_commission_persentage .=" || SuperDealer ".$result_SDealer_commission->row(0)->commission_per." %";
					$commission_SDealer_per = $result_SDealer_commission->row(0)->commission_per - $commission_per;
					if($commission_SDealer_per > 0)
						{
							$commission_SDealer_amount =round((($amount * $commission_SDealer_per) / 100),4);
						}
						else
						{
							$commission_SDealer_amount = 0;
						}
					$LOG .="||  Super Dealer : ".$commission_SDealer_per." % --> ".$commission_SDealer_amount;
					echo "<br>SuperDealer = ".$commission_SDealer_per;
					$this->addParentCommission($parent,$user_id,$commission_SDealer_amount,$recharge_id,$company_id);
				}
				
				
			}
				
			}
			if(trim($user) == 'Distributor')
			{	
				$parent =  $this->GetDistributerID($user_id);
				if($this->getUserType($parent) == "MasterDealer")
				{
					$commission_MDealer_query = "select commission_per from tblcommission where scheme_id = ( select scheme_id from tblusers where user_id=?) and company_id = ?";
					$result_MDealer_commission = $this->db->query($commission_MDealer_query,array($parent,$company_id));		
					if($result_MDealer_commission->num_rows()== 1)
					{
						$Log_commission_persentage .=" || MasterDealer ".$result_MDealer_commission->row(0)->commission_per." %";
						$commission_MDealer_per = $result_MDealer_commission->row(0)->commission_per - $commission_per;
						if($commission_MDealer_per > 0)
						{
						$commission_MDealer_amount =round((($amount * $commission_MDealer_per) / 100),4);
						}
						else
						{
							$commission_MDealer_amount = 0;
						}
						$LOG .="||  MasterDealer : ".$commission_MDealer_per." % --> ".$commission_MDealer_amount;
						echo "<br>MasterDealer = ".$commission_MDealer_per;
					}
					
					$this->addParentCommission($parent,$user_id,$commission_MDealer_amount,$recharge_id,$company_id);
					$parent_of_Mdealer = $this->GetDistributerID($parent);
					if($this->getUserType($parent_of_Mdealer) == "SuperDealer")
					{
						$commission_SDealer_query = "select commission_per from tblcommission where scheme_id = ( select scheme_id from tblusers where user_id=?) and company_id = ?";
						$result_SDealer_commission = $this->db->query($commission_SDealer_query,array($parent_of_Mdealer,$company_id));		
						if($result_SDealer_commission->num_rows()== 1)
						{
							$Log_commission_persentage .=" || SuperDealer ".$result_SDealer_commission->row(0)->commission_per." %";
							$commission_SDealer_per = $result_SDealer_commission->row(0)->commission_per - $result_MDealer_commission->row(0)->commission_per;
							if($commission_SDealer_per > 0)
							{
								$commission_SDealer_amount =round((($amount * $commission_SDealer_per) / 100),4);
							}
							else
							{
								$commission_SDealer_amount = 0;
							}
							$LOG .="||  SuperDealer : ".$commission_SDealer_per." % --> ".$commission_SDealer_amount;
							echo "<br>SuperDealer = ".$commission_SDealer_per;
						}
						
						$this->addParentCommission($parent_of_Mdealer,$user_id,$commission_SDealer_amount,$recharge_id,$company_id);
					}
					
				}
				else if($this->getUserType($parent) == "SuperDealer")
				{
					$commission_SDealer_query = "select commission_per from tblcommission where scheme_id = ( select scheme_id from tblusers where user_id=?) and company_id = ?";
					$result_SDealer_commission = $this->db->query($commission_SDealer_query,array($parent,$company_id));		
					if($result_SDealer_commission->num_rows()== 1)
					{
						$Log_commission_persentage .=" || SuperDealer ".$result_SDealer_commission->row(0)->commission_per." %";
						$commission_SDealer_per = $result_SDealer_commission->row(0)->commission_per - $commission_per;
						if($commission_SDealer_per > 0)
						{
							$commission_SDealer_amount =round((($amount * $commission_SDealer_per) / 100),4);
						}
						else
						{
							$commission_SDealer_amount = 0;
						}
						$LOG .="||  SuperDealer : ".$commission_SDealer_per."% --> ".$commission_SDealer_amount;
						echo "<br>SuperDealer = ".$commission_SDealer_per;
						$this->addParentCommission($parent,$user_id,$commission_SDealer_amount,$recharge_id,$company_id);
					}
				}
			
			}
			if(trim($user) == 'MasterDealer')
			{
	
			$parent =  $this->GetDistributerID($user_id);
			if($this->getUserType($parent) == "SuperDealer")
			{
				$commission_SDealer_query = "select commission_per from tblcommission where scheme_id = ( select scheme_id from tblusers where user_id=?) and company_id = ?";
				$result_SDealer_commission = $this->db->query($commission_SDealer_query,array($parent,$company_id));		
				if($result_SDealer_commission->num_rows()== 1)
				{
					$Log_commission_persentage .=" || SuperDealer ".$result_SDealer_commission->row(0)->commission_per." %";
					$commission_SDealer_per = $result_SDealer_commission->row(0)->commission_per - $commission_per;
					if($commission_SDealer_per > 0)
					{
						$commission_SDealer_amount =round((($amount * $commission_SDealer_per) / 100),4);
					}
					else
					{
						$commission_SDealer_amount = 0;
					}
					$LOG .="||  SuperDealer : ".$commission_SDealer_per."% --> ".$commission_SDealer_amount;
					echo "<br>SuperDealer = ".$commission_SDealer_per;
				}
				
			$this->addParentCommission($parent,$user_id,$commission_SDealer_amount,$recharge_id,$company_id);
			}
			
		}
////////////////////////////////  ----END----  //////////////////////////////////////////////////////////						
/////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////  LOG ENTRY  //////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
	$company_name = $this->Tblrecharge_methods->getCompanyName($recharge_id);
	$rechargeDetaile ="Recharge Entry: REcharge_id = ".$recharge_id." | Recharge By ".$user_id." | ".$user." | ".$company_name." | ".$amount." | ".$mobile_no;
	$commissionDetails="Commession Entry: Recharge_id = ".$recharge_id." | SelfCommission = ".$commission_per."% -- ".$commission_amount." || ".$LOG;
	$rechargeBy =$user_id." || ".$user; 
	$this->load->model("Errorlog");
	$this->Errorlog->RechargeCommissionEntry("GPRS",$rechargeBy,$recharge_id,$Log_commission_persentage,$rechargeDetaile,$commissionDetails);
//////////////////////////////////////////////////////////////////////////////////////////////////////		
			return $recharge_id;						
			
		}
		else
		{
			return false;
		}		
	}	

	public function DealerAddBalance($username,$pwd,$otherUname,$amount)
	{
		$this->load->model("common_method_model");	
		$remark ="Direct Payment By ".$username." TO ".$otherUname;
		$user_id = $this->common_method_model->getUserId($username,$pwd);
		if($user_id != false)
		{
			if($this->common_method_model->getUserIdByUserName($otherUname) != false)
			{
				$otherUserId = $this->common_method_model->getUserIdByUserName($otherUname);
				$response = $this->Common_methods->DealerAddBalance($user_id,$otherUserId,$amount,"SMS");
				echo $response;exit;
			}
			else
			{
				echo "Invalid User";exit;
			}	
		}
		else
		{
			echo "Username and password id incorrect";exit;
		}
	}
	public function revertBalance($username,$pwd,$otherUname,$amount)
	{
		$this->load->model("common_method_model");	
		$this->load->model("recharge_home_model");
		$this->load->model("insert_model");
		$remark ="Direct Revert By ".$username." TO ".$otherUname;
		$user_id = $this->common_method_model->getUserId($username,$pwd);
		if($user_id != false)
		{
			$otherUserId = $this->common_method_model->getUserIdByUserName($otherUname);
			if($otherUserId  != false)
			{
				$dr_user_id = $otherUserId;
				$cr_user_id = $user_id;
				
				$response = $this->Common_methods->DealerRevertBalance($dr_user_id,$cr_user_id,$amount);
				echo $response;exit;
			}
			else
			{
				echo "Invalid Username";exit;
			}
			
		}
		else
		{
			echo "Username and password is incorrect";exit;
		}
	}
	public function ChangePassword($username,$pwd,$oldpwd,$newpwd)
	{
		$this->load->model("common_method_model");	
		$this->load->model("recharge_home_model");
		$this->load->model("update_methods");
		if($this->common_method_model->getUserId($username,$pwd) != false)
		{
			$user_id = $this->common_method_model->getUserId($username,$pwd);
			if($this->update_methods->updatePassword($user_id,$newpwd) == true)
			{
				echo "success";
			}
			else
			{
				echo "Invalid Username";exit;
			}
			
		}
		else
		{
			echo "Username and password id incorrect";exit;
		}
		
	}
	public function AddComplain($username,$pwd,$mobile,$amount,$date,$message)
	{
		$str_message = $message." || ".$mobile." || ".$amount." || ".$date;
		$this->load->model("common_method_model");	
		if($this->common_method_model->getUserId($username,$pwd) != false)
		{
			
			$user_id = $this->common_method_model->getUserId($username,$pwd);
			$this->Insert_model->addComplaint($user_id,$str_message);
			echo "success";
		}
		else
		{
			echo "Username and password id incorrect";exit;
		}
	}
	public function getUserType($user_id)
	{
		$str_query = "select * from tblusers where user_id = ?";
		$result = $this->db->query($str_query,array($user_id));
		return $result->row(0)->usertype_name;
	}
	public function addParentCommission($user_id,$given_by,$amount,$recharge_id,$company_id)
	{
		$this->load->library('common');
		$add_date = $this->common->getDate();
		$str_pay = "insert into tblparentcommission(user_id,amount,comm_by,recharge_id,add_date,company_id) values(?,?,?,?,?,?)";
		$result = $this->db->query($str_pay,array($user_id,$amount,$given_by,$recharge_id,$add_date,$company_id));
	}
}

?>