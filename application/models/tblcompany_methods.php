<?php
class Tblcompany_methods extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function getCompany_name($company_id)
	{
		$rlst = $this->db->query("select company_name from tblcompany where company_id = '".$company_id."'");
		return $rlst->row(0)->company_name;
	}
	public function getCompany_info($company_id)
	{
		$rlst = $this->db->query("select * from tblcompany where company_id = '".$company_id."'");
		if($rlst->num_rows() > 0)
		{
			return $rlst;
		}
		else
		{
			return false;
		}
	}
	public function getCompanyByOpcode_info($provider)
	{
		$rlst = $this->db->query("select * from tblcompany where provider = '".$provider."'");
		return $rlst;
	}
	public function getCompanyIdByProvider($provider)
	{
		$rlst = $this->db->query("select * from tblcompany where provider = '".$provider."'");
		if($rlst->num_rows() > 0)
		{
			return $rlst->row(0)->company_id;
		}
		else
		{
			return false;
		}
	}
	
}

?>