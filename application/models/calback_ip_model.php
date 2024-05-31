<?php
class Calback_ip_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function ip_address($ip_address,$User_id)
	{	
		$str_query = "update tblusers set ip_address=? where user_id=?";
		$result = $this->db->query($str_query,array($ip_address,$User_id));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	

public	function opblock($opblock,$User_id)
	{	
		$str_query = "update tblusers set opblock=? where user_id=?";
		$result = $this->db->query($str_query,array($opblock,$User_id));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
		public	function call_back($api_execution_url,$User_id)
	{	
		$str_query = "update tblusers set api_execution_url=? where user_id=?";
		$result = $this->db->query($str_query,array($api_execution_url,$User_id));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	

	public	function addMobile($ReasonMobile,$NewMobile,$user_id)
	{	
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$request_date = $this->common->getMySqlDate();
		$str_query = "insert into tblchangeprofile (request_date,mobile_no,mobile_reason,userid,status,update_by,add_date,ipaddress) values(?,?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($request_date,$NewMobile,$ReasonMobile,$user_id,'Pending','Mobile',$date,$ip));		
//		$str_query = "update tblusers set `mobile_no`=?,reason_mobile=? where user_id=?";
//		$result = $this->db->query($str_query,array($NewMobile,$ReasonMobile,$user_id));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public	function addEmail($ReasonEmail,$NewEmail,$user_id)
	{	
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$request_date = $this->common->getMySqlDate();

		$str_query = "insert into tblchangeprofile (request_date,emailid,emailid_reason,userid,status,update_by,add_date,ipaddress) values(?,?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($request_date,$NewEmail,$ReasonEmail,$user_id,'Pending','Email',$date,$ip));		
//
//		$str_query = "update tblusers set `emailid`=?,reason_emailid=? where user_id=?";
//		$result = $this->db->query($str_query,array($NewEmail,$ReasonEmail,$user_id));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	
}

?>