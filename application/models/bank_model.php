<?php
class Bank_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($bankName)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$str_query = "insert into tblbank(bank_name,add_date,ipaddress) values(?,?,?)";
		$result = $this->db->query($str_query,array($bankName,$date,$ip));		
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
		$str_query = "delete from tblbank where bank_id=?";
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
	
	public	function update($bankID,$bankName)
	{	
		$str_query = "update tblbank set bank_name=? where bank_id=?";
		$result = $this->db->query($str_query,array($bankName,$bankID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}		
	public function get_bank()
	{
		$str_query = "select * from tblbank order by bank_name";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_bank_limited($start_row,$per_page)
	{
		$str_query = "select * from tblbank order by bank_name limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
	
}

?>