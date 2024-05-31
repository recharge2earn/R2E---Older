<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_fund_md extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{
		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		}	
		$start_row = $this->uri->segment(3);
		$per_page = $this->common_value->getPerPage();
		if(trim($start_row) == ""){$start_row = 0;}
		$this->load->model('Md_dealer_list_model');
		$result = $this->Md_dealer_list_model->get_dealer();
		$total_row = $result->num_rows();		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."add_fund_md/pageview";
		$config['total_rows'] = $total_row;
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config); 
		$this->view_data['pagination'] = $this->pagination->create_links();
		$this->view_data['result_dealer'] = $this->Md_dealer_list_model->get_dealer_limited($start_row,$per_page);
		$this->view_data['message'] =$this->msg;
		$this->load->view('add_fund_md_view',$this->view_data);		
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
			if($this->input->post("hidSearchFlag") && $this->input->post("hidSearchValue"))
			{
				$SearchBy = $this->input->post("hidSearchFlag",TRUE);
				$SearchWord = $this->input->post("hidSearchValue",TRUE);								
				$this->load->model('Md_dealer_list_model');
				$result = $this->Md_dealer_list_model->getMasterdealerFiltered("MasterDealer",$SearchBy,$SearchWord);		
				$this->view_data['result_dealer'] = $result;
				$this->view_data['message'] =$this->msg;
				$this->view_data['pagination'] = NULL;
				$this->load->view('add_fund_md_view',$this->view_data);			
			}
			else if($this->input->post('btnSearch') == "Search")
			{
				$SearchBy = $this->input->post("ddlSearchBy",TRUE);
				$SearchWord = $this->input->post("txtSearch_Word",TRUE);								
				$this->load->model('Md_dealer_list_model');
				$result = $this->Md_dealer_list_model->Search($SearchBy,$SearchWord);		
				$this->view_data['result_dealer'] = $result;
				$this->view_data['message'] =$this->msg;
				$this->view_data['pagination'] = NULL;
				$this->load->view('add_fund_md_view',$this->view_data);						
			}					
			else if($this->input->post('hidaction') == "Set")
			{								
				$status = $this->input->post("hidstatus",TRUE);
				$user_id = $this->input->post("hiduserid",TRUE);
				$start_page = $this->input->post("startpage",TRUE);
				$this->load->model('Agent_list_model');
				$result = $this->Agent_list_model->updateAction($status,$user_id);
				if($result == true)
				{
					$this->msg="Action Submit Successfully.";
					redirect(base_url()."add_fund_md/pageview/".$start_page);	
				}
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
}