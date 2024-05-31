<?php
class Add_mlmagentbalance_model extends CI_Model 
{	
	private $isFirst=0;
	private $isCount=0;
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function GetUserInfo($user_id)
	{
		$str_query = "select * from tblusers where `tblusers`.user_id=?";
		$result = $this->db->query($str_query,array($user_id));		
		return $result;
	}	

	public function add_newbalance($cr_user_id,$amount)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$payment_date = $this->common->getMySqlDate();
		$payment_time = $this->common->getMySqlTime();						
		$str_master_query = "insert into tblpayment_master(user_id,add_date,ip_address) values(?,?,?)";
		$result_master = $this->db->query($str_master_query,array($this->session->userdata('id'),$date,$ip));
		$master_id = $this->db->insert_id();
		
		$str_cr_dr_query = "insert into tblpayment(cr_user_id,dr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?,?)";
		$result_cr_dr = $this->db->query($str_cr_dr_query,array($cr_user_id,$this->session->userdata('id'),$master_id,$amount,'cash','Direct Payment','Recharge',$payment_date,$payment_time,$date,$ip));
		$result_parent = $this->GetParent($cr_user_id);
		$parent_id = $result_parent->row(0)->parent_id;
		//echo $parent_id;exit;		
		$this->UpdatePayment($parent_id,'1',($amount * 0.05 / 100));				
		if($result_cr_dr > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	public function UpdatePayment($user_id,$dr_user_id,$amount)
	{	
		if($this->isFirst == 0)
		{
		$this->load->model('Add_balance_model');
		$this->Add_balance_model->add_MLMIncome3($user_id,$dr_user_id,$amount);
		$this->isFirst = $this->isFirst + 1;
		if($user_id == 1)
		{
			return true;
		}
		$result = $this->GetParent($user_id);
		$parent_id = $result->row(0)->parent_id;		
		$this->isCount=$this->isCount + 1;
		if($parent_id == 1)
				{
					return true;
				}
				else{
		$this->UpdatePayment($parent_id,$dr_user_id,$amount);			
				}
		}
		else
		{
			if($this->isCount == 8)
			{return true;}
			else
			{
				$this->load->model('Add_balance_model');
				$this->Add_balance_model->add_MLMIncome3($user_id,$dr_user_id,$amount);
				$this->isCount=$this->isCount + 1;	
				$result = $this->GetParent($user_id);
				$parent_id = $result->row(0)->parent_id;
				if($parent_id == 1)
				{
					return true;
				}
				else
				{
				$this->UpdatePayment($parent_id,$dr_user_id,$amount);		
				}
			}
		}
	}
	public function GetParent($user_id)
	{
		$str_query = "select * from tblusers where user_id=?";
		$result = $this->db->query($str_query,array($user_id));
		return $result;
	}
	public function add_revert_balance($cr_user_id,$dr_user_id,$amount)
	{
		$this->load->library('common');
		$ip = $this->common->getRealIpAddr();
		$date = $this->common->getDate();
		$payment_date = $this->common->getMySqlDate();
		$payment_time = $this->common->getMySqlTime();						
		
		$str_master_query = "insert into tblpayment_master(user_id,add_date,ip_address) values(?,?,?)";
		$result_master = $this->db->query($str_master_query,array($cr_user_id,$date,$ip));
		$master_id = $this->db->insert_id();
		
		
		$str_cr_dr_query = "insert into tblpayment(cr_user_id,dr_user_id,payment_master_id,amount,payment_type,remark,transaction_type,payment_date,payment_time,add_date,ipaddress) values(?,?,?,?,?,?,?,?,?,?,?)";
		$result_cr_dr = $this->db->query($str_cr_dr_query,array($cr_user_id,$dr_user_id,$master_id,$amount,'cash','Revert Back Direct Payment','Recharge',$payment_date,$payment_time,$date,$ip));
		if($result_cr_dr > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	
}

?>