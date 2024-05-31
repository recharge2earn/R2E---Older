<?php
class Retailer_list_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_retailer()
	{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='Retailer' order by business_name";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function Search($SearchBy,$SearchWord)
	{
		if($SearchBy == "Mobile")
		{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='Retailer' and mobile_no like '".$SearchWord."%' order by business_name";
		$result = $this->db->query($str_query);
		return $result;	
		}		
		if($SearchBy == "Retailer")
		{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='Retailer' and business_name like '".$SearchWord."%' order by business_name ";
		$result = $this->db->query($str_query);
		return $result;	
		}		
		if($SearchBy == "UserID")
		{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='Retailer' and username like '".$SearchWord."%' order by business_name";
		$result = $this->db->query($str_query);
		return $result;	
		}				
	}
	public function get_retailer_limited($start_row,$per_page)
	{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='Retailer' order by business_name limit $start_row,$per_page";
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