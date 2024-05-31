<?php
class Dmr_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function addRequest($request_amount,$payment_date,$payment_mode,$deposite_time,$cheque_no,$cheque_date,$bank_id,$client_bank_id,$remarks,$user_id)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$str_query = "insert into tblpaymentrequest(request_amount,payment_date,payment_mode,deposite_time,cheque_no,cheque_date,bank_id,to_bank_id,remarks,user_id,request_status,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($request_amount,$payment_date,$payment_mode,$deposite_time,$cheque_no,$cheque_date,$bank_id,$client_bank_id,$remarks,$user_id,'Pending',$date,$ip));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}			
	
	public function get_payment_request($id)
	{
		$str_query = "select tblpaymentrequest.*,(select bank_name from tblbank where tblbank.bank_id=tblpaymentrequest.bank_id) as bank_name from tblpaymentrequest where  user_id=? order by payment_date";
		$result = $this->db->query($str_query,array($id));
		return $result;
	}
	public function get_payment_request_limited($start_row,$per_page,$id)
	{
		$str_query = "select tblpaymentrequest.*,(select bank_name from tblbank where tblbank.bank_id=tblpaymentrequest.bank_id) as bank_name from tblpaymentrequest where user_id=? order by payment_date limit 0,10";
		$result = $this->db->query($str_query,array($id));
		return $result;
	}	
}

?>