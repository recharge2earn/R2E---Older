<?php
class Forexincome_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($user_id,$amount,$per,$remark)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$payment_date = $this->common->getMySqlDate();
		$str_query = "insert into tblforexincome(user_id,amount,percentage,remark,add_date,ipaddress,pay_date) values(?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($user_id,$amount,$per,$remark,$date,$ip,$payment_date));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public	function delete($schemeID)
	{	
		$str_query = "delete from tblforexincome where forex_id=?";
		$result = $this->db->query($str_query,array($schemeID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	
	public	function update($schemeID,$schemeName,$schemeDesc,$schemeAmt,$schemeType)
	{	
		$str_query = "update tblscheme set scheme_name=?,scheme_description=?,amount=?,scheme_type=? where scheme_id=?";
		$result = $this->db->query($str_query,array($schemeName,$schemeDesc,$schemeAmt,$schemeType,$schemeID));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	public function get_scheme()
	{
		$str_query = "select tblforexincome.*, (select business_name from tblusers where user_id=tblforexincome.user_id) as name_user from  tblforexincome order by forex_id";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_scheme_limited($start_row,$per_page)
	{
		$str_query = "select tblforexincome.*, (select business_name from tblusers where user_id=tblforexincome.user_id) as name_user from  tblforexincome order by forex_id limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
	
}

?>