<?php
class Common_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_banklist()
	{
		$str_query = "select tbluser_bank.*,tblbank.bank_name from tbluser_bank,tblbank where tbluser_bank.user_id=? and tblbank.bank_id=tbluser_bank.bank_id order by tblbank.bank_name";
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'Admin')
		{
		$result = $this->db->query($str_query,array($this->session->userdata('id')));		
		}
		else if($user_type == 'Distributer')
		{
		$result = $this->db->query($str_query,array('7'));		
		}
		else if($user_type == 'Customer')
		{
		$result = $this->db->query($str_query,array('7'));		
		}
		else if($user_type == 'Retailer')
		{
		$result = $this->db->query($str_query,array('7'));		
		}
		$data ='';
		for($i=0; $i<$result->num_rows(); $i++)
		{
			$data .= "<option branch_name='".$result->row($i)->branch_name."' ifsc_code='".$result->row($i)->ifsc_code."' account_no='".$result->row($i)->account_number."' value='".$result->row($i)->bank_id."'>".$result->row($i)->bank_name."</option>";
		}
		return $data; 
	}
	public function getSelectedSmsApi()
	{
		//$rslt = $this->db->query("select * from common where param = 'smsapi'");
		return 0;
	}
}

?>