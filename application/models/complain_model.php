<?php
class Complain_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($Subject,$Message,$recharge_id)
	{
		$this->load->library('common');
		$date = $this->common->getMySqlDate();
		$user_id = $this->session->userdata('id');
		$str_query = "insert into tblcomplain(user_id,complain_date,complain_status,message,complain_type,recharge_id) values(?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($user_id,$date,'Pending',$Message,$Subject,$recharge_id));		
		if($result > 0)
		{
			return $this->db->insert_id();
			//return true;
		}
		else
		{
			return false;
		}		
	}	
	public function GetUserInfo($user_id)
	{
		$str_query = "select * from tblusers where `tblusers`.user_id=?";
		$result = $this->db->query($str_query,array($user_id));		
		return $result;
	}	
	public function get_complain()
	{
		$str_query = "select * from `tblcomplain` where user_id=? order by complain_date";
		$result = $this->db->query($str_query,array($this->session->userdata('id')));
		return $result;
	}
	public function get_complain_limited($start_row,$per_page)
	{
		$str_query = "select * from `tblcomplain` where user_id=? order by complain_date limit $start_row,$per_page";
		$result = $this->db->query($str_query,array($this->session->userdata('id')));
		return $result;
	}
	public function GetRechargeResult($tranID)
	{
		$str_query = "select tblrecharge.*,tblcompany.company_name from `tblrecharge`,tblcompany where tblcompany.company_id=tblrecharge.company_id and ss_id=? and tblrecharge.user_id='".$this->session->userdata('id')."'";
		$result = $this->db->query($str_query,array($tranID));
		return $result;
	}
	public function getListCity($State_id)
	{
		$str_query = "select * from tblcity where state_id = ? order by city_name";
		$result = $this->db->query($str_query,array($State_id));		
		return $result;		
	}
	public function getDistribute()
	{
		$typeName='Distributer';
		$str_query = "select * from tblusers where usertype_name = ? order by business_name";
		$result = $this->db->query($str_query,array($typeName));		
		return $result;		
	}			
	public function getListArea($City_id)
	{
		$str_query = "select * from tbllocalarea where city_id = ? order by area_name";
		$result = $this->db->query($str_query,array($City_id));		
		return $result;		
	}			
}

?>