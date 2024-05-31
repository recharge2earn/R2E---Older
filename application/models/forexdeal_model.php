<?php
class Forexdeal_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function add_ForexIncome($user_id,$amount,$remark)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$payment_date = $this->common->getMySqlDate();
		$payment_time = $this->common->getMySqlTime();						
		$str_master_query = "insert into tblpayment_master(user_id,add_date,ip_address) values(?,?,?)";
		$result_master = $this->db->query($str_master_query,array('1',$date,$ip));
		$master_id = $this->db->insert_id();		
		
		$str_cr_dr_query = "insert into tblpayment(cr_user_id,dr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?,?)";
		$result_cr_dr = $this->db->query($str_cr_dr_query,array($user_id,'1',$master_id,$amount,'cash',$remark,'ForexIncome',$payment_date,$payment_time,$date,$ip));
					
	}
	public function UpdatePayment11($user_id,$amount,$percent,$remark)
	{
		try
		{
		$final_amount = (($amount * $percent ) /100);
		$this->add_ForexIncome($user_id,$final_amount,$remark); // First Payment
		
		$result = $this->GetParent($user_id);
		$parent_id = $result->row(0)->parent_id;		
		if($parent_id == 1)
		{
			return true;
		}
		$final_amount = (($amount * 3) /100);
		$this->add_ForexIncome($parent_id,$final_amount,$remark); // Second Payment
		
		
		$result = $this->GetParent($parent_id);
		$parent_id = $result->row(0)->parent_id;		
		if($parent_id == 1)
		{
			return true;
		}
		$final_amount = (($amount * 2) /100);
		$this->add_ForexIncome($parent_id,$final_amount,$remark); // Third Payment												
	}
		catch(Exception $ex)
		{
			return array('Error'=>$ex->getMessage());
		}
	}
	public function GetParent($user_id)
	{
		$str_query = "select * from tblusers where user_id=?";
		$result = $this->db->query($str_query,array($user_id));
		return $result;
	}
	public	function getDate($date)
	{		
	$str_query = "select * from  tblforexincome where pay_date=?";
	$result = $this->db->query($str_query,array($date));		
	return $result;	
	}		
}

?>