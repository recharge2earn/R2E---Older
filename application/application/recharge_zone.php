<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recharge_zone extends CI_Controller {
 	public function getBalance()
	{		
		$this->load->model('Recharge_home_model');
		if($this->session->userdata("user_type") == "Agent")
		{
			$balance = $this->Common_methods->getAgentBalance($this->session->userdata("id"));	
			
		}
		else
		{
			$balance = $this->Common_methods->getCurrentBalance($this->session->userdata("id"));
			
		}
		//$balance = $this->Recharge_home_model->GetCurrentBalance();
		echo "<span id='spanbal' style='text-align:center;vertical-align:central;padding-top:10px;padding-left:30px;float:left;position:absolute;font-weight:bold;color:#FFF;'>  Balance : ".$balance."</span>";
		
	}
	public function get_ajax_transaction()
	{
	echo '<table style="width:100%;" cellpadding="3" cellspacing="0" border="0">
    <tr class="ColHeader">
    <th scope="col" align="left">ID</th>
    <th scope="col" align="left">Company</th>
    <th scope="col" align="left">Mobile No</th>
    <th scope="col" align="left">Amt</th>
    <th scope="col" align="left">By</th>    
    <th scope="col" align="left">Status</th>
	   
    <th scope="col" align="left">Date Time</th>	
	<th scope="col" align="left">Transaction</th>
	<th scope="col" align="left">Complain</th>
    </tr>';
	$str_query_recharge = "select tblrecharge.*,tblcompany.company_name from tblrecharge,tblcompany where tblcompany.company_id=tblrecharge.company_id and user_id=? order by tblrecharge.recharge_id desc limit 0, 7";
	$result_recharge = $this->db->query($str_query_recharge,array($this->session->userdata('id')));		
	$i = 0;
	foreach($result_recharge->result() as $resultRecharge) 	{ 
		echo '<tr class="'; 
		if($i%2 == 0){
			echo "row1"; 
			}
			else{ 
			echo "row2";
			}
		echo '">';
		echo '<td>'.$resultRecharge->recharge_id.'</td>';
        echo '<td>'.$resultRecharge->company_name.'</td>';
 		echo '<td>'.$resultRecharge->mobile_no.'</td>';
 		echo '<td>'.$resultRecharge->amount.'</td>';
 		echo '<td>'.$resultRecharge->recharge_by.'</td>';		 		
 		echo '<td>';
		if($resultRecharge->recharge_status == "Pending") { echo '<span class="orange">Pending</span>'; }  
		if($resultRecharge->recharge_status == 'Success') { echo '<span class="green">Success</span>'; }  
		if($resultRecharge->recharge_status == 'Failure') { echo '<span class="red">Failure</span>'; } 		
		echo '</td>';
		
		echo '<td>'.$resultRecharge->recharge_date.'<br/>'.$resultRecharge->recharge_time.'</td>';
		  echo '<td>';
  			if($resultRecharge->recharge_status == "Success")
			{
				echo "<span class='green'>Debit</span>";
			}
  			if($resultRecharge->recharge_status == "Pending")
			{
				echo "<span>Wait</span>";
			}
 			if($resultRecharge->recharge_status == "Failure")
			{
				echo "<span class='red' title='Revert Back Amount : ".$resultRecharge->amount."'>Credit</span>";
			}
  echo '</td> <td align="center"><img src="'.base_url().'images/complain.png" style="height:15px;width:20px;" onClick="javascript:complainadd( '.$resultRecharge->recharge_id.')" /></td>  ';
	echo '</tr>';	 	
		$i++;} 
		echo '</table>';

	}	
	public function getMobileCompany()
	{
		$str_query = "select * from tblcompany where service_id='1' and company_id != 34 and company_id != 39 order by company_name";
		$result_mobile = $this->db->query($str_query);		
		echo '<option>--Select--</option>';
		for($i=0; $i<$result_mobile->num_rows(); $i++)
		{
			echo "<option serviceid='".$result_mobile->row($i)->service_id."'   value='".$result_mobile->row($i)->company_id."'>".    $result_mobile->row($i)->company_name."</option>";
	}
	}
	public function getLAPUCompany()
	{
		$str_query = "select * from tblcompany where service_id='3' and company_id != 34 and company_id != 39 order by company_name";
		$result_mobile = $this->db->query($str_query);		
		echo '<option>--Select--</option>';
		for($i=0; $i<$result_mobile->num_rows(); $i++)
		{
			echo "<option serviceid='".$result_mobile->row($i)->service_id."'   value='".$result_mobile->row($i)->company_id."'>".    $result_mobile->row($i)->company_name."</option>";
	}
	}
	public function getPOSTPAIDCompany()
	{
		$str_query = "select * from tblcompany where service_id='4' and company_id != 34 and company_id != 39 order by company_name";
		$result_mobile = $this->db->query($str_query);		
		echo '<option>--Select--</option>';
		for($i=0; $i<$result_mobile->num_rows(); $i++)
		{
			echo "<option serviceid='".$result_mobile->row($i)->service_id."'   value='".$result_mobile->row($i)->company_id."'>".    $result_mobile->row($i)->company_name."</option>";
	}
	}
	public function getDTHCompany()
	{		
		$str_query = "select * from tblcompany where service_id='2' order by company_name";
		$result_dth = $this->db->query($str_query);		
		echo '<option>--Select--</option>';
		for($i=0; $i<$result_dth->num_rows(); $i++)
		{
			echo "<option serviceid='".$result_dth->row($i)->service_id."' value='".$result_dth->row($i)->company_id."'>".$result_dth->row($i)->company_name."</option>";
		}
	}

	
	public function index()
	{	
		if ($this->session->userdata('logged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		} 
		else 
		{ 

		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache"); 
			$user=$this->session->userdata('user_type');			
			if(trim($user) == 'Agent' or trim($user) == 'MasterDealer' or trim($user) == 'Distributor')
			{
			if($this->input->post("btnRecharge") == "Recharge")				
			{
			$this->load->model("Tblcompany_methods");
			$this->load->model("Do_recharge_model");	
			$this->load->model("Recharge_home_model");
			$MobileNo =	$this->input->post("txtMobileNo",true);
			$Amount = $this->input->post("txtAmount",true);
			$company_id=$this->input->post("ddlOperator",true);	
			$company_info = $this->Tblcompany_methods->getCompany_info($company_id);
			if($company_info == false)
			{
				$this->session->set_flashdata('message', 'Please Select Operator.');
				redirect(base_url()."recharge_zone");	
			}
			$product_name = $company_info->row(0)->product_name;
			$RoyalProvider = $company_info->row(0)->provider;			
			$user_id= $this->session->userdata('id');
			$service_id = $this->input->post("hidServiceId",true);
			$circle_code = $this->input->post("hidCircle",true);
			$scheme_id = $this->session->userdata("scheme_id");
			$recharge_type = $this->Common_methods->getRechargeType($service_id);
			$rechargeBy = "WEB";
			$current_bal = $this->Common_methods->getAgentBalance($user_id);
			if($Amount < 10)
			{	
				$this->session->set_flashdata('message', 'Minimum amount 10 INR For Recharge.');
				redirect(base_url()."recharge_zone");			
			}
			
			$user_info = $this->Userinfo_methods->getUserInfo($user_id);	
			if($current_bal >= $Amount)
			{	
														
					//$circle_code = "*";
					$response = $this->Do_recharge_model->ProcessRecharge($user_info,$circle_code,$company_id,$Amount,$MobileNo,$recharge_type,$service_id,$rechargeBy);
					$this->session->set_flashdata('message', $response);
					redirect(base_url()."recharge_zone");	
				
			}
			else
			{
					$this->session->set_flashdata('message', 'Insufficient Balance');
					redirect(base_url()."recharge_zone");	
			}
			
		}
			else
			{					
					$this->view_data['message'] ="";
					$this->load->view('recharge_zone_view',$this->view_data);
			}
		} 
	}
}
}	