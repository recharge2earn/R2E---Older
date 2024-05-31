<?php
class Balance_transfer_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_balance_transfer($id)
	{
		$str_query = "SELECT tblpay.remark,tblpay.payment_id,tblpay.amount,concat(tblpay.payment_date,' ',tblpay.payment_time) as paydate,(select business_name from tblusers where user_id = tblpay.dr_user_id) as DebitUser,(select business_name from tblusers where user_id = tblpay.cr_user_id) as CreditUser,case cr_user_id when ? then 'CR' ELSE 'DR' end as Typecrdr FROM tblpayment tblpay where cr_user_id=? or dr_user_id=? order by tblpay.payment_id";
		$result = $this->db->query($str_query,array($id,$id,$id));
		return $result;
	}
}

?>