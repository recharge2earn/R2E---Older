<?php
class Get_recharge_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_recharge()
	{
		$str_query = "select tblrecharge.*,tblcompany.company_name,tblcompany.provider, business_name as name from tblrecharge,tblcompany,tblusers where tblusers.user_id=tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id and recharge_status='Pending' and ExecuteBy='Global' order by recharge_id limit 0,50";
		$result = $this->db->query($str_query);
		return $result;
	}			
}

?>