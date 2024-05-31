<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Core_balance extends CI_Controller {
    
	
	private $msg='';
	public function pageview()
	{ 
	$this->load->library('common');
    	$this->load->model('Core_balance_model');		
		$RCInfo = $this->Core_balance_model->get_Info('API1');
		$url="http://api.globalsoftware.co.in/api/balance.php";
		$postfield = "uid=".$RCInfo->row(0)->username."&pin=".$RCInfo->row(0)->password."&route=recharge";
		$this->view_data['balance'] = $this->common->ExecuteBalanceURL($url,$postfield);				
		$this->view_data['message'] = $this->msg;
		$this->load->view('core_balance_view',$this->view_data);			
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
