<?php
class Retailer_form1_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($RetailerName,$Parent_id,$PostalAddr,$Landmark,$Pin,$State,$City,$Area,$ConPer,$MobNo,$LandNo,$RetType,$Email,$DistName,$Other_Area,$Bank1,$AcNo1,$AcType1,$Org,$PreLang,$Bank2,$AcNo2,$AccType2,$Scheme_id,$PayMode,$ChqDDNo,$ChqDDDate,$DepBank,$WorLimit,$Scheme_amt)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$total_amount = $WorLimit+$Scheme_amt;
		$payment_date = $this->common->getMySqlDate();
		$payment_time = $this->common->getMySqlTime();
		$str_query = "insert into tblusers(business_name,parent_id,postal_address,landmark,pincode,state_id,city_id,subarea_id,contact_person,mobile_no,landline,retailer_type_id,emailid,other_area,usertype_name,add_date,ipaddress,bank_id,account_no,account_type,ordganisation,prefered_language,bank_id_2,account_no_2,account_type_2,scheme_id,payment_mode,cheque_dd_no,cheque_dd_date,depositing_bank_id,working_limit,scheme_amount,total_amount,status) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($RetailerName,$Parent_id,$PostalAddr,$Landmark,$Pin,$State,$City,$Area,$ConPer,$MobNo,$LandNo,$RetType,$Email,$Other_Area,'Retailer',$date,$ip,$Bank1,$AcNo1,$AcType1,$Org,$PreLang,$Bank2,$AcNo2,$AccType2,$Scheme_id,$PayMode,$ChqDDNo,$ChqDDDate,$DepBank,$WorLimit,$Scheme_amt,$total_amount,'1'));		
		if($result > 0)
		{
			$user_id = $this->db->insert_id();			
			$this->db->query("INSERT INTO `tblmodule_rights` (`isMobile`,`isDTH`,`user_id`,`add_date`,`ipaddress`) VALUES ('no','no','".$this->db->insert_id()."','".$date."','".$ip."')");	
			
			
			$str_master_query = "insert into tblpayment_master(user_id,add_date,ip_address) values(?,?,?)";
		$result_master = $this->db->query($str_master_query,array($this->session->userdata('id'),$date,$ip));
		$master_id = $this->db->insert_id();				
		$str_cr_dr_query = "insert into tblpayment(cr_user_id,dr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?,?)";
		$result_cr_dr = $this->db->query($str_cr_dr_query,array($user_id,$this->session->userdata('id'),$master_id,( $Scheme_amt + $WorLimit ),$PayMode,'First Payment To Distibuter','Recharge',$payment_date,$payment_time,$date,$ip));
		
		$str_cr_dr_query = "insert into tblpayment(cr_user_id,dr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?,?)";
		$result_cr_dr = $this->db->query($str_cr_dr_query,array($this->session->userdata('id'),$user_id,$master_id,$Scheme_amt,$PayMode,'Registration Fees','Recharge',$payment_date,$payment_time,$date,$ip));
			
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
		if($result->num_rows() == 1)
		{			
			return false;
		}
		else
		{
			return true;
		}				
	}
	
}

?>