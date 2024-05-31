<?php
class Agent_registration_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
public	function add($RetailerName,$Parent_id,$PostalAddr,$Pin,$State,$City,$MobNo,$LandNo,$RetType,$Email,$Scheme_id,$WorLimit,$Scheme_amt,$user_type,$pan_no,$con_per)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$total_amount = $WorLimit+$Scheme_amt;
		$payment_date = $this->common->getMySqlDate();
		$payment_time = $this->common->getMySqlTime();
$str_query = "insert into tblusers(business_name,parent_id,postal_address,pincode,state_id,city_id,mobile_no,landline,retailer_type_id,emailid,usertype_name,add_date,ipaddress,scheme_id,working_limit,scheme_amount,total_amount,status,kount,pan_no,contact_person) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($RetailerName,$Parent_id,$PostalAddr,$Pin,$State,$City,$MobNo,$LandNo,$RetType,$Email,$user_type,$date,$ip,$Scheme_id,$WorLimit,$Scheme_amt,$total_amount,'1','-1',$pan_no,$con_per));		
		if($result > 0)
		{
			$user_id = $this->db->insert_id(); 			
			$this->db->query("INSERT INTO `tblmodule_rights` (`isMobile`,`isDTH`,`user_id`,`add_date`,`ipaddress`) VALUES ('yes','yes','".$this->db->insert_id()."','".$date."','".$ip."')");
			
			
		$str_master_query = "insert into tblpayment_master(user_id,add_date,ip_address) values(?,?,?)";
		$result_master = $this->db->query($str_master_query,array($this->session->userdata('id'),$date,$ip));
		$master_id = $this->db->insert_id();				
		$str_cr_dr_query = "insert into tblpayment(cr_user_id,dr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?,?)";
		$result_cr_dr = $this->db->query($str_cr_dr_query,array($user_id,$this->session->userdata('id'),$master_id,( $Scheme_amt + $WorLimit ),'cash','First Payment'.$user_type,'Recharge',$payment_date,$payment_time,$date,$ip));
		
		$str_cr_dr_query = "insert into tblpayment(cr_user_id,dr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?,?)";
		$result_cr_dr = $this->db->query($str_cr_dr_query,array($this->session->userdata('id'),$user_id,$master_id,$Scheme_amt,'cash','Registration Fees','Recharge',$payment_date,$payment_time,$date,$ip));
		
		
		
			return $user_id;
		}
		else
		{
			return false;
		}		
	}	
	
	
	
	public function counting_distributer($user_id)
	{
		if($user_id == 1)
		{
			return true;		
		}
		else
		{
        $this->update_count($user_id);
		$parent_id = $this->get_parent($user_id);		
		$this->counting_distributer($parent_id);
		}
	}
	public function update_count($user_id)
	{
		$str_query = "select `kount` from tblusers where user_id=?";
		$result_exit_count = $this->db->query($str_query,array($user_id));				
		$kount = $result_exit_count->row(0)->kount;
		
		$str_query = "update tblusers set `kount`=? where user_id=?";
		$result = $this->db->query($str_query,array(($kount + 1),$user_id));					
		if(($kount + 1) == 3)
		{
		$str_query = "update tblusers set `usertype_name`=? where user_id=?";
		$result = $this->db->query($str_query,array('Distributor',$user_id));					
			
		}

	
	}
	public function get_parent($user_id)
	{
		$str_query = "select `parent_id` from tblusers where user_id=?";
		$result_exit_count = $this->db->query($str_query,array($user_id));				
		return $result_exit_count->row(0)->parent_id;		
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