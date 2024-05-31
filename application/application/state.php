<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class State extends CI_Controller {
	
	private $msg='';
	public function pageview()
	{
		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		} 
		$this->load->model('State_model');
		$result = $this->State_model->get_state();
		 
		$this->view_data['pagination'] = NULL;
		$this->view_data['result_state'] = $result;
		$this->view_data['message'] =$this->msg;
		$this->load->view('state_view',$this->view_data);		
	}
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
			if($this->input->post("btnSubmit") == "Submit")
			{
				$stateName = $this->input->post("txtState",TRUE);
				$stateCode = $this->input->post("txtCode",TRUE);
				$circleCode = $this->input->post("txtCircleCode",TRUE);				
				$this->load->model('State_model');
				if($this->State_model->add($stateName,$stateCode,$circleCode) == true)
				{
					$this->msg ="State Name Add Successfully.";
					$this->pageview();
				}
				else
				{
					
				}
			}
			else if($this->input->post("btnSubmit") == "Update")
			{				
				$stateID = $this->input->post("hidID",TRUE);
				$stateName = $this->input->post("txtState",TRUE);
				$stateCode = $this->input->post("txtCode",TRUE);			
				$circleCode = $this->input->post("txtCircleCode",TRUE);		
				$this->load->model('State_model');
				if($this->State_model->update($stateID,$stateName,$stateCode,$circleCode) == true)
				{
					$this->msg ="State Name Update Successfully.";
					$this->pageview();
				}
				else
				{
					
				}				
			}
			else if( $this->input->post("hidValue") && $this->input->post("action") ) 
			{
				
				$stateID = $this->input->post("hidValue",TRUE);
				$this->load->model('State_model');
				if($this->State_model->delete($stateID) == true)
				{
					$this->msg ="State Name Delete Successfully.";
					$this->pageview();
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
				$this->pageview();
				}
				else
				{redirect(base_url().'login');}																					
			}
		} 
	}
}