<?php
class Reseller_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_retailer()
	{
		$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,tblusers.business_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name,tblusers.mobile_no,tblusers.emailid from tblusers where tblusers.parent_id='1' order by username";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function Search($SearchBy,$SearchWord)
	{
		if($SearchBy == "Mobile")
		{
		$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,tblusers.business_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name,tblusers.mobile_no,tblusers.emailid from tblusers where tblusers.usertype_name='Agent' and mobile_no like '".$SearchWord."%' order by username";
		$result = $this->db->query($str_query);
		return $result;	
		}		
		if($SearchBy == "Agent")
		{
		$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,tblusers.business_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name,tblusers.mobile_no,tblusers.emailid from tblusers where tblusers.usertype_name='Agent' and business_name like '".$SearchWord."%' order by username";
		$result = $this->db->query($str_query);
		return $result;	
		}		
		if($SearchBy == "UserID")
		{
		$str_query = "select tblusers.*, (select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,(select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,tblusers.business_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name,tblusers.mobile_no,tblusers.emailid from tblusers where tblusers.usertype_name='Agent' and username like '".$SearchWord."%' order by username";
		$result = $this->db->query($str_query);
		return $result;	
		}				
	}
	public function get_retailer_limited($start_row,$per_page)
	{
		$str_query = "select tblusers.*,tblusers.business_name,(select business_name from tblusers a where a.user_id = tblusers.parent_id) as parent_name,(select city_name from tblcity where tblcity.city_id=tblusers.city_id) as city_name,(select state_name from tblstate where tblstate.state_id 	=tblusers.state_id) as state_name,tblusers.mobile_no,tblusers.emailid from tblusers where tblusers.parent_id='1' order by username limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
	public function updateAction($status,$user_id)
	{
		$userinfo = $this->Userinfo_methods->getUserInfo($user_id);
		$password = $this->common->GetPassword();
		$str_query = "update tblusers set status=?,password=? where user_id=?";
		$result = $this->db->query($str_query,array($status,$password,$user_id));
		if($result > 0)
		{
			if($status == 1)
			{
				$smsMessage = 
'Your account has been successfully Activated.
User Name : '.$userinfo->row(0)->username.'
Password : '.$password.'
';
					$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$userinfo->row(0)->mobile_no,$smsMessage);	
			}
			return true;
		}
		else
		{
			return false;
		}		
	}
	public function updateUsertype($usertype_name,$user_id)
	{
		$str_query = "update tblusers set usertype_name=? where user_id=?";
		$result = $this->db->query($str_query,array($usertype_name,$user_id));
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