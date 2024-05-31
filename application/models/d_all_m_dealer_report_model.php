<?php
class D_all_m_dealer_report_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_recharge($start_date,$end_date,$user_id)
	{
		if($user_id == "ALL")
		{
			$str_query ="select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id and tblusers.usertype_name = 'Distributor' and
		tblcompany.company_id=tblrecharge.company_id and recharge_date >=? and recharge_date <= ?  and parent_id=? order by tblrecharge.recharge_date ";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$this->session->userdata('id')));
		return $result;
		}
		$str_query ="select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id and tblusers.usertype_name = 'Distributor' and
		tblcompany.company_id=tblrecharge.company_id and recharge_date >=? and recharge_date <= ? and tblrecharge.user_id=? order by tblrecharge.recharge_date";		
		$result = $this->db->query($str_query,array($start_date,$end_date,$user_id));
		return $result;
	}
}

?>