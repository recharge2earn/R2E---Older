<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_otp123 extends CI_Controller {
	
/*$otp = $this->common->getOTP();
				$str_query ="update tblusers set otp = ? where user_id = ?";
				$rslt = $this->db->query($str_query,array($otp,$user_id));*/

	public function index() 
	{
		$this->load->model("Errorlog");
		$this->Errorlog->logentry("hi");
		$str_query = "select * from tblusers where usertype_name = 'Agent' or usertype_name = 'Distributor'";
		$rslt = $this->db->query($str_query);
		foreach($rslt->result() as $result)
		{
			$otp = $this->common->getOTP();
			$str_query ="update tblusers set otp = ? where user_id = ?";
			$rslt = $this->db->query($str_query,array($otp,$result->user_id));
		}
	}	
}