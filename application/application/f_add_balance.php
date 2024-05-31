<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class F_add_balance extends CI_Controller {
	private $msg='';
	public function process()
	{
		if($this->input->post('btnSubmit'))
		{
			$amount = $this->input->post('txtAmount');
			$cr_user_id = $this->input->post('hidUserID');
			$name = $this->input->post('hidName');
			$this->load->model('Recharge_home_model');
			$current_balance = $this->Recharge_home_model->GetBalanceByUser($this->session->userdata('id'));
			if($current_balance - $amount >= 0)
			{
				$this->load->model('F_add_balance_model');
				if($this->F_add_balance_model->add_newbalance($cr_user_id,$amount) == true)
				{
				$user_info = $this->F_add_balance_model->GetUserInfo($cr_user_id);
				$dist_user_info = $this->F_add_balance_model->GetUserInfo($this->session->userdata('id'));
				$this->load->model('Recharge_home_model');
				$retailer_balance = $this->Recharge_home_model->GetBalanceByUser($cr_user_id);
				$this->load->library("common");
$smsMessageDIST =
'Dear Business Partner,Your Transfered Amount is '.$amount.' to '.$name.',Your Updated Balance is '.($retailer_balance).' from '.$this->session->userdata('Welcome_Dist').' ,www.a2zpay.biz';

$smsMessageRET ='Dear Franchisee,Your Received Amount is '.$amount.',Your Updated Balance is '.($retailer_balance).' from '.$this->session->userdata('Welcome_Dist').' ,www.a2zpay.biz';

				$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$user_info->row(0)->mobile_no,$smsMessageRET);

				$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$dist_user_info->row(0)->mobile_no,$smsMessageDIST);

				$this->session->set_flashdata('user_message', 'Balance Add Successfull.');
				redirect("list_distributer");
				}
			}
			else
			{
				$this->session->set_flashdata('user_message', 'Balance is not sufficent');
				redirect("list_distributer");
			}
		}
		else
		{
		$user_id = $this->uri->segment(3);
		$this->load->model('F_add_balance_model');
		$this->view_data['result_retailer'] =$this->F_add_balance_model->get_distributor($user_id);
		$this->load->model('Recharge_home_model');
		$this->view_data['BalanceAmount'] = $this->Recharge_home_model->GetBalanceByUser($user_id);
		$this->view_data['message'] =$this->msg;
		$this->load->view('f_add_balance_view',$this->view_data);
		}
	}

}