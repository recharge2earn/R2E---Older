<?php
class Highchart_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	function getStudentDetails($stuName) {
        $query = "select * from tblusers";
        $result = $this->db->query($query);
        return $result;
    }
}

?>