<?php
class Edit_distributer_form1_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function update($Distname,$PostalAddr,$Landmark,$Pin,$State,$City,$Area,$ConPer,$MobNo,$LandNo,$RetType,$Email,$Other_Area,$User_id)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$str_query = "update tblusers  set business_name=?,postal_address=?,landmark=?,pincode=?,state_id=?,city_id=?,subarea_id=?,contact_person=?,mobile_no=?, landline=?,retailer_type_id=?,emailid=?,other_area=?,usertype_name=?,edit_date=?,ipaddress=? where user_id=?";
		$result = $this->db->query($str_query,array($Distname,$PostalAddr,$Landmark,$Pin,$State,$City,$Area,$ConPer,$MobNo,$LandNo,$RetType,$Email,$Other_Area,'Distributer',$date,$ip,$User_id));		
		if($result > 0)
		{
			$user_id = array('user_id' => $User_id,'dist_name' => $Distname ); 
			$this->session->set_userdata($user_id);
			return true;
		}
		else
		{
			return false;
		}		
	}
}

?>