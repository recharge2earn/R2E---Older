<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_commission extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{
		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		} 
		$this->load->model("Company_model");
		$this->view_data['pagination'] = NULL;
		$this->view_data['result_admin_comm'] = $this->Company_model->getAdminCommissionView();
		$this->view_data['message'] =$this->msg;
		$this->load->view('admin_commission_view',$this->view_data);		
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

				$RoyalComm = $this->input->post("txtRoyalComm",TRUE);
				$MarsComm = $this->input->post("txtMarsComm",TRUE);
				$RecDunComm = $this->input->post("txtRecDunComm",TRUE);
				$RechargeServer = $this->input->post("txtRechargeServer",TRUE);
				$Company_id = $this->input->post("ddlcompany",TRUE);
				
				$this->load->model('Company_model');
			
				if($this->Company_model->UpdateAdminCommission($Company_id,$RoyalComm,$MarsComm,$RecDunComm,$RechargeServer) == true)
				{
					$this->msg ="Commission Add Successfully.";
					$this->pageview();
				}
				else
				{
					
				}
			}
			
			else if( $this->input->post("hidValue") && $this->input->post("action") ) 
			{				
				$apiID = $this->input->post("hidValue",TRUE);
				$this->load->model('Api_model');
				if($this->Api_model->delete($apiID) == true)
				{
					$this->msg ="Api Delete Successfully.";
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