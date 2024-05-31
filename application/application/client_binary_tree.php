<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_binary_tree extends CI_Controller {
		
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
			$data['message']='';				
			if($this->input->post("btnSubmit") == "Submit")
			{}				
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Retailer')
				{
				$this->load->view('client_binary_tree_view');		
				}
				else
				{redirect(base_url().'login');}																												
			}
		} 
	}	
}