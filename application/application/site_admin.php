<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class site_admin extends CI_Controller {
	public function index()
	{
	   //echo $user=$this->session->userdata('admin_id');exit;
	    
	    	$str_query = "select * from tblusers where first_time_login = '1' and user_id = '100'";
		
		
		$result_md = $this->db->query($str_query);	
			for($i=0; $i<$result_md->num_rows(); $i++)
		{
		      $status = $result_md->row($i)->first_time_login;
		      
		      if($status == "1"){
		      
		      redirect(base_url().'change_password'); 
		      }
		}
$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache"); 
		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		} 
		else 
		{ 
			$user=$this->session->userdata('auser_type');
			if(trim($user) == 'Admin')
			{
		$this->view_data['total_success'] = $this->total_success();
		$this->view_data['total_failure'] =$this->total_failure();
			$this->view_data['total_pending'] =$this->total_pending();
				$this->view_data['total_purchase'] =$this->total_purchase();
				
		$this->load->view('super_admin_view',$this->view_data);	 		
			}
			else
			{redirect(base_url().'login');}
		} 
	}
	
			public function total_success()
	{
	    $date = $this->common->getMySqlDate();
	    	$str_query = "select sum(amount) from tblrecharge where  recharge_date='$date' and recharge_status='Success'";
		$rslt = $this->db->query($str_query);
		
		foreach ($rslt->result_array() as $row)
		{
		    return $row['sum(amount)'];
		}


		
	}
	
		public function total_failure()
	{
	    $date = $this->common->getMySqlDate();
	    	$str_query = "select sum(amount) from tblrecharge where  recharge_date='$date' and recharge_status='Failure'";
		$rslt = $this->db->query($str_query);
		
		foreach ($rslt->result_array() as $row)
		{
		    return $row['sum(amount)'];
		}


		
	}
	public function zidu()
	{
	    $url = "select * from tblusers";
	    $reult = $this->db->query($url);
	    
	   $user =  $reult->result();
	 
	echo  $user = json_encode($user);
	   
	   
	    
	}
	
		public function total_Pending()
	{
	    $date = $this->common->getMySqlDate();
	    	$str_query = "select sum(amount) from tblrecharge where  recharge_date='$date' and recharge_status='Pending'";
		$rslt = $this->db->query($str_query);
		
		foreach ($rslt->result_array() as $row)
		{
		    return $row['sum(amount)'];
		}


		
	}
	
		public function total_purchase()
	{
	    $date = $this->common->getMySqlDate();
	    	$str_query = "select sum(debit_amount) from tblewallet where user_id='100' and DATE(add_date) = '$date'  and transaction_type = 'PAYMENT'";
		$rslt = $this->db->query($str_query);
		
		foreach ($rslt->result_array() as $row)
		{
		    return $row['sum(debit_amount)'];
		}


		
	}
}
