<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_check_status extends CI_Controller {
	
	
	private $msg=''; 
	public function pageview() 
	{
		$this->view_data['result_payment'] = NULL;
		$this->view_data['message'] =$this->msg;
		$this->load->view('a_check_status_view',$this->view_data);		
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
				
				if(trim($this->input->post('btnSubmit')) == 'Submit')
				{	
					$txid = $this->input->post("txtTid",TRUE);	
					$this->load->model('A_check_status_model');		
					$this->view_data['result_payment'] = $this->A_check_status_model->get_balance_transfer($txid);
					$this->view_data['message'] =$this->msg;
					$this->load->view('a_check_status_view',$this->view_data);		

				}
				else
				{
				
				if(trim($user) == 'Admin')
				{
				$this->pageview();
				}
				else{redirect(base_url().'login');}																					
				}
			}
		} 
	}	
}
//50.22.77.79