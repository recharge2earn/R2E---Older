<?php
class Status_model extends CI_Model 
{	
private $str='';
private $str_chd='';
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_transaction_status($transaction_id)
	{
		$url ="http://220.226.204.98/mainlinkpos/purchase/pw_gettransstatus.php3?agentid=81&sp_transid=$transaction_id&client_transid=&service=FLEXI&appver=3.39&loginstatus=live";		
		$this->load->library('common');
		$output = $this->common->ExecuteCustomerURL($url,NULL);
		return $output;
	}
	public function get_gt_status($gt_id)
	{
		
		$url ="http://220.226.204.98/mainlinkpos/purchase/pw_gettransstatus.php3?agentid=81&sp_transid=&client_transid=$gt_id&service=FLEXI&appver=3.39&loginstatus=live";		
		$this->load->library('common');
		$output = $this->common->ExecuteCustomerURL($url,NULL);
		return $output;
		
		
//		$url ="http://220.226.204.98/mainlinkpos/purchase/pw_gettransstatus.php3";		
//		$this->load->library('common');
//		$output = $this->common->ExecuteCustomerURL($url,"agentid=77&sp_transid=&client_transid=$gt_id&service=FLEXI&appver=3.39&loginstatus=live&flgreqoperatorid=TRUE");
//		return $output;
	}
}