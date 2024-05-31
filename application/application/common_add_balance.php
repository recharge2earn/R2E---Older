<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_add_balance extends CI_Controller {
	

	private $msg='';
	public function process()
	{
		//echo $this->session->userdata("user_type");exit;
		if($this->session->userdata("user_type") != "MasterDealer" and $this->session->userdata("user_type") != "Distributor")
		{
			redirect("login");exit;
		}
		if($this->input->post('btnSubmit'))
		{	
			$redirect_flag = $this->Common_methods->decrypt($this->uri->segment(4));
			$amount = $this->input->post('txtAmount');
			
			if($this->Common_methods->decrypt($this->uri->segment(5)) == "Add")
			{
				$cr_user_id = $this->input->post('hidUserID');
				$dr_user_id  = $this->session->userdata("id");
				if($this->Common_methods->CheckBalance($dr_user_id,$amount) == false)
				{
					$this->session->set_flashdata('user_message', 'You Dont Have Sufficient Balance .');	
					redirect($redirect_flag);			
					
				}
					$response = $this->Common_methods->DealerAddBalance($dr_user_id,$cr_user_id,$amount);
					$bal = $this->Common_methods->getAgentBalance($cr_user_id);
			$user_info = $this->db->query("select * from tblusers where user_id = ?",array($cr_user_id));
			$smsMessageCUSTOMER = "Dear Business Partner, Your Received Amount is ".$amount.", Your Updated Balance is ".($bal).", ";
$message2  = $smsMessageCUSTOMER;				
				$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$user_info->row(0)->mobile_no,$message2);
					$this->session->set_flashdata('user_message', $response);	
					redirect($redirect_flag);
					
			}
			if($this->Common_methods->decrypt($this->uri->segment(5)) == "Revert")
			{
				//echo $this->Common_methods->decrypt($this->uri->segment(4));exit;
				$amount = $this->input->post('txtAmount');
				$dr_user_id = $this->input->post('hidUserID');
				$this->load->model('Add_balance_model');	
				$payment_type= $this->input->post('hidpaymentType');
				$remark = $this->input->post('txtRemark');
				$otp = $this->input->post('txtOTP');
				$transaction_type = "REVERT_PAYMENT";
				$cr_user_id  = $this->session->userdata("id");
				$resp = $this->Userinfo_methods->validateOTP($dr_user_id,$otp);
				if($resp == true)
				{
					
					$this->session->set_flashdata('user_message', 'Invalid OTP.');	
					$redirect_flag = $this->Common_methods->decrypt($this->uri->segment(4));
					redirect($redirect_flag);
				}
				else
				{

					if($this->Userinfo_methods->checkBalance($dr_user_id,$amount) == true)
					{
						
						$response = $this->Common_methods->DealerRevertBalance($dr_user_id,$cr_user_id,$amount);
						$this->session->set_flashdata('user_message', $response);	
						$redirect_flag = $this->Common_methods->decrypt($this->uri->segment(4));
						redirect($redirect_flag);
					}
					else
					{
						
						$this->session->set_flashdata('user_message', 'Insufficient Funds.');	
						$redirect_flag = $this->Common_methods->decrypt($this->uri->segment(4));
						redirect($redirect_flag);
					}
					
				}
				
			}
				
		}	
		else
		{
			
			$user_id = $this->Common_methods->decrypt($this->uri->segment(3));
			if($this->Common_methods->decrypt($this->uri->segment(5)) == "Revert")
			{
				$otp = $this->common->getOTP();
				$str_query ="update tblusers set otp = ? where user_id = ?";
				$rslt = $this->db->query($str_query,array($otp,$user_id));
			}
		
		
		$action =  $this->Common_methods->decrypt($this->uri->segment(5));
		$this->load->model('Add_balance_model');
		$this->view_data['result_users'] =$this->Add_balance_model->GetUserInfo($user_id);		
		$this->load->model('Common_methods');
		$this->view_data['BalanceAmount'] = $this->Common_methods->getAgentBalance($user_id);
		
		
		$this->view_data['message'] =$this->msg;
		$this->view_data['flag'] ="revert";
		$this->load->view('common_add_balance_view',$this->view_data);	
		}
	}
	
	public function index() 
	{
			
	}	
}