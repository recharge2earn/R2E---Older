<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Set_ip extends CI_Controller {
			
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
			if($this->input->post("btnSubmit") == "Update Details")
			{
							
				$ip_address = $this->input->post("ip_address",TRUE);
				$User_id = $this->session->userdata("id");				
				
				$this->load->model('Calback_ip_model');
				if($this->Calback_ip_model->ip_address($ip_address,$User_id) == true)
				{
					$this->view_data['message'] ="IP Address  Updated successfully.";
					$this->load->view('set_ip_view',$this->view_data);		
				}
				else
				{
					$this->view_data['message'] ="no change apply for your profile.";
					$this->load->view('set_ip_view',$this->view_data);		
				}
				
			}			
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'SuperDealer' or trim($user) == 'Distributor' or trim($user) == 'MasterDealer' or trim($user) == 'Agent' or trim($user) == 'APIUSER' or trim($user) == 'Customer')
				{
					$this->view_data['message'] ="";
					$this->load->view('set_ip_view',$this->view_data);		
				}
				else
				{redirect(base_url().'login');}																					
			}
		} 
	}	
}
