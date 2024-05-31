<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dist_home extends CI_Controller {
	private $msg='';
	public function pageview()
	{
		$start_row = $this->uri->segment(3);
		$per_page = $this->common_value->getPerPage();
		if(trim($start_row) == ""){$start_row = 0;}
		$this->load->model('D_list_dealer_model');		
		$result = $this->D_list_dealer_model->get_agent($this->session->userdata('id'));
		$total_row = $result->num_rows();		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."dist_home/pageview";
		$config['total_rows'] = $total_row;
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config); 
		$this->view_data['pagination'] = $this->pagination->create_links();
		$this->view_data['result_dealer'] = $this->D_list_dealer_model->get_agent_limited($start_row,$per_page,$this->session->userdata('id'));
		$this->view_data['message'] =$this->msg;
		$this->load->view('dist_home_view',$this->view_data);		
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
			if($this->input->post("hidSearchFlag") && $this->input->post("hidSearchValue"))
			{
				$SearchBy = $this->input->post("hidSearchFlag",TRUE);
				$user_id = $this->session->userdata("id");
				$SearchWord = $this->input->post("hidSearchValue",TRUE);								
				$this->load->model('Md_dealer_list_model');
				$result = $this->Md_dealer_list_model->getAgentOfSistributerFiltered($user_id,"Agent",$SearchBy,$SearchWord);		
				$this->view_data['result_dealer'] = $result;
				$this->view_data['message'] =$this->msg;
				$this->view_data['pagination'] = NULL;
				$this->load->view('dist_home_view',$this->view_data);			
			}
			else if($this->input->post('btnSearch') == "Search")
			{
				$SearchBy = $this->input->post("ddlSearchBy",TRUE);
				$SearchWord = $this->input->post("txtSearch_Word",TRUE);								
				$this->load->model('D_list_dealer_model');
				$result = $this->D_list_dealer_model->Search($SearchBy,$SearchWord);		
				$this->view_data['result_retailer'] = $result;
				$this->view_data['message'] =$this->msg;
				$this->view_data['pagination'] = NULL;
				$this->load->view('dist_home_view',$this->view_data);						
			}				
			else if($this->input->post('hidaction') == "Set")
			{								
				$status = $this->input->post("hidstatus",TRUE);
				$user_id = $this->input->post("hiduserid",TRUE);
				$this->load->model('D_list_dealer_model');
				$result = $this->D_list_dealer_model->updateAction($status,$user_id);
				if($result == true)
				{
					$this->msg="Action Submit Successfully.";
					$this->pageview();	
				}
			}
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Distributor')
				{
					$this->pageview();
				}
				else
				{redirect(base_url().'login');}																								
			}
		} 
	}	
}
