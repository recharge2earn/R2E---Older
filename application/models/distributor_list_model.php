<?php
class Distributor_list_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_dealer()
	{
		$str_query = "select tblusers.*, (select IFNULL(sum(amount),0) - (select IFNULL(sum(amount),0) from tblpayment where dr_user_id=tblusers.user_id) - (select IFNULL(sum(amount),0) as 'RechargeAmount' from tblrecharge where user_id=tblusers.user_id and (recharge_status='Success' or recharge_status='Pending'))  +(select IFNULL(Sum(tblparentcommission.amount), 0) from tblparentcommission JOIN tblrecharge on (tblparentcommission.recharge_id = tblrecharge.recharge_id) where tblrecharge.recharge_status = 'Success' and tblparentcommission.user_id = tblusers.user_id)+ (select IFNULL(SUM(commission_amount),0) AS commission_amount from tblrecharge where user_id=tblusers.user_id and (recharge_status='Success' or recharge_status='Pending')) as Balance from tblpayment where cr_user_id=tblusers.user_id) as balance,tblusers.business_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name,tblusers.mobile_no,tblusers.emailid from tblusers where tblusers.usertype_name='Distributor' order by username";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function Search($SearchBy,$SearchWord)
	{
		if($SearchBy == "Mobile")
		{
		$str_query = "select tblusers.*, (select IFNULL(sum(amount),0) - (select IFNULL(sum(amount),0) from tblpayment where dr_user_id=tblusers.user_id) - (select IFNULL(sum(amount),0) as 'RechargeAmount' from tblrecharge where user_id=tblusers.user_id and (recharge_status='Success' or recharge_status='Pending')) + (select IFNULL(SUM(distributer_commission_amount),0) AS dis_commission_amount from tblrecharge where tblrecharge.user_id in (select  unduser.user_id FROM `tblusers` unduser WHERE unduser.parent_id=tblusers.user_id) and (recharge_status='Success' or recharge_status='Pending')) + (select IFNULL(SUM(commission_amount),0) AS commission_amount from tblrecharge where user_id=tblusers.user_id and (recharge_status='Success' or recharge_status='Pending')) as Balance from tblpayment where cr_user_id=tblusers.user_id) as balance,tblusers.business_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name,tblusers.mobile_no,tblusers.emailid from tblusers where tblusers.usertype_name='Distributor' and mobile_no like '".$SearchWord."%' order by username";
		$result = $this->db->query($str_query);
		return $result;	
		}		
		if($SearchBy == "Dealer")
		{
		$str_query = "select tblusers.*, (select IFNULL(sum(amount),0) - (select IFNULL(sum(amount),0) from tblpayment where dr_user_id=tblusers.user_id) - (select IFNULL(sum(amount),0) as 'RechargeAmount' from tblrecharge where user_id=tblusers.user_id and (recharge_status='Success' or recharge_status='Pending')) + (select IFNULL(SUM(distributer_commission_amount),0) AS dis_commission_amount from tblrecharge where tblrecharge.user_id in (select  unduser.user_id FROM `tblusers` unduser WHERE unduser.parent_id=tblusers.user_id) and (recharge_status='Success' or recharge_status='Pending')) + (select IFNULL(SUM(commission_amount),0) AS commission_amount from tblrecharge where user_id=tblusers.user_id and (recharge_status='Success' or recharge_status='Pending')) as Balance from tblpayment where cr_user_id=tblusers.user_id) as balance,tblusers.business_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name,tblusers.mobile_no,tblusers.emailid from tblusers where tblusers.usertype_name='Distributor' and business_name like '".$SearchWord."%' order by username";
		$result = $this->db->query($str_query);
		return $result;	
		}		
		if($SearchBy == "UserID")
		{
		$str_query = "select tblusers.*, (select IFNULL(sum(amount),0) - (select IFNULL(sum(amount),0) from tblpayment where dr_user_id=tblusers.user_id) - (select IFNULL(sum(amount),0) as 'RechargeAmount' from tblrecharge where user_id=tblusers.user_id and (recharge_status='Success' or recharge_status='Pending')) + (select IFNULL(SUM(distributer_commission_amount),0) AS dis_commission_amount from tblrecharge where tblrecharge.user_id in (select  unduser.user_id FROM `tblusers` unduser WHERE unduser.parent_id=tblusers.user_id) and (recharge_status='Success' or recharge_status='Pending')) + (select IFNULL(SUM(commission_amount),0) AS commission_amount from tblrecharge where user_id=tblusers.user_id and (recharge_status='Success' or recharge_status='Pending')) as Balance from tblpayment where cr_user_id=tblusers.user_id) as balance,tblusers.business_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name,tblusers.mobile_no,tblusers.emailid from tblusers where tblusers.usertype_name='Distributor' and username like '".$SearchWord."%' order by username";
		$result = $this->db->query($str_query);
		return $result;	
		}				
	}
	public function get_dealer_limited($start_row,$per_page)
	{
		$str_query = "select tblusers.*, (select IFNULL(sum(amount),0) - (select IFNULL(sum(amount),0) from tblpayment where dr_user_id=tblusers.user_id) - (select IFNULL(sum(amount),0) as 'RechargeAmount' from tblrecharge where user_id=tblusers.user_id and (recharge_status='Success' or recharge_status='Pending')) + (select IFNULL(Sum(tblparentcommission.amount),0) from tblparentcommission JOIN tblrecharge on (tblparentcommission.recharge_id = tblrecharge.recharge_id) where tblrecharge.recharge_status = 'Success' and tblparentcommission.user_id = tblusers.user_id) + (select IFNULL(SUM(commission_amount),0) AS commission_amount from tblrecharge where user_id=tblusers.user_id and (recharge_status='Success' or recharge_status='Pending')) as Balance from tblpayment where cr_user_id=tblusers.user_id) as balance,tblusers.business_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name,tblusers.mobile_no,tblusers.emailid from tblusers where tblusers.usertype_name='Distributor' order by username limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
	public function updateAction($status,$user_id)
	{
		$str_query = "update tblusers set status=? where user_id=?";
		$result = $this->db->query($str_query,array($status,$user_id));
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