<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rechargeserver_resp_clone extends CI_Controller {

	public function index()
	{
		$str_query = "select tblrecharge.*,(select company_name from tblcompany where tblcompany.company_id = tblrecharge.company_id) as company_name from tblrecharge where ExecuteBy='RechargeServer' and recharge_status='Pending'";
		$rslt = $this->db->query($str_query);
		if($rslt->num_rows() > 0)
		{

			foreach($rslt->result() as $row)
			{
				$company_name = $row->company_name;
				$mobile = $row->mobile_no;
				$amount = $row->amount;
				$user_id = $row->user_id;
				$dr_amount = $amount - $row->commission_amount;
				$this->getResponse($row->transaction_id,$row->recharge_id,$company_name,$mobile,$amount,$user_id,$dr_amount);

			}
		}
	}
	public function getResponse($transaction_id,$recharge_id,$company_name,$mobile,$amount,$user_id,$dr_amount)
	{
			$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,  "http://www.rjrecharge.in/api/status?username=726a636f6e6e656374&pwd=52a3151563a03&ssid=".$transaction_id);
		echo "http://www.rjrecharge.in/api?username=726a636f6e6e656374&pwd=52a3151563a03&ssid=".$transaction_id."<br>";
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$status = curl_exec($ch);
		curl_close($ch);

		$this->load->model("Recharge_home_model");
		$this->load->model("Errorlog");
		$this->Errorlog->logentry("cron : ".$status);

		if($status == "Success")
		{
			$this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"",$status);


		}
		else if($status == "Failure")
		{
			$this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"",$status);
			$this->load->model("Insert_model");
			$this->Insert_model->rechargerefund($recharge_id);
		}
		echo $user_id." # ".$recharge_id." # ".$mobile." # ".$amount." # ".$status."<br>";


}
}