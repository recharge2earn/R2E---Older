<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rechargeserver_resp extends CI_Controller {

	public function index()
	{
		$data = $_SERVER['REQUEST_URI'];
		$this->load->model("Errorlog");
		$this->Errorlog->logentry($data);
		$transaction_id = $_GET["transaction_id"];
		$status = $_GET["status"];

		$rst = $this->db->query("select tblrecharge.*,(select company_name from tblcompany where tblcompany.company_id = tblrecharge.company_id) as company_name,(select tblusers.mobile_no from tblusers where tblusers.user_id = tblrecharge.user_id) as senderMobile from tblrecharge where transaction_id = ?",array($transaction_id));
		if($rst->num_rows() < 1)
		{
			return 0;
		}
		if($rst->row(0)->recharge_status == "Success")
		{
			exit("already success");
		}
		$user_id = $rst->row(0)->user_id;

		$user_info = $this->db->query("select * from tblusers where user_id = ?",array($user_id));

		$company_name = $rst->row(0)->company_name;
		$mobile_no = $rst->row(0)->mobile_no;
		$amount = $rst->row(0)->amount;
		$senderMobile = $user_info->row(0)->mobile_no;

		$this->load->model("Recharge_home_model");
		$this->Recharge_home_model->updateRechargeStatus($rst->row(0)->recharge_id,$transaction_id,"",$status);
		if($status == "Success")
		{
			$dr_amount = $rst->row(0)->amount - $rst->row(0)->commission_amount;

			if($rechargeBy == "SMS")
			{
				$balance = $this->Common_methods->getAgentBalance($user_id);
				$this->sendRechargeSMS($rst->company_name,$mobile_no,$amount,$rst->row(0)->recharge_id,$status,$balance,$senderMobile);
			}

		}
		else if($status == "Failure")
		{
				$balance = $this->Common_methods->getAgentBalance($user_id);
				$this->load->model("Insert_model");
			$this->Insert_model->rechargerefund($recharge_id);
				$this->sendRechargeSMS($company_name,$mobile_no,$amount,$rst->row(0)->recharge_id,$status,$balance,$senderMobile);

		}

	}
		public function sendRechargeSMS($company_name,$Mobile,$Amount,$TransactionID,$status,$balance,$senderMobile)
	{
	$smsMessage = 'Dear Business Partner Your Request is Com  '.$company_name.' Number  '.$Mobile.' Amt '.$Amount.' Tx id '.$TransactionID.' Status  '.$status.' Curent Bal '.$balance.' www.a2zpay.biz';

		$smsMessage = 'Dear Business Partner Your Request isCom : '.$result_company->row(0)->company_name.'Number : '.$Mobile.'Amt : '.$Amount.'Tx id : '.$TransactionID.'Status : '.$status.'A/C Bal : '.$balance.'www.a2zpay.biz';*/
$this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$senderMobile,$smsMessage);

	}

}