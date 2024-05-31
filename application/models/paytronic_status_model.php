
<?php
class Paytronic_status_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_payworldInfo($Apiname)
	{
		$str_query = "select * from  tblapi where api_name=?";
		$result = $this->db->query($str_query,array($Apiname));
		return $result;
	}	
}

?>