<?php
class Commission_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($Company_id,$Proirity,$RCommission,$Scheme)
	{
		
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$str_query = "insert into tblcommission(company_id,set_prority,royalComm,scheme_id,add_date,ipaddress) values(?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($Company_id,$Proirity,$RCommission,$Scheme,$date,$ip));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public	function delete($commissionID)
	{	
		$str_query = "delete from tblcommission where commission_id=?";
		$result = $this->db->query($str_query,array($commissionID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	
	public	function update($commissionID,$Company_id,$Proirity,$RCommission,$Scheme)
	{	
		$str_query = "update tblcommission  set company_id=?,set_prority=?,royalComm=?,scheme_id=? where commission_id=?";
		$result = $this->db->query($str_query,array($Company_id,$Proirity,$RCommission,$Scheme,$commissionID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public function get_commission()
	{
		$str_query = "select tblcommission.*,tblcompany.company_name,tblscheme.scheme_name FROM tblcommission,tblcompany,tblscheme
where tblcommission.company_id=tblcompany.company_id
 and tblcommission.scheme_id=tblscheme.scheme_id order by tblscheme.scheme_name ,tblcompany.company_name";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function find_exist_commission($company_id,$scheme_id)
	{
		$str_query = "select tblcommission.* FROM tblcommission where tblcommission.company_id=? 
and tblcommission.scheme_id=?";
		$result = $this->db->query($str_query,array($company_id,$scheme_id));
		if($result->num_rows() == 1)
		{
			return false;
		}else{return true;}
	}
	
	public function get_commission_limited($start_row,$per_page)
	{
		$str_query = "select tblcommission.*,tblcompany.company_name,tblscheme.scheme_name FROM tblcommission,tblcompany,tblscheme
where tblcommission.company_id=tblcompany.company_id
 and tblcommission.scheme_id=tblscheme.scheme_id order by tblscheme.scheme_name ,tblcompany.company_name limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
	
}

?>