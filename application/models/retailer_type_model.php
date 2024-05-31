<?php
class Retailer_type_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($retailer_type_name)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$str_query = "insert into tblratailertype(retailer_type_name,add_date,ipaddress) values(?,?,?)";
		$result = $this->db->query($str_query,array($retailer_type_name,$date,$ip));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public	function delete($retailerID)
	{	
		$str_query = "delete from  tblratailertype where retailer_type_id=?";
		$result = $this->db->query($str_query,array($retailerID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	
	public	function update($retailerID,$retailerName)
	{	
		$str_query = "update tblratailertype set retailer_type_name=? where retailer_type_id=?";
		$result = $this->db->query($str_query,array($retailerName,$retailerID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public function get_retailer_type()
	{
		$str_query = "select * from  tblratailertype order by retailer_type_name";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_retailer_type_limited($start_row,$per_page)
	{
		$str_query = "select * from  tblratailertype order by retailer_type_name limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}
	
}

?>