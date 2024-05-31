<?php
class Contact_us_model extends CI_Model 
{	
function _construct()
{
      // Call the Model constructor
      parent::_construct();
}
	function add($name,$email,$message,$conactno,$subject)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();		
		$str_query = "insert into tblbeapartner(visitorname,email,message,contact_no,enquire_type,request_date,ipaddress) values(?,?,?,?,?,?,?)";				
		$result = $this->db->query($str_query,array($name,$email,$message,$conactno,$subject,$date,$ip));		
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