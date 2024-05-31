<?php
class Beapartner_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($yName,$bname,$baddress,$city,$state,$mobileno,$email,$interestedas,$businessdetail,$varification)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$str_query = "insert into tblbeapartner(yname,bname,baddress,city,state,mobileno,email,interestedas,businessdetail,varification,reqdate,ipaddress) values(?,?,?,?,?,?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($yName,$bname,$baddress,$city,$state,$mobileno,$email,$interestedas,$businessdetail,$varification,$date,$ip));		
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