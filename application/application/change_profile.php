<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_profile extends CI_Controller {
			
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
				$Address = $this->input->post("txtPostalAddr",TRUE);				
				$Pin = $this->input->post("txtPin",TRUE);
				$State = $this->input->post("ddlState",TRUE);
				$City = $this->input->post("ddlCity",TRUE);				
				$LandNo = $this->input->post("txtLandNo",TRUE);
				$RetType = $this->input->post("ddlRetType",TRUE);
				$Email = $this->input->post("txtEmail",TRUE);				
				$stateCode = $this->input->post("hidStateCode",TRUE);
				$User_id = $this->session->userdata("id");				
				
				$this->load->model('Change_profile_model');
				if($this->Change_profile_model->update($Address,$Pin,$State,$City,$LandNo,$RetType,$Email,$User_id) == true)
				{
					$this->view_data['message'] ="Profile change successfully.";
					$this->load->view('change_profile_view',$this->view_data);		
				}
				else
				{
					$this->view_data['message'] ="no change apply for your profile.";
					$this->load->view('change_profile_view',$this->view_data);		
				}
				
			}			
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'SuperDealer' or trim($user) == 'Distributor' or trim($user) == 'MasterDealer' or trim($user) == 'Agent' or trim($user) == 'APIUSER' or trim($user) == 'Customer')
				{
					$this->view_data['message'] ="";
					$this->load->view('change_profile_view',$this->view_data);		
				}
				else
				{redirect(base_url().'login');}																					
			}
		} 
	}	
}
