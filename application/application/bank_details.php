<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank_details extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{
		$str_query = "select tbluser_bank.*,(select bank_name from tblbank where tblbank.bank_id = tbluser_bank.bank_id) as bank_name from tbluser_bank";
		$rslt = $this->db->query($str_query);
		$this->view_data['pagination'] = NULL;
		$this->view_data['result_bank'] = $rslt;
		$this->view_data['message'] =$this->msg;
		$this->load->view('bank_details_view',$this->view_data);		
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
			
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Agent' or trim($user) == 'Distributor' or trim($user) == 'MasterDealer')
				{
					$this->pageview();
				}
				else
				{redirect(base_url().'login');}																					
			
		} 
	}	
}