<?php
class D_list_dealer_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_retailer($user_id)
	{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where parent_id=? and usertype_name='Distributor' order by user_id";
		$result = $this->db->query($str_query,array($user_id));
		return $result;
	}
	public function get_retailer_limited($start_row,$per_page,$user_id)
	{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where parent_id=? and usertype_name='Distributor' order by business_name limit $start_row,$per_page";
		$result = $this->db->query($str_query, array($user_id));
		return $result;
	}	
	
	public function get_agent($user_id)
	{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where parent_id=? and usertype_name='Agent' order by user_id";
		$result = $this->db->query($str_query,array($user_id));
		return $result;
	}
	public function get_agent_limited($start_row,$per_page,$user_id)
	{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where parent_id=? and usertype_name='Agent' order by user_id limit $start_row,$per_page";
		$result = $this->db->query($str_query, array($user_id));
		return $result;
	}	
	
	
	
	public function Search($SearchBy,$SearchWord)
	{		
		if($SearchBy == "Mobile")
		{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='Distributor' and parent_id = ? and mobile_no like '".$SearchWord."%' order by business_name";
		$result = $this->db->query($str_query,array($this->session->userdata('id')));
		return $result;	
		}		
		if($SearchBy == "Distributor")
		{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='Distributor' and parent_id = ? and business_name like '".$SearchWord."%' order by business_name";
		$result = $this->db->query($str_query,array($this->session->userdata('id')));
		return $result;	
		}		
		if($SearchBy == "UserName")
		{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='Distributor' and parent_id = ? and username like '".$SearchWord."%' order by business_name";
		$result = $this->db->query($str_query,array($this->session->userdata('id')));
		return $result;	
		}						
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