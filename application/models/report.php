<?php
class Report extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function getAccountReport($user_id,$from_date,$to_date)
	{
		if($from_date =="" or $to_date== "" or $from_date ==NULL or $to_date== NULL)
		{
			$str_query = "select * from tblewallet where user_id = ?";
			$reslt = $this->db->query($str_query,array($user_id));
			
			return $reslt;
		}
		else
		{
			$str_query = "select * from tblewallet where user_id = ? and date >=? and date <= ?";
			$reslt = $this->db->query($str_query,array($user_id,$from_date,$to_date));
			
			return $reslt;
		}
	}
	public function getAccountEntry($payment_type,$referance_id)
	{
		if($payment_type = "Payment")
		{
			$str_query = "select * from tblewallet where payment_id = ?";
		}
		else if($payment_type = "Recharge")
		{
			$str_query = "select * from tblewallet where recharge_id = ?";
		}
			
			$reslt = $this->db->query($str_query,array($referance_id));
			
			return $reslt;
	}
	public function getMobileReport($user_id,$from_date,$to_date)
	{
		if($from_date =="" or $to_date== "" or $from_date ==NULL or $to_date== NULL)
		{
			$today_date = $this->common->getMySqlDate();
			$str_query = "select * from tblrecharge where user_id = ? and recharge_type='Mobile' and recharge_date =?";
			$reslt = $this->db->query($str_query,array($user_id,$today_date));
			return $reslt;
		}
		else
		{
			$str_query = "select tblrecharge.*,(select company_name from tblcompany where tblcompany.company_id = tblrecharge.company_id) as company_name from tblrecharge where user_id = ? and recharge_type='Mobile' and recharge_date >=? and recharge_date <= ?";
			$reslt = $this->db->query($str_query,array($user_id,$from_date,$to_date));
			return $reslt;
		}
	}
	public function getDthReport($user_id,$from_date,$to_date)
	{
		if($from_date =="" or $to_date== "" or $from_date ==NULL or $to_date== NULL)
		{
			$today_date = $this->common->getMySqlDate();
			$str_query = "select * from tblrecharge where user_id = ? and recharge_type='DTH' and recharge_date =?";
			$reslt = $this->db->query($str_query,array($user_id,$today_date));
			return $reslt;
		}
		else
		{
			$str_query = "select * from tblrecharge where user_id = ? and recharge_type='DTH' and recharge_date >=? and recharge_date <= ?";
			$reslt = $this->db->query($str_query,array($user_id,$from_date,$to_date));
			return $reslt;
		}
	}
	public function getRechargeReport($user_id,$start_date,$end_date,$user_type)
	{
		if($user_id == "ALL")
		{
			$str_query ="select tblrecharge.*,tblcompany.company_name,tblusers.business_name from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id and tblusers.usertype_name = ? and
		tblcompany.company_id=tblrecharge.company_id and recharge_date >=? and recharge_date <= ? order by tblrecharge.recharge_date,tblrecharge.recharge_time";		
		$result = $this->db->query($str_query,array($user_type,$start_date,$end_date));
		return $result;
		}
		$str_query ="select tblrecharge.*,tblcompany.company_name,tblusers.business_name from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id and tblusers.usertype_name = ? and
		tblcompany.company_id=tblrecharge.company_id and recharge_date >=? and recharge_date <= ? and tblrecharge.user_id=? order by tblrecharge.recharge_date,tblrecharge.recharge_time";		
		$result = $this->db->query($str_query,array($user_type,$start_date,$end_date,$user_id));
		return $result;
	}
	public function getRechargeOfNumberOnDate($number, $date, $todate)
	{
		$str_query = "select tblrecharge.*,(select company_name from tblcompany where tblcompany.company_id = tblrecharge.company_id) as company_name,( select business_name from tblusers where tblusers.user_id = tblrecharge.user_id) as bname,(select usertype_name from tblusers where tblusers.user_id = tblrecharge.user_id) as userType from tblrecharge where recharge_date >= ? and recharge_date <= ? and mobile_no like '$number%' ";
		$rslt = $this->db->query($str_query,array($date,$todate));
		return $rslt;
	}
	public function getListOfUsers($user_type)
	{
		$str_query = "select * from tblusers where username_type = ?";
		$rslt = $this->db->query($user_type);
		return $rslt;
	}
	public function AccountLedger_getReport($user_id,$from_date,$to_date)
	{
		$str_query = "select tblewallet.*,(select a.balance  from tblewallet a where a.user_id = '$user_id' and DATE(a.add_date) < '$from_date' order by a.id desc limit 1) as openingBalance ,(select tblpayment.add_date from tblpayment where tblpayment.payment_id = tblewallet.payment_id) as payment_date,(select business_name from tblusers where tblusers.user_id = (select cr_user_id from tblpayment where tblpayment.payment_id = tblewallet.payment_id)) as bname,(select username from tblusers where tblusers.user_id = (select cr_user_id from tblpayment where tblpayment.payment_id = tblewallet.payment_id)) as username,(select usertype_name from tblusers where tblusers.user_id = (select cr_user_id from tblpayment where tblpayment.payment_id = tblewallet.payment_id)) as usertype from tblewallet where user_id = '$user_id' and DATE(add_date) >= '$from_date' and DATE(add_date) <= '$to_date' order by tblewallet.Id desc";
		$rslt = $this->db->query($str_query);
		return $rslt;
	}
	public function AccountLedger_getAllReport($user_id)
	{
		$str_query = "select tblewallet.*,(select business_name from tblusers where tblusers.user_id = tblewallet.user_id) as bname,(select usertype_name from tblusers where tblusers.user_id = tblewallet.user_id) as usertype from tblewallet where user_id = '$user_id'";
		$rslt = $this->db->query($str_query);
		return $rslt;
	}
	public function AccountLedger_getAllReport_limited($user_id,$start_row,$per_page)
	{
		$str_query = "select tblewallet.*,(select tblpayment.add_date from tblpayment where tblpayment.payment_id = tblewallet.payment_id) as payment_date,(select business_name from tblusers where tblusers.user_id = (select cr_user_id from tblpayment where tblpayment.payment_id = tblewallet.payment_id)) as bname,(select username from tblusers where tblusers.user_id = (select cr_user_id from tblpayment where tblpayment.payment_id = tblewallet.payment_id)) as username,(select usertype_name from tblusers where tblusers.user_id = (select cr_user_id from tblpayment where tblpayment.payment_id = tblewallet.payment_id)) as usertype from tblewallet where user_id = '$user_id' order by Id desc limit $start_row,$per_page";
		$rslt = $this->db->query($str_query);
		return $rslt;
	}
	public function getAligibleFlatCommission($from_date,$to_date)
	{
		$str_query = "SELECT tblflatcommission.Id,tblflatcommission.description as description,(select IFNULL(Sum(amount),0)) as totalComm,(select 'falt') as commission_type, (select IFNULL(Sum(depositAmount),0)) as totalDeposit ,(select username from tblusers where tblusers.user_id = tblflatcommission.user_id) as username,(select business_name from tblusers where tblusers.user_id = tblflatcommission.user_id) as business_name,(select mobile_no from tblusers where tblusers.user_id = tblflatcommission.user_id) as mobile_no,(select emailid from tblusers where tblusers.user_id = tblflatcommission.user_id) as emailid,'' as totalRecharge FROM `tblflatcommission` where DATE(add_date) >= '$from_date' and  DATE(add_date) <= '$to_date' and payment_status = 'false' GROUP BY user_id
 UNION
SELECT tblparentcommission.Id,(select '' )as description,(select IFNULL(Sum(amount),0)) as totalComm,(select 'variable') as commission_type,

(select '0') as description,(select username from tblusers where tblusers.user_id = tblparentcommission.user_id) as username,(select business_name from tblusers where tblusers.user_id = tblparentcommission.user_id) as business_name,(select mobile_no from tblusers where tblusers.user_id = tblparentcommission.user_id) as mobile_no,(select emailid from tblusers where tblusers.user_id = tblparentcommission.user_id) as emailid,(select IFNULL(Sum(amount),0) from tblrecharge where tblrecharge.recharge_id in (select recharge_id from tblparentcommission a where a.user_id = tblparentcommission.user_id)) as totalRecharge FROM `tblparentcommission` where tblparentcommission.user_id != 1 and DATE(add_date) >= '$from_date' and  DATE(add_date) <= '$to_date' and payment_status = 'false' and recharge_id in (select recharge_id from tblrecharge where recharge_status = 'Success' and DATE(add_date) >= '$from_date' and  DATE(add_date) <= '$to_date')  group by user_id";
		$rslt = $this->db->query($str_query);
		return $rslt;
	}
}

?>