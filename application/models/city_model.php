<?php
class City_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($CityName,$StateID)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$str_query = "insert into tblcity(city_name,state_id,add_date,ipaddress) values(?,?,?,?)";
		$result = $this->db->query($str_query,array($CityName,$StateID,$date,$ip));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public	function delete($cityID)
	{	
		$str_query = "delete from tblcity where city_id=?";
		$result = $this->db->query($str_query,array($cityID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	
	public	function update($cityID,$cityName,$stateID)
	{	
		$str_query = "update tblcity set city_name=?,state_id=? where city_id=?";
		$result = $this->db->query($str_query,array($cityName,$stateID,$cityID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	public function get_city()
	{
		$str_query = "select `tblcity`.*,`tblstate`.state_name FROM `tblcity`,`tblstate` WHERE `tblcity`.state_id = `tblstate`.state_id order by `tblstate`.state_name,`tblcity`.city_name";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_city_limited($start_row,$per_page)
	{
		$str_query = "select `tblcity`.*,`tblstate`.state_name FROM `tblcity`,`tblstate` WHERE `tblcity`.state_id = `tblstate`.state_id order by `tblstate`.state_name,`tblcity`.city_name limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
}

?>