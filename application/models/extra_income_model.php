<?php
class Extra_income_model extends CI_Model 
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
	public function GetParent($user_id)
	{
		$str_query = "select * from tblusers where user_id=?";
		$result = $this->db->query($str_query,array($user_id));
		return $result;
	}
	public function add_ExtraIncome($user_id,$amount,$remark)
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
		$result_cr_dr = $this->db->query($str_cr_dr_query,array($user_id,$this->session->userdata('id'),$master_id,$amount,'cash',$remark,'ExtraIncome',$payment_date,$payment_time,$date,$ip));
		
		if($result_cr_dr > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	public function UpdatePayment($user_id,$amount,$percent,$remark)
	{		
		if($this->isFirst == 0)
		{		
		$final_amount = (($amount * $percent ) /100);
		$this->add_ExtraIncome($user_id,$final_amount,$remark);
		$this->isFirst = $this->isFirst + 1;
		$result = $this->GetParent($user_id);
		$parent_id = $result->row(0)->parent_id;
		$this->isCount=$this->isCount + 1;
		if($parent_id == 1)
				{
					return true;
				}
				else{
					$newAmount = $amount - $final_amount;
		$this->UpdatePayment($parent_id,$newAmount,$percent,$remark);	
				}
		}
		else
		{
			if($this->isCount == 8)
			{return true;}
			else
			{
				$final_amount = (($amount * 10) /100);
				$this->add_ExtraIncome($user_id,$final_amount,$remark);
				$this->isCount=$this->isCount + 1;	
				$result = $this->GetParent($user_id);
				$parent_id = $result->row(0)->parent_id;
				if($parent_id == 1)
				{
					return true;
				}
				else
				{
				$this->UpdatePayment($parent_id,$amount,$percent,$remark);		
				}
			}
		}
	}
}

?>