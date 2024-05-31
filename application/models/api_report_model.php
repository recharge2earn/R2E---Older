<?php
class Api_report_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_recharge($start_date,$end_date,$api)
	{
		if($api == 'ALL')
		{
		$str_query ="select tblrecharge.*,tblcompany.company_name,tblusers.business_name  from tblrecharge,tblcompany,tblusers where 
		tblusers.user_id = tblrecharge.user_id  and
		tblcompany.company_id=tblrecharge.company_id and recharge_date >=? and recharge_date <= ? order by tblrecharge.recharge_id";		
		$result = $this->db->query($str_query,array($start_date,$end_date));
		return $result;		

		}
		else
		{
		$str_query ="select tblrecharge.*,tblcompany.company_name,tblusers.business_name from tblrecharge,tblcompany,tblusers where 
		tblusers.user_id = tblrecharge.user_id  and
		tblcompany.company_id=tblrecharge.company_id and recharge_date >=? and recharge_date <= ? and ExecuteBy = ? order by tblrecharge.recharge_id";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$api));
		return $result;		
		}
	}
	public function get_recharge_limited($start_date,$end_date,$api,$start_row,$per_page)
	{
		if($api == 'ALL')
		{
		$str_query ="select tblrecharge.*,tblcompany.company_name,tblusers.username  from tblrecharge,tblcompany,tblusers where 
		tblusers.user_id = tblrecharge.user_id  and
		tblcompany.company_id=tblrecharge.company_id and recharge_date >=? and recharge_date <= ? order by tblrecharge.recharge_id limit $start_row,$per_page";		
		$result = $this->db->query($str_query,array($start_date,$end_date));
		return $result;		

		}
		else
		{
		$str_query ="select tblrecharge.*,tblcompany.company_name,tblusers.username  from tblrecharge,tblcompany,tblusers where 
		tblusers.user_id = tblrecharge.user_id  and
		tblcompany.company_id=tblrecharge.company_id and recharge_date >=? and recharge_date <= ? and ExecuteBy = ? order by tblrecharge.recharge_id limit $start_row,$per_page";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$api));
		return $result;		
		}
	}
}

?>