<?php
class List_recharge_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_recharge()
	{
		$str_query = "select tblrecharge.*,tblcompany.company_name, username,business_name from tblrecharge,tblcompany,tblusers where tblusers.user_id=tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id  order by recharge_id";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_recharge_bydate($fromDate,$ToDate)
	{
		$str_query = "select tblrecharge.*,(select IFNULL(Sum(amount),0)from tblrecharge where tblrecharge.recharge_status = 'Success' and recharge_date >=? and recharge_date <= ? )  as totalRecahrge ,tblcompany.company_name, username,business_name from tblrecharge,tblcompany,tblusers where tblusers.user_id=tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id and recharge_date >=? and recharge_date <= ? order by recharge_id desc";
		$result = $this->db->query($str_query,array($fromDate,$ToDate,$fromDate,$ToDate));
		return $result;
	}
	public function get_recharge_bydate_limited($fromDate,$ToDate,$start_row,$per_page)
	{
		$str_query = "select tblrecharge.*,(select IFNULL(Sum(amount),0)from tblrecharge where tblrecharge.recharge_status = 'Success' and recharge_date >=? and recharge_date <= ? )  as totalRecahrge ,tblcompany.company_name, username,business_name from tblrecharge,tblcompany,tblusers where tblusers.user_id=tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id and recharge_date >=? and recharge_date <= ? order by recharge_id desc limit $start_row,$per_page";
		$result = $this->db->query($str_query,array($fromDate,$ToDate,$fromDate,$ToDate));
		return $result;
	}
	
	public function get_recharge_limited($start_row,$per_page)
	{
		$str_query = "select tblrecharge.*,tblcompany.company_name, username,business_name from tblrecharge,tblcompany,tblusers where tblusers.user_id=tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id order by recharge_id limit $start_row,$per_page";
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
	public function SearchRechargeByWord($searchword)
	{
		$str_query = "select tblrecharge.*,(select IFNULL(Sum(amount),0)from tblrecharge where tblrecharge.recharge_status = 'Success' )  as totalRecahrge ,tblcompany.company_name, username,business_name from tblrecharge,tblcompany,tblusers where tblusers.user_id=tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id and (tblrecharge.recharge_id = '$searchword' or tblrecharge.mobile_no = '$searchword' or tblrecharge.amount = '$searchword') order by recharge_id desc";
		$result = $this->db->query($str_query);
		return $result;
	}
}

?>