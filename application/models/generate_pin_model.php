<?php
class Generate_pin_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public	function add($amount,$user_id,$pinqty)
	{		
	
		for($k=0;$k<$pinqty;$k++)
		{
			$str_query = "insert into tblgenpin(amount,user_id) values(?,?)";
			$result = $this->db->query($str_query,array($amount,$user_id));		
			$id= $this->db->insert_id();
			$pin_no = rand(567,489948).''.$id;		
			$str_query = "update tblgenpin set pin_no=? where user_id=? and pin_id=?";
			$result = $this->db->query($str_query,array($pin_no,$user_id,$id));		
		}	
		return true;
	}		
	public function get_pin()
	{
		$str_query = "select * from tblgenpin order by pin_id";
		$result = $this->db->query($str_query);
		return $result;
	}
	public function get_pin_limited($start_row,$per_page)
	{
		$str_query = "SELECT tblgenpin.*,(select tblusers.business_name from tblusers where tblusers.user_id=tblgenpin.user_id) as name FROM `tblgenpin` order by pin_id limit $start_row,$per_page";
		$result = $this->db->query($str_query);
		return $result;
	}	
	
}

?>