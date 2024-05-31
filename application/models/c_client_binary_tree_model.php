<?php
class c_client_binary_tree_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
		private $first=0;
	private $data='';
	public function display_btree($client_id)
	{
		$sql= "select * from tblusers where parent_id='$client_id' order by Order_No" ;		
		$CI =& get_instance();      	
		$result = $CI->db->query($sql);
		$id1;$id2;
		global $first;
		global $data;		
		for($i=0;$i<$result->num_rows();$i++)
		{
			if($i==0)
			{
			$data .= '"'.$result->row($i)->business_name.'"';		
			}
			else
			{
				$data .= ',"'.$result->row($i)->business_name.'"';				
			}			
		}
		return $data;
	}

}

?>