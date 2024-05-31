<?php
class List_contact_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_contactlist()
	{
		$str_query = "select tblbeapartner.* from tblbeapartner order by partnerid";
		$result = $this->db->query($str_query);
		return $result;
	}
}

?>