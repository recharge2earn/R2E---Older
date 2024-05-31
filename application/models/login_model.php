<?php
class Login_model extends CI_Model 
{	
function _construct()
{
      // Call the Model constructor
      parent::_construct();
}
		function check_login($username,$password)
	{
		$str_query = "select  tblusers.*  from tblusers where mobile_no=? and password=?";
		$result = $this->db->query($str_query,array($username,$password));		
		if($result->num_rows() == 1)
		{
			if($result->row(0)->status == '1')
			{
  			$this->session->sess_destroy();
		$result_mobile = $this->db->query('select mobile_no from tblusers where user_id=?',array($result->row(0)->parent_id));
		$result_admin = $this->db->query('select user_id from tblusers where usertype_name="Admin"');
		$mobile_no='';
		if($result_mobile->num_rows() == 1)
		{
			$mobile_no='('.$result_mobile->row(0)->mobile_no.')';
		}	
		if($result->row(0)->usertype_name == "Admin")	
		{
			$data = array(
			'admin_id' => $result->row(0)->user_id,
			'alogged_in' => true,
			'auser_type' => $result->row(0)->usertype_name,
			'abusiness_name' => $result->row(0)->business_name);
		}
		else if($result->row(0)->usertype_name == "APIUSER")
		{
			$data = array(
						'ApiId' => $result->row(0)->user_id,
						'ApiParentId' => $result->row(0)->parent_id,
						'ApiLoggedIn' => true,
						'ApiUserType' => $result->row(0)->usertype_name,
						'ApiBusinessName' => $result->row(0)->business_name,
						'ApiFirstTimeLogin'=>$result->row(0)->first_time_login,
						'ApiSchemeId'=>$result->row(0)->scheme_id,
						'ApiIsAPI' => $result->row(0)->isAPIEnable,
						'AdminId'=>$this->session->userdata("adminid"),
						'Redirect'=>base_url()."api_users/recharge_history",
						);
						$this->session->set_userdata($data);
						redirect($this->session->userdata("Redirect"));
		}
		else
		{
			$data = array(
			'id' => $result->row(0)->user_id,
			'parent_id' => $result->row(0)->parent_id,
			'logged_in' => true,
			'user_type' => $result->row(0)->usertype_name,
			'business_name' => $result->row(0)->business_name,
			'is_first_time'=>$result->row(0)->first_time_login,
			'scheme_id'=>$result->row(0)->scheme_id,
			'isAPI' => $result->row(0)->isAPIEnable,
			'admin_id'=>$result_admin->row(0)->user_id); 
		}

			$this->session->set_userdata($data);
			
		$this->load->library('common');
		$login_date = $this->common->getMySqlDate();
		$result_history = $this->db->query("select * from tbllogin_history where date_login=? and user_id=?",array($login_date,$result->row(0)->user_id));
		if($result_history->num_rows() == 0)
		{
			$ip = $this->common->getRealIpAddr();		
			$login_time = $this->common->getMySqlTime();	
			$this->db->query("insert into tbllogin_history(user_id,date_login,time_login,ip_address) values(?,?,?,?)",array($result->row(0)->user_id,$login_date,$login_time,$ip));
		}
		return $result->row(0)->user_id;			
			}
			else
			{

				return 'Not Active';
			}
		}
		else
		{
			return false;
		}		
	}
	function mobile_no($mobile_no)
	{
		$str_query = "select * from tblusers where mobile_no=? ";
		$result = $this->db->query($str_query,array($mobile_no));						
		if($result->num_rows() == 1)
		{
			return $result->row(0)->mobile_no;
		}
		else
		{
			return false;
		}
	}
	function findMobile($EmailID,$MobileNo)
	{
		$str_query = "select * from tblusers where emailid=? and mobile_no=?";
		$result = $this->db->query($str_query,array($EmailID,$MobileNo));						
		if($result->num_rows() == 1)
		{
			return $result;
		}
		else
		{
			return false;
		}
	}
	function UpdatePassword($password,$mobile_no)
	{
		$str_query = "update tblusers set password=?,first_time_login='0' where mobile_no=? ";
		$result = $this->db->query($str_query,array($password,$mobile_no));						
		return $result;
	}

	function add($emailID,$Name,$Mobile)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$result_scheme = $this->db->query("select scheme_id from tblscheme where scheme_type='Customer'");
		$scheme_id = $result_scheme->row(0)->scheme_id;		
		$str_query = "insert into tblusers(emailid,name_of_free_user,mobile_no,usertype_name,add_date,ipaddress,scheme_id) values(?,?,?,?,?,?,?)";				
		$result = $this->db->query($str_query,array($emailID,$Name,$Mobile,'Customer',$date,$ip,$scheme_id));		
		if($result > 0)
		{						
			$userid_value = $this->db->insert_id();
$this->db->query("INSERT INTO `tblmodule_rights` (`isMobile`,`isDTH`,`user_id`,`add_date`,`ipaddress`) VALUES ('yes','yes','".$userid_value."','".$date."','".$ip."')");						
			$user_id = array('user_id' => $userid_value); 			
			$this->session->set_userdata($user_id);
			return true;
		}
		else
		{
			return false;
		}		
	}
	public function update($username,$pwd,$user_id)
	{
		$str_query = "update tblusers set username=?,password=? where user_id=?";
		$result = $this->db->query($str_query,array($username,$pwd,$user_id));		
		if($result > 0)
		{			
			return true;
		}
		else
		{
			return false;
		}				
	}	
	function getUserType($id)
	{
		$str_query = "select * from tblusers where user_id=?";
		$result = $this->db->query($str_query,array($id));						
		return $result->row(0)->usertype_name;		
	}
	public function find_mobile_exist($mobile)
	{
		$str_query = "select * from tblusers where mobile_no=?";
		$result = $this->db->query($str_query,array($mobile));		
		if($result->num_rows() == 1)
		{			
			return false;
		}
		else
		{
			return true;
		}				
	}	
}

?>