<?php
class Access_rights_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add_update($user_id,$isMobile,$isDTH,$isAIR,$module_id)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$str_query = "update tblmodule_rights set user_id=?,isDTH=?,isAIR=?,isMobile=?,edit_date=?,ipaddress=? where module_id=?";
		$result = $this->db->query($str_query,array($user_id,$isDTH,$isAIR,$isMobile,$date,$ip,$module_id));		
		if($result > 0){return true;}
		else{return false;}							
	}	
	public function Search($SearchWord)
	{
		
		$str_query = "select business_name as name,tblmodule_rights.* from  tblmodule_rights,tblusers where tblusers.user_id = tblmodule_rights.user_id and (tblusers.mobile_no like '".$SearchWord."%' or tblusers.username like '".$SearchWord."%' or tblusers.usertype_name like '".$SearchWord."%' or tblusers.business_name like '".$SearchWord."%') order by name";
		$result = $this->db->query($str_query);
		return $result;	
					
	}	
	public function is_access_rights($user_id,$module_name)
	{
		$str_query = "select tblmodule_rights.* from  tblmodule_rights where user_id =? and module_name=?";
		$result = $this->db->query($str_query,array($user_id,$module_name));
		if($result->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function get_access_rights_details($user_id,$module_name)
	{
		$str_query = "select tblmodule_rights.* from  tblmodule_rights where user_id =? and module_name=?";
		$result = $this->db->query($str_query,array($user_id,$module_name));
		return $result;
//		select 
//    (SELECT module_name FROM tblmodule_rights WHERE module_name='DTH' AND user_id = T1.user_id ) AS A,
//    (SELECT module_name FROM tblmodule_rights WHERE module_name='Mobile' AND user_id = T1.user_id ) AS B,
//    (SELECT module_name FROM tblmodule_rights WHERE module_name='Account' AND user_id = T1.user_id ) AS C
//FROM tblmodule_rights AS T1,tblusers TU
//where  T1.user_id = TU.user_id
//GROUP BY T1.module_name

		
	}
	public function get_access_rights()
	{
		$str_query = "select (CASE usertype_name WHEN 'Customer' THEN business_name ELSE business_name END) as name,tblmodule_rights.* from  tblmodule_rights,tblusers where tblusers.user_id = tblmodule_rights.user_id";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_username($usertype)
	{
		if($usertype == "Distributer")
		{
		$str_query = "select user_id,business_name as name from tblusers where usertype_name = ? order by business_name";
		}
		if($usertype == "Retailer")
		{
		$str_query = "select user_id,business_name as name from tblusers where usertype_name = ? order by business_name";
		}
		if($usertype == "Customer")
		{
		$str_query = "select user_id,business_name as name from tblusers where usertype_name = ? order by business_name";
		}		
		$result = $this->db->query($str_query,array($usertype));
		return $result;
	}	
	public function get_access_rights_limited($start_row,$per_page)
	{
		$str_query = "select (CASE usertype_name WHEN 'Customer' THEN business_name ELSE business_name END) as name,tblmodule_rights.* from  tblmodule_rights,tblusers where tblusers.user_id = tblmodule_rights.user_id limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}
}

?>