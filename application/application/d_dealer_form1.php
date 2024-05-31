<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class D_dealer_form1 extends CI_Controller {

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
				$distributer_name = $this->input->post("txtDistname",TRUE);
				$parent_id = $this->session->userdata("id");
				$pan_no = $this->input->post("txtpanNo",TRUE);
				$contact_person = $this->input->post("txtConPer",TRUE);
				$postal_address = $this->input->post("txtPostalAddr",TRUE);
				$pincode = $this->input->post("txtPin",TRUE);
				$state_id = $this->input->post("ddlState",TRUE);
				$city_id = $this->input->post("ddlCity",TRUE);
				$mobile_no = $this->input->post("txtMobNo",TRUE);
				$landline = $this->input->post("txtLandNo",TRUE);
				$retailer_type_id = $this->input->post("ddlRetType",TRUE);
				$emailid = $this->input->post("txtEmail",TRUE);
				$stateCode = $this->input->post("hidStateCode",TRUE);
				$scheme_id = $this->input->post("ddlSchDesc",TRUE);
				$working_limit = $this->input->post("txtWorLimit",TRUE);
				$usertype_name = "Distributor";
				$status = 1;
				$username = $this->Common_methods->getNewUserId($usertype_name);
				$password = $this->common->GetPassword();
				$current_balance = $this->Common_methods->getAgentBalance($parent_id);
				if($current_balance < $working_limit)
				{
						$reg_data = array(
					'distributer_name'=>$distributer_name,
					'parent_id'=>$parent_id ,
					'pan_no'=>$pan_no,
					'contact_person'=>$contact_person,
					'postal_address'=>$postal_address,
					'pincode'=>$pincode,
					'state_id'=>$state_id,
					'city_id'=>$city_id,
					'mobile_no'=>$mobile_no,
					'landline'=>$landline,
					'retailer_type_id'=>$retailer_type_id,
					'emailid'=>$emailid,
					'stateCode'=>$stateCode,
					'scheme_id'=>$scheme_id,
					'working_limit'=>$working_limit
				);
					$data['flag'] = 'mobileExist';
					$data['regData'] = $reg_data;
					$data['message'] = "Insufficient Fund";
					$this->load->view('d_dealer_form1_view',$data);

					return 0;
				}
				$this->load->model('Admin_d_registration_model');
				if($this->Admin_d_registration_model->find_mobile_exist($mobile_no))
				{
					$this->Insert_model->tblusers_registration_Entry($parent_id,$distributer_name,$postal_address,$pincode,$state_id,$city_id,$contact_person,$mobile_no,$landline,$retailer_type_id,$emailid,$usertype_name,$status,$scheme_id,$working_limit,$username,$password,$working_limit,0,0,0,0,0,0);
					$this->Common_methods->Increment_id("Distributor");
					$to = $emailid;
					$subject = $this->common_value->getSubject();
					$name = $distributer_name;
					$message = $this->common_value->getEmailMessage($username,$password,$distributer_name);
					$from = $this->common_value->getFromEmail();
					$headers = "From:" . $from;
					$headers .= "\nContent-Type: text/html";
					mail($to,$subject,$message,$headers);

	$smsMessage = 'Congratulations *' . $distributer_name . '*!' . "\n" .
 'Your account has been created successfully.' . "\n\n" .
    '*Your login details:*' . "\n" .
    'Mobile No: ' . $mobile_no . "\n" .
    'Password: ' . $password . "\n\n" .
    'Regards' . "\n" . 'RechargeToEarn';

	$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$mobile_no,$smsMessage);

		//////SMS API START////
//$mobile_no = $user_info->row(0)->mobile_no;

$this->load->model('Whats_app_model');
$this->Whats_app_model->send_whats_app($mobile_no,$smsMessage);

//////SMS API END////

					$this->session->set_flashdata('message', 'Account Create Successfully.');
				redirect("d_dealer_form1");
				}
				else //If mobile no exist then Give message
				{	$reg_data = array(
					'distributer_name'=>$distributer_name,
					'parent_id'=>$parent_id ,
					'pan_no'=>$pan_no,
					'contact_person'=>$contact_person,
					'postal_address'=>$postal_address,
					'pincode'=>$pincode,
					'state_id'=>$state_id,
					'city_id'=>$city_id,
					'mobile_no'=>$mobile_no,
					'landline'=>$landline,
					'retailer_type_id'=>$retailer_type_id,
					'emailid'=>$emailid,
					'stateCode'=>$stateCode,
					'scheme_id'=>$scheme_id,
					'working_limit'=>$working_limit
				);
					$data['flag'] = 'mobileExist';
					$data['regData'] = $reg_data;
					$data['message'] = $mobile_no." - Mobile no already registered.";
					$this->load->view('d_dealer_form1_view',$data);
				}

			}
		else
		{
			$reg_data = array(
					'distributer_name'=>'',
					'parent_id'=>'' ,
					'pan_no'=>'',
					'contact_person'=>'',
					'postal_address'=>'',
					'pincode'=>'',
					'state_id'=>'',
					'city_id'=>'',
					'mobile_no'=>'',
					'landline'=>'',
					'retailer_type_id'=>'',
					'emailid'=>'',
					'stateCode'=>'',
					'scheme_id'=>'',
					'working_limit'=>''
				);
					$data['flag'] = 'mobileExist';
					$data['regData'] = $reg_data;
			$data['message']='';
			$this->load->view('d_dealer_form1_view',$data);}
	}
	}
}
?>