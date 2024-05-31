<?php
class Franchise_report_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_recharge($start_date,$end_date,$user_id,$service_id)
	{
		if($service_id == "ALL" && $user_id == "ALL")
		{
		$str_query ="select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany,tblusers where 
		tblusers.user_id = tblrecharge.user_id and tblusers.usertype_name = 'Franchise' and
		tblcompany.company_id=tblrecharge.company_id and recharge_date >=? and recharge_date <= ? order by tblrecharge.recharge_date";		
		$result = $this->db->query($str_query,array($start_date,$end_date));
		return $result;
		}
		if($user_id == "ALL")
		{
		$str_query ="select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id and tblusers.usertype_name = 'Franchise' and
		tblcompany.company_id=tblrecharge.company_id and recharge_date >=? and recharge_date <= ? and tblrecharge.service_id=? order by tblrecharge.recharge_date";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$service_id));
		return $result;
		}		
		if($service_id == "ALL")
		{
		$str_query ="select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id and tblusers.usertype_name = 'Franchise' and
		tblcompany.company_id=tblrecharge.company_id and recharge_date >=? and recharge_date <= ? and tblrecharge.user_id=? order by tblrecharge.recharge_date";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$user_id));
		return $result;
		}				
		$str_query ="select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany,tblusers where
				tblusers.user_id = tblrecharge.user_id and tblusers.usertype_name = 'Franchise' and
		tblcompany.company_id=tblrecharge.company_id and recharge_date >=? and recharge_date <= ? and tblrecharge.user_id=? and tblrecharge.service_id=? order by tblrecharge.recharge_date";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$user_id,$service_id));
		return $result;
	}
}

?>