<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_otp extends CI_Controller {
	
	

	public function index() 
	{
		if($this->session->userdata("user_type") == "Agent" or $this->session->userdata("user_type") == "Distributor" or $this->session->userdata("user_type") == "MasterDealer")
		{

			echo "OTP : ".$this->Userinfo_methods->getOTP($this->session->userdata("id"));
		}	

	}	
}