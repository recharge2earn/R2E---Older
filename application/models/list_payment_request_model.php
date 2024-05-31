<?php
class List_payment_request_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function updateStatus($user_id,$status,$id,$Amount,$BankCharge,$Remark,$bank_id,$remark_details)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$payment_date = $this->common->getMySqlDate();
		$payment_time = $this->common->getMySqlTime();						
		$str_query="UPDATE  `tblpaymentrequest` SET  `request_status` =  ?,bank_charge=?,deposit_remark=? WHERE  `tblpaymentrequest`.`payment_request_id` =? and `tblpaymentrequest`.`user_id` =?";
		$result = $this->db->query($str_query,array($status,$BankCharge,$Remark,$id,$user_id));
		if($result > 0)
		{
			if($status == "Success")
			{

		$str_master_query = "insert into tblpayment_master(user_id,add_date,ip_address) values(?,?,?)";
		$result_master = $this->db->query($str_master_query,array($this->session->userdata('id'),$date,$ip));
		$master_id = $this->db->insert_id();
		
		$final_amt = ($Amount - $BankCharge);
		
		
		$str_cr_dr_query = "insert into tblpayment(cr_user_id,dr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress,bank_id) values(?,?,?,?,?,?,?,?,?,?,?,?)";
		$result_cr_dr = $this->db->query($str_cr_dr_query,array($user_id,$this->session->userdata('id'),$master_id,$final_amt,'cheque',$remark_details,'Recharge',$payment_date,$payment_time,$date,$ip,$bank_id));
		
		$str_bankcharge_query = "insert into tblpayment(cr_user_id,dr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress,bank_id) values(?,?,?,?,?,?,?,?,?,?,?,?)";
		$result_cr_dr = $this->db->query($str_bankcharge_query,array($this->session->userdata('id'),$user_id,$master_id,$BankCharge,'cheque','By Bankcharge','BankCharge',$payment_date,$payment_time,$date,$ip,$bank_id));
		
		
//		$str_cr_query = "insert into tblpayment(cr_user_id,payment_master_id,amount,remark,payment_type,payment_date,payment_time,transaction_type,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?)";
//		$result_cr = $this->db->query($str_cr_query,array($user_id,$master_id,$final_amt,$Remark,'cheque',$payment_date,$payment_time,'Recharge',$date,$ip));
//						
//		$str_dr_query = "insert into tblpayment(dr_user_id,payment_master_id,amount,remark,payment_type,payment_date,payment_time,transaction_type,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?)";
//		$result_dr = $this->db->query($str_dr_query,array($this->session->userdata('id'),$master_id,$final_amt,$Remark,'cheque',$payment_date,$payment_time,'Recharge',$date,$ip));
		
			}
		return true;
		}
		else
			return false;
	}
	public function get_payment_request()
	{
		$str_query = "select tblpaymentrequest.*,(select bank_name from tblbank where tblbank.bank_id=tblpaymentrequest.bank_id) as bank_name,(select tblbank.bank_name from tblbank where bank_id=tblpaymentrequest.to_bank_id) as client_bank,tblusers.username from tblpaymentrequest,tblusers  where tblusers.user_id=tblpaymentrequest.user_id and request_status='Pending' order by payment_date";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_payment_request_limited($start_row,$per_page)
	{
		$str_query = "select * from tblpaymentrequest,tblusers  where tblusers.user_id=tblpaymentrequest.user_id and request_status='Pending' order by payment_date limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
}

?>