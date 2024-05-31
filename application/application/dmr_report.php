<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dmr_report extends CI_Controller {
	
	
	private $msg='';	
	public function index() 
	{
				$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache"); 

		if ($this->session->userdata('logged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		}				
		else if($this->input->post('btnSearch'))
		{
		
			$from = $this->input->post('txtFrom',true);
			$to = $this->input->post('txtTo',true);
			$mobile_no = $this->input->post('mobile_no',true);
			$user_id = $this->session->userdata('id');			
			$this->load->model('Agent_report_model');
			if($this->session->userdata("user_type") == "Agent" or $this->session->userdata("user_type") == "Distributor" or $this->session->userdata("user_type") == "MasterDealer")
			{
				$this->view_data['result_all'] = $this->Agent_report_model->dmr_report($from,$to,$user_id,$mobile_no);
			}
			
			$this->view_data['message'] =$this->msg;
			$this->load->view('dmr_report_view',$this->view_data);								
		}
		else 
		{ 						
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Distributor' or trim($user) == 'MasterDealer' or trim($user) == 'Agent')
				{										
					$this->view_data['message']='';
					$this->load->view('dmr_report_view',$this->view_data);		
				}
				else
				{redirect(base_url().'login');}																								
		} 
	}	
}