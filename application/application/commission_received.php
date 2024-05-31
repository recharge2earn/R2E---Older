<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commission_received extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{ 
		if($this->input->post("btnSearch") == "Search")
		{
			$date = $this->input->post("txtSearch_Date");
		$this->load->model('Commission_received_model');		
		$this->view_data['result_commission'] = $this->Commission_received_model->get_commission_received_bydate($this->session->userdata('id'),$date);
		$this->view_data['message'] =$this->msg;
		$this->load->view('commission_received_view',$this->view_data);		
			
		}
		else
		{	
		$this->load->model('Commission_received_model');		
		$this->view_data['result_commission'] = $this->Commission_received_model->get_commission_received_bydate($this->session->userdata('id'),'');
		$this->view_data['message'] =$this->msg;
		$this->load->view('commission_received_view',$this->view_data);		
		}
	}
	
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
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Agent')
				{
				$this->pageview();
				}
				else
				{redirect(base_url().'login');}																					
			}
		} 
	}	
}
//50.22.77.79