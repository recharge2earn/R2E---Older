<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class D_mdealer_form1 extends CI_Controller {

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

		if($this->input->post("btnSubmit")){
				$Retailername = $this->input->post("txtRetailerName",TRUE);
				$Parent_id = $this->session->userdata("id");
				$pan_no = $this->input->post("txtpanNo",TRUE);
				$con_per = $this->input->post("txtConPer",TRUE);
				$PostalAddr = $this->input->post("txtPostalAddr",TRUE);
				$Pin = $this->input->post("txtPin",TRUE);
				$State = $this->input->post("ddlState",TRUE);
				$City = $this->input->post("ddlCity",TRUE);
				$MobNo = $this->input->post("txtMobNo",TRUE);
				$LandNo = $this->input->post("txtLandNo",TRUE);
				$RetType = $this->input->post("ddlRetType",TRUE);
				$Email = $this->input->post("txtEmail",TRUE);
				$stateCode = $this->input->post("hidStateCode",TRUE);
				$Scheme_id = $this->input->post("ddlSchDesc",TRUE);
				$WorLimit = $this->input->post("txtWorLimit",TRUE);
				$Scheme_amt = $this->input->post("hid_scheme_amount",TRUE);

				$total_amt = $WorLimit + $Scheme_amt;
				$this->load->model('Recharge_home_model');
				$current_balance = $this->Recharge_home_model->GetBalanceByUser($this->session->userdata('id'));
				if($current_balance - $total_amt >= 0) // Check current user have sufficent balance
				{
				$this->load->model('Admin_d_registration_model');
				if($this->Admin_d_registration_model->find_mobile_exist($MobNo))
				{
					$user_id=$this->Admin_d_registration_model->add($Retailername,$Parent_id,$PostalAddr,$Pin,$State,$City,$MobNo,$LandNo,$RetType,$Email,$Scheme_id,$WorLimit,$Scheme_amt,'MasterDealer',$pan_no,$con_per);
					$UserName = "RLID".$user_id;
					$Password = $this->common->GetPassword();
					$this->Admin_d_registration_model->update($UserName,$Password,$user_id);
					$to = $Email;
					$subject = $this->common_value->getSubject();
					$message = $this->common_value->getEmailMessage($UserName,$Password,$Retailername);
					$from = $this->common_value->getFromEmail();
					$headers = "From:" . $from;
					$headers .= "\nContent-Type: text/html";
					mail($to,$subject,$message,$headers);
$smsMessage =
'Your account has been successfully created.User Name : '.$UserName.'Password : '.$Password.'www.a2zpay.biz';
					$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$MobNo,$smsMessage);
					$this->session->set_flashdata('message', 'Distributor Account Create Successfully.');
				redirect("d_mdealer_form1");
				}
				else //If mobile no exist then Give message
				{
					$data['message'] = $MobNo." - Mobile no already registered.";
					$this->load->view('d_mdealer_form1_view',$data);
				}
				}
				else
				{
					$data['message'] = "You don't have sifficent balance to create account.<br />To Create this account you need $total_amt amount topup.";
					$this->load->view('d_mdealer_form1_view',$data);
				}


			}else
		{$data['message']='';$this->load->view('d_mdealer_form1_view',$data);}
	}
	}
}
?>