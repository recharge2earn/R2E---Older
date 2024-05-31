<?php
class Userinfo_methods extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function getUserInfo($user_id)
	{
		$rlst = $this->db->query("select tblusers.*,(select a.business_name from tblusers a where a.user_id = tblusers.parent_id)as parent_name,(select scheme_name from tblscheme where tblscheme.scheme_id = tblusers.scheme_id) as scheme_name,(select state_name from tblstate where tblstate.state_id = tblusers.state_id) as state_name,(select state_name from tblcity where tblcity.city_id = tblusers.city_id) as city_name from tblusers where user_id = '".$user_id."'");
		return $rlst;
	}
	public function getUserInfoByUsernamePassword($username,$password)
	{
		$rlst = $this->db->query("select * from tblusers where username = '".$username."' and password = '$password'");
		return $rlst;
	}
	public function getUserInfoByMobile($mobile_no)
	{
		$rlst = $this->db->query("select * from tblusers where mobile_no = '".$mobile_no."'");
		if($rlst->num_rows() > 0)
		{
			return $rlst;
		}
		else
		{
			return false;
		}
	}
	public function getUserInfoByUsername($username)
	{
		$rlst = $this->db->query("select * from tblusers where username = '".$username."'");
		if($rlst->num_rows() > 0)
		{
			return $rlst;
		}
		else
		{
			return false;
		}
	}
	public function getSchemeId($user_id)
	{
		$rlst = $this->db->query("select scheme_id from tblusers where user_id = '".$user_id."'");
		return $rlst->row(0)->scheme_id;
	}
	public function getSchemeInfo($user_id)
	{
		$rlst = $this->db->query("select * from tblscheme where scheme_id = (select scheme_id from tblusers where user_id = '$user_id')");
		return $rlst;
	}
	public function getParentId($user_id)
	{
		$rlst = $this->db->query("select parent_id from tblusers where user_id = '".$user_id."'");
		return $rlst->row(0)->parent_id;
	}
	public function getReferer_id($user_id)
	{
		$rlst = $this->db->query("select referer_id from tblusers where user_id = '".$user_id."'");
		return $rlst->row(0)->referer_id;
	}
	public function getUserType($user_id)
	{
		$rlst = $this->db->query("select usertype_name from tblusers where user_id = '".$user_id."'");
		return $rlst->row(0)->usertype_name;
	}
	public function getBusinessName($user_id)
	{
		$rlst = $this->db->query("select distributer_name from tblusers where user_id = '".$user_id."'");
		return $rlst->row(0)->distributer_name;
	}
	public function getAdminId()
	{
		$rlst = $this->db->query("select user_id from tblusers where usertype_name = 'Admin'");
		return $rlst->row(0)->user_id;
	}
	public function getMasterDealerList()
	{
		$rlst = $this->db->query("select * from tblusers where usertype_name = 'MasterDealer'");
		return $rlst;
	}
	public function getDistributerList()
	{
		$rlst = $this->db->query("select * from tblusers where usertype_name = 'Distributer'");
		return $rlst;
	}
	public function getRetailerList()
	{
		$rlst = $this->db->query("select * from tblusers where usertype_name = 'Retailer'");
		return $rlst;
	}
	public function getBalance($user_id)
	{
		
	}
	public function getOTP($user_id)
	{
		$rslt = $this->db->query("select otp from tblusers where user_id = '$user_id'");
		if($rslt->num_rows() > 0)
		{
			return $rslt->row(0)->otp;
		}
		else
		{
			return 0;
		}
	}
	public function validateOTP($user_id,$otp)
	{
		$str_query = "select * from tblusers where user_id = ? and otp = ?";
		$rslt = $this->db->query($str_query,array($user_id,$otp));
		if($rslt->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function checkBalance($user_id,$amount)
	{
		$this->load->model("Recharge_home_model");
		$balance = $this->Recharge_home_model->GetBalanceByUser($user_id);
		if($balance >= $amount)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function getSchemeType($scheme_id)
	{
		$rslt = $this->db->query("select * from tblscheme where scheme_id = '$scheme_id'");
		if($rslt->num_rows() > 0)
		{
			return $rslt->row(0)->scheme_type;
		}
		else
		{
			return false;
		}
	}
	public function getTotalCommissionPer($company_id,$ExecuteBy)
	{
		if($ExecuteBy == "RoyalCapital")
		{
			$rslt = $this->db->query("select * from tblcompany where company_id = '$company_id'");
			if($rslt->num_rows() > 0)
			{
				return $rslt->row(0)->royalComm;
			}else { return 0;}
		}
		else if($ExecuteBy == "RechargeDunia")
		{
			$rslt = $this->db->query("select * from tblcompany where company_id = '$company_id'");
			if($rslt->num_rows() > 0)
			{
				return $rslt->row(0)->RecDunComm;
			}else { return 0;}	
		}
		else if($ExecuteBy == "RechargeServer")
		{
			$rslt = $this->db->query("select * from tblcompany where company_id = '$company_id'");
			if($rslt->num_rows() > 0)
			{
				return $rslt->row(0)->RechargeServerComm;
			}else { return 0;}
		}
		else if($ExecuteBy == "NEW_MARS")
		{
			$rslt = $this->db->query("select * from tblcompany where company_id = '$company_id'");
			if($rslt->num_rows() > 0)
			{
				return $rslt->row(0)->MarsComm;
			}else { return 0;}
		}
		else if($ExecuteBy == "Global")
		{
			return 4;
		}
		else if($ExecuteBy == "API2")
		{
			return 3;
		}
	}
	public function getCommissionInfo($company_id,$user_id)
	{
		$str_query = "select * from tbluser_commission where company_id = ? and user_id = ?";
		$rslt = $this->db->query($str_query,array($company_id,$user_id));
		if($rslt->num_rows() == 1)
		{
			return $rslt->row(0)->commission;
		}
		else
		{
			return 0;
		}
	}
		public function check_login($username,$pwd)
	{
		$rslt = $this->db->query("select * from tblusers where username = ? and password = ? and usertype_name = 'APIUSER'",array($username,$pwd));
		if($rslt->num_rows() > 0)
		{
			if($rslt->row(0)->status == 1)
			{
				return true;
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
	public function getUserInfoByUsernamePwd($username,$pwd)
	{
		$rslt = $this->db->query("select * from tblusers where username = ? and password = ? and usertype_name = 'APIUSER'",array($username,$pwd));
		if($rslt->num_rows() > 0)
		{
			if($rslt->row(0)->status == 1)
			{
				return $rslt;
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
}

?>