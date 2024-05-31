<?php
class D_admin_bank_details_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($bankId,$ifsc,$accountno,$branch,$user_id)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$str_query = "insert into tbluser_bank(bank_id,ifsc_code,account_number,branch_name,user_id,add_date,ip_address) values(?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($bankId,$ifsc,$accountno,$branch,$user_id,$date,$ip));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public	function delete($bankID)
	{	
		$str_query = "delete from tbluser_bank where user_bank_id=?";
		$result = $this->db->query($str_query,array($bankID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	
	public	function update($bankId,$ifsc,$accountno,$branch,$user_bank_id,$user_id)
	{	
		$str_query = "update tbluser_bank set bank_id=?,ifsc_code=?,account_number=?,branch_name=?,user_id=? where user_bank_id=?";
		$result = $this->db->query($str_query,array($bankId,$ifsc,$accountno,$branch,$user_id,$user_bank_id));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}		
	public function get_bank($user_id)
	{
		$str_query = "select * from tbluser_bank,tblbank where tbluser_bank.user_id=? and tblbank.bank_id=tbluser_bank.bank_id order by tblbank.bank_name";
		$result = $this->db->query($str_query,array($user_id));
		return $result;
	}
	public function get_bank_limited($start_row,$per_page,$user_id)
	{
		$str_query = "select * from tbluser_bank,tblbank where tbluser_bank.user_id=? and tblbank.bank_id=tbluser_bank.bank_id order by tblbank.bank_name limit $start_row,$per_page";
		$result = $this->db->query($str_query,array($user_id));
		return $result;
	}	
	
}

?>