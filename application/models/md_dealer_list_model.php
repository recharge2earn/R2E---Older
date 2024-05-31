<?php
class Md_dealer_list_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_dealer()
	{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='MasterDealer' order by username";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function Search($SearchBy,$SearchWord)
	{
		if($SearchBy == "Mobile")
		{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='MasterDealer' and mobile_no like '".$SearchWord."%' order by username";
		$result = $this->db->query($str_query);
		return $result;	
		}		
		if($SearchBy == "MasterDealer")
		{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='MasterDealer' and business_name like '".$SearchWord."%' order by username ";
		$result = $this->db->query($str_query);
		return $result;	
		}		
		if($SearchBy == "UserID")
		{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='MasterDealer' and username like '".$SearchWord."%' order by username";
		$result = $this->db->query($str_query);
		return $result;	
		}				
	}
	public function get_dealer_limited($start_row,$per_page)
	{
		$str_query = "select tblusers.*,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='MasterDealer' order by username limit $start_row,$per_page";
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
	public function getMasterdealerFiltered($user_type,$search_type,$searchWord)
	{
		if($search_type == "distributorcode")
		{
			$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='$user_type' and username like '".$searchWord."%' order by username";
		$result = $this->db->query($str_query);
		return $result;	
		}
		if($search_type == "name")
		{
			$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='$user_type' and business_name like '%".$searchWord."%' order by username ";
		$result = $this->db->query($str_query);
		return $result;	
		}
		if($search_type == "ParentName")
		{
			$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='$user_type' and parent_id in (select user_id from tblusers where business_name like '%".$searchWord."%') order by username ";
		$result = $this->db->query($str_query);
		return $result;	
		}
		if($search_type == "Status")
		{
			$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id =tblusers.state_id) as state_name  from tblusers where usertype_name='$user_type' and status =$searchWord order by username";
		$result = $this->db->query($str_query);
		return $result;	
		}
		if($search_type == "Mobile")
		{
			$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='$user_type' and mobile_no like '".$searchWord."%' order by username";
		$result = $this->db->query($str_query);
		return $result;	
		}
		if($search_type == "Email")
		{
			$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='$user_type' and emailid like '".$searchWord."%' order by username ";
		$result = $this->db->query($str_query);
		return $result;	
		}
		if($search_type == "City")
		{
			$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,(select city_name from tblcity where tblcity.city_id = tblusers.city_id) as city_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='$user_type' and city_id in (select city_id from tblcity where city_name like '".$searchWord."%') order by username ";
		$result = $this->db->query($str_query);
		return $result;	
		}
		if($search_type == "state")
		{
			$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,(select city_name from tblcity where tblcity.city_id = tblusers.city_id) as city_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where usertype_name='$user_type' and state_id = '$searchWord' order by username ";
		$result = $this->db->query($str_query);
		return $result;	
		}
		if($search_type == "balance")
		{
		}
	}
	public function getAgentOfSistributerFiltered($parent_id,$user_type,$search_type,$searchWord)
	{
		if($search_type == "distributorcode")
		{
			$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where parent_id = '$parent_id' and  usertype_name='$user_type' and username like '".$searchWord."%' order by username";
		$result = $this->db->query($str_query);
		return $result;	
		}
		if($search_type == "name")
		{
			$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where parent_id = '$parent_id' and usertype_name='$user_type' and business_name like '%".$searchWord."%' order by username ";
		$result = $this->db->query($str_query);
		return $result;	
		}
		
		if($search_type == "Mobile")
		{
			$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where parent_id = '$parent_id' and usertype_name='$user_type' and mobile_no like '".$searchWord."%' order by username";
		$result = $this->db->query($str_query);
		return $result;	
		}
		if($search_type == "Email")
		{
			$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where parent_id = '$parent_id' and usertype_name='$user_type' and emailid like '".$searchWord."%' order by username ";
		$result = $this->db->query($str_query);
		return $result;	
		}
		if($search_type == "City")
		{
			$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,(select city_name from tblcity where tblcity.city_id = tblusers.city_id) as city_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where parent_id = '$parent_id' and usertype_name='$user_type' and city_id in (select city_id from tblcity where city_name like '".$searchWord."%') order by username ";
		$result = $this->db->query($str_query);
		return $result;	
		}
		if($search_type == "state")
		{
			$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,(select city_name from tblcity where tblcity.city_id = tblusers.city_id) as city_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name  from tblusers where parent_id = '$parent_id' and usertype_name='$user_type' and state_id = '$searchWord' order by username ";
		$result = $this->db->query($str_query);
		return $result;	
		}
		if($search_type == "balance")
		{
		}
	}
}

?>