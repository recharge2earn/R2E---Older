<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_customer extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{
		$this->view_data['result_customer'] = NULL;
		$this->view_data['message'] =$this->msg;
		$this->load->view('search_customer_view',$this->view_data);		
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
			if($this->input->post('btnSearch') == "Search")
			{				
				$MobileNo = $this->input->post("txtSearch_Word",TRUE);								
				$this->load->model('Search_customer_model');
				$result = $this->Search_customer_model->Search($MobileNo);		
				$this->view_data['result_customer'] = $result;
				$this->view_data['message'] =$this->msg;
				$this->load->view('search_customer_view',$this->view_data);						
			}					
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Retailer')
				{
				$this->pageview();
				}
				else
				{redirect(base_url().'login');}																								
			}
		} 
	}	
}