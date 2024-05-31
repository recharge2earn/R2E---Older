<?php
class Login_history_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_login_history($user_id)
	{
		$str_query = "select business_name as name,tbllogin_history.*  from tblusers,tbllogin_history where tbllogin_history.user_id = tblusers.user_id and tbllogin_history.user_id=? order by tbllogin_history.date_login";
		$result = $this->db->query($str_query,array($user_id));
		return $result;
	}
	public function Search($SearchBy,$SearchWord,$from_date,$to_date)
	{				
		if($SearchBy == "Mobile")
		{
		$str_query = "select business_name as name,tbllogin_history.*  from tblusers,tbllogin_history where tbllogin_history.user_id = tblusers.user_id and mobile_no = '".$SearchWord."' and tbllogin_history.date_login>=? and tbllogin_history.date_login<=? order by tbllogin_history.date_login";
		$result = $this->db->query($str_query,array($from_date,$to_date));
		return $result;	
		}		
		if($SearchBy == "UserName")
		{
		$str_query = "select business_name as name,tbllogin_history.*  from tblusers,tbllogin_history where tbllogin_history.user_id = tblusers.user_id and username = '".$SearchWord."' and tbllogin_history.date_login>=? and tbllogin_history.date_login<=? order by tbllogin_history.date_login";
		$result = $this->db->query($str_query,array($from_date,$to_date));
		return $result;	
		}				
	}
}

?>