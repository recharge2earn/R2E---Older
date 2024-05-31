<?php
class Search_customer_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}	
	public function Search($mobile_no)
	{					
		$str_query = "select * from tblusers where usertype_name='Customer' and mobile_no = ?";
		$result = $this->db->query($str_query,array($mobile_no));
		return $result;	
	}	
}

?>