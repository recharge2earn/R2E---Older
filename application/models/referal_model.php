<?php
class Referal_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function getRegistration_fee($usertype)
	{
		
		$str_query = "select Amount from tblregfee where usertype=?";
		$result = $this->db->query($str_query, array($usertype));
		return $result->row(0)->Amount;
	}
	public function getRefCommAmount($amount,$comm_per)
	{
		$com_amount = ($amount * $comm_per)/100;
		return $com_amount;
	}
	
	public function getreg_commission($usertype)
	{
			$child = $this->getChild($usertype);
			if($usertype == 'MasterDealer')
			{
					
						$str_com_query = "SELECT * FROM `tblmdplan` where target>? order by target limit 1";
						$result_com = $this->db->query($str_com_query,array($child));
						return $result_com->row(0)->commission_persontage;	
					
			}
			else if($usertype == 'Distributer')
			{
				
					$str_com_query = "SELECT * FROM `tbldplan` where target>? order by target limit 1";
					$result_com = $this->db->query($str_com_query,array($child));
					return $result_com->row(0)->commission_per;	
				
			}
			else if($usertype == 'Retailer')
			{
				
					$str_com_query = "SELECT * FROM `tblrplan` where target>? order by target limit 1";
					$result_com = $this->db->query($str_com_query,array($child));
					return $result_com->row(0)->commission_per;	
				
			}
    }
	public function getParentReg_commission($usertype)
	{
			$child = $this->getChild($usertype);
			if($usertype == 'MasterDealer')
			{
					
						$str_com_query = "SELECT * FROM `tblmdplan` where target>? order by target limit 1";
						$result_com = $this->db->query($str_com_query,array($child));
						return $result_com->row(0)->parent_commission_per;	
					
			}
			else if($usertype == 'Distributer')
			{
				
					$str_com_query = "SELECT * FROM `tbldplan` where target>? order by target limit 1";
					$result_com = $this->db->query($str_com_query,array($child));
					return $result_com->row(0)->commission_per;	
				
			}
			else if($usertype == 'Retailer')
			{
				
					$str_com_query = "SELECT * FROM `tblrplan` where target>? order by target limit 1";
					$result_com = $this->db->query($str_com_query,array($child));
					return $result_com->row(0)->parent_commission_per;	
				
			}
    }
	public function getChild($usertype)
	{
	$str_query = "SELECT * FROM `tblusers` where referer_id=? and usertype_name=?";
	$result = $this->db->query($str_query,array($this->session->userdata("id"),$usertype));
	$child =$result->num_rows();
	return $child;
	}
	public function getChildReferer($userid)
	{
	$str_query = "SELECT * FROM `tblusers` where referer_id=?";
	$result = $this->db->query($str_query,array($userid));
	$child =$result->num_rows();
	return $child;
	}
	public function get_referar_id()
	{
		$str_ref_query="select referer_id from tblusers where user_id=?";
		$result = $this->db->query($str_ref_query,array($this->session->userdata('id')));
		return $result->row(0)->referer_id;
	}
	public function getparentid($user_id)
	{
		$str_query = "select parent_id from tblusers where user_id=?";
		$result_parent=$this->db->query($str_query,array($user_id));
		return $result_parent->row(0)->parent_id;
	}
	
	public function find_mobile_exist($mobile)
	{
		$str_query = "select * from tblusers where mobile_no=?";
		$result = $this->db->query($str_query,array($mobile));	
		if($result->num_rows() > 0){return false;}
		else{return true;}				
	}
	public function update($username,$pwd,$user_id)
	{ 
		$str_query = "update tblusers set username=?,password=? where user_id=?";
		$result = $this->db->query($str_query,array($username,$pwd,$user_id));		
		if($result > 0)
		{			
			return true;
		}
		else
		{
			return false;
		}				
	}
	
	public function getUserDetails($user_id)
	{
		$str_query = "select * from tblusers where user_id=?";
		$result = $this->db->query($str_query,array($user_id));	
		return $result;
	}
	public function getNameByUserId($user_id)
	{
		$str_query = "select (CASE usertype_name WHEN 'MasterDealer' THEN distributer_name WHEN 'Distributer' THEN distributer_name WHEN 'Retailer' THEN retailer_name END) as name from tblusers where user_id = ? ";
		$rlst = $this->db->query($str_query,array($user_id));
		return $rlst->row(0)->name;
	}
	public function getReferalCommisssionReceivedReport($user_id)
	{
		$str_query = "select ref_comm.*,(select distributer_name from tblusers where tblusers.user_id = ref_comm.reg_user_id) as uname,(select usertype_name from tblusers where tblusers.user_id = ref_comm.reg_user_id) as usertype_name from ref_comm where user_id = ?";
		$rlst = $this->db->query($str_query,array($user_id));
	
			return $rlst;
	}
	public function getReferalCommisssionReceivedReportByDate($user_id,$date)
	{
		$str_query = "select ref_comm.*,(select distributer_name from tblusers where tblusers.user_id = ref_comm.reg_user_id) as uname,(select usertype_name from tblusers where tblusers.user_id = ref_comm.reg_user_id) as usertype_name from ref_comm where user_id = ? and add_date=?";
		$rlst = $this->db->query($str_query,array($user_id,$date));
		
			return $rlst;
	}
	public function getReferalCommisssionReceivedReportALL()
	{
		$str_query = "select ref_comm.*,(select distributer_name from tblusers where tblusers.user_id = ref_comm.user_id) as uname,(select usertype_name from tblusers where tblusers.user_id = ref_comm.user_id) as usertype_name from ref_comm";
		$rlst = $this->db->query($str_query);
		
			return $rlst;	
	}
	public function getFreeRechargeReceivedReportALL()
	{
		$str_query = "select free_rec_comm.*,(select distributer_name from tblusers where tblusers.user_id = free_rec_comm.user_id) as uname,(select usertype_name from tblusers where tblusers.user_id = free_rec_comm.user_id) as usertype_name,(select username from tblusers where tblusers.user_id = free_rec_comm.user_id) as username,(select mobile_no from tblusers where tblusers.user_id = free_rec_comm.user_id) as mobile from free_rec_comm";
		$rlst = $this->db->query($str_query);
		
			return $rlst;	
	}
	public function get_report($search_type,$searchWord)
	{
		
		if($search_type == 'mobile')
		{
			
			$str_query = "select ref_comm.*,(select distributer_name from tblusers where tblusers.user_id = ref_comm.user_id) as uname,(select usertype_name from tblusers where tblusers.user_id = ref_comm.user_id) as usertype_name from ref_comm  where user_id = (select user_id from tblusers where mobile_no = ?)";
			$result = $this->db->query($str_query,array($searchWord));
			return $result;
		}
		if($search_type == 'username')
		{
			
			$str_query = "select ref_comm.*,(select distributer_name from tblusers where tblusers.user_id = ref_comm.user_id) as uname,(select usertype_name from tblusers where tblusers.user_id = ref_comm.user_id) as usertype_name from ref_comm  where user_id =  (select user_id from tblusers where username = ?)";
			$result = $this->db->query($str_query,array($searchWord));
			return $result;
		}
		if($search_type == 'usertype')
		{
			
			$str_query = "select ref_comm.*,(select distributer_name from tblusers where tblusers.user_id = ref_comm.user_id) as uname,(select usertype_name from tblusers where tblusers.user_id = ref_comm.user_id) as usertype_name from ref_comm  where user_id =  (select user_id from tblusers where usertype_name like '".$searchWord."%')";
			$result = $this->db->query($str_query );
			return $result;
		}
		
	
	}
	public function getFree_Recharge_report($search_type,$searchWord)
	{
		
		if($search_type == 'mobile')
		{
			
			$str_query = "select free_rec_comm.*,(select distributer_name from tblusers where tblusers.user_id = free_rec_comm.user_id) as uname,(select usertype_name from tblusers where tblusers.user_id = free_rec_comm.user_id) as usertype_name,(select username from tblusers where tblusers.user_id = free_rec_comm.user_id) as username,(select mobile_no from tblusers where tblusers.user_id = free_rec_comm.user_id) as mobile from free_rec_comm  where user_id = (select user_id from tblusers where mobile_no = ?)";
			$result = $this->db->query($str_query,array($searchWord));
			return $result;
		}
		if($search_type == 'username')
		{
			
			$str_query = "select free_rec_comm.*,(select distributer_name from tblusers where tblusers.user_id = free_rec_comm.user_id) as uname,(select usertype_name from tblusers where tblusers.user_id = free_rec_comm.user_id) as usertype_name,(select username from tblusers where tblusers.user_id = free_rec_comm.user_id) as username,(select mobile_no from tblusers where tblusers.user_id = free_rec_comm.user_id) as mobile from free_rec_comm  where user_id = (select user_id from tblusers where username = ?)";
			$result = $this->db->query($str_query,array($searchWord));
			return $result;
		}
		if($search_type == 'usertype')
		{
			
			$str_query = "select free_rec_comm.*,(select distributer_name from tblusers where tblusers.user_id = free_rec_comm.user_id) as uname,(select usertype_name from tblusers where tblusers.user_id = free_rec_comm.user_id) as usertype_name,(select username from tblusers where tblusers.user_id = free_rec_comm.user_id) as username,(select mobile_no from tblusers where tblusers.user_id = free_rec_comm.user_id) as mobile from free_rec_comm where user_id =  (select user_id from tblusers where usertype_name like '".$searchWord."%' and tblusers.user_id = free_rec_comm.user_id)";
			$result = $this->db->query($str_query );
			return $result;
		}
		
	
	}
	public function getFree_Recharge_By_userId($user_id)
	{
		$str_query = "select free_rec_comm.*,(select distributer_name from tblusers where tblusers.user_id = free_rec_comm.user_id) as uname,(select usertype_name from tblusers where tblusers.user_id = free_rec_comm.user_id) as usertype_name,(select username from tblusers where tblusers.user_id = free_rec_comm.user_id) as username,(select mobile_no from tblusers where tblusers.user_id = free_rec_comm.user_id) as mobile from free_rec_comm where user_id = ?";
		$rlst = $this->db->query($str_query,array($user_id));
		
			return $rlst;	
	}
	public function getLevel($usertype,$child)
	{
		if($usertype == 'MasterDealer')
			{
					
						$str_com_query = "SELECT * FROM `tblmdplan` where target>? order by target limit 1";
						$result_com = $this->db->query($str_com_query,array($child));
						return $result_com->row(0)->level;	
					
			}
			else if($usertype == 'Distributer')
			{
				
					$str_com_query = "SELECT * FROM `tbldplan` where target>? order by target limit 1";
					$result_com = $this->db->query($str_com_query,array($child));
					return $result_com->row(0)->level;	
				
			}
			else if($usertype == 'Retailer')
			{
				
					$str_com_query = "SELECT * FROM `tblrplan` where target>? order by target limit 1";
					$result_com = $this->db->query($str_com_query,array($child));
					return $result_com->row(0)->level;	
				
			}
	}
	public function getLevelTarget($usertype,$level)
	{
		if($usertype == "MasterDealer")
		{
			$str_com_query1 = "SELECT * FROM `tblmdplan` where level < ?  order by Id desc  limit 1";
			$result_com = $this->db->query($str_com_query1,array($level));
			
			return $result_com->row(0)->target;
		}
		else if($usertype == "Distributer")
		{
			$str_com_query2 = "SELECT * FROM `tbldplan` where level < ? order by Id desc  limit 1 ";
			$result_com = $this->db->query($str_com_query2,array($level));
			return $result_com->row(0)->target;
		}
		else if($usertype == "Retailer")
		{
			$str_com_query3 = "SELECT * FROM `tblrplan` where level < ? order by Id desc  limit 1";
			$result_com = $this->db->query($str_com_query3,array($level));
			
			return $result_com->row(0)->target;
		}
		
	}
	public function getLevelCommission($usertype,$level)
	{
		if($usertype == "MasterDealer")
		{
			$str_query = "SELECT * FROM `tblmdplan` where level = ?";
			$rslt = $this->db->query($str_query,array($level));
			return $rslt->row(0)->commission_persontage;
		}
		if($usertype == "Distributer")
		{
			$str_query = "SELECT * FROM `tbldplan` where level = ? ";
			$rslt = $this->db->query($str_query,array($level));
			return $rslt->row(0)->commission_per;
		}
		if($usertype == "Retailer")
		{
			$str_query = "SELECT * FROM `tblrplan` where level = ?";
			$rslt = $this->db->query($str_query,array($level));
			return $rslt->row(0)->commission_per;
		}
		
	}

}

?>