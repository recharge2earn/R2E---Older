<?php
class F_add_balance_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_distributor($user_id)
	{
		$str_query = "select * from tblusers where usertype_name='Distributer' and user_id=?";
		$result = $this->db->query($str_query,array($user_id));
		return $result;
	}
	public function GetUserInfo($user_id)
	{
		$str_query = "select * from tblusers where `tblusers`.user_id=?";
		$result = $this->db->query($str_query,array($user_id));		
		return $result;
	}	

	public function add_newbalance($cr_user_id,$amount)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$payment_date = $this->common->getMySqlDate();
		$payment_time = $this->common->getMySqlTime();						
		
		$str_master_query = "insert into tblpayment_master(user_id,add_date,ip_address) values(?,?,?)";
		$result_master = $this->db->query($str_master_query,array($this->session->userdata('id'),$date,$ip));
		$master_id = $this->db->insert_id();
		
		
		$str_cr_dr_query = "insert into tblpayment(cr_user_id,dr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?,?)";
		$result_cr_dr = $this->db->query($str_cr_dr_query,array($cr_user_id,$this->session->userdata('id'),$master_id,$amount,'cash','Direct Payment','Recharge',$payment_date,$payment_time,$date,$ip));
		
		
		//$str_cr_query = "insert into tblpayment(cr_user_id,payment_master_id,amount,remark,payment_type,payment_date,payment_time,transaction_type,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?)";
//		$result_cr = $this->db->query($str_cr_query,array($cr_user_id,$master_id,$amount,'Direct Payment','cash',$payment_date,$payment_time,'Recharge',$date,$ip));

		//$str_commmission_query = "insert into tblpayment(cr_user_id,amount,remark,transaction_type,add_date,ipaddress) values(?,?,?,?,?,?,?,?)";	// For Commission Add in Distributer
//		$result_cr = $this->db->query($str_commmission_query,array($this->session->userdata('id'),$amount,'Direct Payment','Commission',$date,$ip));

		
		//$str_dr_query = "insert into tblpayment(dr_user_id,payment_master_id,amount,remark,payment_type,payment_date,payment_time,transaction_type,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?)";
//		$result_dr = $this->db->query($str_dr_query,array($this->session->userdata('id'),$master_id,$amount,'Direct Payment','cash',$payment_date,$payment_time,'Recharge',$date,$ip));
		if($result_cr_dr > 0)
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