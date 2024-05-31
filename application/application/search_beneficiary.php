<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_beneficiary extends CI_Controller {
            
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
                        $sender_mobile = $_POST[sender_mobile];
            
                        $ben_id = $_POST[ben_id];
                        $otp = $_POST[otp];
                        $token = "R3RxOYfeegdzYwf3MQI8EQRjqM0PLT";
            
$this->load->model('Royalcapital_balance_model');       
$RCInfo = $this->Royalcapital_balance_model->get_RoyalInfo('MYRC');
$username = $RCInfo->row(0)->username;
$pwd = $RCInfo->row(0)->password;
            
$demo = $this->common->myrc_search($username,$pwd,$sender_mobile); 
$obj = json_decode($demo,true);
$mes= $obj[message];
$status = $obj[status];
$ben_list = $obj[beneficiaryList]; 
$data = $obj[sender_details];
$response = $demo;
                          
                
                $User_id = $this->session->userdata("id");              
                
                
                if($mes == "success")
                {
                    $this->view_data['message'] = $ben_list;

                   $this->view_data['data'] = $data;
                    $this->load->view('search_beneficiary_view',$this->view_data);     
                }
                else
                {
                    $this->view_data['dataa'] = $mes;
                    $this->load->view('search_beneficiary_view',$this->view_data);     
                }
                
            }           
            else
            {
                $user=$this->session->userdata('user_type');
                if(trim($user) == 'SuperDealer' or trim($user) == 'Distributor' or trim($user) == 'MasterDealer' or trim($user) == 'Agent' or trim($user) == 'APIUSER' or trim($user) == 'Customer')
                {
                    $this->view_data['message'] ="";
                    $this->load->view('search_beneficiary_view',$this->view_data);     
                }
                else
                {redirect(base_url().'login');}                                                                                 
            }
        } 
    }   
}
