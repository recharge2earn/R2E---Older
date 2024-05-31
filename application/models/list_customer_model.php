<?php
class List_customer_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_customer()
	{
		$str_query = "select * from tblusers where usertype_name='Customer' order by name_of_free_user";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function Search($SearchBy,$SearchWord)
	{				
		if($SearchBy == "Mobile")
		{
		$str_query = "select * from tblusers where usertype_name='Customer' and mobile_no like '".$SearchWord."%' order by name_of_free_user";
		$result = $this->db->query($str_query);
		return $result;	
		}		
		if($SearchBy == "Customer")
		{
		$str_query = "select * from tblusers where usertype_name='Customer' and name_of_free_user like '".$SearchWord."%' order by name_of_free_user";
		$result = $this->db->query($str_query);
		return $result;	
		}		
		if($SearchBy == "UserName")
		{
		$str_query = "select * from tblusers where usertype_name='Customer' and username like '".$SearchWord."%' order by name_of_free_user";
		$result = $this->db->query($str_query);
		return $result;	
		}				
	}
	public function get_customer_limited($start_row,$per_page)
	{
		$str_query = "select * from tblusers where usertype_name='Customer' order by name_of_free_user limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
	public function updateAction($status,$user_id)
	{
		$str_query = "update tblusers set status=? where user_id=?";
		$result = $this->db->query($str_query,array($status,$user_id));
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