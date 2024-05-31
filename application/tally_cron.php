<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tally_cron extends CI_Controller {
	

	public function index() 
	{
	    
	
	foreach ($this->get_user()->result() as $user ){
	    
	    $user_id = $user->user_id;
	    
	    $get_recharge_credit_debit = $this->get_recharge_credit_debit($user_id);
	    
	    foreach ($get_recharge_credit_debit->result_array() as $value)
	    {
	       $refund =  $value['sum(credit_amount)'];
	       $recharge = $value['sum(debit_amount)'];
	    }
	  
	  
	  ////////////BILLING/////////  
	    $billing_credit_debit = $this->billing_credit_debit($user_id);
	    
	     foreach ($billing_credit_debit->result_array() as $value)
	    {
	        $revert = $value['sum(debit_amount)'];
            $billing = $value['sum(credit_amount)'];
	    }
	    
	    
	    //////////////////SUCCESS AND COMMMISSION/////
	   $success_and_commission = $this->success_and_commission($user_id);
	   
	     foreach ($success_and_commission->result_array() as $value)
	    {
	        $amount_success = $value['sum(amount)'];
            $commission_amount = $value['sum(commission_amount)'];
	    }
	    
	    
	    $current_balance = $this->getCurrentBalance($user_id);
	    
	   $opening_balance = $this->opening_balance($user_id);
	    
	    
	    
	    
	    $difference = $opening_balance+$billing+$refund-$recharge-$revert;
	    $diff = $difference-$current_balance;
	   
	 
	    
	   // $this->adjust($user_id,$difference);
	    
	    if($diff <= "-10"  or $diff >= "10")
	    {
	      $this->adjust($user_id,$difference);
	      
	      
	       echo "DIFF ".$diff." USER ID ".$user_id."  Balance Should be  ".$difference."  opening balance ".$opening_balance." Commission ".$commission_amount."  Success Recharge ".$amount_success." Billing reverted ".$revert." and credited ".$billing." refund ".$refund." success ".$recharge." current balance ".$current_balance."<br>"; exit;
	       
	       
	    }
	   
	    
	  echo "No difference <br>";
	}
		
	}	
	

	public function get_user()
	{
	    date_default_timezone_set('Asia/Calcutta');
		$date = date("Y-m-d");	
	    
	    $url = "SELECT user_id from tblrecharge where recharge_date = '$date' group by user_id";
	   $rsp =  $this->db->query($url);
	    
	    return $rsp;
	    
	}
	
	
	public function get_recharge_credit_debit($user_id)
	{
	    
	    date_default_timezone_set('Asia/Calcutta');
		$date = date("Y-m-d");
	    $url = "SELECT sum(debit_amount), sum(credit_amount) FROM tblewallet WHERE user_id = '$user_id' and transaction_type != 'JADY' and transaction_type != 'PAYMENT' and DATE(add_date) ='$date'";
	    
	    return $rsp =  $this->db->query($url);
	    
	    
	    
	}
	
	
	public function billing_credit_debit($user_id)
	{
	     date_default_timezone_set('Asia/Calcutta');
		$date = date("Y-m-d");
	    $url = "SELECT sum(debit_amount), sum(credit_amount) FROM tblewallet WHERE user_id = '$user_id' and transaction_type = 'PAYMENT' and DATE(add_date) ='$date'";
	    
	    return $rsp =  $this->db->query($url);
	    
	}
	
	
	
	public function success_and_commission($user_id)
	{
	    
	    date_default_timezone_set('Asia/Calcutta');
		$date = date("Y-m-d");
	    $url = "SELECT sum(amount), sum(commission_amount) FROM tblrecharge WHERE user_id = '$user_id' and recharge_status != 'Failure' and DATE(add_date)>='$date'";
	    
	    return $rsp =  $this->db->query($url);
	}
	
	
	
		public function getCurrentBalance($user_id)
	{
		$str_query = "SELECT * FROM `tblewallet` where user_id = ? order by Id desc limit 1";
		$result = $this->db->query($str_query,array($user_id));
		if($result->num_rows() > 0)
		{
			return $result->row(0)->balance;
		}
		else 
		{
			return 0;
		}
		return 0;
	}
	
	
			public function opening_balance($user_id)
	{
	    
	     date_default_timezone_set('Asia/Calcutta');
		 $date = date("Y-m-d");
		 
		  $new_date = date('Y-m-d', strtotime($date.' - 1 days')); 
		  
		$str_query = "SELECT balance FROM `tblewallet` where user_id = ? and DATE(add_date)<='$new_date' order by Id desc limit 1";
		$result = $this->db->query($str_query,array($user_id));
		if($result->num_rows() > 0)
		{
			return $result->row(0)->balance;
		}
		else 
		{
			return 0;
		}
		return 0;
	}
	
	
		public function adjust($user_id,$dr_amount)
	{
	
	
		$add_date = $this->common->getDate();
		$date = $this->common->getMySqlDate();

		
		$current_balance = $dr_amount;
		
		$str_query = "insert into  tblewallet(user_id,recharge_id,transaction_type,debit_amount,balance,description,add_date)
		values(?,?,?,?,?,?,?)";
		$reslut = $this->db->query($str_query,array($user_id,"0","JADY",$dr_amount,$current_balance,"ADJUST",$add_date));
		
		return "done";
		
		
	}
	
	
}