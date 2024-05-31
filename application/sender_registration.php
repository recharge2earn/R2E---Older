<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sender_registration extends CI_Controller {
			
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
							
			if($this->input->post("btnSubmit") == "Submit")
			{
			$mobile = $this->input->post("mobile",true);
			$sender= $this->input->post("sendername",true);
			$pincode = $this->input->post("pincode",true);
                        $name = str_replace(' ','',$sender);
                        
$this->load->model('Royalcapital_balance_model');		
$RCInfo = $this->Royalcapital_balance_model->get_RoyalInfo('MYRC');
$username = $RCInfo->row(0)->username;
$pwd = $RCInfo->row(0)->password;
			
$demo = $this->common->myrc_sender($username,$pwd,$name,$pincode,$mobile);
$obj = json_decode($demo,true);
$mes= $obj[message];
$status = $obj[status];

$response = $demo;

							
				
				$User_id = $this->session->userdata("id");				
				
				
				if($status == "200")
				{
					$this->view_data['message'] = "<b> Sender Registered Successfully, Please Add Beneficiary Below </b>";
					$this->load->view('add_beneficiary_view',$this->view_data);		
				}
				elseif($status !== "200")
				{
				    $this->view_data['message'] = $mes;
					$this->load->view('sender_registration_view',$this->view_data);
				}
				else
				{
					$this->view_data['message'] = $response;
					$this->load->view('sender_registration_view',$this->view_data);		
				}
				
			}			
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'SuperDealer' or trim($user) == 'Distributor' or trim($user) == 'MasterDealer' or trim($user) == 'Agent' or trim($user) == 'APIUSER' or trim($user) == 'Customer')
				{
					$this->view_data['message'] = $mes;
					$this->load->view('sender_registration_view',$this->view_data);		
				}
				else
				{redirect(base_url().'login');}																					
			}
		} 
	}	
}
