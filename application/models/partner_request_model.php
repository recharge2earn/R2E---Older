<?php
class Partner_request_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_partner()
	{
		$str_query = "select * from tblbeapartner order by partnerid desc";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_partner_limited($start_row,$per_page)
	{
		$str_query = "select * from tblbeapartner order by partnerid desc limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
}

?>