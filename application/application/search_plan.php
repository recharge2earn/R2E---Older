<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_plan extends CI_Controller {
			
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
							
				$api_execution_url = $this->input->post("api_execution_url",TRUE);
				$User_id = $this->session->userdata("id");				
				
				$this->load->model('Calback_ip_model');
				if($this->Calback_ip_model->call_back($api_execution_url,$User_id) == true)
				{
					$this->view_data['message'] ="Call Back URL Updated successfully.";
					$this->load->view('search_plan',$this->view_data);		
				}
				else
				{
					$this->view_data['message'] ="no change apply for your profile.";
					$this->load->view('search_plan',$this->view_data);		
				}
				
			}			
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'SuperDealer' or trim($user) == 'Distributor' or trim($user) == 'MasterDealer' or trim($user) == 'Agent' or trim($user) == 'APIUSER' or trim($user) == 'Customer')
				{
					$this->view_data['message'] ="";
					$this->load->view('search_plan',$this->view_data);		
				}
				else
				{redirect(base_url().'login');}																					
			}
		} 
	}	
}
