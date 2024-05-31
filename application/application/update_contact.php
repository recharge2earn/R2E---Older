<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_contact extends CI_Controller {
	public function index() 
	{
				$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache"); 

		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		} 
		else 
		{ 
			$data['message']='';				
			if($this->input->post("btnSubmit"))
			{
				$Alerts =htmlentities($this->input->post("editor1"));
				$this->load->model('Alerts_model');
				if($this->Alerts_model->contact($Alerts) == true)
				{
					$data['message'] = "Contact Details updated Successfully.";				
					$this->load->view('update_contact_view',$data);
				}
				else
				{
					
				}
			}
			else
			{				
				$user=$this->session->userdata('auser_type');
				if(trim($user) == 'Admin')
				{
					$this->load->view('update_contact_view',$data);
				}
				else
				{redirect(base_url().'login');}					
				}
		} 
	}	
}