<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Complain extends CI_Controller {
		 
	private $msg='';
	public function pageview()
	{
		$start_row = $this->uri->segment(3);
		$per_page = $this->common_value->getPerPage();
		if(trim($start_row) == ""){$start_row = 0;}
		$this->load->model('Complain_model');
		$result = $this->Complain_model->get_complain();
		$total_row = $result->num_rows();		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."complain/pageview";
		$config['total_rows'] = $total_row;
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config); 
		$this->view_data['pagination'] = $this->pagination->create_links();
		$this->view_data['result_complain'] = $this->Complain_model->get_complain_limited($start_row,$per_page);
		$this->view_data['message'] =$this->msg;
		$this->load->view('complain_view',$this->view_data);		
	}
	public function GetRechargeDetails() 
	{
		$tranID = $this->input->get("trandID");
		$this->load->model('Complain_model');
		$result_recharge =	$this->Complain_model->GetRechargeResult($tranID);
		if($result_recharge->num_rows() == 1)
		{
		echo'<table cellpadding="3" cellspacing="3" border="0">
    <tr>
    <th style="width:250px;" align="right">Company : </th><td align="left">'.$result_recharge->row(0)->company_name.'</td></tr>
    <tr><th align="right">Mobile No : </th><td align="left">'.$result_recharge->row(0)->mobile_no.'</td></tr>
    <tr><th align="right">Amount : </th><td align="left">'.$result_recharge->row(0)->amount.'</td></tr>
    <tr><th align="right">Recharge Date : </th><td align="left">'.$result_recharge->row(0)->recharge_date.'</td></tr>
    <tr><th align="right">Recharge Time : </th><td align="left">'.$result_recharge->row(0)->recharge_time.'</td>    </tr>
    <tr><th align="right">Status : </th><td align="left">';
		if($result_recharge->row(0)->recharge_status == "Pending") { echo '<span class="orange">Pending</span>'; }  
		if($result_recharge->row(0)->recharge_status == 'Success') { echo '<span class="green">Success</span>'; }  
		if($result_recharge->row(0)->recharge_status == 'Failure') { echo '<span class="red">Failure</span>'; } 
echo '</td>    
    </tr>';
		echo '</table>';
		}
		else{echo "<span style='color:#F00;font-size:14px;'>No Data found.</span>";}
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
				$Subject = $this->input->post("txtSubject",TRUE);
				$Message = $this->input->post("txtMessage",TRUE);
				$this->load->model('Complain_model');
				$isAdd = $this->Complain_model->add($Subject,$Message);				
				$user_id = $this->session->userdata('id');
				$user_info = $this->Complain_model->GetUserInfo($user_id);
				$this->load->library("common");				
$smsMessage = 
'Your Complaint has been received.
Your Complaint ID is '.$isAdd.'.
It may take 24 hours to get it resolved.
';					
				$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$user_info->row(0)->mobile_no,$smsMessage);
				$this->session->set_flashdata('message', 'Complain Details Submited Successfully.');
				redirect(base_url()."complain");				
			}
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Distributor' or trim($user) == 'MasterDealer' or trim($user) == 'Agent' or trim($user) == 'MLMAgent' or trim($user) == 'Customer')
				{
				$this->pageview();
				}
				else
				{redirect(base_url().'login');}																					
			}
		} 
	}	
}