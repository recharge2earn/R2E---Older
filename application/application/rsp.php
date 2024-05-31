<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rsp extends CI_Controller {			
	public function index() 
	{	
		$well = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->test($well);
	    $this->load->model("Recharge_home_model");
		$this->load->model("Tblrecharge_methods");
		$this->load->model("Api_model");
		$this->load->model("Recharge_home_model");
		$this->load->model("Tblrecharge_methods");
		$this->load->model("Api_model");
		$this->load->model("Longcode_model");
		$recharge_id = $_REQUEST['rchid'].$_REQUEST['client_key'].$_REQUEST['AGENTID'].$_REQUEST['Merchantrefno'].$_REQUEST['reqid'].$_REQUEST['ClientRefNo'].$_REQUEST['RequestID'].$_REQUEST['client_id'].$_REQUEST['TXNID'].$_REQUEST['refid'].$_REQUEST['CLIENTID'].$_REQUEST['order_id'].$_REQUEST['uniqueid']; 
		
		
		
		
		$rechargeInfo = $this->Tblrecharge_methods->getRechargeTblEntry($recharge_id);
		$recUser =  $rechargeInfo->row(0)->user_id;
		$rsp_urls = $this->db->query("select api_execution_url from tblusers where user_id = '".$recUser."'");
		$api_execution_url = $rsp_urls->row(0)->api_execution_url;
		$response = $rechargeInfo->row(0)->response;
	    $trns_id = $rechargeInfo->row(0)->transaction_id;
	    $orderid = $rechargeInfo->row(0)->orderid; 
		$company_id = $rechargeInfo->row(0)->company_id; 
		$api_name = $rechargeInfo->row(0)->ExecuteBy; 
		$api_info = $this->Api_model->GetAPIInfoByAPIName($api_name);
		$api_username = $api_info->row(0)->username;
		$api_password = $api_info->row(0)->password;
		$oldStatus = $rechargeInfo->row(0)->recharge_status;
		
		$status = $_REQUEST['Status'].$_REQUEST['status'].$_REQUEST['STATUS'];
		
		$royal_resp = $_REQUEST['TransID'].$_REQUEST['Operatorid'].$_REQUEST['OPTXID'].$_REQUEST['LIVEID'].$_REQUEST['OperatorRef'].$_REQUEST['success_id'].$_REQUEST['TransactionID'].$_REQUEST['opid'].$_REQUEST['field1'].$_REQUEST['OprID'].$_REQUEST['operator_ref'].$_REQUEST['operator_id'];
	
	
	
	
	
	
	
		if($status == "SUCCESS" or $status == "Success" or $status == "success" or $status == "Succesful" or $status == "2" or $status == "1")
	{
	    $this->updateRechargeStatus($recharge_id,"Success",$royal_resp);
	    $this->load->model("Insert_model");
	$rsp_urls = $this->db->query("select api_execution_url from tblusers where user_id = '".$recUser."'");
		$api_execution_url = $rsp_urls->row(0)->api_execution_url;
		echo $url = $api_execution_url."?txid=".$orderid."&status=Success"."&opid=".$royal_resp;
        file_get_contents($url);
		echo "SUCCESS";
	}
	elseif($status == "FAILED" or $status == "FAILURE" or $status == "REFUND" or $status == "failure" or $status == "failed" or $status == "refund" or $status == "3" or  $status == "5" or  $status == "4" or  $status == "3" or  $status == "3")
	{
	    $this->updateRechargeStatus($recharge_id,"Failure",$royal_resp);
	    $this->load->model("Insert_model");
	    $this->Insert_model->rechargerefund($recharge_id);
$rsp_urls = $this->db->query("select api_execution_url from tblusers where user_id = '".$recUser."'");
		$api_execution_url = $rsp_urls->row(0)->api_execution_url;
		echo $url = $api_execution_url."?txid=".$orderid."&status=Failure"."&opid=Failed";
        file_get_contents($url);
        echo "FAILURE";
	}
	else  echo "Please pass parameter";
	}
	public function updateRechargeStatus($recharge_id,$status,$royal_resp)
		{
			$str_query = "update tblrecharge set recharge_status=?,operator_id=? where recharge_id = ?";
			$rslt = $this->db->query($str_query,array($status,$royal_resp,$recharge_id));
			
			return true;
		}
		
			public function test($well)
		{
			$str_query = "update tblrecharge set recharge_status='Success',operator_id=? where recharge_id ='12'";
			$rslt = $this->db->query($str_query,array($well));
			
			return true;
		}
		public function resolveSuccessToFailure($recharge_id,$recUser)
	{
		$this->load->model("Insert_model");
		$this->Insert_model->rechargerefund($recharge_id);
	}
}