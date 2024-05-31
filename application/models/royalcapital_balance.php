<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class royalcapital_balance extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{
		$user=$this->session->userdata('user_type');
		if(trim($user) != 'SuperAdmin')
				{redirect(base_url().'login');}	
				
		$this->load->library('common');
		$this->load->model('Royalcapital_balance_model');		
		$RCInfo = $this->Royalcapital_balance_model->get_RoyalInfo('Emoney');
		$url="http://www.emoneygroup.in/RechargeApi/Balance.aspx";
		$postfield = "Username=".$RCInfo->row(0)->username."&Password=".$RCInfo->row(0)->password."&route=recharge";
		$this->view_data['balance'] = $this->common->ExecuteBalanceURL($url,$postfield);				
		$this->view_data['message'] = $this->msg;
		$this->load->view('royalcapital_balance_view',$this->view_data);		
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
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'SuperAdmin')
				{
				$this->pageview();
				}
				else
				{redirect(base_url().'login');}																								
		} 
	}	
}