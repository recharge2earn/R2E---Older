<?php
class State_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($stateName,$stateCode,$circleCode)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$str_query = "insert into tblstate(state_name,codes,circle_code,add_date,ipaddress) values(?,?,?,?,?)";
		$result = $this->db->query($str_query,array($stateName,$stateCode,$circleCode,$date,$ip));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public	function delete($stateID)
	{	
		$str_query = "delete from tblstate where state_id=?";
		$result = $this->db->query($str_query,array($stateID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	
	public	function update($stateID,$stateName,$stateCode,$circleCode)
	{	
		$str_query = "update tblstate set state_name=?,codes=?,circle_code=? where state_id=?";
		$result = $this->db->query($str_query,array($stateName,$stateCode,$circleCode,$stateID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public function get_state()
	{
		$str_query = "select * from  tblstate order by state_name";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_state_limited($start_row,$per_page)
	{
		$str_query = "select * from  tblstate order by state_name limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}
}

?>