<?php
class Retailer_form2_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($radNo,$PanForm,$Bank1,$AcNo1,$AcType1,$RegNo,$RegDate,$Exempted,$Org,$TDS,$PreLang,$Bank2,$AcNo2,$AccType2,$Scheme_id,$PayMode,$ChqDDNo,$ChqDDDate,$DepBank,$WorLimit,$Scheme_amt,$user_id)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$total_amount = $WorLimit+$Scheme_amt;
		$payment_date = $this->common->getMySqlDate();
		$payment_time = $this->common->getMySqlTime();						
		$str_query = "insert into tblbank_details(ispanform60,panform60_no,bank_id,account_no,account_type,st_registration_no,st_registration_date,st_exempted,ordganisation,tds,prefered_language,bank_id_2,account_no_2,account_type_2,scheme_id,payment_mode,cheque_dd_no,cheque_dd_date,depositing_bank_id,working_limit,scheme_amount,total_amount,add_date,ipaddress,user_id) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($radNo,$PanForm,$Bank1,$AcNo1,$AcType1,$RegNo,$RegDate,$Exempted,$Org,$TDS,$PreLang,$Bank2,$AcNo2,$AccType2,$Scheme_id,$PayMode,$ChqDDNo,$ChqDDDate,$DepBank,$WorLimit,$Scheme_amt,$total_amount,$date,$ip,$user_id));		
		
		
		$str_master_query = "insert into tblpayment_master(user_id,add_date,ip_address) values(?,?,?)";
		$result_master = $this->db->query($str_master_query,array($this->session->userdata('id'),$date,$ip));
		$master_id = $this->db->insert_id();
		
		$str_cr_dr_query = "insert into tblpayment(cr_user_id,dr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?,?)";
		$result_cr_dr = $this->db->query($str_cr_dr_query,array($user_id,$this->session->userdata('id'),$master_id,($Scheme_amt + $WorLimit),$PayMode,'First Payment To Retailer','Recharge',$payment_date,$payment_time,$date,$ip));
		
		$str_cr_dr_query = "insert into tblpayment(cr_user_id,dr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?,?)";
		$result_cr_dr = $this->db->query($str_cr_dr_query,array($this->session->userdata('id'),$user_id,$master_id,($Scheme_amt),$PayMode,'Registration Fees','Recharge',$payment_date,$payment_time,$date,$ip));
		
//		$str_cr_query = "insert into tblpayment(cr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?)";
//		$result_cr = $this->db->query($str_cr_query,array($user_id,$master_id,$WorLimit,$PayMode,'First Payment To Retailer','Recharge',$payment_date,$payment_time,$date,$ip));
//		$str_dr_query = "insert into tblpayment(dr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?)";
//		$result_dr = $this->db->query($str_dr_query,array($this->session->userdata('id'),$master_id,$WorLimit,$PayMode,'First Payment To Retailer','Recharge',$payment_date,$payment_time,$date,$ip));		

		
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