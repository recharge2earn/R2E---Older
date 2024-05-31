<?php
class All_transaction_report_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_recharge($start_date,$end_date,$user_id,$Type)
	{
		if($Type == 'ALL')
		{
		$str_query ="select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany where tblcompany.company_id=tblrecharge.company_id and recharge_date>=? and recharge_date<= ? and user_id=? order by tblrecharge.recharge_date,recharge_type";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$user_id));
		return $result;

		}
		else
		{
		$str_query ="select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany where tblcompany.company_id=tblrecharge.company_id and recharge_date>=? and recharge_date<= ? and user_id=? and recharge_type=? order by tblrecharge.recharge_date,recharge_type";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$user_id,$Type));
		return $result;
		}
	}
}

?>