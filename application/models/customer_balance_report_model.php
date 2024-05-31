<?php
class Customer_balance_report_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function get_balance($user_id)
	{
		if($user_id == "ALL")
		{
			$this->load->model("Recharge_home_model");			
			$result = $this->Recharge_home_model->GetBalanceByALLUser('Customer');
			return $result;
		}
		else
		{
			$this->load->model("Recharge_home_model");			
			$result = $this->Recharge_home_model->GetBalanceByUserArray($user_id);
			return $result;
		}
	}
}

?>