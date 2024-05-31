<?php
class Getresponse_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function updateStatus($TransactionID,$RefNo,$Mobile,$Amount,$Status)
	{
		$str_query = "select * from tblrecharge where mobile_no=? and amount=? and recharge_status='Pending'";
		$result = $this->db->query($str_query);		
		if($Status == 'SUCCESS')
		{
		$str_update="update tblrecharge set transaction_id	=?,aktel_id=?,recharge_status=? where recharge_id=?";
		$result_update = $this->db->query($str_update,array($TransactionID,$RefNo,'Success',$result->row(0)->recharge_id));
		}
		if($Status == 'FAILURE')
		{
		$str_update="update tblrecharge set transaction_id	=?,aktel_id=?,recharge_status=? where recharge_id=?";
		$result_update = $this->db->query($str_update,array($TransactionID,$RefNo,'Failure',$result->row(0)->recharge_id));			
		}
	}
}

?>