<?php
class Distributer_form1_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($Distname,$PostalAddr,$Landmark,$Pin,$State,$City,$Area,$ConPer,$MobNo,$LandNo,$RetType,$Email,$Other_Area)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$str_query = "insert into tblusers(business_name,postal_address,landmark,pincode,state_id,city_id,subarea_id,contact_person,mobile_no,landline,retailer_type_id,emailid,other_area,usertype_name,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($Distname,$PostalAddr,$Landmark,$Pin,$State,$City,$Area,$ConPer,$MobNo,$LandNo,$RetType,$Email,$Other_Area,'Distributer',$date,$ip));		
		if($result > 0)
		{
			$user_id = $this->db->insert_id(); 			
			$this->db->query("INSERT INTO `tblmodule_rights` (`isMobile`,`isDTH`,`isAIR`,`isAccount`,`user_id`,`add_date`,`ipaddress`) VALUES ('no','no','no','yes','".$this->db->insert_id()."','".$date."','".$ip."')");			
			return $user_id;
		}
		else
		{
			return false;
		}		
	}
	public function update($username,$pwd,$user_id)
	{
		$str_query = "update tblusers set username=?,password=? where user_id=?";
		$result = $this->db->query($str_query,array($username,$pwd,$user_id));		
		if($result > 0)
		{			
			return true;
		}
		else
		{
			return false;
		}				
	}
	public function find_mobile_exist($mobile)
	{
		$str_query = "select * from tblusers where mobile_no=?";
		$result = $this->db->query($str_query,array($mobile));		
		if($result->num_rows() == 1){return false;}
		else{return true;}				
	}
}

?>