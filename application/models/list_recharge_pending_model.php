<?php
class List_recharge_pending_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_recharge()
	{
		$str_query = "select tblrecharge.*,(select business_name from tblusers where tblusers.user_id = tblrecharge.user_id) as name,(select company_name from tblcompany where tblcompany.company_id = tblrecharge.company_id) as company_name from tblrecharge where recharge_status='Pending' or recharge_status='' order by recharge_id desc";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_recharge_bydate($date)
	{
		$str_query = "select tblrecharge.*,tblcompany.company_name, business_name as name from tblrecharge,tblcompany,tblusers where tblusers.user_id=tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id and recharge_date=? and  recharge_status='Pending' order by recharge_date";
		$result = $this->db->query($str_query,array($date));
		return $result;
	}
	
	public function get_recharge_limited($start_row,$per_page)
	{
		$str_query = "select tblrecharge.*,tblcompany.company_name, business_name as name from tblrecharge,tblcompany,tblusers where tblusers.user_id=tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id and recharge_status='Pending' order by recharge_date limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
	public function updateAction($status,$recharge_id)
	{
		$str_query = "update tblrecharge set recharge_status=? where recharge_id=?";
		$result = $this->db->query($str_query,array($status,$recharge_id));
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
}

?>