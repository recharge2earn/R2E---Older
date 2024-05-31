<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_fund extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{
		$start_row = $this->uri->segment(3);
		$per_page = $this->common_value->getPerPage();
		if(trim($start_row) == ""){$start_row = 0;}
		$this->load->model('Payment_request_model');
		$result = $this->Payment_request_model->get_payment_request($this->session->userdata('id'));
		$total_row = $result->num_rows();		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."add_fund/pageview";
		$config['total_rows'] = $total_row;
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config); 
		$this->view_data['pagination'] = $this->pagination->create_links();
		$this->view_data['result_payment'] = $this->Payment_request_model->get_payment_request_limited($start_row,$per_page,$this->session->userdata('id'));
		$this->view_data['message'] =$this->msg;
		$this->load->view('add_fund_view',$this->view_data);		
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
			if($this->input->post("btnSubmit") == 'Submit')
			{								
				$request_amount = $this->input->post("txtReqamt",TRUE);
				$payment_date = $this->input->post("txtPaymentdate",TRUE);
				$payment_mode = $this->input->post("ddlDepositBank",TRUE);
				$deposite_time = "";
				$cheque_no = $this->input->post("txtChaqueno",TRUE);
				$cheque_date = "";				
				$client_bank_id = "";								
				$bank_id = $this->input->post("ddlDepositBank",TRUE);
				$remarks = $this->input->post("txtRemarks",TRUE);				
				$user_id =$this->session->userdata("id");						$str_query = "select * from tblpaymentrequest where `tblpaymentrequest`.cheque_no=?";
		$result = $this->db->query($str_query,array($cheque_no));	
		
		if($result->num_rows() == 1)
		{
			$this->session->set_flashdata('message', 'Dublicate Bank Ref no..');
					redirect(base_url()."add_fund");exit;
		}
				
				$this->load->model('Payment_request_model');
				if($this->Payment_request_model->addRequest($request_amount,$payment_date,$payment_mode,$deposite_time,$cheque_no,$cheque_date,$bank_id,$client_bank_id,$remarks,$user_id) == true)
				{
					$this->session->set_flashdata('message', 'Payment Request Submit Successfully.');
					redirect(base_url()."add_fund");					
				}				
			}			
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'MasterDealer' or trim($user) == 'Distributor' or trim($user) == 'Agent')
				{
				$this->pageview();
				}
				else
				{redirect(base_url().'login');}																					
			}
		} 
	}	
}