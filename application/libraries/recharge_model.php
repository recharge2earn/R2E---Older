<?php
class Recharge_model extends CI_Model
{
	function _construct()
	{
		  parent::_construct();
	}
	public function ProcessRecharge($user_info,$circle_code,$company_id,$Amount,$Mobile,$recharge_type,$service_id,$rechargeBy)
	{
		$circle_code = 23;
		$this->load->model("Tblrecharge_methods");
		$this->load->model("Recharge_home_model");
		$this->load->model("Tblcompany_methods");
		$this->load->model("Longcode_model");
		$mobile_no = $user_info->row(0)->mobile_no;
		$usertype = $user_info->row(0)->usertype_name;
		$user_id = $user_info->row(0)->user_id;
		$scheme_id = $user_info->row(0)->scheme_id;
		$company_info = $this->Tblcompany_methods->getCompany_info($company_id);
		$ApiInfo=$this->Recharge_home_model->getAPIInfo($company_id);
		$RoyalProvider = $company_info->row(0)->provider;
		$RecDuniaProvider = $company_info->row(0)->RecDuniaProvider;
		$marsprovider = $company_info->row(0)->marsprovider;
		$sProvider = $company_info->row(0)->sProvider;



		if($this->Longcode_model->CheckPendingResult($Mobile,$Amount) != true) // Check pending result
		{
			$current_bal = $this->Common_methods->getAgentBalance($user_id);
			if($Amount >= 10)
			{
					if($current_bal >= $Amount)
					{
if($this->Common_methods->CheckAgentBalance($user_id,$Amount) == true)
{
					 // GET Information about Which API Execute
	if($ApiInfo->num_rows() == 0)
	{
		return 'Configuration is missing! contact service provider.';
	}
	$api_name = $ApiInfo->row(0)->api_name;

	$recharge_id = $this->Recharge_home_model->add($company_id,$Amount,$Mobile,$user_id,$service_id,$recharge_type,$recharge_type,'Pending',$ApiInfo,$scheme_id,$rechargeBy);

	if($recharge_id > 0)
	{
		$commission_per = $this->Tblrecharge_methods->getcommission_per($recharge_id);
		$commission_amount = $this->Tblrecharge_methods->getcommission_amount($recharge_id);
	if($commission_amount > 0)
	{
		$dr_amount = $Amount - $commission_amount;
	}
	else
	{
		$dr_amount = $Amount;
	}
		$this->load->library('common');
		if($ApiInfo->num_rows()== 1)
		{
	$username = $ApiInfo->row(0)->username;
	$password = $ApiInfo->row(0)->password;
	$static_ip = $ApiInfo->row(0)->static_ip;
	$url= $ApiInfo->row(0)->url;
$transaction_type = "Recharge";
	$Description = "Recharge ".$company_info->row(0)->company_name." | ".$Mobile." | ".$Amount." | Recharge Id = ".$recharge_id;
	$this->load->model("Insert_model");
	$this->Insert_model->tblewallet_Recharge_DrEntry($user_id,$recharge_id,$transaction_type,$dr_amount,$Description);

					if($ApiInfo->row(0)->api_name == "Twister")
                   	{
						$req='http://www.twistermultiservices.com/api_users/recharge?clientid='.$username.'&password='.$password."&circlecode=".$circle_code."&operatorcode=".$RoyalProvider."&number=".$Mobile.'&amount='.$Amount.'&orderid='.$recharge_id;


                        $royal_resp = file_get_contents($req);
                        $this->db->query("update tblrecharge set request = ?, response = ? where recharge_id = ?",array($req,$royal_resp,$recharge_id));

                        //$royal_resp = "12345#Success#43235454565";
                            if($royal_resp != NULL)
                            {
                            if(strpos($royal_resp, '#') !== FALSE)
                            {//1307764#Success#GU0025493723
                                $resp_arr = explode("#",$royal_resp);
                                if(count($resp_arr) >= 1)
                                {
                                    $trns_id = $resp_arr[0];
                                    $status = $resp_arr[1];
                                    if($status == "" or $status==NULL)
                                    {
                                        $status="Pending";
                                    }
                                    $operator_trans_id = '';
                                    $this->Recharge_home_model->updateRechargeStatus($recharge_id,$trns_id,$operator_trans_id,$status);
                                    if($status == "Success")
                                    {

										return $recharge_id."#Success";

                                    }
                                    if($status == "Failure")
                                    {
										$this->load->model("Insert_model");
							$this->Insert_model->rechargerefund($recharge_id);
                                       return $recharge_id."#Failure";
                                    }

                                }

                            }
                            else if (preg_match('/ERROR::Insufficient Balance,Errorcode=12/',$royal_resp) == 1)                        {

                                $this->Recharge_home_model->updateRechargeStatus($recharge_id,NULL,NULL,"Failure");
								$this->load->model("Insert_model");
							$this->Insert_model->rechargerefund($recharge_id);
                             //   $rslt = $this->db->query("update tblcompany set api_id = 6 where api_id = 4");
                                return $recharge_id."#Failure";
                            }
                            else
                            {
                                if(preg_match('/ERROR::/',$royal_resp) == 1)
                                {
                                    $this->Recharge_home_model->updateRechargeStatus($recharge_id,NULL,NULL,"Failure");
									$this->load->model("Insert_model");
							$this->Insert_model->rechargerefund($recharge_id);
                                    return $recharge_id."#Failure";
                                }
                                else if(preg_match('/ERROR::/',$royal_resp) == 1)
                                {
                                    $this->Recharge_home_model->updateRechargeStatus($recharge_id,NULL,NULL,"Failure");
									$this->load->model("Insert_model");
							$this->Insert_model->rechargerefund($recharge_id);
                                    return $recharge_id."#Failure";
                                }

                            }


                            }

                    }

				}
				else
				{
					return 'Configuration Missing, Contact Service Provider';
				}
	}
	else
	{
		return 'Low Balance Please Contact Service Provider';
	}
}
					}
			}
			else
			{
				return 'Minimum amount 10 INR For Recharge.';
			}
		}
		else
		{
			return "Already in pending process";
		}
	}
	public function sendRechargeSMS($result_company,$Mobile,$Amount,$TransactionID,$status,$balance,$senderMobile,$recharge_id,$user_id)
	{

	$smscharge_info = $this->db->query("select * from common where param = 'smscharge'");
	$charge = $smscharge_info->row(0)->value;
	if($balance > $charge)
	{
		$dr_amount = $charge;
		$transaction_type = "SMS_CHARGE";
		$Description = "SMS_CHARGE  Recharge Id = ".$recharge_id;
		$this->load->model("Insert_model");
		$this->Insert_model->tblewallet_Recharge_DrEntry($user_id,$recharge_id,$transaction_type,$dr_amount,$Description);
		$smsMessage = 'Dear Business Partner Your Request is Com  '.$result_company->row(0)->company_name.' Number  '.$Mobile.' Amt '.$Amount.' Tx id '.$TransactionID.' Status  '.$status.' Curent Bal '.$balance.' ';
		$result = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$senderMobile,$smsMessage);
			echo $smsMessage;
	}
	else
	{
		echo "Insufficient balance to Pay sms charge";
	}




*$smsMessage = 'Dear Business Partner Your Request is
Com : '.$result_company->row(0)->company_name.'
Number : '.$Mobile.'
Amt : '.$Amount.'
Tx id : '.$TransactionID.'
Status : '.$status.'
A/C Bal : '.$balance.'
';*

	}
	public function updateRechargeRequest($request,$recharge_id)
	{
		$str_query = "update tblrecharge set request = ? where recharge_id = ?";
		$rslt = $this->db->query($str_query,array($request,$recharge_id));
		return true;
	}
	public function updateRechargeResponse($response,$recharge_id)
	{
		$str_query = "update tblrecharge set response = ? where recharge_id = ?";
		$rslt = $this->db->query($str_query,array($response,$recharge_id));
		return true;
	}
	public function updateStatusMars($rechargeId,$refid)
	{
		$str_query = "update tblrecharge set mars_ref_Id= ? where recharge_id = ?";
		$reslt = $this->db->query($str_query,array($refid,$rechargeId));
		return true;
	}
	public function updateStatusMarsFail($rechargeId)
	{
		$str_query = "update tblrecharge set recharge_status= ? where recharge_id = ?";
		$reslt = $this->db->query($str_query,array('Failure',$rechargeId));
		return true;
	}
	public function updateStatusRespMars($mars_ref_Id,$transaction_id,$status)
	{
		$str_query = "update tblrecharge set transaction_id= ?,recharge_status=? where mars_ref_Id = ?";
		$reslt = $this->db->query($str_query,array($transaction_id,$status,$mars_ref_Id));
		return true;
	}
	public function insertSentSms($to,$message,$response)
	{
		$date = $this->common->getDate();
		$message = urldecode($message);
		$order   = array("\r\n", "\n", "\r",":");
		$replace = '';
		$response = str_replace($order, $replace, $response);

		$str_query = "insert into sms_outbox(to_mobile,message,response,add_date) values(?,?,?,?)";

		$reslt = $this->db->query($str_query,array($to,$message,$response,$date));
		return true;
	}


}
?>