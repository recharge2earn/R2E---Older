<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Retailer_module extends CI_Controller {
	public function index()
	{	
		if ($this->session->userdata('logged_in') != true) 
		{ 
			redirect(base_url().'login'); 
		} 
		else 
		{ 
			$user=$this->session->userdata('user_type');
			if(trim($user) == 'Retailer')
			{
					$this->load->view('retailer_module_view');
			}
			else
			{redirect(base_url().'login');}
		} 				
	}	
}
