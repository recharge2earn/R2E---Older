<?php
class Commission_rate_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_commission_rate($id)
	{
		$str_query = "SELECT tblcommission.*,tblcompany.company_name FROM `tblcommission`,tblcompany where tblcompany.company_id = tblcommission.company_id and scheme_id ='".$this->session->userdata('scheme_id')."' order by tblcompany.company_name ";
		$result = $this->db->query($str_query,array($id));
		return $result;
	}
}

?>