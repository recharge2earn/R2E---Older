<?php
class List_complain_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_complain()
	{
		$str_query = "select tblcomplain.*,tblusers.business_name from tblcomplain,tblusers where tblusers.user_id = tblcomplain.user_id order by tblcomplain.complain_date";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function Search($txtFrom,$txtTo)
	{
		$str_query = "select tblcomplain.*,tblusers.business_name,tblusers.username,tblusers.usertype_name from tblcomplain,tblusers where tblusers.user_id = tblcomplain.user_id and tblcomplain.complain_date >= ? and tblcomplain.complain_date <= ? order by tblcomplain.complain_date";
		$result = $this->db->query($str_query,array($txtFrom,$txtTo));
		return $result;
	}
	public function get_complain_limited($start_row,$per_page)
	{
		$str_query = "select tblcomplain.*,tblusers.business_name,tblusers.username,tblusers.usertype_name from tblcomplain,tblusers where tblusers.user_id = tblcomplain.user_id order by tblcomplain.complain_id desc limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
	public function updateAction($status,$complain_id,$response_message)
	{
		$this->load->library("common");
		$date = $this->common->getMySqlDate();
		$str_query = "update tblcomplain set complain_status=?,response_message=?,complainsolve_date=? where complain_id=?";
		$result = $this->db->query($str_query,array($status,$response_message,$date,$complain_id));
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	public function GetUserInfoByComplain($complain_id)
	{
		$str_query = "select tblusers.mobile_no from tblusers,tblcomplain where tblusers.user_id=tblcomplain.user_id and   complain_id=?";
		$result = $this->db->query($str_query,array($complain_id));		
		return $result;
	}	
	public function AjaxSearchComplain($SearchWord)
	{
		
		$str_query = "select tblcomplain.*,tblusers.business_name,tblusers.username,tblusers.usertype_name from tblcomplain,tblusers where tblusers.user_id = tblcomplain.user_id and (tblcomplain.complain_id=? or tblcomplain.recharge_id=? or tblcomplain.complain_date=? or tblusers.business_name = ? or tblusers.usertype_name = ? or tblcomplain.complain_status = ? or tblusers.username = ?) order by tblcomplain.complain_date";
		$result = $this->db->query($str_query,array($SearchWord,$SearchWord,$SearchWord,$SearchWord,$SearchWord,$SearchWord,$SearchWord));
		return $result;
	}

}

?>