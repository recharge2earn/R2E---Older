<?php
class Change_profile_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function update($Address,$Pin,$State,$City,$LandNo,$RetType,$Email,$User_id)
	{	
		$str_query = "update tblusers set postal_address=?,pincode=?,state_id=?,city_id=?,landline=?,retailer_type_id=?,emailid=? where user_id=?";
		$result = $this->db->query($str_query,array($Address,$Pin,$State,$City,$LandNo,$RetType,$Email,$User_id));		
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