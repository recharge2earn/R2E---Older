<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_registration extends CI_Controller {
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
			if($this->input->post("btnSubmit"))
			{
				$RetailerName = $this->input->post("txtFranName",TRUE);
				$DistId = $this->session->userdata("id");
				$DistName = $this->session->userdata("Welcome_Dist");
				$PostalAddr = $this->input->post("txtPostalAddr",TRUE);
				$Landmark = $this->input->post("txtLandmark",TRUE);
				$Pin = $this->input->post("txtPin",TRUE);
				$State = $this->input->post("ddlState",TRUE);
				$City = $this->input->post("ddlCity",TRUE);
				$Area = "";
				$ConPer = $this->input->post("txtConPer",TRUE);
				$MobNo = $this->input->post("txtMobNo",TRUE);
				$LandNo = $this->input->post("txtLandNo",TRUE);
				$RetType = $this->input->post("ddlRetType",TRUE);
				$Email = $this->input->post("txtEmail",TRUE);
				$Other_Area = "";
				$Bank1 = $this->input->post("ddlBank",TRUE);
				$AcNo1 = $this->input->post("txtAcNo",TRUE);
				$AcType1 = $this->input->post("ddlAcType",TRUE);
				$Org = $this->input->post("ddlOrg",TRUE);
				$PreLang = $this->input->post("ddlPreLang",TRUE);
				$Bank2 = $this->input->post("ddlAddBank",TRUE);
				$AcNo2 = $this->input->post("txtAddAcNo2",TRUE);
				$AccType2 = $this->input->post("ddlAcType_2",TRUE);
				$Scheme_id = $this->input->post("ddlSchDesc",TRUE);
				$PayMode = $this->input->post("radPayMode",TRUE);
				$ChqDDNo = $this->input->post("txtChqDDNo",TRUE);
				$ChqDDDate = $this->input->post("txtChqDDDate",TRUE);
				$DepBank = $this->input->post("ddlDepBank",TRUE);
				$WorLimit = $this->input->post("txtWorLimit",TRUE);
				$Scheme_amt = $this->input->post("hid_scheme_amount",TRUE);
				$stateCode = 'SI'.$this->input->post("hidStateCode",TRUE);
				$total_amt = $WorLimit + $Scheme_amt;
				$this->load->model('Recharge_home_model');
				$current_balance = $this->Recharge_home_model->GetBalanceByUser($this->session->userdata('id'));
				if($current_balance - $total_amt >= 0) // Check current user have sufficent balance
				{
				$this->load->model('Customer_registration_model');
				if($this->Customer_registration_model->find_mobile_exist($MobNo))
				{

$id_root=$this->Customer_registration_model->checkCustomer_Exist($this->session->userdata("id"));
if($id_root == 'true')
{
		$client_id = $this->session->userdata("id");
$user_id=$this->Customer_registration_model->add($RetailerName,$DistId,$PostalAddr,$Landmark,$Pin,$State,$City,$Area,$ConPer,$MobNo,$LandNo,$RetType,$Email,$DistName,$Other_Area,$Bank1,$AcNo1,$AcType1,$Org,$PreLang,$Bank2,$AcNo2,$AccType2,$Scheme_id,$PayMode,$ChqDDNo,$ChqDDDate,$DepBank,$WorLimit,$Scheme_amt,'root','0','1',$client_id);
}
else
{
	$level_no = $this->Customer_registration_model->getBinaryLevelNo($this->session->userdata("id"));
    $parent_id = $this->Customer_registration_model->getBinaryParentID($this->session->userdata("id"));
	//echo 'hi....'.$parent_id;exit;
	$Order_No = $this->Customer_registration_model->getOrderNo($this->session->userdata("id"));
	$client_id = $this->session->userdata("id");
	$side = 'left';
	$user_id=$this->Customer_registration_model->add($RetailerName,$parent_id,$PostalAddr,$Landmark,$Pin,$State,$City,$Area,$ConPer,$MobNo,$LandNo,$RetType,$Email,$DistName,$Other_Area,$Bank1,$AcNo1,$AcType1,$Org,$PreLang,$Bank2,$AcNo2,$AccType2,$Scheme_id,$PayMode,$ChqDDNo,$ChqDDDate,$DepBank,$WorLimit,$Scheme_amt,$side,$level_no,$Order_No,$client_id);
}
					$UserName = "SI".$user_id;
					$Password = $this->common->GetPassword();
					$commission_user = $this->Customer_registration_model->getAllParent($user_id);
					$this->Customer_registration_model->update($UserName,$Password,$user_id,$commission_user);
					$this->db->query("insert into tblbalance(user_id,bal) values(?,?)",array($user_id,'0'));

					//$to = $Email;
//					$subject = $this->common_value->getSubject();
//					$message = $this->common_value->getEmailMessage($UserName,$Password);
//					$from = $this->common_value->getFromEmail();
//					$headers = "From:" . $from;
//					$headers .= "\nContent-Type: text/html";
//					mail($to,$subject,$message,$headers);
$smsMessage =
'Your account has been successfully created.User Name : '.$UserName.'Password : '.$Password.'www.a2zpay.biz';
					$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$MobNo,$smsMessage);
					$this->session->set_flashdata('message', 'Account Create Successfully. Check your mobile number to login id and password.');
					redirect("customer_registration");
				}
				else //If mobile no exist then Give message
				{
					$data['message'] = $MobNo." - Mobile no already registered.";
					$this->load->view('customer_registration_view',$data);
				}
				}
				else
				{
					$data['message'] = "You don't have sifficent balance to create account.<br />To Create this account you need $total_amt amount topup.";
					$this->load->view('customer_registration_view',$data);
				}
			}
			else
			{$data['message']='';$this->load->view('customer_registration_view',$data);}
		}
	}
	}