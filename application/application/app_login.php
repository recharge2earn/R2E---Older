<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_login extends CI_Controller {
	public function index()
	{
		if($this->input->post("btnLogin"))
		{
			$this->dologin();
		}
		else if($this->input->post("btnRegister"))
		{
			$emailID= $this->input->post("txtEmail",TRUE);
			$Name= $this->input->post("txtName",TRUE);
			$Mobile= $this->input->post("txtMobile",TRUE);
			if($this->Login_model->find_mobile_exist($Mobile))
			{
			if($this->Login_model->add($emailID,$Name,$Mobile) == TRUE)
			{
				$this->load->library("common");
				$UserName  =  substr($Name,0,3)."".$this->session->userdata('user_id');
				$Password = $this->common->GetPassword();
				if($this->Login_model->update($UserName,$Password,$this->session->userdata('user_id')))
				{
					$to = $emailID;
					$subject = $this->common_value->getSubject();
					$message = $this->common_value->getEmailMessage($UserName,$Password);
					$from = $this->common_value->getFromEmail();
					$headers = "From:" . $from;
					$headers .= "\nContent-Type: text/html";
					mail($to,$subject,$message,$headers);
					$this->session->unset_userdata('user_id');
$smsMessage =
'Your account has been successfully created.User Name : '.$UserName.'Password : '.$Password.'';
					$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$Mobile,$smsMessage);
					$this->session->set_flashdata('message', 'Registration Form Details Submited Successfully.<br/>
					Check your email account for username and password details.');
					redirect(base_url()."app_login");
				}
			}
			}
			else
			{
				$data['message'] = $Mobile." - Mobile no already registered.";
				$this->load->view('app_login_view',$data);
			}
		}
		else
		{
			$data = array('message' => '');
			$this->load->view('app_login_view',$data);
		}
	}
	public function username()
	{
		$EmailID = $this->input->post("txtForgerUser_Email",TRUE);
		$MobileNo = $this->input->post("txtForgetMobileNo",TRUE);
		$this->load->model("Login_model");
		$result = $this->Login_model->findMobile($EmailID,$MobileNo);
		if($result == false)
		{
			$data['message'] = "Account not exist for this email id.";
			$this->load->view('app_login_view',$data);
		}
		else
		{
			$to = $EmailID;
			$subject = $this->common_value->getForgetUserNameSubject();
			$userName=$result->row(0)->username;
			$message = $this->common_value->getForgetUserNameMessage($userName);
			$from = $this->common_value->getFromEmail();
			$headers = "From:" . $from;
			$headers .= "\nContent-Type: text/html";
			mail($to,$subject,$message,$headers);
			$data['message'] = "Check your email account to show your user name.";
			$this->load->view('app_login_view',$data);
		}
	}
	public function forget()
	{
		$EmailID = $this->input->post("txtForgerEmail",TRUE);
		$UserName = $this->input->post("txtForgetUserName",TRUE);
		$this->load->model("Login_model");
		$isOK = $this->Login_model->findEmailID($EmailID,$UserName);
		if($isOK != false)
		{
			$to = $EmailID;
			$subject = $this->common_value->getForgetSubject();
			$n = rand(10e16, 10e20);
			$newPassword=base_convert($n, 10, 36);
			$this->Login_model->UpdatePassword($EmailID,$UserName,$newPassword);
			$message = $this->common_value->getForgetEmailMessage($newPassword);
			$from = $this->common_value->getFromEmail();
			$headers = "From:" . $from;
			$headers .= "\nContent-Type: text/html";
			mail($to,$subject,$message,$headers);
			$this->load->library("common");
$smsMessage =
'Your password has been reset.Password : '.$newPassword.'';
$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$isOK,$smsMessage);

			$data['message'] = "Your Password has been reset. Your new password has been sent to your registered mobile number.";
			$this->load->view('app_login_view',$data);

		}
		else
		{
			$data['message'] = "Account not exist , Please input correct Username and email id. ";
			$this->load->view('login_new',$data);
		}
	}
	public function dologin()
	{
		$uname = $this->input->post("username",TRUE);
		$upwd = $this->input->post("password",TRUE);
		$id = $this->Login_model->check_login($uname,$upwd);
		if($id == false)
		{
			$data['message'] = "Invalid User name or Password.";
			$this->load->view('app_login_view',$data);
		}
		else
		{
			if($id == 'Not Active')
			{
				$data['message'] = "Your Account Details Not Activated!";
				$this->load->view('app_login_view',$data);
			}
			else
			{

				$usertype = $this->session->userdata('user_type');

				if($this->session->userdata('alogged_in') == true)
				{
					redirect("admin_control");
				}
				if($usertype == "Agent")
				{

						redirect("recharge_zone");

				}
				if($usertype == "MasterDealer")
				{
						redirect("recharge_zone");

				}
				if($usertype == "Distributor")
				{
					redirect("recharge_zone");
				}
			}
		}
	}
}