<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{
	    $us_id = $this->session->userdata("id");
		$str_query = "select * from tblusers where user_id='$us_id'";
		$rslt = $this->db->query($str_query);

		$this->view_data['total_success'] = $this->total_success($us_id);
		$this->view_data['total_failure'] =$this->total_failure($us_id);
			$this->view_data['total_pending'] =$this->total_pending($us_id);
				$this->view_data['total_purchase'] =$this->total_purchase($us_id);
				$this->view_data['operator_report'] =$this->operator_report($us_id);
				
			$this->view_data['opening_balance'] = $this->opening_balance($us_id);
			
		$this->view_data['get_recharge_credit_debit'] =$this->get_recharge_credit_debit($us_id);
	$this->view_data['billing_credit_debit'] = $this->billing_credit_debit($us_id);
				
		$this->load->view('dashboard_view',$this->view_data);
		
	}
	
	public function index() 
	{
	    
	    
				$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache"); 

		if ($this->session->userdata('logged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		}
		
		else 
		{ 
			$data['message']='';				
			
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Agent' or trim($user) == 'Distributor' or trim($user) == 'MasterDealer')
				{
					$this->pageview();
				}
				else
				{redirect(base_url().'login');}																					
			
		} 
	}	
	public function total_success($us_id)
	{
	    $date = $this->common->getMySqlDate();
	    	$str_query = "select sum(amount) from tblrecharge where user_id='$us_id' and recharge_date='$date' and recharge_status='Success'";
		$rslt = $this->db->query($str_query);
		
		foreach ($rslt->result_array() as $row)
		{
		    return $row['sum(amount)'];
		}


		
	}
	
		public function total_failure($us_id)
	{
	    $date = $this->common->getMySqlDate();
	    	$str_query = "select sum(amount) from tblrecharge where user_id='$us_id' and recharge_date='$date' and recharge_status='Failure'";
		$rslt = $this->db->query($str_query);
		
		foreach ($rslt->result_array() as $row)
		{
		    return $row['sum(amount)'];
		}


		
	}
	
		public function total_Pending($us_id)
	{
	    $date = $this->common->getMySqlDate();
	    	$str_query = "select sum(amount) from tblrecharge where user_id='$us_id' and recharge_date='$date' and recharge_status='Pending'";
		$rslt = $this->db->query($str_query);
		
		foreach ($rslt->result_array() as $row)
		{
		    return $row['sum(amount)'];
		}


		
	}
	
		public function total_purchase($us_id)
	{
	    $date = $this->common->getMySqlDate();
	    	$str_query = "select sum(credit_amount) from tblewallet where user_id='$us_id' and DATE(add_date) = '$date'  and transaction_type = 'PAYMENT'";
		$rslt = $this->db->query($str_query);
		
		foreach ($rslt->result_array() as $row)
		{
		    return $row['sum(credit_amount)'];
		}


		
	}
	
	
	
	
	
	
	
	
		public function operator_report($us_id)
	{
	   //  $us_id =  "2814";
	    $date = $this->common->getMySqlDate();
	    	$str_query = "select sum(amount), tblcompany.company_name from tblrecharge, tblcompany where tblrecharge.company_id = tblcompany.company_id and user_id='$us_id' and recharge_date>='$date' and recharge_date<='$date' and recharge_status='Success'group by company_name";
	return	$rslt = $this->db->query($str_query);
		
		

//and recharge_date>='$date' and recharge_date<='$date' group by company_name
		
	}
	
	
	public function opening_balance($us_id)
	{
	    
	     date_default_timezone_set('Asia/Calcutta');
		 $date = date("Y-m-d");
		 
		  $new_date = date('Y-m-d', strtotime($date.' - 1 days')); 
		  
		$str_query = "SELECT balance FROM `tblewallet` where user_id = ? and DATE(add_date)<='$new_date' order by Id desc limit 1";
		$result = $this->db->query($str_query,array($us_id));
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
	
	public function get_recharge_credit_debit($us_id)
	{
	    
	    date_default_timezone_set('Asia/Calcutta');
		$date = date("Y-m-d");
	    $url = "SELECT sum(debit_amount), sum(credit_amount) FROM tblewallet WHERE user_id = '$us_id' and transaction_type != 'JADY' and transaction_type != 'PAYMENT' and DATE(add_date) ='$date'";
	    
	    return $rsp =  $this->db->query($url);
	    
	    
	    
	}	
	public function zidu()
	{
	    $url = "select * from tblusers";
	    $reult = $this->db->query($url);
	    
	   $user =  $reult->result();
	 
	echo  $user = json_encode($user);
	   
	   
	    
	}
	
	public function billing_credit_debit($us_id)
	{
	     date_default_timezone_set('Asia/Calcutta');
		$date = date("Y-m-d");
	    $url = "SELECT sum(debit_amount), sum(credit_amount) FROM tblewallet WHERE user_id = '$us_id' and transaction_type = 'PAYMENT' and DATE(add_date) ='$date'";
	    
	    return $rsp =  $this->db->query($url);
	    
	}
	
	
}