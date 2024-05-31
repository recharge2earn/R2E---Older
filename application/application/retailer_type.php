<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Retailer_type extends CI_Controller {
	
	private $msg='';
	public function pageview()
	{
		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		} 
		$this->load->model('Retailer_type_model');
		$this->view_data['result_retailer_type']  = $this->Retailer_type_model->get_retailer_type();
		$this->view_data['pagination'] =NULL;		
		$this->view_data['message'] =$this->msg;
		$this->load->view('retailer_type_view',$this->view_data);		
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
				$retailer_type_Name = $this->input->post("txtRetailer_type",TRUE);
				$this->load->model('Retailer_type_model');
				if($this->Retailer_type_model->add($retailer_type_Name) == true)
				{
					$this->msg ="Retailer Type Name Add Successfully.";
					$this->pageview();
				}
				else
				{
					
				}
			}
			else if($this->input->post("btnSubmit") == "Update")
			{				
				$retailerID = $this->input->post("hidID",TRUE);
				$retailerName = $this->input->post("txtRetailer_type",TRUE);
				$this->load->model('retailer_type_model');
				if($this->retailer_type_model->update($retailerID,$retailerName) == true)
				{
					$this->msg ="Retailer Type Name Update Successfully.";
					$this->pageview();
				}
				else
				{
					
				}				
			}
			else if( $this->input->post("hidValue") && $this->input->post("action") ) 
			{
				
				$retailerID = $this->input->post("hidValue",TRUE);
				$this->load->model('retailer_type_model');
				if($this->retailer_type_model->delete($retailerID) == true)
				{
					$this->msg ="Retailer Type Name Delete Successfully.";
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