<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_add_balance extends CI_Controller {


	private $msg='';
	public function process()
	{
		if($this->input->post('btnSubmit'))
		{
			$amount = $this->input->post('txtAmount');
			$cr_user_id = $this->input->post('hidUserID');
			$this->load->model('Customer_add_balance_model');
			$this->load->model('Recharge_home_model');
			$current_balance = $this->Recharge_home_model->GetBalanceByUser($this->session->userdata('id'));
			if($current_balance - $amount >= 0)
			{
			if($this->Customer_add_balance_model->add_newbalance($cr_user_id,$amount) == true)
			{
				$user_info = $this->Customer_add_balance_model->GetUserInfo($cr_user_id);
				$this->load->model('Recharge_home_model');
				$bal = $this->Recharge_home_model->GetBalanceByUser($cr_user_id);
				$this->load->library("common");
$smsMessage =
'Dear Business Partner,Your Deposit Amount is '.$amount.',Your Updated Balance is '.$bal.',www.akashmobileworld.com';
				$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$user_info->row(0)->mobile_no,$smsMessage);

			$this->session->set_flashdata('user_message', 'Balance Add Successfull.');
			redirect("search_customer");
			}
			}
			else
			{
				$this->session->set_flashdata('user_message', 'Balance is not sufficent');
				redirect("search_customer");
			}
		}
		else
		{
		$user_id = $this->uri->segment(3);
		$this->load->model('Customer_add_balance_model');
		$this->view_data['result_customer'] =$this->Customer_add_balance_model->get_customer($user_id);
		$this->load->model('recharge_home_model');
		$this->view_data['BalanceAmount'] = $this->recharge_home_model->GetBalanceByUser($user_id);
		$this->view_data['message'] =$this->msg;
		$this->load->view('customer_add_balance_view',$this->view_data);
		}
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
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Customer')
				{
				$this->pageview();
				}
				else
				{redirect(base_url().'login');}
		}
	}
}