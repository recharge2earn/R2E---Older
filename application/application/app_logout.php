<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_logout extends CI_Controller {
	
	public function index()
	{ 
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('id');		
		$this->session->unset_userdata('business_name');
		$this->session->unset_userdata('scheme_id');		
		$data['message']='You have Succesfully Logged out';
		$this->load->view('app_login_view',$data);		
	}	
}
