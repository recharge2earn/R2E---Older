<?php
class Chart_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_Recharge_By_Company_name($compny_name,$today_date)
	{
		$str_query = "select IFNULL(Sum(amount),0) as TotalRecharge from tblrecharge where recharge_date = '$today_date' and company_id = (select company_id from tblcompany where company_name = '$compny_name')";
		$result = $this->db->query($str_query);
		return $result->row(0)->TotalRecharge;
	}
}

?>