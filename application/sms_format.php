<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sms_format extends CI_Controller {
	public function index()
	{
		
		$this->load->view('api_users/sms_format_view');		
	}	
}
