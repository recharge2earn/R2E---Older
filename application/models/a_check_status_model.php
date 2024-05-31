<?php
class A_check_status_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_balance_transfer($txid)
	{
		$str_query = "select tblrecharge.*,tblcompany.company_name,tblusers.business_name from tblrecharge,tblcompany,tblusers where tblusers.user_id = tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id and tblrecharge.`mobile_no` = ?";
		$result = $this->db->query($str_query,array($txid));
		return $result;
	}
}

?>