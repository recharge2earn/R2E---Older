<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Retailer_form1 extends CI_Controller {
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
				$DistId = $this->input->post("txtDistname",TRUE);
				$DistName = $this->input->post("hidDistname",TRUE);
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
				$stateCode = $this->input->post("hidStateCode",TRUE);
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
				$this->load->model('Retailer_form1_model');
				if($this->Retailer_form1_model->find_mobile_exist($MobNo))
				{
					//$form1_data = array('RetailerName'=>$RetailerName,'DistId'=>$DistId,'DistName'=>$DistName,'PostalAddr'=>$PostalAddr,'Landmark'=>$Landmark,'Pin'=>$Pin,'State'=>$State,'City'=>$City,'Area'=>$Area,'ConPer'=>$ConPer,'MobNo'=>$MobNo,'LandNo'=>$LandNo,'RetType'=>$RetType,'Email'=>$Email,'Other_Area'=>$Other_Area,'stateCode'=>$stateCode);
//					$this->session->set_userdata($form1_data);
//					redirect("retailer_form2");

					$user_id=$this->Retailer_form1_model->add($RetailerName,$DistId,$PostalAddr,$Landmark,$Pin,$State,$City,$Area,$ConPer,$MobNo,$LandNo,$RetType,$Email,$DistName,$Other_Area,$Bank1,$AcNo1,$AcType1,$Org,$PreLang,$Bank2,$AcNo2,$AccType2,$Scheme_id,$PayMode,$ChqDDNo,$ChqDDDate,$DepBank,$WorLimit,$Scheme_amt);
					$UserName = "SI".$user_id."".$DistId;
					$Password = $this->common->GetPassword();
					$this->Retailer_form1_model->update($UserName,$Password,$user_id);
					$to = $Email;
					$subject = $this->common_value->getSubject();
					$message = $this->common_value->getEmailMessage($UserName,$Password);
					$from = $this->common_value->getFromEmail();
					$headers = "From:" . $from;
					$headers .= "\nContent-Type: text/html";
					mail($to,$subject,$message,$headers);
$smsMessage =
'Your account has been successfully created.User Name : '.$UserName.'Password : '.$Password.'www.a2zpay.biz';
					$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$MobNo,$smsMessage);
					$this->session->set_flashdata('message', 'Account Create Successfully.');
					redirect("retailer_form1");

				}
				else //If mobile no exist then Give message
				{
					$data['message'] = $MobNo." - Mobile no already registered.";
					$this->load->view('retailer_form1_view',$data);
				}
			}
			else
			{$data['message']='';$this->load->view('retailer_form1_view',$data);}
		}
	}
}
