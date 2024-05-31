<?php
class Local_area_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($LocalArea_name,$Pincode,$CityID,$StateID)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$str_query = "insert into tbllocalarea(area_name,city_id,state_id,pincode,add_date,ipaddress) values(?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($LocalArea_name,$CityID,$StateID,$Pincode,$date,$ip));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public	function delete($areaID)
	{	
		$str_query = "delete from tbllocalarea where area_id=?";
		$result = $this->db->query($str_query,array($areaID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	
	public	function update($AreaID,$areaName,$Pincode,$cityID,$stateID)
	{	
		$str_query = "update tbllocalarea set area_name=?,pincode=?,city_id=?,state_id=? where area_id=?";
		$result = $this->db->query($str_query,array($areaName,$Pincode,$cityID,$stateID,$AreaID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public function get_local_area()
	{
		$str_query = "select `tbllocalarea`.*,`tblstate`.state_name,`tblcity`.city_name FROM `tblcity`,`tblstate`,`tbllocalarea` WHERE `tbllocalarea`.city_id = `tblcity`.city_id and `tbllocalarea`.state_id= `tblstate`.state_id order by `tblstate`.state_name,`tblcity`.city_name,`tbllocalarea`.area_name";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_local_area_limited($start_row,$per_page)
	{
		$str_query = "select `tbllocalarea`.*,`tblstate`.state_name,`tblcity`.city_name FROM `tblcity`,`tblstate`,`tbllocalarea` WHERE `tbllocalarea`.city_id = `tblcity`.city_id and `tbllocalarea`.state_id= `tblstate`.state_id order by `tblstate`.state_name,`tblcity`.city_name,`tbllocalarea`.area_name limit $start_row,$per_page";
		$result = $this->db->query($str_query);
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