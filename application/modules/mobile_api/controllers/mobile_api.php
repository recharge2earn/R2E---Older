<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mobile_api extends MX_Controller {	
	public function index()
	{
	    
	        echo '<html><head>
    <meta charset="utf-8">

    <title>Response</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

</head>

<body> ';
	    
	  echo  "<h1>Thank your for Using UPI Payment GATEWAY</h1>";
	  
	   echo "<script>window.close();</script>";
	  
	  echo '</body></html>';
	    
	}
	
public function send_whatsapp($number,$message)
{
    
   // $number = $this->get_whatsapp_number();
   // $number = "917908309992";
  //  $message = "ALL DTH RECHARGE WORKING FINE WITH HIGHER MARGIN , KINDLY DIVERT YOUR FULL TRAFFIC TO MYRC API";
    
    
    $msg = str_replace(" ","%20",$message);
    
    $arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  

 $buffer = file_get_contents("https://whatsbot.tech/api/send_sms?api_token=a3d625f0-624b-4bf2-a64f-66d2e994018e&mobile=91".$number."&message=".$msg, false, stream_context_create($arrContextOptions));

    
  
}
//OTP REGISTER SYSTEM VERSION 5.2

//STEP 1 SEND OTP
public function otp_register()
{
  
    $mobile_number = $_REQUEST['number'];
    
     $mobile_number_len = strlen($mobile_number);
    
    if($mobile_number_len < 10 or $mobile_number_len > 10)
    {
       echo "Invalid Mobile number"; exit;
    }
    elseif ($this->mobile_exist($mobile_number) == "true") {
       
       echo "Mobile Number already registered, Do forget password"; exit;
    }
    else{
         $smsMessage = " Your OTP for account registration is ".$this->temp_otp($mobile_number);
        
        			//////SMS API START////

$this->load->model('Whats_app_model');
$this->Whats_app_model->send_whats_app($mobile_number,$smsMessage);


//////SMS API END////

$json[status] = "Success";
$json[message] = "OTP Sent to your mobile number ".$mobile_number;

echo json_encode($json);

        
    }
    
    
}

// STEP 2 VERIFY OTP
public function verify_otp()
{
    $otp = $_REQUEST['otp'];
    $number = $_REQUEST['number'];
    $url = "select * from sms_outbox where message = '$otp' and to_mobile = '$number'";
    $rsp = $this->db->query($url);
    
     $result =  $rsp->row(0)->message;
    
    if($result != "")
    {
        $json[status] = "Success";
$json[message] = "OTP Verified successfully";

echo json_encode($json);
    }
    else{
        
        $json[status] = "Failure";
$json[message] = "Invalid OTP , please try again";

echo json_encode($json);
    }
    
}


//STEP 3 FINAL REGISTERATION
public function new_register()
	{
//{echo 'TEMPORARY REGISTERATION NOT ALLOWED, TO GET OUR SERVICES PLEASE CALL/WHATSAPP';exit;}
$mobile_no = $_REQUEST['number'];
 $mobile_number_len = strlen($mobile_no);
    
    if($mobile_number_len < 10 or $mobile_number_len > 10)
    {
       echo "Invalid Mobile number"; exit;
    }

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['name']) && isset($_REQUEST['number']) && isset($_REQUEST['email']) )
			{
		$distributer_name = $_REQUEST['name'];
		        $mobile_no = $_REQUEST['number'];
		        $emailid = $_REQUEST['email'];
	
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['name']) && isset($_GET['number']) && isset($_GET['email']))
			{
				$distributer_name = $_REQUEST['name'];
		        $mobile_no = $_REQUEST['number'];
		        $emailid = $_REQUEST['email'];
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}							
	
	
	
				$parent_id = "";
				$pan_no = "";
				$contact_person = "0";//status of user
				$postal_address = " ";
				$pincode = " ";
				$state_id = " ";
				$city_id = "0";
				
				$landline = "0";
				$retailer_type_id = "";
				
				$stateCode = "";
				$scheme_id = "28";
				$working_limit ="0";
				$AIR = "no";
				$MOBILE = "no";
				$DTH = "no";
				$GPRS = "no";
				$SMS = "no";
				$WEB = "no";
				$usertype_name = "Agent";
				$status = 1;
				$username = $this->Common_methods->getNewUserId($usertype_name);
				$password = $_REQUEST['password'];
				$this->load->model('Admin_d_registration_model');
				if($this->Admin_d_registration_model->find_mobile_exist($mobile_no))
				{
					$this->Insert_model->tblusers_registration_Entry($parent_id,$distributer_name,$postal_address,$pincode,$state_id,$city_id,$contact_person,$mobile_no,$landline,$retailer_type_id,$emailid,$usertype_name,$status,$scheme_id,$working_limit,$username,$password,$working_limit,$AIR,$MOBILE,$DTH,$GPRS,$SMS,$WEB);
					$this->Common_methods->Increment_id("Agent");
					$to = $emailid;
					$subject = $this->common_value->getSubject();
					$message = $this->common_value->getEmailMessage($mobile_no,$password,$distributer_name);
					$from = $this->common_value->getFromEmail();
					$headers = "From:" . $from;
					$headers .= "\nContent-Type: text/html";
					mail($to,$subject,$message,$headers);
                    $smsMessage =' Account created, Mobile number '.$mobile_no.' and  Password is '.$password;
			
			
			
			//////SMS API START////

$this->load->model('Whats_app_model');
$this->Whats_app_model->send_whats_app($mobile_no,$smsMessage);



//////SMS API END////

					
				
				echo "Congratulation! Your Account has been Created. We have sent Login details on registered mobile number. Also contact support for KYC approval" ;
                    

				}
				else //If mobile no exist then Give message
				{
					echo "Mobile number already registered. Please reset your password";
				
				}
	
	
	
	
	

	}


public function temp_otp($number)
{
      $otp = $this->common->getOTP();
      
      $url = "insert into sms_outbox(to_mobile,message) values(?,?)";
        $rsp = $this->db->query($url,array($number,$otp));
       
       if($rsp == 1)
       {
           return $otp;
       }
       
       
      
      
      
}



public function mobile_exist($number)
{
  
    $url = "select * from tblusers where mobile_no = '$number'";
    $result = $this->db->query($url);
     $num = $result->num_rows();
    
    if($num > 0)
    {
        return "true";
    }
    else{
        
        return "false";
    }
}




// END OF OTP SYSTEM	
	






//NEW UPDATE VERSION 5.1
//NEW UPDATE DATE 31 MARCH 2022

function agenet_list()
	{
	   $username = $_REQUEST['username'];
			    $pwd =  $_REQUEST['pwd'];
			    $parent_id = $_REQUEST['user_id'];
			    	$this->load->model('Mobile_api_model');

	    	$AUTHENTICATION = $this->Mobile_api_model->check_login($username,$pwd);
	    
	    if($AUTHENTICATION == true)
	    {
	        	$str_query = "select business_name, mobile_no, usertype_name, user_id, username from tblusers where parent_id=?";
		$result = $this->db->query($str_query,array($parent_id));		
		if($result->num_rows() > 0)
		{
			
			 $result = $result->result();
			
		//	echo json_encode($result);
		
		$resultArray = array();
			
			foreach ($result as $value)
			{
			    $response["business_name"] = $value->business_name;
$response["user_id"] = $value->user_id;
$response["usertype_name"] = $value->usertype_name;

$response["username"] = $value->username;	
$response["mobile_no"] = $value->mobile_no;	

$response["balance"] = $this->Common_methods->getCurrentBalance($value->user_id);

$resultArray[] = $response;


			}
			
	echo json_encode($resultArray);		
			
		}
		else
		{
			 $response["business_name"] = "0";
$response["user_id"] = "0";
$response["usertype_name"] = "0";

$response["username"] = "0";	
$response["mobile_no"] = "0";

$response["balance"] = "0";

echo json_encode($response);
		}
	    }
	    
			
	}


	
		public function dashboard()
	{
	    $us_id = $_REQUEST['us_id'];
	    
	    $json[status] = "true";
	     $json[total_purchase] = $this->total_purchase($us_id);
	     $json[total_success] = $this->total_success($us_id);
	     $json[total_pending] = $this->total_pending($us_id);
	     
	     echo json_encode($json);
	}
	
	
	
		public function total_purchase($us_id)
	{
	     
	    $date = $this->common->getMySqlDate();
	    	$str_query = "select sum(credit_amount) from tblewallet where user_id='$us_id' and DATE(add_date) = '$date'  and transaction_type = 'PAYMENT'";
		$rslt = $this->db->query($str_query);
		
	
		
		foreach ($rslt->result_array() as $row)
		
		{
		    	 $success = $row['sum(credit_amount)'];
		    	 
		    	  if($success !=""){
		    
		    return $row['sum(credit_amount)'];
		    
		    }
		    else{
		        
		        return "0";
		    }
		    
		}


		
	}
	
		public function total_success($us_id)
	{
	   
	    
	    $date = $this->common->getMySqlDate();
	    	$str_query = "select sum(amount) from tblrecharge where user_id='$us_id' and recharge_date='$date' and recharge_status='Success'";
		$rslt = $this->db->query($str_query);
		
	
		
		foreach ($rslt->result_array() as $row)
		{
		    $success = $row['sum(amount)'];
		    
		    if($success !=""){
		    
		    return $success = $row['sum(amount)'];
		    
		    }
		    else{
		        
		        return "0";
		    }
		}


		
	}
	
	
		public function total_pending($us_id)
	{
	 
	    
	    $date = $this->common->getMySqlDate();
	    	$str_query = "select sum(commission_amount) from tblrecharge where user_id='$us_id' and recharge_date='$date' and recharge_status='Success'";
		$rslt = $this->db->query($str_query);
		
	
		
		foreach ($rslt->result_array() as $row)
		{
		    $success = $row['sum(commission_amount)'];
		    
		    if($success !=""){
		    
		    return $success = $row['sum(commission_amount)'];
		    
		    }
		    else{
		        
		        return "0";
		    }
		}


		
	}
	
	
			public function bill_fetch()
	{		
	
		        $number = $_REQUEST['number'];
		        $opcode = $_REQUEST['opcode'];
		        $unit = $_REQUEST['unit'];
	

				
				$url = "http://myrc.in/plan_api/electricity?username=503261&token=1ac496420e9ed920a5c7544570861582&unit=".$unit."&number=".$number."&opcode=".$opcode;

               echo  $op_response = file_get_contents($url);

//{"Operator":"Jio","Circle":"West Bengal","product_id":97040327,"status":true,"postpaid":false,"source":"prefix"}


	
	
	}
	
// END NEW UPDATE 5.1	
	
		public function upi()
	{
	 echo "no response from bank pelase add fund manually";
	
	}

	
	public function r_offer()
	{		
	
		        $number = $_REQUEST['number'];
		        $opcode = $_REQUEST['opcode'];
	

				
				$url = "http://myrc.in/plan_api/r_offer?username=503261&plan=ROFFER&token=1ac496420e9ed920a5c7544570861582&number=".$number."&opcode=".$opcode;
               echo  $op_response = file_get_contents($url);

//{"Operator":"Jio","Circle":"West Bengal","product_id":97040327,"status":true,"postpaid":false,"source":"prefix"}


	
	
	}
	
		public function dth_info()
	{		
	
		        $number = $_REQUEST['number'];
		        $opcode = $_REQUEST['opcode'];
	

				
				$url = "http://myrc.in/plan_api/dth_info?username=501405&token=3c124f54cbdc99d6f861016e73d79e81&number=".$number."&opcode=".$opcode;

               echo  $op_response = file_get_contents($url);

//{"Operator":"Jio","Circle":"West Bengal","product_id":97040327,"status":true,"postpaid":false,"source":"prefix"}


	
	
	}	
	
	public function operator_find()
	{		
	
		        $number = $_REQUEST['number'];
		   
	

				
				$url = "https://digitalapiproxy.paytm.com/v1/mobile/getopcirclebyrange?channel=web&version=2&number=".$number."&child_site_id=1&site_id=1&locale=en-in";

                 $op_response = file_get_contents($url);

//{"Operator":"Jio","Circle":"West Bengal","product_id":97040327,"status":true,"postpaid":false,"source":"prefix"}


$json_ar = json_decode($op_response, true);

if($json_ar[Operator] == true){

$json[status] = "true";
$json[company] = $json_ar[Operator];
$json[circle] = $json_ar[Circle];
 echo json_encode($json);exit;	
}
else{
   $json[status] = "false";
    $json[company] = "false";
			    $json[message] =  "Invalid Mobile Number";
                echo json_encode($json);exit;	  
    
}

	
	
	}
	
	
	
public function agent_schem()
{
    
    $str_query = "select * from tblscheme where scheme_for='Agent'";
		$resultScheme = $this->db->query($str_query);	
		echo json_encode($resultScheme->result());
}

	public function search_user()
	{
	
	
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']))
			{
			    $username = $_REQUEST['username'];
			    $pwd =  $_REQUEST['pwd'];
			    $parent_id = $_REQUEST['user_id'];
			    $mobile_no = $_REQUEST['mobile_no'];
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']))
			{
			    $username = $_GET['username'];
			    $pwd =  $_GET['pwd'];
			    $parent_id = $_GET['user_id'];
			    $mobile_no = $_GET['mobile_no'];
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		
		$this->load->model('Mobile_api_model');
		$AUTHENTICATION = $this->Mobile_api_model->check_login($username,$pwd);
		if($AUTHENTICATION == false)
		{
			$response["status"] = "false";	
			$response["message"] = "Invalid Userd id or Password";
			$response["usertype_name"] = "false";
			echo json_encode($response);
		}
		else
		{
	$user_response = $this->Mobile_api_model->search_agent($parent_id,$mobile_no);
	if($user_response !=""){
	    	   $value = $user_response;
$response["status"] = "true";

$response["business_name"] = $value->row(0)->business_name;
$response["user_id"] = $value->row(0)->user_id;
$response["usertype_name"] = $value->row(0)->usertype_name;
$response["username"] = $value->row(0)->username;

$response["mobile_no"] = $value->row(0)->mobile_no;	

$response["balance"] = $balance = $this->Common_methods->getCurrentBalance($value->row(0)->user_id);

     
echo json_encode($response);
	}
	
	else{
	    echo "User Not Found";
	}
	

		}		
	}

	public function change_password()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['user_id']) )
			{
			    	$username = $_REQUEST["username"];
		$pwd = $_REQUEST["pwd"];
				$oldPwd = $_REQUEST['oldPwd'];
		$newPwd = $_REQUEST['newPwd'];
		
		$user_id = $_REQUEST['user_id'];
		
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']) && isset($_GET['user_id']))
			{
		$username = $_GET["username"];
		$pwd = $_GET["pwd"];
		$oldPwd = $_GET['oldPwd'];
		$newPwd = $_GET['newPwd'];
		
		$user_id = $_GET['user_id'];
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}							
		
$this->load->model('Mobile_api_model');
		$AUTHENTICATION = $this->Mobile_api_model->check_login($username,$pwd);
			if($AUTHENTICATION == false)
			{
				echo "Authentication fail!";exit(0);	
			}
			else
			{
			    
		$this->load->model('Change_password_model');
				if($this->Change_password_model->update($oldPwd,$newPwd,$user_id) == true)
				{
                echo "Password changed successfully";
					
				}
				else
				{
					echo "Old password is not matching. Try Again";
					
				}
}
	}






	public function profile()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['user_id']) )
			{
			    	$username = $_REQUEST["username"];
		$pwd = $_REQUEST["pwd"];
				$postal_address = $_REQUEST['postal_address'];
		$pincode = $_REQUEST['pincode'];
		$emailid = $_REQUEST['emailid'];
		$user_id = $_REQUEST['user_id'];
		
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']) && isset($_GET['user_id']))
			{
		$username = $_GET["username"];
		$pwd = $_GET["pwd"];
		$postal_address = $_GET['postal_address'];
		$pincode = $_GET['pincode'];
		$emailid = $_GET['emailid'];
		$user_id = $_GET['user_id'];
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}							
		
$this->load->model('Mobile_api_model');
		$AUTHENTICATION = $this->Mobile_api_model->check_login($username,$pwd);
			if($AUTHENTICATION == false)
			{
				echo "Authentication fail!";exit(0);	
			}
			else
			{
			    
		$result_recharge = $this->Mobile_api_model->profile_update($postal_address,$pincode,$emailid,$user_id,$username);
			echo $result_recharge;
}
	}



	
	
public function forget()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['number']))
			{
		 $mobile_no = $_REQUEST['number'];
	
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['number']))
			{
			
		         $mobile_no = $_REQUEST['number'];
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}							
	
	
	
	
        
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
//$result_sms = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$isOK,$smsMessage);



//////SMS API START////


$this->load->model('Whats_app_model');
$this->Whats_app_model->send_whats_app($mobile_no,$smsMessage);

//////SMS API END////




            echo "Your Password has been reset. Your new password has been sent to your registered mobile";
           

        }
        else
        {
         echo "Invalid User Mobile Number.";
            
        }		
	
	
	

	}		
	
	
	
	public function list_bank()
	{
	    $str_query = "select tbluser_bank.*,(select bank_name from tblbank where tblbank.bank_id = tbluser_bank.bank_id) as bank_name from tbluser_bank";
		$rslt = $this->db->query($str_query);
		$rslt = $rslt->result();
		echo json_encode($rslt);
	}
	
	public function add_fund()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['user_id']) )
			{
			$username = $_REQUEST['username'];
			$pwd =  $_REQUEST['pwd'];
			$user_id = $_REQUEST['user_id'];
		$request_amount = $_REQUEST['request_amount'];
		$payment_date = $_REQUEST['payment_date'];
		$payment_mode = $_REQUEST['payment_mode'];
		$deposite_time = $_REQUEST['deposite_time'];
		$cheque_no = $_REQUEST['cheque_no'];
		$cheque_date = $_REQUEST['cheque_date'];
		$bank_id = $_REQUEST['bank_id'];
		$client_bank_id = $_REQUEST['client_bank_id'];
		$remarks = $_REQUEST['remarks'];
	
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']) && isset($_GET['user_id']))
			{
			$username = $_REQUEST['username'];
			$pwd =  $_REQUEST['pwd'];
			$user_id = $_REQUEST['user_id'];
		$request_amount = $_REQUEST['request_amount'];
		$payment_date = $_REQUEST['payment_date'];
		$payment_mode = $_REQUEST['payment_mode'];
		$deposite_time = $_REQUEST['deposite_time'];
		$cheque_no = $_REQUEST['cheque_no'];
		$cheque_date = $_REQUEST['cheque_date'];
		$bank_id = $_REQUEST['bank_id'];
		$client_bank_id = $_REQUEST['client_bank_id'];
		$remarks = $_REQUEST['remarks'];
		
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}							
		$this->load->model('Mobile_api_model');
		$result_recharge = $this->Mobile_api_model->add_fund($request_amount,$payment_date,$payment_mode,$deposite_time,$cheque_no,$cheque_date,$bank_id,$client_bank_id,$remarks,$user_id);

	
			echo	$result_recharge;

	}
	
	
	
	
	public function register()
	{
//{echo 'TEMPORARY REGISTERATION NOT ALLOWED, TO GET OUR SERVICES PLEASE CALL/WHATSAPP';exit;}
$mobile_no = $_REQUEST['number'];
 $mobile_number_len = strlen($mobile_no);
    
    if($mobile_number_len < 10 or $mobile_number_len > 10)
    {
       echo "Invalid Mobile number"; exit;
    }

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['name']) && isset($_REQUEST['number']) && isset($_REQUEST['email']) )
			{
		$distributer_name = $_REQUEST['name'];
		        $mobile_no = $_REQUEST['number'];
		        $emailid = $_REQUEST['email'];
	
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['name']) && isset($_GET['number']) && isset($_GET['email']))
			{
				$distributer_name = $_REQUEST['name'];
		        $mobile_no = $_REQUEST['number'];
		        $emailid = $_REQUEST['email'];
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}							
	
	
	
				$parent_id = "";
				$pan_no = "";
				$contact_person = "0";//status of user
				$postal_address = " ";
				$pincode = " ";
				$state_id = " ";
				$city_id = "0";
				
				$landline = "0";
				$retailer_type_id = "";
				
				$stateCode = "";
				$scheme_id = "28";
				$working_limit ="0";
				$AIR = "no";
				$MOBILE = "no";
				$DTH = "no";
				$GPRS = "no";
				$SMS = "no";
				$WEB = "no";
				$usertype_name = "Agent";
				$status = 0;
				$username = $this->Common_methods->getNewUserId($usertype_name);
				$password = $this->common->getOTP();
				$this->load->model('Admin_d_registration_model');
				if($this->Admin_d_registration_model->find_mobile_exist($mobile_no))
				{
					$this->Insert_model->tblusers_registration_Entry($parent_id,$distributer_name,$postal_address,$pincode,$state_id,$city_id,$contact_person,$mobile_no,$landline,$retailer_type_id,$emailid,$usertype_name,$status,$scheme_id,$working_limit,$username,$password,$working_limit,$AIR,$MOBILE,$DTH,$GPRS,$SMS,$WEB);
					$this->Common_methods->Increment_id("Agent");
					$to = $emailid;
					$subject = $this->common_value->getSubject();
					$message = $this->common_value->getEmailMessage($mobile_no,$password,$distributer_name);
					$from = $this->common_value->getFromEmail();
					$headers = "From:" . $from;
					$headers .= "\nContent-Type: text/html";
					mail($to,$subject,$message,$headers);
                    $smsMessage ='account created, User Name '.$mobile_no.' Password '.$password;
			
			
			
			//////SMS API START////



$message = $smsMessage;
$company = "";
$number = "+91".$mobile_no;




$this->load->model('Royalcapital_balance_model');		
$RCInfo = $this->Royalcapital_balance_model->get_RoyalInfo('SMS');
$username = $RCInfo->row(0)->username;
$pwd = $RCInfo->row(0)->password;


file_get_contents("http://myrc.in/sms_api/api?username=".$username."&token=".$pwd."&number=".$mobile_no."&orderid=&format=json&message=".$smsMessage."&brand_name=A1 Topup");

$this->send_whatsapp($mobile_no,$smsMessage);

//////SMS API END////

					
				
				echo "Congratulation ! Your Account has been Created. We have sent SMS with User id and Password also contact support for KYC approval" ;
                    

				}
				else //If mobile no exist then Give message
				{
					echo "Mobile number already registered.";
				
				}
	
	
	
	
	

	}	
	
	

	public function commission()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['user_id']) )
			{
			$username = $_REQUEST['username'];
			$pwd =  $_REQUEST['pwd'];
			$user_id = $_REQUEST['user_id'];
		
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']) && isset($_GET['user_id']))
			{
			$username = $_GET['username'];
			$pwd = $_GET['pwd'];
			$user_id =  $_GET['user_id'];
		
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}							
		$this->load->model('Mobile_api_model');
		$result_recharge = $this->Mobile_api_model->get_commission($user_id);

	
			echo	$myJSON = json_encode($result_recharge->result());

	}	

	public function ledger()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['user_id']) )
			{
			$username = $_REQUEST['username'];
			$pwd =  $_REQUEST['pwd'];
			$user_id = $_REQUEST['user_id'];
		
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']) && isset($_GET['user_id']))
			{
			$username = $_GET['username'];
			$pwd = $_GET['pwd'];
			$user_id =  $_GET['user_id'];
		
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}							
		$this->load->model('Mobile_api_model');
		$result_recharge = $this->Mobile_api_model->get_ledger($user_id);

	
			echo	$myJSON = json_encode($result_recharge->result());

	}
	
	
	public function search_mobile()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['user_id']) && isset($_REQUEST['number']))
			{
			$username = $_REQUEST['username'];
			$pwd =  $_REQUEST['pwd'];
			$user_id = $_REQUEST['user_id'];
			$number = $_REQUEST['number'];
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']) && isset($_GET['user_id']) && isset($_GET['number']))
			{
			$username = $_GET['username'];
			$pwd = $_GET['pwd'];
			$user_id =  $_GET['user_id'];
			$number =  $_GET['number'];
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}							
		$this->load->model('Mobile_api_model');
		$result_recharge = $this->Mobile_api_model->mobile_no($number,$user_id);

	
			echo	$myJSON = json_encode($result_recharge->result());

	}	
	
	
	
public function sender_registration()
	{		
	
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['name'])  && isset($_REQUEST['pincode']) && isset($_REQUEST['sender_mobile']))
			{

				$username = $_REQUEST['username'];
		        $pwd =  $_REQUEST['pwd'];
		        $name = $_REQUEST['name'];
		        $name = str_replace(' ','',$name);
			    $pincode = $_REQUEST['pincode'];
			    
			    $mobile = $_REQUEST['sender_mobile'];	
			    					            }
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']) && isset($_GET['name'])   && isset($_GET['pincode'])  && isset($_GET['sender_mobile']))
			{
				$username = $_GET['username'];
				$pwd =  $_GET['pwd'];
				$name = $_GET['name'];
				$name = str_replace(' ','',$name);
			    $pincode = $_GET['pincode'];
			    
			    $mobile = $_GET['sender_mobile'];
		    }
			else
			{echo 'Paramenter is missing';exit;}			
		}													
			$this->load->model('Mobile_api_model');
			
			$AUTHENTICATION = $this->Mobile_api_model->check_login($username,$pwd);
			if($AUTHENTICATION == false)
			{
				echo "Authentication fail!";exit(0);	
			}
			else
			{	
			$user_info = $this->Userinfo_methods->getUserInfoByUsernamePassword($username,$pwd);

			if($user_info->row(0)->usertype_name == "Agent" or $user_info->row(0)->usertype_name == "Distributor" or $user_info->row(0)->usertype_name == "MasterDealer")
			{
				
				$url = "http://api.rechapi.com/moneyTransfer/customerRegistration.php?format=json&token=R3RxOYfeegdzYwf3MQI8EQRjqM0PLT&customerName=".$name."&customerPincode=".$pincode."&customerMobile=".$mobile;

$demo = file_get_contents($url);

$obj = json_decode($demo,true);
$mes= $obj['data']['resText'];
$response = $obj['data']['error_code'];

$status = $response;
$myObj->txid = $recharge_id;
$myObj->status= $response;
$myObj->message = $mes;
$myObj->Sender_name= $name;
$myObj->pincode= $pincode;
$myObj->sender_mobile = $mobile;

$myJSON = json_encode($myObj);

	echo $myJSON;exit;



			}	
			else
			{
				echo "Unauthorised Access";exit;
			}
		}
	}	
	
	
	
	
	
public function verify_beneficiary()
	{		
	
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['sender_mobile'])  && isset($_REQUEST['otp']) && isset($_REQUEST['ben_id']))
			{

				$username = $_REQUEST['username'];
		        $pwd =  $_REQUEST['pwd'];
		        $sender_mobile = $_REQUEST['sender_mobile'];
			    $otp = $_REQUEST['otp'];
			    $ben_id = $_REQUEST['ben_id'];		



			    					            }
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']) && isset($_GET['sender_mobile'])  && isset($_GET['otp']) && isset($_GET['ben_id']))
			{
				$username = $_GET['username'];
				$pwd =  $_GET['pwd'];
				$sender_mobile = $_GET['sender_mobile'];
			    $otp = $_GET['otp'];
			    
			    $ben_id = $_GET['ben_id'];
		    }
			else
			{echo 'Paramenter is missing';exit;}			
		}													
			$this->load->model('Mobile_api_model');
			
			$AUTHENTICATION = $this->Mobile_api_model->check_login($username,$pwd);
			if($AUTHENTICATION == false)
			{
				echo "Authentication fail!";exit(0);	
			}
			else
			{	
			$user_info = $this->Userinfo_methods->getUserInfoByUsernamePassword($username,$pwd);

			if($user_info->row(0)->usertype_name == "Agent" or $user_info->row(0)->usertype_name == "Distributor" or $user_info->row(0)->usertype_name == "MasterDealer")
			{
				
				$url = "http://api.rechapi.com/moneyTransfer/beneficiaryVerifiy.php?format=json&token=R3RxOYfeegdzYwf3MQI8EQRjqM0PLT&customerMobile=".$sender_mobile."&otp=".$otp."&beneficiaryId=".$ben_id;

$demo = file_get_contents($url);

$obj = json_decode($demo,true);
$mes= $obj['data']['resText'];
$response = $obj['data']['error_code'];
$recharge_id = "0";
$status = $response;


$myObj->status= $response;
$myObj->message = $mes;
$myObj->sender_mobile = $sender_mobile;
$myObj->otp = $otp;
$myObj->beneficiaryId = $ben_id;

$myJSON = json_encode($myObj);


	echo $myJSON;exit;



			}	
			else
			{
				echo "Unauthorised Access";exit;
			}
		}
	}	
	
	
	
	
public function add_beneficiary()
	{		
	
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['sender_mobile'])  && isset($_REQUEST['ben_name']) && isset($_REQUEST['ben_mobile']) && isset($_REQUEST['account_number']) && isset($_REQUEST['ifsc_code']))
			{

				$username = $_REQUEST['username'];
		        $pwd =  $_REQUEST['pwd'];
		        $sender_mobile = $_REQUEST['sender_mobile'];
			    $ben_name = $_REQUEST['ben_name'];
			    $ben_name = str_replace(' ','',$ben_name);
			    
			    $ben_mobile = $_REQUEST['ben_mobile'];
			    $account_number = $_REQUEST['account_number'];
			    $ifsc_code = $_REQUEST['ifsc_code'];		



			    					            }
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']) && isset($_GET['sender_mobile'])   && isset($_GET['ben_name'])  && isset($_GET['ben_mobile']) && isset($_GET['account_number']) && isset($_GET['ifsc_code']))
			{
				$username = $_GET['username'];
				$pwd =  $_GET['pwd'];
				$sender_mobile = $_GET['sender_mobile'];
			    $ben_name = $_GET['ben_name'];
			    $ben_name = str_replace(' ','',$ben_name);
			    $ben_mobile = $_GET['ben_mobile'];
			    $account_number = $_GET['account_number'];
			    $ifsc_code = $_GET['ifsc_code'];
		    }
			else
			{echo 'Paramenter is missing';exit;}			
		}													
			$this->load->model('Mobile_api_model');
			
			$AUTHENTICATION = $this->Mobile_api_model->check_login($username,$pwd);
			if($AUTHENTICATION == false)
			{
				echo "Authentication fail!";exit(0);	
			}
			else
			{	
			$user_info = $this->Userinfo_methods->getUserInfoByUsernamePassword($username,$pwd);

			if($user_info->row(0)->usertype_name == "Agent" or $user_info->row(0)->usertype_name == "Distributor" or $user_info->row(0)->usertype_name == "MasterDealer")
			{
				
				$url = "http://api.rechapi.com/moneyTransfer/addBeneficiary.php?format=json&token=R3RxOYfeegdzYwf3MQI8EQRjqM0PLT&customerMobile=".$sender_mobile."&beneficiaryName=".$ben_name."&beneficiaryMobileNumber=".$ben_mobile."&beneficiaryAccountNumber=".$account_number."&ifscCode=".$ifsc_code;

$demo = file_get_contents($url);

$obj = json_decode($demo,true);
$mes= $obj['data']['resText'];
$response = $obj['data']['error_code'];
$recharge_id = "0";
$status = $response;
$ben_id = $obj['data']['beneficiaryId'];

$myObj->status= $response;
$myObj->message = $mes;
$myObj->beneficiaryName = $ben_name;
$myObj->beneficiaryMobileNumber = $ben_mobile;
$myObj->beneficiaryAccountNumber = $account_number;
$myObj->ben_id = $ben_id;
$myObj->ifscCode = $ifscCode;
$myJSON = json_encode($myObj);


	echo $myJSON;exit;



			}	
			else
			{
				echo "Unauthorised Access";exit;
			}
		}
	}	
	
	
	
	
	public function transfer()
	{		
	
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['sender_mobile'])  && isset($_REQUEST['mode']) && isset($_REQUEST['ben_id']) && isset($_REQUEST['amount']))
			{

				$username = $_REQUEST['username'];
		        $pwd =  $_REQUEST['pwd'];
		        $sender_mobile = $_REQUEST['sender_mobile'];
			    $mode = $_REQUEST['mode'];
			    $ben_id =  $_REQUEST['ben_id'];
			    $amount = $_REQUEST['amount'];
			    	
			    					            }
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']) && isset($_GET['sender_mobile'])   && isset($_GET['mode']) && isset($_GET['ben_id']) && isset($_GET['amount']))
			{
				$username = $_GET['username'];
				$pwd =  $_GET['pwd'];
				$sender_mobile = $_GET['sender_mobile'];
			    $mode = $_GET['mode'];
			    $ben_id =  $_GET['ben_id'];
			    $amount = $_GET['amount'];
			    
		    }
			else
			{echo 'Paramenter is missing';exit;}			
		}													
			$this->load->model('Mobile_api_model');
			$this->load->model("do_dmr_model");	
			$this->load->model("Tblcompany_methods");
			$AUTHENTICATION = $this->Mobile_api_model->check_login($username,$pwd);
			if($AUTHENTICATION == false)
			{
				echo "Authentication fail!";exit(0);	
			}
			else
			{	
			$user_info = $this->Userinfo_methods->getUserInfoByUsernamePassword($username,$pwd);
			if($user_info->row(0)->usertype_name == "Agent" or $user_info->row(0)->usertype_name == "Distributor" or $user_info->row(0)->usertype_name == "MasterDealer")
			{
				$company_id = $this->Tblcompany_methods->getCompanyIdByProvider($mode);
				if($company_id == false)
				{
					echo "Error Code : 1001, Invalid Transfer Mode";exit;
				}
				if($amount < 1000)
				{	
					echo ' Minimum amount Rs 1000  Allowed.';exit;
				}
				$company_info = $this->Tblcompany_methods->getCompany_info($company_id);
				$MobileNo =	$ben_id;
				$Amount = $amount;
				$product_name = $company_info->row(0)->product_name;
				$company_id = $company_info->row(0)->company_id; 
				$RoyalProvider = $company_info->row(0)->provider;	
				$payworld_provider = $company_info->row(0)->payworld_provider;		
				$service_id = $company_info->row(0)->service_id;
				$recharge_type = $this->Common_methods->getRechargeType($service_id);
				$rechargeBy = "APP";
				$circle_code = "2";
			$orderid = $orderid;
				$response = $this->do_dmr_model->ProcessRecharge($user_info,$circle_code,$company_id,$Amount,$MobileNo,$recharge_type,$service_id,$rechargeBy,$orderid);
				echo $response;exit;
			}	
			else
			{
				echo "Unauthorised Access";exit;
			}
		}
	}	
	
public function search_beneficiary()
	{		
	
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['sender_mobile']))
			{

				$username = $_REQUEST['username'];
		        $pwd =  $_REQUEST['pwd'];
		        $sender_mobile = $_REQUEST['sender_mobile'];
			   	



			    					            }
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']) && isset($_GET['sender_mobile']))
			{
				$username = $_GET['username'];
				$pwd =  $_GET['pwd'];
				$sender_mobile = $_GET['sender_mobile'];
			    
		    }
			else
			{echo 'Paramenter is missing';exit;}			
		}													
			$this->load->model('Mobile_api_model');
			
			$AUTHENTICATION = $this->Mobile_api_model->check_login($username,$pwd);
			if($AUTHENTICATION == false)
			{
				echo "Authentication fail!";exit(0);	
			}
			else
			{	
			$user_info = $this->Userinfo_methods->getUserInfoByUsernamePassword($username,$pwd);

			if($user_info->row(0)->usertype_name == "Agent" or $user_info->row(0)->usertype_name == "Distributor" or $user_info->row(0)->usertype_name == "MasterDealer")
			{
				
				$url = "http://api.rechapi.com/moneyTransfer/cusDetails.php?format=json&token=R3RxOYfeegdzYwf3MQI8EQRjqM0PLT&customerMobile=".$sender_mobile;

$demo = file_get_contents($url);

$obj = json_decode($demo,true);
$mes= $obj['data']['resText'];
$response = $obj['data']['error_code'];
$recharge_id = "0";
$status = $response;
$sender_details = $obj['data']['details'];
$beneficiaryList = $obj['data']['beneficiaryList'];



//$myObj->status= $response;
//$myObj->message = $mes;
//$myObj->sender_details = $sender_details;
//$myObj->beneficiaryList = $beneficiaryList;


$myJSON = json_encode($beneficiaryList);


	echo $myJSON;exit;



			}	
			else
			{
				echo "Unauthorised Access";exit;
			}
		}
	}	
	
	
	
 public function buy_pan_coupon()
    {       
    
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['operatorcode']) && isset($_REQUEST['number']) && isset($_REQUEST['quantity']))

            {
              $username = $_REQUEST['username'];
             $pwd =  $_REQUEST['pwd'];
             
            $operatorcode = $_REQUEST['operatorcode'];
            $number =  $_REQUEST['number'];
            $quantity = $_REQUEST['quantity'];
            

            }

            else
            {


  
                
                $myObj->status = "Failure";
                $myObj->opid = "Parameter is Missing";
                
                echo $myJSON = json_encode($myObj);exit;
                
               


            }           
        }


        else
        {
            if(isset($_GET['username']) && isset($_GET['pwd']) && isset($_GET['operatorcode']) && isset($_GET['number']) && isset($_GET['quantity']))

            {
                $username = $_GET['username'];
                $pwd =  $_GET['pwd'];
                $operatorcode = $_GET['operatorcode'];
            
            $number =  $_GET['number'];
            $quantity = $_GET['quantity'];
            
                
                
            }
            else
            {




   
                $myObj->status = "Failure";
                $myObj->opid = "Parameter is Missing";
                
                echo $myJSON = json_encode($myObj);exit;



            }           
        } 
        
        
            $this->load->model('Mobile_api_model');
            $this->load->model("recharge_model");   
            $this->load->model("Tblcompany_methods");
            $AUTHENTICATION = $this->Mobile_api_model->check_login($username,$pwd);
            
            if($AUTHENTICATION == false)
            {
                

                $myObj->status = "Failure";
                $myObj->opid = "AUTHENTICATION FAIL";
                
                echo $myJSON = json_encode($myObj);exit;



            }

            else

            {   
            $user_info = $this->Userinfo_methods->getUserInfoByUsernamePassword($username,$pwd);
            
            if($user_info->row(0)->usertype_name == "Agent" or $user_info->row(0)->usertype_name == "Distributor" or $user_info->row(0)->usertype_name == "MasterDealer")
            {
                $company_id = $this->Tblcompany_methods->getCompanyIdByProvider($operatorcode);
                if($company_id == false)
                {
                    

                $myObj->txid = "0";
                $myObj->status = "Failure";
                $myObj->opid = "Invalid operatorcode";
                $myObj->number= $number;
                $myObj->quantity = $quantity;
                $myObj->orderid = $orderid;
                echo $myJSON = json_encode($myObj);exit;
                
               

                }
                
                

                if($quantity < 2)
                {   
                    


                $myObj->txid = "0";
                $myObj->status = "Failure";
                $myObj->opid = "Minimum  2 Coupon Required";
                $myObj->number= $Mobile;
                $myObj->quantity = $quantity;
                $myObj->orderid = $orderid;
                echo $myJSON = json_encode($myObj);exit;
                
               

                }
                
                
                
                $company_info = $this->Tblcompany_methods->getCompany_info($company_id);
                $MobileNo = $number;
                $rslt = $this->db->query("select * from common where id = '2'");
        $pan_cost = $rslt->row(0)->value;
                $quantity = $quantity*$pan_cost;
                $product_name = $company_info->row(0)->product_name;
                $company_id = $company_info->row(0)->company_id; 
                $RoyalProvider = $company_info->row(0)->provider;   
                $payworld_provider = $company_info->row(0)->payworld_provider;      
                $service_id = $company_info->row(0)->service_id;
                $recharge_type = $this->Common_methods->getRechargeType($service_id);
                $rechargeBy = "GPRS";
                $circle_code = "2";
                $orderid = $orderid;
                $response = $this->recharge_model->ProcessRecharge($user_info,$circle_code,$company_id,$quantity,$MobileNo,$recharge_type,$service_id,$rechargeBy,$orderid);
                echo $response;exit;
            }
            
            
            else
            {
             
                 $myObj->status = "Failure";
                $myObj->opid = "Parameter is Missing";
                
                echo $myJSON = json_encode($myObj);exit;
                
                }
            
            }
    }
	
	public function authentication()
	{
	
	
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']))
			{$username = $_REQUEST['username'];$pwd =  $_REQUEST['pwd'];}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']))
			{$username = $_GET['username'];$pwd =  $_GET['pwd'];}
			else
			{echo 'Paramenter is missing';exit;}			
		}											
		$this->load->model('Mobile_api_model');
		$AUTHENTICATION = $this->Mobile_api_model->check_login($username,$pwd);
		if($AUTHENTICATION == false)
		{
			$response["status"] = "false";	
			$response["message"] = "Invalid Userd id or Password";
			$response["usertype_name"] = "false";
			echo json_encode($response);
		}
		else
		{
	
		    $value = $AUTHENTICATION;
$response["status"] = "true";
$response["message"] = "Login Successful";
$response["business_name"] = $value->row(0)->business_name;
$response["user_id"] = $value->row(0)->user_id;
$response["usertype_name"] = $value->row(0)->usertype_name;
$response["username"] = $value->row(0)->username;
$response["postal_address"] = $value->row(0)->postal_address;
$response["pincode"] = $value->row(0)->pincode;	
$response["mobile_no"] = $value->row(0)->mobile_no;	
$response["emailid"] = $value->row(0)->emailid;	
$response["balance"] = $balance = $this->Common_methods->getCurrentBalance($value->row(0)->user_id);
$response["upi"] = $this->get_upi_id()->row(0)->upi_id;	
$response["set_amount"] = $this->get_upi_id()->row(0)->set_amount;	
$result_alert = $this->db->query("select * from tblalerts"); 
$response["news"]  =  $result_alert->row(0)->alert_name; 
     
echo json_encode($response);
	
		}		
	}
	
	public function app_login()
	{
	
	
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']))
			{$username = $_REQUEST['username'];$pwd =  $_REQUEST['pwd'];}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']))
			{$username = $_GET['username'];$pwd =  $_GET['pwd'];}
			else
			{echo 'Paramenter is missing';exit;}			
		}											
		$this->load->model('Mobile_api_model');
		$AUTHENTICATION = $this->Mobile_api_model->check_login_app($username,$pwd);
		if($AUTHENTICATION == false)
		{
			$response["status"] = "false";	
			$response["message"] = "Invalid Userd id or Password";
			$response["usertype_name"] = "false";
			echo json_encode($response);
		}
		else
		{
	
		    $value = $AUTHENTICATION;
$response["status"] = "true";
$response["message"] = "Login Successful";
$response["business_name"] = $value->row(0)->business_name;
$response["user_id"] = $value->row(0)->user_id;
$response["usertype_name"] = $value->row(0)->usertype_name;
$response["username"] = $value->row(0)->username;
$response["postal_address"] = $value->row(0)->postal_address;
$response["pincode"] = $value->row(0)->pincode;	
$response["mobile_no"] = $value->row(0)->mobile_no;	
$response["emailid"] = $value->row(0)->emailid;	
$response["balance"] = $balance = $this->Common_methods->getCurrentBalance($value->row(0)->user_id);

$result_alert = $this->db->query("select * from tblalerts"); 

$n_text = $result_alert->row(0)->alert_name; 
$news_text = strip_tags($n_text);
$response["news"]  = $news_text; 
$response["upi"] = $this->get_upi_id()->row(0)->upi_id;	
$response["set_amount"] = $this->get_upi_id()->row(0)->set_amount;	
$response["whatsapp"] = "9363622952";
$response["upi_gateway"] = "no";
$response["paytm_gateway"] = $this->paytm_status();
$response["marchant_upi"] = $this->upi_status();
     
echo json_encode($response);
	
		}		
	}
	
	public function getTransaction()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']))
			{$username = $_REQUEST['username'];$pwd =  $_REQUEST['pwd'];}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']))
			{$username = $_GET['username'];$pwd =  $_GET['pwd'];}
			else
			{echo 'Paramenter is missing';exit;}			
		}							
		$this->load->model('Mobile_api_model');
		$result_recharge = $this->Mobile_api_model->getrecharge($username,$pwd);

		$resultArray = array();
		foreach($result_recharge->result() as $result)
		{
$myObj["recharge_id"] = $result->recharge_id;
		$myObj["company_name"] = $result->company_name;
		$myObj["company_id"] = $result->company_id;
		$myObj["amount"]= $result->amount;
			$myObj["balance"]= $result->balance;
		$myObj["recharge_date"] = $result->add_date;
		$myObj["recharge_status"]= $result->recharge_status;
		$myObj["mobile_no"]= $result->mobile_no;
			$myObj["operator_id"]= $result->operator_id;
		
		$resultArray[] = $myObj;

		}
			echo	$myJSON = json_encode($resultArray);

	}
	public function balance()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']))
			{$username = $_REQUEST['username'];$pwd =  $_REQUEST['pwd'];}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']))
			{$username = $_GET['username'];$pwd =  $_GET['pwd'];}
			else
			{echo 'Paramenter is missing';exit;}			
		}							
		$this->load->model('Mobile_api_model');
		$AUTHENTICATION = $this->Mobile_api_model->check_login($username,$pwd);
		if($AUTHENTICATION == false)
		{
			echo "Authentication fail!";exit(0);	
		}		
		$this->load->model('Recharge_home_model');				
		$USERINFO = $this->Mobile_api_model->GetUserInfo($username, $pwd);
		if($USERINFO->row(0)->usertype_name == "Agent")
		{
			$balance = $this->Common_methods->getAgentBalance($USERINFO->row(0)->user_id);
			$opt = $this->Userinfo_methods->getOTP($USERINFO->row(0)->user_id);
		}
		else if( $USERINFO->row(0)->usertype_name == "MasterDealer")
		{
			$balance = $this->Common_methods->getCurrentBalance($USERINFO->row(0)->user_id);
			$opt = "";
		}
		else if($USERINFO->row(0)->usertype_name == "Distributor")
		{
			$balance = $this->Common_methods->getCurrentBalance($USERINFO->row(0)->user_id);
			$opt = $this->Userinfo_methods->getOTP($USERINFO->row(0)->user_id);
		}
		echo $balance;			
	}
	public function status()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['gtid']))
			{$username = $_REQUEST['username'];$pwd =  $_REQUEST['pwd'];$gtid = $_REQUEST['gtid'];}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']) && isset($_GET['gtid']))
			{$username = $_GET['username'];$pwd =  $_GET['pwd'];$gtid = $_GET['gtid'];}
			else
			{echo 'Paramenter is missing';exit;}			
		}											
		$this->load->model('Mobile_api_model');
		$AUTHENTICATION = $this->Mobile_api_model->check_login($username,$pwd);
		if($AUTHENTICATION == false)
		{
			echo "Authentication fail!";exit(0);	
		}		
		$USERINFO = $this->Mobile_api_model->GetUserInfo($username);
		$status = $this->Mobile_api_model->GetRechargeStatus($USERINFO->row(0)->user_id,$gtid);
		echo $status;
	}	
	public function api()
	{		
	
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['circlecode'])  && isset($_REQUEST['operatorcode']) && isset($_REQUEST['number']) && isset($_REQUEST['amount']))
			{$username = $_REQUEST['username'];$pwd =  $_REQUEST['pwd'];$circlecode = $_REQUEST['circlecode'];
			$operatorcode = $_REQUEST['operatorcode'];$number =  $_REQUEST['number'];$amount = $_REQUEST['amount'];						            }
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd']) && isset($_GET['circlecode'])   && isset($_GET['operatorcode']) && isset($_GET['number']) && isset($_GET['amount']))
			{$username = $_GET['username'];$pwd =  $_GET['pwd'];$circlecode = $_GET['circlecode'];
			$operatorcode = $_GET['operatorcode'];$number =  $_GET['number'];$amount = $_GET['amount'];}
			else
			{echo 'Paramenter is missing';exit;}			
		}													
			$this->load->model('Mobile_api_model');
			$this->load->model("Do_recharge_model");	
			$this->load->model("Tblcompany_methods");
			$AUTHENTICATION = $this->Mobile_api_model->check_login($username,$pwd);
			if($AUTHENTICATION == false)
			{
				echo "Authentication fail!";exit(0);	
			}
			else
			{	
			$user_info = $this->Userinfo_methods->getUserInfoByUsernamePassword($username,$pwd);
			if($user_info->row(0)->usertype_name == "Agent" or $user_info->row(0)->usertype_name == "Distributor" or $user_info->row(0)->usertype_name == "MasterDealer")
			{
				$company_id = $this->Tblcompany_methods->getCompanyIdByProvider($operatorcode);
				if($company_id == false)
				{
					echo "Error Code : 1001, Contact Service Provider";exit;
				}
				if($amount < 10)
				{	
					echo ' Minimum amount 10 INR For Recharge.';exit;
				}
				$company_info = $this->Tblcompany_methods->getCompany_info($company_id);
				$MobileNo =	$number;
				$Amount = $amount;
				$product_name = $company_info->row(0)->product_name;
				$company_id = $company_info->row(0)->company_id; 
				$RoyalProvider = $company_info->row(0)->provider;	
				$payworld_provider = $company_info->row(0)->payworld_provider;		
				$service_id = $company_info->row(0)->service_id;
				$recharge_type = $this->Common_methods->getRechargeType($service_id);
				$rechargeBy = "GPRS";
				$circle_code = $circlecode;
				//echo $company_id ;exit;
				$response = $this->Do_recharge_model->ProcessRecharge($user_info,$circle_code,$company_id,$Amount,$MobileNo,$recharge_type,$service_id,$rechargeBy);
				echo $response;exit;
			}	
			else
			{
				echo "Unauthorised Access";exit;
			}
		}
	}
	public function addBalance()
	{
		//addBalance?username=&pwd=&OthersId=&amount=
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['OthersId'])  && isset($_REQUEST['amount']))
			{
				$username = $_REQUEST['username'];
				$pwd =  $_REQUEST['pwd'];
				$othersId = $_REQUEST['OthersId'];
				$amount = $_REQUEST['amount'];
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd'])  && isset($_GET['OthersId'])  && isset($_GET['amount']))
			{
				$username = $_GET['username'];
				$pwd =  $_GET['pwd'];
				$othersId = $_GET['OthersId'];
				$amount = $_GET['amount'];
				}
			else
			{echo 'Paramenter is missing';exit;}			
		}	
		if($amount < 0)
		{
			echo "Invalid Amount";exit;
		}
		$this->load->model("mobile_api_model");	
		$this->mobile_api_model->DealerAddBalance($username,$pwd,$othersId,$amount);
	}
	public function revertBalance()
	{
		//revertBalance?username=&pwd=&OthersId=&amount=
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['OthersId'])  && isset($_REQUEST['amount']))
			{
				$username = $_REQUEST['username'];
				$pwd =  $_REQUEST['pwd'];
				$othersId = $_REQUEST['OthersId'];
				$amount = $_REQUEST['amount'];
				
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd'])  && isset($_GET['OthersId'])  && isset($_GET['amount']))
			{
				$username = $_GET['username'];
				$pwd =  $_GET['pwd'];
				$othersId = $_GET['OthersId'];
				$amount = $_GET['amount'];
				
				}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		if($amount < 0)
		{
			echo "Invalid Amount";exit;
		}
		
			$this->load->model("mobile_api_model");	
			$this->mobile_api_model->revertBalance($username,$pwd,$othersId,$amount);		
	}
	//change_pwd?username=&pwd=&oldpwd=&newpwd=";
	public function change_pwd()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['newpwd'])  && isset($_REQUEST['oldpwd']))
			{
				$username = $_REQUEST['username'];
				$pwd =  $_REQUEST['pwd'];
				$newpwd = $_REQUEST['newpwd'];
				$oldpwd = $_REQUEST['oldpwd'];
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd'])  && isset($_GET['newpwd'])  && isset($_GET['oldpwd']))
			{
				$username = $_GET['username'];
				$pwd =  $_GET['pwd'];
				$newpwd = $_GET['newpwd'];
				$oldpwd = $_GET['oldpwd'];
				}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		$this->load->model("mobile_api_model");	
		$this->mobile_api_model->ChangePassword($username,$pwd,$oldpwd,$newpwd);		
	}
	//complain?username="+txtUsername+"&pwd="+txtPassword+"&mobile="+Comp_mobile.getString()+"&amount="+CompAmount.getString()+"&date="+CompDate.getString()+"&message="+comp_message.getString();
	public function complain()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_REQUEST['username']) && isset($_REQUEST['pwd']) && isset($_REQUEST['mobile'])  && isset($_REQUEST['amount'])  && isset($_REQUEST['date'])  && isset($_REQUEST['message']))
			{
				$username = $_REQUEST['username'];
				$pwd =  $_REQUEST['pwd'];
				$mobile = $_REQUEST['mobile'];
				$amount = $_REQUEST['amount'];
				$date = $_REQUEST['date'];
				$message = $_REQUEST['message'];
			}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		else
		{
			if(isset($_GET['username']) && isset($_GET['pwd'])  && isset($_GET['mobile'])  && isset($_GET['amount'])  && isset($_GET['date'])  && isset($_GET['message']))
			{
				$username = $_GET['username'];
				$pwd =  $_GET['pwd'];
				$mobile = $_GET['mobile'];
				$amount = $_GET['amount'];
				$date = $_GET['date'];
				$message = $_GET['message'];
				}
			else
			{echo 'Paramenter is missing';exit;}			
		}
		
		$this->load->model("mobile_api_model");	
		$this->mobile_api_model->AddComplain($username,$pwd,$mobile,$amount,$date,$message);
		exit;
	}
	public function updateStatus($txId,$status)
	{
		$str_query = "update tblrecharge set recharge_status= ? where recharge_id = ?";
		$reslt = $this->db->query($str_query,array($status,$txId));
		return true;
	}
	
	
	public function get_upi_id()
	{
		$str_query = "select upi_id,set_amount,mobile_no from  tblusers where user_id='100'";
		$result = $this->db->query($str_query);
		return $result;
	}


public function paytm_status()
{
    $url = "select * from pg_setting where name = 'PAYTM'";
    $result = $this->db->query($url);
     $status = $result->row(0)->app_status;
  
  if($status == "ON")
  {
      return "yes";
  }
  else{
      return "no";
  }
  
}

public function upi_status()
{
    $url = "select * from pg_setting where name = 'UPI'";
    $result = $this->db->query($url);
     $status = $result->row(0)->app_status;
  
  if($status == "ON")
  {
      return "yes";
  }
  else{
      return "no";
  }
  
}	

public function payment_web_status()
{
    $gateway = $_REQUEST['gateway'];
    
    $url = "select * from pg_setting where name = '$gateway'";
    $result = $this->db->query($url);
     $status = $result->row(0)->web_status;
     
     $json[status] = $status;
     
     echo json_encode($json);
     
     
  
 
  
}



	

}

