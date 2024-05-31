<?php
class User_scheme_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function update_scheme($user_id,$scheme_id)
	{
		$str_query = "update tblusers set scheme_id=? where user_id=?";
		$result = $this->db->query($str_query,array($scheme_id,$user_id));
		return true;
	}
	public function get_commission_by_user($user_id)
	{
		$str_query = "SELECT tblcommission.*,tblcompany.company_name FROM `tblcommission`,`tblcompany` where `tblcommission`.company_id = `tblcompany`.company_id and  tblcommission.scheme_id=(select scheme_id from tblusers where user_id = ?)";
		$result = $this->db->query($str_query,array($user_id));
		return $result;
	}
	public function get_commission_by_scheme($scheme_id)
	{
		$str_query = "SELECT tblcommission.*,tblcompany.company_name FROM `tblcommission`,`tblcompany` where `tblcommission`.company_id = `tblcompany`.company_id and  tblcommission.scheme_id=?";
		$result = $this->db->query($str_query,array($scheme_id));
		return $result;
	}
}

?>