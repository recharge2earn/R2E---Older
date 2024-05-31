<?php
class Errorlog extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function Entry($data,$recharge_id,$number,$amount,$company_name,$user_info,$path)
	{
	
		$user_id = $user_info->row(0)->user_id;
		$user_type = $user_info->row(0)->usertype_name;
		$this->load->library("common");
		$dt = $this->common->getMySqlDate();
		$filename = $dt."cashul38Thiw7i7error.txt";
		if (!file_exists($filename)) 
		{
			file_put_contents($filename, '');
		} 
		$this->load->helper('file');
		$datetime = $this->common->getDate();
		$sapretor = "------------------------------------------------------------------------------------";
		
write_file($filename, $datetime."       ".$path.    ".\n", 'a+');
write_file($filename, "Recharge Id = ".$recharge_id."|| Number = ".$number."| Amount = ".$amount." | Company_name = ".$company_name."\n", 'a+');
write_file($filename, "User Id = ".$user_id." || user Type = ".$user_type."\n", 'a+');
write_file($filename, $data."\n", 'a+');
write_file($filename, $sapretor."\n", 'a+');
	}
	public function LongcodeEntry($data,$recharge_id,$user_info,$path)
	{
		$user_id = $user_info->row(0)->user_id;
		$user_type = $user_info->row(0)->usertype_name;
		$this->load->library("common");
		$dt = $this->common->getMySqlDate();
		$filename = $dt."_cashul38LONGCODEhiw7i7error.txt";
		if (!file_exists($filename)) 
		{
			file_put_contents($filename, '');
		} 
		$this->load->library("common");
	//$Adest = $_SERVER['REQUEST_URI'] ;
		$this->load->helper('file');
		//$data = 'Some file data';
		$datetime = $this->common->getDate();
		$sapretor = "------------------------------------------------------------------------------------";
		
write_file($filename, $datetime."       ".$path.    ".\n", 'a+');
write_file($filename, "Recharge Id = ".$recharge_id."\n", 'a+');
write_file($filename, "User Id = ".$user_id." || user Type = ".$user_type."\n", 'a+');
write_file($filename, $data."\n", 'a+');
write_file($filename, $sapretor."\n", 'a+');
	}
	public function GPRSEntry($data,$recharge_id,$user_info,$path)
	{
		$user_id = $user_info->row(0)->user_id;
		$user_type = $user_info->row(0)->usertype_name;
		$this->load->library("common");
		$dt = $this->common->getMySqlDate();
		$filename = $dt."_cashul38GPRShiw7i7error.txt";
		if (!file_exists($filename)) 
		{
			file_put_contents($filename, '');
		} 
		$this->load->library("common");
	//$Adest = $_SERVER['REQUEST_URI'] ;
		$this->load->helper('file');
		//$data = 'Some file data';
		$datetime = $this->common->getDate();
		$sapretor = "------------------------------------------------------------------------------------";
		
write_file($filename, $datetime."       ".$path.    ".\n", 'a+');
write_file($filename, "Recharge Id : ".$recharge_id."\n", 'a+');
write_file($filename, "User Id : ".$user_id." | User Type = ".$user_type."\n", 'a+');
write_file($filename, $data."\n", 'a+');
write_file($filename, $sapretor."\n", 'a+');
	}
	public function RechargeCommissionEntry($recType,$rechargeBy,$recharge_id,$allCommission,$rechargeDetail,$RecCommDetails)
	{
		$this->load->library("common");
		$dt = $this->common->getMySqlDate();
		$filename = $dt."_cashul38RecCommhiw7i7error.txt";
		if (!file_exists($filename)) 
		{
			file_put_contents($filename, '');
		} 
		$this->load->library("common");
	//$Adest = $_SERVER['REQUEST_URI'] ;
		$this->load->helper('file');
		//$data = 'Some file data';
		$datetime = $this->common->getDate();
		$sapretor = "------------------------------------------------------------------------------------";
		
write_file($filename, $datetime.    ".\n", 'a+');
write_file($filename, "Recharge Type = ".$recType.    ".\n", 'a+');
write_file($filename, "Recharge By = ".$rechargeBy.    ".\n", 'a+');
write_file($filename, "Recharge Id = ".$recharge_id.    ".\n", 'a+');
write_file($filename, "All Commission Detail = ".$allCommission.    ".\n", 'a+');
write_file($filename, $rechargeDetail.    ".\n", 'a+');
write_file($filename, $RecCommDetails."\n", 'a+');
write_file($filename, $sapretor."\n", 'a+');
	}
		public function ApiEntry($RoyalResponse,$iSparshResponse,$recharge_id,$number,$amount,$company_name,$user_info,$path)
		{
	if($user_info != NULL)
	{
		$user_id = $user_info->row(0)->user_id;
		$user_type = $user_info->row(0)->usertype_name;
	}
	else
	{
		$user_id = "";
		$user_type = "";
	}
		$this->load->library("common");
		$dt = $this->common->getMySqlDate();
		$filename = $dt."cashul38APIhiw7i7error.txt";
		if (!file_exists($filename)) 
		{
			file_put_contents($filename, '');
		} 
		$this->load->helper('file');
		$datetime = $this->common->getDate();
		$sapretor = "------------------------------------------------------------------------------------";
		
write_file($filename, $datetime."       ".$path.    ".\n", 'a+');
write_file($filename, "Recharge Id = ".$recharge_id."|| Number = ".$number."| Amount = ".$amount." | Company_name = ".$company_name."\n", 'a+');
write_file($filename, "User Id = ".$user_id." || user Type = ".$user_type."\n", 'a+');
write_file($filename, "RoyalCapital Response = ".$RoyalResponse."\n", 'a+');
write_file($filename,  " \n", 'a+');
write_file($filename, "iSparsh Response = ".$iSparshResponse."\n", 'a+');
write_file($filename, $sapretor."\n", 'a+');
	}
	public function logentry($data)
	{
		$filename = "test.txt";
		if (!file_exists($filename)) 
		{
			file_put_contents($filename, '');
		} 
		$this->load->library("common");

		$this->load->helper('file');
	
		$sapretor = "------------------------------------------------------------------------------------";
		
write_file($filename." .\n", 'a+');
write_file($filename, $data."\n", 'a+');
write_file($filename, $sapretor."\n", 'a+');
	}
	
}

?>