<?php
class Parent_commission_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_commission($start_date,$end_date,$user_id,$Type)
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
	public function getListOfChield($user_id)
	{
		$str_query = "select * from tblusers where parent_id = ?";
		$rslt = $this->db->query($str_query,array($user_id));
		
		return $rslt; 
	}
	public function getParentCommission($user_id,$start_date,$end_date)
	{
		$str_query = "SELECT tblparentcommission.*,tblrecharge.ExecuteBy ,tblrecharge.totalCommissionPer,  (select tblcompany.company_name from tblcompany where tblcompany.company_id = tblrecharge.company_id and tblrecharge.recharge_id = tblparentcommission.recharge_id) as company_name,tblrecharge.amount as recAmount,tblrecharge.mobile_no,tblrecharge.recharge_id,tblrecharge.recharge_status,tblrecharge.add_date,(select tblusers.business_name from tblusers where tblusers.user_id = tblrecharge.user_id) as recharge_by,(select tblusers.username from tblusers where tblusers.user_id = tblrecharge.user_id) as recharge_by_userid,(select tblusers.usertype_name from tblusers where tblusers.user_id = tblrecharge.user_id) as usertype FROM tblparentcommission
JOIN tblrecharge ON (tblparentcommission.recharge_id = tblrecharge.recharge_id) 
where tblrecharge.recharge_status='Success' and tblparentcommission.user_id=? and tblrecharge.recharge_date >= ? and tblrecharge.recharge_date <= ?  order by Id desc";
$rlst = $this->db->query($str_query,array($user_id,$start_date,$end_date));

return $rlst;
	}
}

?>