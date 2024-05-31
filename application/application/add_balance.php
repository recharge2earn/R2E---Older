<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_balance extends CI_Controller {


	private $msg='';
	public function process()
	{
		if($this->session->userdata("auser_type") != "Admin")
		{
			redirect("login");exit;
		}
		if($this->Common_methods->decrypt($this->uri->segment(5)) == "Add")
		{
			if($this->input->post('btnSubmit'))
			{
			$redirect_flag = $this->Common_methods->decrypt($this->uri->segment(4));
			$amount = $this->input->post('txtAmount');
			if($amount <= 0)
			{
				$this->session->set_flashdata('user_message', 'Invalid Amount.');
				redirect($redirect_flag);
			}
			$scheme_info = $this->Userinfo_methods->getSchemeInfo($this->Common_methods->decrypt($this->uri->segment(3)));
			if($scheme_info->num_rows() == 1)
			{
				$schemeType = $scheme_info->row(0)->scheme_type;
				$flat_commPer = $scheme_info->row(0)->flat_commission;
			}
			else
			{
				$this->session->set_flashdata('user_message', 'Configuration Mission, Please assign Scheme To The User.');
				redirect($redirect_flag);
			}

			$cr_user_id = $this->input->post('hidUserID');
			$userinfo = $this->Userinfo_methods->getUserInfo($cr_user_id);
			if($userinfo->num_rows() == 0)
			{
				$this->session->set_flashdata('user_message', 'User Not Exists.');
				redirect($redirect_flag);
			}

			$this->load->model('Add_balance_model');
			$payment_type= $this->input->post('hidpaymentType');
			$remark = $this->input->post('txtRemark');
			$transaction_type = "PAYMENT";
			$dr_user_id  = $this->Userinfo_methods->getAdminId();
			$description =  $this->Insert_model->getCreditPaymentDescription($cr_user_id, $dr_user_id,$amount);

			if($this->Common_methods->CheckBalance($dr_user_id,$amount) == false)
			{
				$this->session->set_flashdata('user_message', 'You Dont Have Sufficient Balance .');
				redirect($redirect_flag);

			}
			$this->Insert_model->tblewallet_Payment_CrDrEntry($cr_user_id,$dr_user_id,$amount,$remark,$description,$payment_type);
			if($schemeType == "flat")
			{
				$payment_status = 'false';
				$flatdescription = "Flat Commission ".$flat_commPer." %  On ".$amount." Rs.";

				$flatamount = ($amount * $flat_commPer)/100;
				$this->Insert_model->tblflatcommissionEntry($cr_user_id,$amount,$flatamount,$flat_commPer,$flatdescription,"false");
			}
			$this->session->set_flashdata('user_message', 'Balance Add Successfull.');
			$bal = $this->Common_methods->getAgentBalance($cr_user_id);
			$user_info = $this->db->query("select * from tblusers where user_id = ?",array($cr_user_id));	
		$smsMessage ='Your account credited with '.$amount.', Available bal is '.$bal;
	
	
	
		//////SMS API START////
$mobile_no = $user_info->row(0)->mobile_no;

$this->load->model('Whats_app_model');
$this->Whats_app_model->send_whats_app($mobile_no,$smsMessage);

//////SMS API END////
			
			
			redirect($redirect_flag);
		}
			else
			{

		$user_id = $this->Common_methods->decrypt($this->uri->segment(3));

		$action =  $this->Common_methods->decrypt($this->uri->segment(5));
		$this->load->model('Add_balance_model');
		$this->view_data['result_users'] =$this->Add_balance_model->GetUserInfo($user_id);
		$this->load->model('recharge_home_model');
		$this->view_data['BalanceAmount'] = $this->Common_methods->getCurrentBalance($user_id);


		$this->view_data['message'] =$this->msg;
		$this->load->view('add_balance_view',$this->view_data);
		}
		}
		else if($this->Common_methods->decrypt($this->uri->segment(5)) == "Revert")
		{
			if($this->input->post('btnSubmit'))
			{
			$redirect_flag = $this->Common_methods->decrypt($this->uri->segment(4));
			$amount = $this->input->post('txtAmount');
			$dr_user_id = $this->Common_methods->decrypt($this->uri->segment(3));
			$this->load->model('Add_balance_model');
			$payment_type= $this->input->post('hidpaymentType');
			$remark = $this->input->post('txtRemark');
			$transaction_type = "REVERT_PAYMENT";
			$cr_user_id  = $this->Userinfo_methods->getAdminId();
			$description =  $this->Insert_model->getRevertPaymentDescription($cr_user_id, $dr_user_id,$amount);

			if($amount <= 0)
			{
				$this->session->set_flashdata('user_message', 'Invalid Amount.');
				redirect($redirect_flag);exit;
			}
			$userinfo = $this->Userinfo_methods->getUserInfo($dr_user_id);
			if($userinfo->num_rows() == 0)
			{
				$this->session->set_flashdata('user_message', 'User Not Exists.');
				redirect($redirect_flag);
			}

			$this->Insert_model->tblewallet_Payment_CrDrEntry($cr_user_id,$dr_user_id,$amount,$remark,$description,$payment_type);
			$this->session->set_flashdata('user_message', 'Balance Revert Successfull.');

			redirect($redirect_flag);
		}
			else
			{
				$user_id = $this->Common_methods->decrypt($this->uri->segment(3));
				$userinfo = $this->Userinfo_methods->getUserInfo($user_id);
				if($userinfo->num_rows() == 0)
				{
					$this->session->set_flashdata('user_message', 'User Not Exists.');
					redirect($redirect_flag);
				}
				$this->load->model('Add_balance_model');
				$this->view_data['result_users'] =$this->Add_balance_model->GetUserInfo($user_id);
				$this->load->model('recharge_home_model');
				$this->view_data['BalanceAmount'] = $this->Common_methods->getCurrentBalance($user_id);
				$this->view_data['message'] =$this->msg;
				$this->load->view('add_balance_view',$this->view_data);
			}
		}
	}

	/*public function back()
	{
		if($this->session->userdata("auser_type") != "Admin")
		{
			redirect("login");exit;
		}
		if($this->input->post('btnSubmit'))
		{

			$amount = $this->input->post('txtAmount');
			$dr_user_id = $this->Common_methods->decrypt($this->uri->segment(3));
			$this->load->model('Add_balance_model');
			$payment_type= $this->input->post('hidpaymentType');
			$remark = $this->input->post('txtRemark');
			$transaction_type = "REVERT_PAYMENT";
			$cr_user_id  = $this->Userinfo_methods->getAdminId();
			$description =  $this->Insert_model->getRevertPaymentDescription($cr_user_id, $dr_user_id,$amount);
			$this->Insert_model->tblewallet_Payment_CrDrEntry($cr_user_id,$dr_user_id,$amount,$remark,$description,$payment_type);
			$this->session->set_flashdata('user_message', 'Balance Revert Successfull.');
			$redirect_flag = $this->Common_methods->decrypt($this->uri->segment(4));
			redirect($redirect_flag);
		}
		else
		{
		$user_id = $this->Common_methods->decrypt($this->uri->segment(3));
		$this->load->model('Add_balance_model');
		$this->view_data['result_users'] =$this->Add_balance_model->GetUserInfo($user_id);
		$this->load->model('recharge_home_model');
		$this->view_data['BalanceAmount'] = $this->recharge_home_model->GetBalanceByUser($user_id);
		$this->view_data['message'] =$this->msg;
		$this->load->view('add_balance_view',$this->view_data);
		}
	}*/


	public function index()
	{

	}
}