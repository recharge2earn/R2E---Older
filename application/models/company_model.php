<?php
class Company_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($company_name,$service_id,$provider,$payworld_provider,$cyberplate_provider,$long_code_format,$long_code_no,$logo_path,$productName)
	{
		$this->load->library('common');
		$ipaddress = $this->common->getRealIpAddr();
		$add_date = $this->common->getDate();
		$str_query = "insert into tblcompany(company_name,service_id,provider,marsprovider,RecDuniaProvider,long_code_format,long_code_no,logo_path,add_date,ipaddress,product_name) values(?,?,?,?,?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($company_name,$service_id,$provider,$payworld_provider,$cyberplate_provider,$long_code_format,$long_code_no,$logo_path,$add_date,$ipaddress,$productName));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	public	function delete($companyID)
	{	
		$str_query = "delete from tblcompany where company_id=?";
		$result = $this->db->query($str_query,array($companyID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public	function update($company_ID,$company_name,$service_id,$provider,$payworld_provider,$cyberplate_provider,$long_code_format,$long_code_no,$logo_path,$product_name)
	{	
		$this->load->library('common');
		$ipaddress = $this->common->getRealIpAddr();
		$edit_date = $this->common->getDate();
		$str_query = "update tblcompany set company_name=?,service_id=?,provider=?,marsprovider=?,RecDuniaProvider=?,long_code_format=?,long_code_no=?,logo_path=?,edit_date=?,ipaddress=?, product_name=? where company_id=?";
		$result = $this->db->query($str_query,array($company_name,$service_id,$provider,$payworld_provider,$cyberplate_provider,$long_code_format,$long_code_no,$logo_path,$edit_date,$ipaddress,$product_name,$company_ID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public function get_company()
	{
		$str_query = "select `tblcompany`.*,(select api_name from tblapi where tblapi.api_id = tblcompany.api_id) as api_name,CASE tblcompany.service_id WHEN 1 THEN 'Mobile' WHEN 2 THEN 'DTH' END service_name FROM `tblcompany` order by `tblcompany`.company_name";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_company_limited($start_row,$per_page)
	{
		$str_query = "select `tblcompany`.*,CASE tblcompany.service_id WHEN 1 THEN 'Mobile' WHEN 2 THEN 'DTH' END service_name FROM `tblcompany` order by `tblcompany`.company_name limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
	public function UpdateAdminCommission($company_id,$royalComm,$MarsComm,$RecDunComm,$RechargeServer)
	{
		$str_query = "update tblcompany set royalComm = ?, RecDunComm=?, MarsComm=?, RechargeServerComm = ? where company_id = ? ";
		$rslt = $this->db->query($str_query,array($royalComm,$RecDunComm,$MarsComm,$RechargeServer,$company_id));
		return true;
	}
	public function getAdminCommissionView()
	{
		$rslt = $this->db->query("select * from tblcompany where royalComm > 0 or RecDuniaProvider > 0 or marsprovider > 0 order by company_name");
		return $rslt;
	}	
	
}

?>