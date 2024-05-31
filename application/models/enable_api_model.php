<?php
class Enable_api_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_distributer()
	{
		$str_query = "select * from tblusers where usertype_name='SuperDealer' order by business_name";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function Search($SearchBy,$SearchWord)
	{
		if($SearchBy == "Mobile")
		{
		$str_query = "select * from tblusers where usertype_name='SuperDealer' and mobile_no like '".$SearchWord."%' order by business_name";
		$result = $this->db->query($str_query);
		return $result;	
		}		
		if($SearchBy == "MasterDealer")
		{
		$str_query = "select * from tblusers where usertype_name='SuperDealer' and business_name like '".$SearchWord."%' order by business_name";
		$result = $this->db->query($str_query);
		return $result;	
		}		
		if($SearchBy == "UserName")
		{
		$str_query = "select * from tblusers where usertype_name='SuperDealer' and username like '".$SearchWord."%' order by business_name";
		$result = $this->db->query($str_query);
		return $result;	
		}				
	}
	public function get_distributer_limited($start_row,$per_page)
	{
		$str_query = "select * from tblusers where usertype_name='SuperDealer' order by business_name limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
	public function updateAction($status,$api_execution_url,$user_id)
	{
		$str_query = "update tblusers set isAPIEnable=?,api_execution_url=? where user_id=?";
		$result = $this->db->query($str_query,array($status,$api_execution_url,$user_id));
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
}

?>