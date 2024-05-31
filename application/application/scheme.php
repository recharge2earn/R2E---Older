<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scheme extends CI_Controller {
	
	
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
		$this->load->model('Scheme_model');
		$result = $this->Scheme_model->get_scheme();
		$total_row = $result->num_rows();		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."scheme/pageview";
		$config['total_rows'] = $total_row;
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config); 
		$this->view_data['pagination'] = $this->pagination->create_links();
		$this->view_data['result_scheme'] = $this->Scheme_model->get_scheme_limited($start_row,$per_page);
		$this->view_data['message'] =$this->msg;
		$this->load->view('scheme_view',$this->view_data);		
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
			$data['message']='';				
			if($this->input->post("btnSubmit") == "Submit")
			{
				$SchemeName = $this->input->post("txtSchemeName",TRUE);
				$SchemeDesc = $this->input->post("txtSchemeDesc",TRUE);
				$commission_per = $this->input->post("txtAmount",TRUE);
				$SchemeFor = $this->input->post("ddlSchemeFor",TRUE);
				$SchemeType = $this->input->post("ddlSchemeType",TRUE);	
				if($SchemeType == "variable")
				{
					$commission_per = 0;
				}
				$this->load->model('Scheme_model');
				if($this->Scheme_model->add($SchemeName,$SchemeDesc,$commission_per,$SchemeFor,$SchemeType) == true)
				{
					$this->msg ="Scheme Add Successfully.";
					$this->pageview();
				}
				else
				{
					
				}
			}
			else if($this->input->post("btnSubmit") == "Update")
			{				
				$schemeID = $this->input->post("hidID",TRUE);
				$schemeName = $this->input->post("txtSchemeName",TRUE);
				$schemeDesc = $this->input->post("txtSchemeDesc",TRUE);
				$schemeAmt = $this->input->post("txtAmount",TRUE);
				$schemeType = $this->input->post("ddlSchemeType",TRUE);
				$this->load->model('Scheme_model');
				if($this->Scheme_model->update($schemeID,$schemeName,$schemeDesc,$schemeAmt,$schemeType) == true)
				{
					$this->msg ="Scheme Update Successfully.";
					$this->pageview();
				}
				else
				{
					
				}				
			}
			else if( $this->input->post("hidValue") && $this->input->post("action") ) 
			{
				
				$schemeID = $this->input->post("hidValue",TRUE);
				$this->load->model('Scheme_model');
				if($this->Scheme_model->delete($schemeID) == true)
				{
					$this->msg ="Scheme Delete Successfully.";
					$this->pageview();
				}
				else
				{
					
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