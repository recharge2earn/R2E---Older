<?php
class Retailer_report1_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_recharge($start_date,$end_date,$user_id)
	{
	$str_query="select * from ((SELECT tblpayment.add_date as DATE_TIME,(select (business_name) from tblusers where tblusers.user_id=cr_user_id) as PAYMENT_TO,tblpayment.payment_id as SS_JV_ID,case tblpayment.payment_type when 'cash' then 'cash' when 'cheque' then (select bank_name from tblbank where bank_id = (SELECT DISTINCT bank_id FROM `tblpaymentrequest` WHERE tblpaymentrequest.bank_id=tblpayment.bank_id and user_id=tblpayment.cr_user_id)) end as TYPE_NAME,CASE WHEN cr_user_id = ? THEN 'CR' ELSE 'DR' END PAYTYPE,CASE WHEN cr_user_id != ? THEN tblpayment.amount ELSE '0' END DR_AMOUNT,CASE WHEN cr_user_id = ? THEN tblpayment.amount ELSE '0' END CR_AMOUNT,tblpayment.remark as REMARK,'' as STATUS FROM tblpayment where (cr_user_id=? or dr_user_id=?) and tblpayment.payment_date>=? and  tblpayment.payment_date <= ?) UNION (SELECT CONCAT(tblrecharge.recharge_date,' ', tblrecharge.recharge_time) as DATE_TIME,tblcompany.company_name as PAYMENT_TO,tblrecharge.recharge_id as SS_JV_ID,'sale' as TYPE_NAME,'DR' as PAYTYPE,tblrecharge.amount as DR_AMOUNT,tblrecharge.commission_amount as CR_AMOUNT,tblrecharge.mobile_no as REMARK,tblrecharge.recharge_status as STATUS FROM `tblrecharge`,tblcompany WHERE tblcompany.company_id = tblrecharge.company_id and tblrecharge.user_id=? and recharge_date>=? and recharge_date<=? order by tblrecharge.recharge_id)) as Test order by STR_TO_DATE(DATE_TIME,'%Y-%m-%d %h:%i:%s %p ') asc,ss_jv_id";
		$result = $this->db->query($str_query,array($user_id,$user_id,$user_id,$user_id,$user_id,$start_date,$end_date,$user_id,$start_date,$end_date));
		return $result;
	}
}

?>