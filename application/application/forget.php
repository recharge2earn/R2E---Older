<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class forget extends CI_Controller {
	
	public function index()
	{ 
	    if ( isset( $_POST['btnOK'] ) ) { 
	    $mobile_no = $this->input->post("mobile_no",TRUE);
        
        $this->load->model("Login_model");
        $isOK = $this->Login_model->mobile_no($mobile_no);
        if($isOK != false)
        {
            $to = $EmailID;
            $subject = $this->common_value->getForgetSubject();
            $n = rand(10e16, 10e20);
            $newPassword= $this->common->getOTP();
            $this->Login_model->UpdatePassword($newPassword,$mobile_no);
            $message = $this->common_value->getForgetEmailMessage($newPassword);
            $from = $this->common_value->getFromEmail();
            $headers = "From:" . $from;
            $headers .= "\nContent-Type: text/html";
            mail($to,$subject,$message,$headers);
            $this->load->library("common");
$smsMessage =
'Your New Password is '.$newPassword;

		//////SMS API START////
//$mobile_no = $user_info->row(0)->mobile_no;

$this->load->model('Whats_app_model');
$this->Whats_app_model->send_whats_app($mobile_no,$smsMessage);

//////SMS API END////













//$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$isOK,$smsMessage);

            $data['message'] = "Your Password has been reset. Your new password has been sent to your registered mobile";
            $this->load->view('login_view',$data);

        }
        else
        {
         $data['message'] = "Invalid User Mobile Number.";
            $this->load->view('forget_view',$data);   
        }
	    }
        else
        {
            
            $this->load->view('forget_view');
        }
			}	
			
			public function test()
			{
			    
			    $name = $_REQUEST['name'];
 $email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$message = $_REQUEST['message'];

 $data ="insert into contact(name,email,number,message) values(?,?,?,?)";

 $result  = $this->db->query($data,array($name,$email,$phone,$message));
 $result;
 
 $infomsg ="Dear ".$name." Your Enquiry has been received, We will contact you as soon as possbile ";
           
            
            $this->session->set_flashdata('message', $infomsg);
					redirect(base_url()."login");
 
			}
	}	

