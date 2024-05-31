<?php
class Scheme_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($SchemeName,$SchemeDesc,$commission_per,$SchemeFor,$SchemeType)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$str_query = "insert into tblscheme(scheme_name,scheme_description,flat_commission,scheme_type,scheme_for,add_date,ipaddress) values(?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($SchemeName,$SchemeDesc,$commission_per,$SchemeType,$SchemeFor,$date,$ip));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public	function delete($schemeID)
	{	
		$str_query = "delete from tblscheme where scheme_id=?";
		$result = $this->db->query($str_query,array($schemeID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	
	public	function update($schemeID,$schemeName,$schemeDesc,$schemeAmt,$schemeType)
	{	
		$str_query = "update tblscheme set scheme_name=?,scheme_description=?,amount=?,scheme_type=? where scheme_id=?";
		$result = $this->db->query($str_query,array($schemeName,$schemeDesc,$schemeAmt,$schemeType,$schemeID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public function get_scheme()
	{
		$str_query = "select * from  tblscheme order by scheme_name";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_scheme_limited($start_row,$per_page)
	{
		$str_query = "select * from  tblscheme order by scheme_name limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
	
}

?>