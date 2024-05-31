<?php
class Api_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($ApiName,$UserName,$Password)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$str_query = "insert into tblapi(api_name,username,password,add_date,ipaddress) values(?,?,?,?,?)";
		$result = $this->db->query($str_query,array($ApiName,$UserName,$Password,$date,$ip));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public	function delete($apiID)
	{	
		$str_query = "delete from tblapi where api_id=?";
		$result = $this->db->query($str_query,array($apiID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	
	public	function update($apiID,$ApiName,$UserName,$Password,$ip)
	{	
		$str_query = "update tblapi set api_name=?,username=?,password=?,static_ip = ? where api_id=?";
		$result = $this->db->query($str_query,array($ApiName,$UserName,$Password,$ip,$apiID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public function get_api()
	{
		$str_query = "select * from  tblapi order by api_name";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_api_limited($start_row,$per_page)
	{
		$str_query = "select * from  tblapi order by api_name limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function GetAPIInfo($company_id)
	{		
	$str_query = "select * from tblapi where tblapi.api_id = (select api_id from tblcompany where tblcompany.company_id = '$company_id')";
	$result = $this->db->query($str_query);		
	return $result;	
	}
	public function GetAPIInfoByAPIName($api_name)
	{		
	$str_query = "select * from tblapi where api_name = '$api_name'";
	$result = $this->db->query($str_query);		
	return $result;	
	}
}

?>