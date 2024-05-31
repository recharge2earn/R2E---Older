<?php
class Commission_received_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_commission_received($id)
	{
		$str_query = "SELECT tblrecharge.*,tblcompany.company_name FROM `tblrecharge`,tblcompany where tblcompany.company_id = tblrecharge.company_id and tblrecharge.user_id=? and recharge_status='Success' order by tblrecharge.recharge_date";
		$result = $this->db->query($str_query,array($id));
		return $result;
	}
	public function get_commission_received_bydate($id,$date)
	{
		if($date == '')
		{
			$this->load->library('common');
					$date = $this->common->getMySqlDate();
						$str_query = "SELECT tblrecharge.*,tblcompany.company_name FROM `tblrecharge`,tblcompany where tblcompany.company_id = tblrecharge.company_id and tblrecharge.user_id=? and tblrecharge.recharge_date=? and recharge_status='Success' order by tblrecharge.recharge_date";
		$result = $this->db->query($str_query,array($id,$date));
		return $result;
		}
		else
		{
			$str_query = "SELECT tblrecharge.*,tblcompany.company_name FROM `tblrecharge`,tblcompany where tblcompany.company_id = tblrecharge.company_id and tblrecharge.user_id=? and tblrecharge.recharge_date=? and recharge_status='Success' order by tblrecharge.recharge_date";
		$result = $this->db->query($str_query,array($id,$date));
		return $result;	
		}			
	}
}

?>