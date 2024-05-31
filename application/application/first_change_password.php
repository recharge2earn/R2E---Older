<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class First_change_password extends CI_Controller {

	public function index()
	{
				$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache");
		if ($this->session->userdata('logged_in') != true)
		{
			redirect(base_url().'login');
		}
		else
		{
			$data['message']='';
			if($this->input->post("btnSubmit") == "Submit")
			{
				$oldPwd = $this->input->post("txtOldPassword",TRUE);
				$newPwd = $this->input->post("txtNewPassword",TRUE);
				$user_id = $this->session->userdata("id",TRUE);
				$this->load->model('D_change_password_model');
				if($this->D_change_password_model->update($oldPwd,$newPwd,$user_id) == true)
				{

					$user_info = $this->D_change_password_model->GetUserInfo($user_id);
					$this->load->library("common");
$smsMessage =
'Your password has been updated successfully.New Password : '.$newPwd.',';

					$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$user_info->row(0)->mobile_no,$smsMessage);


					$this->session->set_flashdata('message', 'Password change successfully.');
					redirect('recharge_home');
				}
				else
				{
					$this->view_data['message'] ="Old password does not match. Try Again!";
					$this->load->view('first_change_password_view',$this->view_data);
				}
			}
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Agent')
				{
					$this->view_data['message'] ="";
					$this->load->view('first_change_password_view',$this->view_data);
				}
				else
				{redirect(base_url().'login');}
			}
		}
	}
}