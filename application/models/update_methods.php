<?php
class Update_methods extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	
	public function updatePassword($user_id,$password)
	{
		$str_query ="update tblusers set password = ? where user_id = ?";
		$rlst = $this->db->query($str_query,array($password,$user_id));
		return true;
	}
}

?>