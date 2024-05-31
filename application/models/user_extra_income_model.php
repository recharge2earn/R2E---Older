<?php
class User_extra_income_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_commission_received($id,$date)
	{
		$this->load->library('common');
		$date = $this->common->getMySqlDate();		
		$str_query = "SELECT tblpayment.*,(select business_name from tblusers where user_id=tblpayment.cr_user_id) as name_user FROM `tblpayment` where cr_user_id=? and tblpayment.payment_date=? and transaction_type='ExtraIncome'";		
		$result = $this->db->query($str_query,array($id,$date));
		return $result;
	}
	public function get_commission_received_bydate($id,$date1,$date2)
	{
		if($date1 == '')
		{
			$this->load->library('common');
					$date = $this->common->getMySqlDate();
					$str_query = "SELECT tblpayment.*,(select business_name from tblusers where user_id=tblpayment.cr_user_id) as name_user FROM `tblpayment` where cr_user_id=? and tblpayment.payment_date>=? and tblpayment.payment_date<=? and transaction_type='ExtraIncome' order by tblpayment.payment_date";					
		$result = $this->db->query($str_query,array($id,$date1,$date2));
		return $result;
		}
		else
		{
			$str_query = "SELECT tblpayment.*,(select business_name from tblusers where user_id=tblpayment.cr_user_id) as name_user FROM `tblpayment` where cr_user_id=? and tblpayment.payment_date>=? and tblpayment.payment_date<=? and transaction_type='ExtraIncome' order by tblpayment.payment_date";
		$result = $this->db->query($str_query,array($id,$date1,$date2));
		return $result;	
		}			
	}
}

?>