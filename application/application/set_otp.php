<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class set_otp extends CI_Controller {
			
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
			{
				
				$newPwd = $this->input->post("txtNewPassword",TRUE);								
				$user_id = $this->session->userdata("id",TRUE);
				$this->load->model('Change_password_model');
				if($this->Change_password_model->update($newPwd,$user_id) == true)
				{
					$this->view_data['message'] ="Password change successfully.";
					$this->load->view('c_change_password_view',$this->view_data);		
				}
				else
				{
					$this->view_data['message'] ="Old password does not match. Try Again!";
					$this->load->view('c_change_password_view',$this->view_data);		
				}
			}
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Distributor' or trim($user) == 'MasterDealer' or trim($user) == 'Agent')
				{
					$this->view_data['message'] ="";
					$this->load->view('set_otp_view',$this->view_data);		
				}
				else
				{redirect(base_url().'login');}																					
			}
		} 
	}	
}