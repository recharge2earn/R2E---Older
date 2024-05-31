<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_beneficiary extends CI_Controller {
			
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
			$sender_mobile = $_POST[sender_mobile ];
			$name = $_POST[ben_name];
			$ben_mobile = $_POST[ben_mobile];
                        $ben_account = $_POST[ben_account];
                        $ifsc = $_POST[ifsc];
                        
                        $ben_name = str_replace(' ','',$name);
			
$this->load->model('Royalcapital_balance_model');       
$RCInfo = $this->Royalcapital_balance_model->get_RoyalInfo('MYRC');
$username = $RCInfo->row(0)->username;
$password = $RCInfo->row(0)->password;
            
 $demo = $this->common->myrc_add($username,$password,$sender_mobile,$ben_name,$ben_mobile,$ben_account,$ifsc);
$obj = json_decode($demo,true);
$mes= $obj[message];
$status = $obj[status];
$ben_id = $obj[ben_id];
$response = $demo;

							
				
				$User_id = $this->session->userdata("id");				
				
				
				if($status == "200")
				{
					$this->view_data['message'] = $mes." Your Beneficiary id is <b>".$ben_id."</b>";
					$this->load->view('verify_beneficiary_view',$this->view_data);
		
				}
				elseif($status !== "200")
                {
                    $this->view_data['message'] = $mes;
                    $this->load->view('add_beneficiary_view',$this->view_data);
                }
                else
                {
                    $this->view_data['message'] = $response;
                    $this->load->view('add_beneficiary_view',$this->view_data);     
                }
				
			}			
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'SuperDealer' or trim($user) == 'Distributor' or trim($user) == 'MasterDealer' or trim($user) == 'Agent' or trim($user) == 'APIUSER' or trim($user) == 'Customer')
				{
					$this->view_data['message'] ="";
					$this->load->view('add_beneficiary_view',$this->view_data);		
				}
				else
				{redirect(base_url().'login');}																					
			}
		} 
	}	
}
