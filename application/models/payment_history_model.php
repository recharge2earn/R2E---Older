<?php
class Payment_history_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_payment_request($id)
	{
		$str_query = "select tblpaymentrequest.*,tblbank.bank_name from tblpaymentrequest,tblbank where tblbank.bank_id=tblpaymentrequest.bank_id  order by payment_date";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_payment_request_limited($start_row,$per_page,$id)
	{
		$str_query = "select tblpaymentrequest.*,tblbank.bank_name from tblpaymentrequest,tblbank where tblbank.bank_id=tblpaymentrequest.bank_id order by payment_date limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
}

?>