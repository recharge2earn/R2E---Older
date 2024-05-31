<?php
class Change_security_pin_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function update($oldPwd,$newPwd,$user_id)
	{	
		if($this->CheckOldPassword($oldPwd,$user_id))
		{
			$str_query = "update tblusers set `security_pin`=? where user_id=?";
			$result = $this->db->query($str_query,array($newPwd,$user_id));		
			if($result > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}	
	public function CheckOldPassword($oldPwd,$user_id)
	{
		$str_query = "select * from tblusers where `tblusers`.user_id=? and `tblusers`.security_pin=?";
		$result = $this->db->query($str_query,array($user_id,$oldPwd));		
		if($result->num_rows() == 1)
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