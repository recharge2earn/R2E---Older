<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account_balance extends CI_Controller {	
		private $msg='';
	public function pageview()
	{
		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		} 
		$this->load->model("Common_methods");
		$balance = $this->Userinfo->getAdminBalance();
		$this->view_data['message'] ="";
		$this->view_data['balance'] =$balance;
		$this->load->view('account_balance_view',$this->view_data);		
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
			if($this->input->post("btnSubmit") == "Add")
			{
				$description = "Balance Updated By Admin";
				$amount = $this->input->post("txtAmount",TRUE);
				$remark = $this->input->post("txtRemark",TRUE);
				$this->Common_methods->AdminBalanceUpdate($description,$amount,$remark);
				$this->session->set_flashdata('message', 'Balance Updated Successfully.');
				redirect('account_balance');
				
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
?>