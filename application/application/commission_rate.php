<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commission_rate extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{
		$this->load->model('Commission_rate_model');		
		$this->view_data['result_commission'] = $this->Commission_rate_model->get_commission_rate($this->session->userdata('id'));
		$this->view_data['message'] =$this->msg;
		$this->load->view('commission_rate_view',$this->view_data);		
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
				if(trim($user) == 'SuperDealer' or trim($user) == 'MasterDealer' or  trim($user) == 'Distributor' or trim($user) == 'Agent' or trim($user) == 'MLMAgent' or trim($user) == 'Customer')
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