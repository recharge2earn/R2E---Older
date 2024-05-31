<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{
		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		} 
		$start_row = $this->uri->segment(3);
		$per_page = $this->common_value->getPerPage();
		if(trim($start_row) == ""){$start_row = 0;}
		$this->load->model('Api_model');
		$result = $this->Api_model->get_api();
		$total_row = $result->num_rows();		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."api/pageview";
		$config['total_rows'] = $total_row;
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config); 
		$this->view_data['pagination'] = $this->pagination->create_links();
		$this->view_data['result_api'] = $this->Api_model->get_api_limited($start_row,$per_page);
		$this->view_data['message'] =$this->msg;
		$this->load->view('api_view',$this->view_data);		
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
				$ApiName = $this->input->post("txtAPIName",TRUE);
				$UserName = $this->input->post("txtUserName",TRUE);
				$Password = $this->input->post("txtPassword",TRUE);				
				$this->load->model('Api_model');
				if($this->Api_model->add($ApiName,$UserName,$Password) == true)
				{
					$this->msg ="Api Add Successfully.";
					$this->pageview();
				}
				else
				{
					
				}
			}
			else if($this->input->post("btnSubmit") == "Update")
			{				
				$apiID = $this->input->post("hidID",TRUE);
				$ApiName = $this->input->post("txtAPIName",TRUE);
				$UserName = $this->input->post("txtUserName",TRUE);
				$Password = $this->input->post("txtPassword",TRUE);
				$Ip = $this->input->post("txtIp",TRUE);				
				$Status = $this->input->post("hidStatus",TRUE);					
				$this->load->model('Api_model');
				if($this->Api_model->update($apiID,$ApiName,$UserName,$Password,$Ip) == true)
				{
					$this->msg ="Api Update Successfully.";
					$this->pageview();
				}
				else
				{
					
				}				
			}
			else if( $this->input->post("hidValue") && $this->input->post("action") ) 
			{				
				$apiID = $this->input->post("hidValue",TRUE);
				$this->load->model('Api_model');
				if($this->Api_model->delete($apiID) == true)
				{
					$this->msg ="Api Delete Successfully.";
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