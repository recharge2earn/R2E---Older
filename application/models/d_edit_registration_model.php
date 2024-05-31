<?php
class D_edit_registration_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function update($Distname,$PostalAddr,$Landmark,$Pin,$State,$City,$Area,$ConPer,$MobNo,$LandNo,$RetType,$Email,$Other_Area,$Bank1,$AcNo1,$AcType1,$Org,$PreLang,$Bank2,$AcNo2,$AccType2,$Scheme_id,$PayMode,$ChqDDNo,$ChqDDDate,$DepBank,$WorLimit,$Scheme_amt,$User_id)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$total_amount = $WorLimit+$Scheme_amt;
		$user_id = $this->session->userdata('user_id');
		$str_query = "update tblusers  set business_name=?,postal_address=?,landmark=?,pincode=?,state_id=?,city_id=?,subarea_id=?,contact_person=?,mobile_no=?, landline=?,retailer_type_id=?,emailid=?,other_area=?,usertype_name=?,edit_date=?,ipaddress=?,bank_id=?,account_no=?,account_type=?,ordganisation=?,prefered_language=?,bank_id_2=?,account_no_2=?,account_type_2=?,scheme_id=?,payment_mode=?,cheque_dd_no=?,cheque_dd_date=?,depositing_bank_id=?,working_limit=?,scheme_amount=?,total_amount=? where user_id=?";
		$result = $this->db->query($str_query,array($Distname,$PostalAddr,$Landmark,$Pin,$State,$City,$Area,$ConPer,$MobNo,$LandNo,$RetType,$Email,$Other_Area,'Distributer',$date,$ip,$Bank1,$AcNo1,$AcType1,$Org,$PreLang,$Bank2,$AcNo2,$AccType2,$Scheme_id,$PayMode,$ChqDDNo,$ChqDDDate,$DepBank,$WorLimit,$Scheme_amt,$total_amount,$User_id));		
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