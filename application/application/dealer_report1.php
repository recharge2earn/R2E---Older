<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dealer_report1 extends CI_Controller {
	
	
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
			//$service_id = $this->input->post('ddlService',true);
			$user_id = $this->input->post('ddlUserName',true);
			
			$this->load->model('Dealer_report1_model');
			$this->view_data['closing_balance']=$this->Dealer_report1_model->getClosing_Balance($user_id,$from);
			$this->load->model('Dealer_report1_model');
			$this->view_data['result_rch'] = $this->Dealer_report1_model->get_recharge($from,$to,$user_id);
			$this->view_data['message'] =$this->msg;
			$this->load->view('dealer_report1_view',$this->view_data);								
		}
		else 
		{ 						
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Admin')
				{										
					$this->view_data['message']='';
					$this->load->view('dealer_report1_view',$this->view_data);		
				}
				else
				{redirect(base_url().'login');}																								
		} 
	}	
}