<?php
class Alerts_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	
	public function set($Alerts)
	{	
		$str_query = "update tblalerts set alert_name=?";
		$result = $this->db->query($str_query,array($Alerts));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	public function contact($Alerts)
	{	
		$str_query = "update contact set contact=?";
		$result = $this->db->query($str_query,array($Alerts));		
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