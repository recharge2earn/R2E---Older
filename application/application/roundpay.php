<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roundpay extends CI_Controller {			
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
		$recharge_id = $_REQUEST['AGENTID'];
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
		$status = $_REQUEST['STATUS'];
		$royal_resp = $_REQUEST['LIVEID'];
		if($status == "2")
	{
	    $this->updateRechargeStatus($recharge_id,"Success",$royal_resp);
	    $this->load->model("Insert_model");
	$rsp_urls = $this->db->query("select api_execution_url from tblusers where user_id = '".$recUser."'");
		$api_execution_url = $rsp_urls->row(0)->api_execution_url;
		echo $url = $api_execution_url."?txid=".$orderid."&status=Success"."&opid=".$royal_resp;
        file_get_contents($url);
		echo "refunded";
	}
	elseif($status == "3" or $status =="4")
	{
	    $this->updateRechargeStatus($recharge_id,"Failure",$royal_resp);
	    $this->load->model("Insert_model");
	    $this->Insert_model->rechargerefund($recharge_id);
$rsp_urls = $this->db->query("select api_execution_url from tblusers where user_id = '".$recUser."'");
		$api_execution_url = $rsp_urls->row(0)->api_execution_url;
		echo $url = $api_execution_url."?txid=".$orderid."&status=Failure"."&opid=Invalid/Amount/Number/";
        file_get_contents($url);
	}
	else  echo "false";
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