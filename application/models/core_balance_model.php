<?php
class Core_balance_model extends CI_Model 
{	
	function _construct()
	{
		 parent::_construct();
	}
	public function get_Info($Apiname)
	{
		$str_query = "select * from  tblapi where api_name=?";
		$result = $this->db->query($str_query,array($Apiname));
		return $result;
	}	
}

?>