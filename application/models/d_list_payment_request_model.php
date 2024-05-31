<?php
class D_list_payment_request_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function updateStatus($user_id,$status,$id,$Amount,$BankCharge,$Remark,$bank_id)
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
		$result_cr_dr = $this->db->query($str_cr_dr_query,array($user_id,$this->session->userdata('id'),$master_id,$final_amt,'cheque','Payment By Request','Recharge',$payment_date,$payment_time,$date,$ip,$bank_id));
		
		$str_bankcharge_query = "insert into tblpayment(cr_user_id,dr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress,bank_id) values(?,?,?,?,?,?,?,?,?,?,?,?)";
		$result_cr_dr = $this->db->query($str_bankcharge_query,array($this->session->userdata('id'),$user_id,$master_id,$BankCharge,'cheque','By Bankcharge','BankCharge',$payment_date,$payment_time,$date,$ip,$bank_id));
		//$str_cr_query = "insert into tblpayment(cr_user_id,payment_master_id,amount,remark,payment_type,payment_date,payment_time,transaction_type,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?)";
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
	
	public function GetBalanceByUser($user_id)
	{
		$str_query = "select sum(amount) as 'CreditAmount' from tblpayment where cr_user_id=?";
	$result_cr = $this->db->query($str_query,array($user_id));		
	$str_query = "select sum(amount) as 'DebitAmount' from tblpayment where dr_user_id=?";
	$result_dr = $this->db->query($str_query,array($user_id));		
	$str_query = "select sum(amount) as 'RechargeAmount',SUM(commission_amount) AS commission_amount from tblrecharge where user_id=? and (recharge_status='Success' or recharge_status='Pending')";
	$result_recharge = $this->db->query($str_query,array($user_id));		
	$Balance = ($result_cr->row(0)->CreditAmount + $result_recharge->row(0)->commission_amount) - ($result_dr->row(0)->DebitAmount + $result_recharge->row(0)->RechargeAmount);		
	return round($Balance,2);	
	}

	
	public function get_payment_request()
	{
		$str_query = "select tblpaymentrequest.*,tblbank.bank_name,tblusers.username from tblpaymentrequest,tblbank,tblusers  where tblbank.bank_id=tblpaymentrequest.bank_id and tblusers.user_id=tblpaymentrequest.user_id and tblusers.parent_id=? and request_status='Pending' order by payment_date";
		$parent_id = $this->session->userdata('id');
		$result = $this->db->query($str_query,array($parent_id));
		return $result;
	}
	public function get_payment_request_limited($start_row,$per_page)
	{
		$str_query = "select tblpaymentrequest.*,tblbank.bank_name,tblusers.username from tblpaymentrequest,tblbank,tblusers  where tblbank.bank_id=tblpaymentrequest.bank_id and tblusers.user_id=tblpaymentrequest.user_id and tblusers.parent_id=? and request_status='Pending' order by payment_date limit $start_row,$per_page";
		$parent_id = $this->session->userdata('id');
		$result = $this->db->query($str_query,array($parent_id));
		return $result;
	}	
}

?>