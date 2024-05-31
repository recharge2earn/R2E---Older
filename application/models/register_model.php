<?php
class Register_model extends CI_Model 
{	
	function findEmailID($EmailID,$UserName)
	{
		$str_query = "select * from tblusers where emailid=? and username=?";
		$result = $this->db->query($str_query,array($EmailID,$UserName));						
		if($result->num_rows() == 1)
		{
			return $result->row(0)->mobile_no;
		}
		else
		{
			return false;
		}
	}
	function findMobile($EmailID,$MobileNo)
	{
		$str_query = "select * from tblusers where emailid=? and mobile_no=?";
		$result = $this->db->query($str_query,array($EmailID,$MobileNo));						
		if($result->num_rows() == 1)
		{
			return $result;
		}
		else
		{
			return false;
		}
	}
	function findReferenceUserName($username)
	{
		$str_query = "select * from tblusers where username=?";
		$result = $this->db->query($str_query,array($username));						
		if($result->num_rows() == 1)
		{
			return $result;
		}
		else
		{
			return false;
		}
	}

	
	function UpdatePassword($emailID,$UserName,$newPassword)
	{
		$str_query = "update tblusers set password=?,first_time_login='0' where emailid=? and username=?";
		$result = $this->db->query($str_query,array($newPassword,$emailID,$UserName));						
		return $result;
	}

	function add($emailID,$Name,$Mobile)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$result_scheme = $this->db->query("select scheme_id from tblscheme where scheme_type='Customer'");
		$scheme_id = $result_scheme->row(0)->scheme_id;		
		$str_query = "insert into tblusers(emailid,business_name,mobile_no,usertype_name,add_date,ipaddress,scheme_id,status) values(?,?,?,?,?,?,?,?)";				
		$result = $this->db->query($str_query,array($emailID,$Name,$Mobile,'Customer',$date,$ip,$scheme_id,'1'));		
		if($result > 0)
		{						
			$userid_value = $this->db->insert_id();
$this->db->query("INSERT INTO `tblmodule_rights` (`isMobile`,`isDTH`,`user_id`,`add_date`,`ipaddress`) VALUES ('yes','yes','".$userid_value."','".$date."','".$ip."')");						
			$user_id = array('user_id' => $userid_value); 			
			$this->session->set_userdata($user_id);
			return true;
		}
		else
		{
			return false;
		}		
	}
	
	function addWithParent($ParentID,$Name,$Mobile)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$result_scheme = $this->db->query("select scheme_id from tblscheme where scheme_type='Customer'");
		$scheme_id = $result_scheme->row(0)->scheme_id;		
		$str_query = "insert into tblusers(parent_id,business_name,mobile_no,usertype_name,add_date,ipaddress,scheme_id,status) values(?,?,?,?,?,?,?,?)";				
		$result = $this->db->query($str_query,array($ParentID,$Name,$Mobile,'Customer',$date,$ip,$scheme_id,'1'));		
		if($result > 0)
		{						
			$userid_value = $this->db->insert_id();
$this->db->query("INSERT INTO `tblmodule_rights` (`isMobile`,`isDTH`,`user_id`,`add_date`,`ipaddress`) VALUES ('yes','yes','".$userid_value."','".$date."','".$ip."')");						
			$user_id = array('user_id' => $userid_value); 			
			$this->session->set_userdata($user_id);
			return true;
		}
		else
		{
			return false;
		}		
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
	
	public function find_mobile_exist($mobile)
	{
		$str_query = "select * from tblusers where mobile_no=?";
		$result = $this->db->query($str_query,array($mobile));		
		if($result->num_rows() == 1)
		{			
			return false;
		}
		else
		{
			return true;
		}				
	}	
}

?>