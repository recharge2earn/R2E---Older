<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_home extends CI_Controller {
	public function index()
	{	
$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache"); 
		if ($this->session->userdata('logged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		} 
		else 
		{ 
			$user=$this->session->userdata('user_type');
			if(trim($user) == 'Admin')
			{
			$this->load->view('admin_home_view');		 		
			}
			else
			{redirect(base_url().'login');}
		} 
	}
}
