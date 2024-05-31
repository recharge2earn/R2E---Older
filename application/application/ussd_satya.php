<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ussd_satya extends CI_Controller {
	public function index()
	{
	//http://http://www.smsalertbox.com///longcode?mobilenumber=#mobile#&message=#fullmessage#
		$this->load->model('Longcode_model');
		$this->load->library("common");
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$sendermobile = $_REQUEST['mobile'];$message =$_REQUEST['response'];
		}
		else
		{
			$sendermobile = $_GET['mobile'];$message =$_GET['response'];
		}
		$user_id = $this->Longcode_model->Find_LongcodeUser($sendermobile);
		if($user_id == false){exit(0);}
		$ArrayResult = explode("*",trim($message));

			if(count($ArrayResult) == 2)
			{
				if($ArrayResult[1] == 34)
				{
					$result_transaction  = $this->Longcode_model->LastThreeTransaction($user_id->row(0)->user_id);
						$myBalance = $this->Longcode_model->getCurrentBalance($user_id->row(0)->user_id);
						echo '<ussd><message navigation="false">
	Bal:'.$myBalance.'
	Three TX:
	1)'.$result_transaction->row(0)->mobile_no.':'.$result_transaction->row(0)->amount.':'.$result_transaction->row(0)->recharge_status.',
	2)'.$result_transaction->row(1)->mobile_no.':'.$result_transaction->row(1)->amount.':'.$result_transaction->row(1)->recharge_status.',
	3)'.$result_transaction->row(2)->mobile_no.':'.$result_transaction->row(2)->amount.':'.$result_transaction->row(2)->recharge_status.'
	</message> </ussd>';
	exit(0);
				}
			}

	if(count($ArrayResult) == 4) // BALANCE TRANSFER To Retailer And Distributor SHR TNSF 100 9825378495 TO 9020501501
  {
   if($ArrayResult[1] == 35)
   {
    $check_exist_customer = $this->Longcode_model->Find_LongcodeUser($ArrayResult[3]);

    if($check_exist_customer == false)
    {
     exit;
    }

    $userToSend = trim($ArrayResult[3]);
    $amountToSend = trim($ArrayResult[2]);
    $myBalance = $this->Longcode_model->getCurrentBalance($user_id->row(0)->user_id);
    if($myBalance - $amountToSend >= 0)
    {
    $SenderResult = $this->Longcode_model->Find_SenderInfo($userToSend);
    if($SenderResult ==false){exit;}
    $this->load->model('D_add_balance_model');
    if($this->D_add_balance_model->add_newbalanceWithLongCode($SenderResult->row(0)->user_id,$user_id->row(0)->user_id,$amountToSend) == true)
    {
    $CUSTOMER_user_info = $this->D_add_balance_model->GetUserInfo($SenderResult->row(0)->user_id);
    $SENDER_user_info = $this->D_add_balance_model->GetUserInfo($user_id->row(0)->user_id);
    $this->load->model('Recharge_home_model');
    $CUSTOMER_balance = $this->Recharge_home_model->GetBalanceByUser($SenderResult->row(0)->user_id);
    $SENDER_balance = $this->Recharge_home_model->GetBalanceByUser($user_id->row(0)->user_id);
    echo '<ussd><message navigation="false">
	PAYMENT PROCESS : SUCCESS
	Your Bal :'.$SENDER_balance.'
	Retailer Bal : '.$CUSTOMER_balance.'
	</message> </ussd>';
    exit;
    }
    }
    else{

   echo '<ussd><message navigation="false">
	Dear Client,You Are Not Able To Transfer Balance,Because Balance Is Not Sufficient In Your Accountwww.a2zpay.biz
	</message> </ussd>';exit(0);
   }

   }



		$Key = 'OP';
		$opcode = strtoupper(trim($ArrayResult[1]));
		$code='';
		switch ($opcode)
		{
    case 1:
        $code='A';
        break;
    case 2:
        $code='I';
        break;
	case 3:
		$code='V';
		break;
	case 4:
		$code='BT';
		break;
	case 5:
		$code='BS';
		break;
	case 6:
		$code='B3';
		break;
	case 7:
		$code='D';
		break;
	case 8:
		$code='DS';
		break;
	case 9:
		$code='AIR';
		break;
	case 10:
		$code='RG';
		break;
	case 11:
		$code='RC';
		break;
	case 12:
		$code='U';
		break;
	case 13:
		$code='US';
		break;
	case 14:
		$code='VG';
		break;
	case 15:
		$code='VC';
		break;
	case 16:
		$code='T';
		break;
	case 17:
		$code='M';
		break;
	case 18:
		$code='VD';
		break;
	case 19:
		$code='VS';
		break;
	case 20:
		$code='LM';
		break;
	case 21:
		$code='MTR';
		break;
	case 22:
		$code='MTT';
		break;
	case 23:
		$code='';
		break;
	case 24:
		$code='';
		break;
	case 25:
		$code='ATV';
		break;
	case 26:
		$code='DTV';
		break;
	case 27:
		$code='VTV';
		break;
	case 28:
		$code='BTV';
		break;
	case 29:
		$code='TTV';
		break;
	case 30:
		$code='STV';
		break;
	case 33:
		$code='AP';
		break;



		}



		$Subkey = strtoupper($code);
		$Amount = $ArrayResult[2];
		$Mobile= $ArrayResult[3];
		$RechargeType = "Mobile";
		if(substr($Subkey,-2) == "TV")		//Find Request is DTH or not
		{$RechargeType = "DTH";}
		if($this->Longcode_model->CheckPendingResult($Mobile,$Amount) == true) // Check pending result
		{exit(0);}
		$Balance = $this->Longcode_model->getCurrentBalance($user_id->row(0)->user_id);
		if($Balance - $Amount <= 0)		// Check the balance is available or not
		{
	echo '<ussd><message navigation="false">
	Dear Client,You Are Not Able To Transfer Balance,Because Balance Is Not Sufficient In Your Accountwww.a2zpay.biz
	</message> </ussd>';exit(0);
	}
		$ResultCompany = $this->Longcode_model->getCompanyResult($Key,$Subkey);
		if($ResultCompany == 'not active')
		{
			exit(0);
		}
		if($ResultCompany == false)  // Check the longcode message format is valid or not
		{
		exit(0);
		}

		$ResultCircleCode = $this->Longcode_model->getCircleCodeUserID($user_id->row(0)->user_id);
		if($ResultCircleCode == false)  // Check the longcode message format is valid or not
		{
			exit(0);
		}

		$Provider=$ResultCompany['provider'];
			$ApiInfo=$this->Longcode_model->GetAPIInfo($ResultCompany['company_id'],$user_id->row(0)->scheme_id); // GET Information about Which API Execute
			if($ApiInfo->num_rows()== 0){echo "API Format is not set for this company.";exit(0);}

			$Recharge_id = $this->Longcode_model->add($ResultCompany['company_id'],$Amount,$Mobile,$user_id->row(0)->user_id,$ResultCompany['service_id'],'USSD',$RechargeType,'Pending',$ApiInfo); //Add Database Entry

					$this->load->model('Recharge_home_model');
					$username = $ApiInfo->row(0)->username;
					$password = $ApiInfo->row(0)->password;
					if($ApiInfo->row(0)->api_name == "RoyalCapital")
					{
					if($this->common->ExecuteAPI($username,$password,$ResultCircleCode['circle_code'],$Provider,$Mobile,$Amount) == true)
					{
						$result_transaction  = $this->Longcode_model->LastThreeTransaction($user_id->row(0)->user_id);
						$myBalance = $this->Longcode_model->getCurrentBalance($user_id->row(0)->user_id);
						echo '<ussd><message navigation="false">
	Bal:'.$myBalance.'
	Three TX:
	1)'.$result_transaction->row(0)->mobile_no.':'.$result_transaction->row(0)->amount.':'.$result_transaction->row(0)->recharge_status.',
	2)'.$result_transaction->row(1)->mobile_no.':'.$result_transaction->row(1)->amount.':'.$result_transaction->row(1)->recharge_status.',
	3)'.$result_transaction->row(2)->mobile_no.':'.$result_transaction->row(2)->amount.':'.$result_transaction->row(2)->recharge_status.'
	</message> </ussd>';

						exit(0);
						}
					}
					if($ApiInfo->row(0)->api_name == "Mars")
					{
					$Provider =$ResultCompany['mars_provider'];
					if($this->common->ExecuteMarsAPI($Provider,$Mobile,$Amount,$Recharge_id,$static_ip) == true)
					{
						$result_transaction  = $this->Longcode_model->LastThreeTransaction($user_id->row(0)->user_id);
						$myBalance = $this->Longcode_model->getCurrentBalance($user_id->row(0)->user_id);
						echo '<ussd><message navigation="false">
	Bal:'.$myBalance.'
	Three TX:
	1)'.$result_transaction->row(0)->mobile_no.':'.$result_transaction->row(0)->amount.':'.$result_transaction->row(0)->recharge_status.',
	2)'.$result_transaction->row(1)->mobile_no.':'.$result_transaction->row(1)->amount.':'.$result_transaction->row(1)->recharge_status.',
	3)'.$result_transaction->row(2)->mobile_no.':'.$result_transaction->row(2)->amount.':'.$result_transaction->row(2)->recharge_status.'
	</message> </ussd>';

					exit(0);
					}
					}

  }

	}
}
?>