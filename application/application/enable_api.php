<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Enable_api extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{
		$start_row = $this->uri->segment(3);
		$per_page = $this->common_value->getPerPage();
		if(trim($start_row) == ""){$start_row = 0;}
		$this->load->model('Enable_api_model');
		$result = $this->Enable_api_model->get_distributer();
		$total_row = $result->num_rows();		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."enable_api/pageview";
		$config['total_rows'] = $total_row;
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config); 
		$this->view_data['pagination'] = $this->pagination->create_links();
		$this->view_data['result_distributer'] = $this->Enable_api_model->get_distributer_limited($start_row,$per_page);
		$this->view_data['message'] =$this->msg;
		$this->load->view('enable_api_view',$this->view_data);		
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
				$SearchBy = $this->input->post("ddlSearchBy",TRUE);
				$SearchWord = $this->input->post("txtSearch_Word",TRUE);								
				$this->load->model('Enable_api_model');
				$result = $this->Enable_api_model->Search($SearchBy,$SearchWord);		
				$this->view_data['result_distributer'] = $result;
				$this->view_data['message'] =$this->msg;
				$this->view_data['pagination'] = NULL;
				$this->load->view('enable_api_view',$this->view_data);						
			}					
			else if($this->input->post('hidaction') == "Set")
			{								
				$status = $this->input->post("hidstatus",TRUE);
				$user_id = $this->input->post("hiduserid",TRUE);
				$api_execution_url = $this->input->post("hidapiurl",TRUE);
				$this->load->model('Enable_api_model');
				$result = $this->Enable_api_model->updateAction($status,$api_execution_url,$user_id);
				if($result == true)
				{
					$this->msg="Action Submit Successfully.";
					$this->pageview();	
				}
			}
			else
			{
				$user=$this->session->userdata('user_type');
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