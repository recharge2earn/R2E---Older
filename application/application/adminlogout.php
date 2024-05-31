<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminlogout extends CI_Controller {
	
	public function index()
	{ 
		$this->session->unset_userdata('alogged_in');
		$this->session->unset_userdata('admin_id');		
		$this->session->unset_userdata('abusiness_name');
		$this->session->unset_userdata('auser_type');
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('id');		
		$this->session->unset_userdata('business_name');
		$this->session->unset_userdata('scheme_id');
		$this->session->unset_userdata('user_type');	
		$data['message']='';
		$this->load->view('login_view',$data);		
	}	
}
