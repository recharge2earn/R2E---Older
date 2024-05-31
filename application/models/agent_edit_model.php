<?php
class Agent_edit_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function update($Retailername,$Parent_id,$Address,$Pin,$State,$City,$MobNo,$LandNo,$RetType,$Email,$Scheme_id,$Scheme_amt,$User_id,$pan_no,$contact_person)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();				
		$str_query = "update tblusers  set business_name=?,parent_id=?,postal_address=?,pincode=?,state_id=?,city_id=?,mobile_no=?, landline=?,retailer_type_id=?,emailid=?,edit_date=?,ipaddress=?,scheme_id=?,scheme_amount=?, pan_no = ?,contact_person = ? where user_id=?";
		$result = $this->db->query($str_query,array($Retailername,$Parent_id,$Address,$Pin,$State,$City,$MobNo,$LandNo,$RetType,$Email,$date,$ip,$Scheme_id,$Scheme_amt,$pan_no,$contact_person,$User_id));		
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