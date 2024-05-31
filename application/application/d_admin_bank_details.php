<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class D_admin_bank_details extends CI_Controller {
	
	private $msg='';
	public function pageview()
	{
		$start_row = $this->uri->segment(3);
		$per_page = $this->common_value->getPerPage();
		if(trim($start_row) == ""){$start_row = 0;}
		$this->load->model('D_admin_bank_details_model');
		$user_id = $this->session->userdata('id');
		$result = $this->D_admin_bank_details_model->get_bank($user_id);
		$total_row = $result->num_rows();		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."d_admin_bank_details/pageview";
		$config['total_rows'] = $total_row;
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config); 
		$this->view_data['pagination'] = $this->pagination->create_links();
		$this->view_data['result_bank'] = $this->D_admin_bank_details_model->get_bank_limited($start_row,$per_page,$user_id);
		$this->view_data['message'] =$this->msg;
		$this->load->view('d_admin_bank_details_view',$this->view_data);		
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
			if($this->input->post("btnSubmit") == "Submit")
			{
				$bankId = $this->input->post("ddlBank",TRUE);
				$ifsc = $this->input->post("txtIfscCode",TRUE);
				$accountno = $this->input->post("txtAccountNo",TRUE);
				$branch = $this->input->post("txtBranchName",TRUE);
				$user_id = $this->session->userdata('id');
				$this->load->model('D_admin_bank_details_model');
				if($this->D_admin_bank_details_model->add($bankId,$ifsc,$accountno,$branch,$user_id) == true)
				{
					$this->msg ="Bank Name Add Successfully.";
					$this->pageview();
				}
				else
				{
					
				}
			}
			else if($this->input->post("btnSubmit") == "Update")
			{				
				$user_bank_id = $this->input->post("hidID",TRUE);
				$bankId = $this->input->post("ddlBank",TRUE);
				$ifsc = $this->input->post("txtIfscCode",TRUE);
				$accountno = $this->input->post("txtAccountNo",TRUE);
				$branch = $this->input->post("txtBranchName",TRUE);
				$user_id = $this->session->userdata('id');				
				$this->load->model('D_admin_bank_details_model');
				if($this->D_admin_bank_details_model->update($bankId,$ifsc,$accountno,$branch,$user_bank_id,$user_id) == true)
				{
					$this->msg ="Bank Name Update Successfully.";
					$this->pageview();
				}
				else
				{
					
				}				
			}
			else if( $this->input->post("hidValue") && $this->input->post("action") ) 
			{
				
				$bankID = $this->input->post("hidValue",TRUE);
				$this->load->model('D_admin_bank_details_model');
				if($this->D_admin_bank_details_model->delete($bankID) == true)
				{
					$this->msg ="Bank Name Delete Successfully.";
					$this->pageview();
				}
				else
				{
					
				}				
			}			
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Dealer')
				{
				$this->pageview();
				}
				else
				{redirect(base_url().'login');}																					
			}
		}
	}	
}