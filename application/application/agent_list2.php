<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent_list2 extends CI_Controller {
		 
	private $msg='';
	public function pageview()
	{
		if ($this->session->userdata('user_type') != "MasterDealer" and $this->session->userdata('user_type') != "Distributor" ) 
		{ 
			redirect(base_url().'login'); 
		}
		$user_id = $this->session->userdata('id');
		$user_type = $this->session->userdata('user_type');
		$start_row = $this->uri->segment(3);
		$per_page = $this->common_value->getPerPage();
		if(trim($start_row) == ""){$start_row = 0;}
		$this->load->model('Agent_list2_model');		
		$result = $this->Agent_list2_model->get_retailer($user_id,$user_type);
		$total_row = $result->num_rows();		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."agent_list2/pageview";
		$config['total_rows'] = $total_row;
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config); 
		$this->view_data['pagination'] = $this->pagination->create_links();
		$this->view_data['result_agent'] = $this->Agent_list2_model->get_retailer_limited($start_row,$per_page,$user_id,$user_type);
		$this->view_data['message'] =$this->msg;
		$this->load->view('agent_list2_view',$this->view_data);		
	}
	
	public function index() 
	{
				$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache"); 

		if ($this->session->userdata('user_type') != "MasterDealer" and $this->session->userdata('user_type') != "Distributor") 
		{ 
			redirect(base_url().'login'); 
		}				
		else 		
		{ 	
			if($this->input->post('btnSearch') == "Search")
			{
				$SearchBy = $this->input->post("ddlSearchBy",TRUE);
				$SearchWord = $this->input->post("txtSearch_Word",TRUE);								
				$this->load->model('Agent_list2_model');
				$result = $this->Agent_list2_model->Search($SearchBy,$SearchWord);		
				$this->view_data['result_retailer'] = $result;
				$this->view_data['message'] =$this->msg;
				$this->view_data['pagination'] = NULL;
				$this->load->view('agent_list2_view',$this->view_data);						
			}				
			else if($this->input->post('hidaction') == "Set")
			{								
				$status = $this->input->post("hidstatus",TRUE);
				$user_id = $this->input->post("hiduserid",TRUE);
				$this->load->model('Agent_list2_model');
				$result = $this->Agent_list2_model->updateAction($status,$user_id);
				if($result == true)
				{
					$this->msg="Action Submit Successfully.";
					$this->pageview();	
				}
			}
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Distributor' or trim($user) == 'MasterDealer')
				{
				$this->pageview();
				}
				else
				{redirect(base_url().'login');}																								
			}
		} 
	}	
}