<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reseller_list extends CI_Controller {
	
	
	private $msg='';
	public function user()
	{
		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		}	
		$start_row = $this->uri->segment(3);
		$per_page = $this->common_value->getPerPage();
		if(trim($start_row) == ""){$start_row = 0;}
		$this->load->model('reseller_model');
		$result = $this->reseller_model->get_retailer();
		$total_row = $result->num_rows();		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."reseller_list/user";
		$config['total_rows'] = $total_row;
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config); 
		$this->view_data['pagination'] = $this->pagination->create_links();
		$this->view_data['result_dealer'] = $this->reseller_model->get_retailer_limited($start_row,$per_page);
		$this->view_data['message'] =$this->msg;
		$this->load->view('reseller_list_view',$this->view_data);		
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
		 	if($this->input->post("hidSearchFlag") && $this->input->post("hidSearchValue") <= 1)
			{
				
				$SearchBy = $this->input->post("hidSearchFlag",TRUE);
				$SearchWord = $this->input->post("hidSearchValue",TRUE);								
				$this->load->model('Md_dealer_list_model');
				$result = $this->Md_dealer_list_model->getMasterdealerFiltered("Agent",$SearchBy,$SearchWord);		
				$this->view_data['result_dealer'] = $result;
				$this->view_data['message'] =$this->msg;
				$this->view_data['pagination'] = NULL;
				$this->load->view('reseller_list_view',$this->view_data);			
			}
			else if($this->input->post('btnSearch') == "Search")
			{
				$SearchBy = 'UserID';
				$SearchWord = $this->input->post("txtSearch_Word",TRUE);								
				$this->load->model('reseller_model');
				$result = $this->reseller_model->Search($SearchBy,$SearchWord);		
				$this->view_data['result_retailer'] = $result;
				$this->view_data['message'] =$this->msg;
				$this->view_data['pagination'] = NULL;
				$this->load->view('reseller_list_view',$this->view_data);						
			}					
			else if($this->input->post('hidaction') == "Set")
			{							
			
				$status = $this->input->post("hidstatus",TRUE);
				$user_id = $this->input->post("hiduserid",TRUE);
				$start_page = $this->input->post("startpage",TRUE);
				$this->load->model('reseller_model');
				$result = $this->reseller_model->updateAction($status,$user_id);
				if($result == true)
				{
					$this->msg="Action Submit Successfully.";
					redirect(base_url()."reseller_list/user/".$start_page);
				}
			}
			else if($this->input->post('hidaddto') == "Addto")
			{								
				$usertype_name = $this->input->post("hidusertype",TRUE);
				$user_id = $this->input->post("hiduserid",TRUE);
				$this->load->model('reseller_model');
				$result = $this->reseller_model->updateUsertype($usertype_name,$user_id);
				if($result == true)
				{
					$this->msg="Action Submit Successfully.";
					$this->user();	
				}
			}
			else
			{
				$user=$this->session->userdata('auser_type');
				if(trim($user) == 'Admin')
				{
				$this->user();
				}
				else
				{redirect(base_url().'login');}																								
			}
		} 
	}	
}