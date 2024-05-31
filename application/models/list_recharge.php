<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class List_recharge extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{
		
		$fromdate = $this->session->userdata("FromDate");
		$todate = $this->session->userdata("ToDate");
		
		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		}
		$start_row = $this->uri->segment(3);
		$per_page =25;
		if(trim($start_row) == ""){$start_row = 0;}
		$this->load->model('List_recharge_model');
		$result =  $this->List_recharge_model->get_recharge_bydate($fromdate,$todate);
		$total_row = $result->num_rows();		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."list_recharge/pageview";
		$config['total_rows'] = $total_row;
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config); 
		$this->view_data['numrows'] =$total_row; 
		$this->view_data['pagination'] = $this->pagination->create_links();
		$this->view_data['result_recharge'] = $this->List_recharge_model->get_recharge_bydate_limited($fromdate,$todate,$start_row,$per_page);
		$this->view_data['message'] =$this->msg;
		$this->load->view('list_recharge_view',$this->view_data);			
	}
	/*public function test()
	{
		$this->load->model("Recharge_home_model");
		$this->load->model("Tblrecharge_methods");
		$recharge_id = $_GET["id"];
		$rechargeInfo = $this->Tblrecharge_methods->getRechargeTblEntry($recharge_id);
		$oldStatus = $rechargeInfo->row(0)->recharge_status;
		$recUser =  $rechargeInfo->row(0)->user_id;
		$trns_id = $rechargeInfo->row(0)->transaction_id; 
		$company_id = $rechargeInfo->row(0)->company_id; 
		$api_info = $ApiInfo=$this->Recharge_home_model->GetAPIInfo($company_id);
		$api_name = $api_info->row(0)->api_name;
		$api_username = $api_info->row(0)->username;
		$api_password = $api_info->row(0)->password;
		if($api_name == "RoyalCapital")
		{
			$url = "http://www.royalcapital.in/recharge/status";
			$postfields = "username=".$api_username ."&pwd=".$api_password."&client_id=".$recharge_id;
			$response = $this->common->ExecuteCustomerURL($url,$postfields);
			if(strpos($royal_resp, '#') !== FALSE)
			{
				$resp_arr = explode("#",$royal_resp);
				if(count($resp_arr) == 2)
				{
					$status = $resp_arr[0];
					$operator_trans_id = $resp_arr[2];
					if($status == "" or $status==NULL)
					{
						$status="Pending";
					}
					$this->Recharge_home_model->updateRechargeStatus($recharge_id,$trns_id,$operator_trans_id,$status);
					if($oldStatus == "Success")
					{
						if($status == "Failure")
						{
							
						}
					}
					else if($oldStatus == "Failure")
					{
						
					}
					else if($oldStatus == "Pending")
					{
						
					}
				}
				else
				{
					$this->Recharge_home_model->updateRechargeStatus($recharge_id,$trns_id,NULL,"Failure");
				}
			}
			echo $response;
			$this->load->model("Errorlog");
			$this->Errorlog->logentry($response);exit;
		}
		
		
		
	}*/
	
	public function index() 
	{
				$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache"); 

		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		}				
		else 		
		{ 	
			if($this->input->post('hidaction') == "Set")
			{
				$this->load->model("Insert_model");
				$this->load->model("Tblrecharge_methods");			
				$status = $this->input->post("hidstatus",TRUE);
				$recharge_id = $this->input->post("hidrechargeid",TRUE);
				$recharge_info = $this->Tblrecharge_methods->getRechargeTblEntry($recharge_id);
				$oldStatus = $recharge_info->row(0)->recharge_status;
				
				if($oldStatus != $status)
				{
					if($oldStatus == "Failure")
					{
						if($status == "Success")
						{
							$user_id = $recharge_info->row(0)->user_id;
							$this->resolveFailureToSuccess($recharge_id,$user_id);
						}
						
					}
					else if($oldStatus == "Success" or $oldStatus == "Pending")
					{
						if($status == "Failure")
						{
							$this->Insert_model->rechargerefund($recharge_id);
						}
					}
				}
				$this->load->model('List_recharge_model');
				$result = $this->List_recharge_model->updateAction($status,$recharge_id);
				if($result == true)
				{
					$this->msg="Action Submit Successfully.";
					$this->pageview();	
				}
			}
			else if($this->input->post('hidflag') == "Set")
			{
				$value = $this->input->post('hidvalue');
				$rslt = $this->db->query("update tblflags set value = '$value' where param ='reloadlistRecharge'");
				$this->pageview();
			}
				else if($this->input->post('hidSearchrechargeAction') == "Set")
			{
				$value = $this->input->post('hidvalue');
				$hash = substr($value, 0, 1);
				if($hash == '#')
				{
					$length = strlen($value);
					$company_name = substr($value, 1, $length);
				//	echo $company_name;exit;
					$fromdate = $this->session->userdata("FromDate");
					$todate = $this->session->userdata("ToDate");
					$str_query = "select tblrecharge.*,(select '')  as payworldCount,(select '')  as totalRecahrge,tblcompany.company_name, username,business_name from tblrecharge,tblcompany,tblusers where tblusers.user_id=tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id and tblrecharge.company_id = (select company_id from tblcompany where tblcompany.company_name = '$company_name') and (Date(tblrecharge.add_date) >= ? and Date(tblrecharge.add_date) <= ?)  order by recharge_id desc";
					$result = $this->db->query($str_query,array($fromdate,$todate));
					$this->view_data['pagination'] = NULL;
					$this->view_data['fromDate'] = NULL;
					$this->view_data['ToDate'] = NULL;
					$this->view_data['result_recharge'] = $result;
					$this->view_data['message'] =$this->msg;
					$this->load->view('list_recharge_view',$this->view_data);
				}
				else if($hash == '>')
				{
					$length = strlen($value);
					$amount = substr($value, 1, $length);
				//	echo $company_name;exit;
					$fromdate = $this->session->userdata("FromDate");
					$todate = $this->session->userdata("ToDate");
					$str_query = "select tblrecharge.*,(select '')  as payworldCount,(select '')  as totalRecahrge,tblcompany.company_name, username,business_name from tblrecharge,tblcompany,tblusers where tblusers.user_id=tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id and tblrecharge.amount >= '$amount' and (Date(tblrecharge.add_date) >= ? and Date(tblrecharge.add_date) <= ?)  order by recharge_id desc";
					$result = $this->db->query($str_query,array($fromdate,$todate));
					$this->view_data['pagination'] = NULL;
					$this->view_data['fromDate'] = NULL;
					$this->view_data['ToDate'] = NULL;
					$this->view_data['result_recharge'] = $result;
					$this->view_data['message'] =$this->msg;
					$this->load->view('list_recharge_view',$this->view_data);
				}
				else if($hash == '<')
				{
					$length = strlen($value);
					$amount = substr($value, 1, $length);
				//	echo $company_name;exit;
					$fromdate = $this->session->userdata("FromDate");
					$todate = $this->session->userdata("ToDate");
					$str_query = "select tblrecharge.*,(select '')  as payworldCount,(select '')  as totalRecahrge,tblcompany.company_name, username,business_name from tblrecharge,tblcompany,tblusers where tblusers.user_id=tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id and tblrecharge.amount <= '$amount' and (Date(tblrecharge.add_date) >= ? and Date(tblrecharge.add_date) <= ?)  order by recharge_id desc";
					$result = $this->db->query($str_query,array($fromdate,$todate));
					$this->view_data['pagination'] = NULL;
					$this->view_data['fromDate'] = NULL;
					$this->view_data['ToDate'] = NULL;
					$this->view_data['result_recharge'] = $result;
					$this->view_data['message'] =$this->msg;
					$this->load->view('list_recharge_view',$this->view_data);
				}
				else if($hash == '@')
				{
					$length = strlen($value);
					$name = substr($value, 1, $length);
				//	echo $company_name;exit;
					$fromdate = $this->session->userdata("FromDate");
					$todate = $this->session->userdata("ToDate");
					$str_query = "select tblrecharge.*,(select '')  as payworldCount,(select '')  as totalRecahrge,tblcompany.company_name, username,business_name from tblrecharge,tblcompany,tblusers where tblusers.user_id=tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id and (tblrecharge.user_id = (select user_id from tblusers where tblusers.business_name = '$name') or tblrecharge.user_id = (select user_id from tblusers where tblusers.username = '$name')) and (Date(tblrecharge.add_date) >= ? and Date(tblrecharge.add_date) <= ?)  order by recharge_id desc";
					$result = $this->db->query($str_query,array($fromdate,$todate));
					$this->view_data['pagination'] = NULL;
					$this->view_data['fromDate'] = NULL;
					$this->view_data['ToDate'] = NULL;
					$this->view_data['result_recharge'] = $result;
					$this->view_data['message'] =$this->msg;
					$this->load->view('list_recharge_view',$this->view_data);
				}
				else if($value == "s" or $value == "f" or $value == "p")
				{
					 
					if($value == "s")
					{
						$value = "Success";
					}
					if($value == "f")
					{
						$value = "Failure";
					}
					if($value == "p")
					{
						$value = "Pending";
					}
					$fromdate = $this->session->userdata("FromDate");
					$todate = $this->session->userdata("ToDate");
					$str_query = "select tblrecharge.*,(select '')  as payworldCount,(select '')  as totalRecahrge ,tblcompany.company_name, username,business_name from tblrecharge,tblcompany,tblusers where tblusers.user_id=tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id and tblrecharge.recharge_status = '$value' and (Date(tblrecharge.add_date) >= ? and Date(tblrecharge.add_date) <= ?)  order by recharge_id desc";
					$result = $this->db->query($str_query,array($fromdate,$todate));
					$this->view_data['pagination'] = NULL;
					$this->view_data['fromDate'] = NULL;
					$this->view_data['ToDate'] = NULL;
					$this->view_data['result_recharge'] = $result;
					$this->view_data['message'] =$this->msg;
					$this->load->view('list_recharge_view',$this->view_data);
					
				}
				else if(strtoupper($value) == "SMS" or strtoupper($value) == "GPRS" or strtoupper($value) == "WEB" or strtoupper($value) == "API")
				{
					 
					
					$fromdate = $this->session->userdata("FromDate");
					$todate = $this->session->userdata("ToDate");
					$str_query = "select tblrecharge.*,(select '')  as payworldCount,(select '')  as totalRecahrge ,tblcompany.company_name, username,business_name from tblrecharge,tblcompany,tblusers where tblusers.user_id=tblrecharge.user_id and tblcompany.company_id=tblrecharge.company_id and tblrecharge.recharge_by = '$value' and (Date(tblrecharge.add_date) >= ? and Date(tblrecharge.add_date) <= ?)  order by recharge_id desc";
					$result = $this->db->query($str_query,array($fromdate,$todate));
					$this->view_data['pagination'] = NULL;
					$this->view_data['fromDate'] = NULL;
					$this->view_data['ToDate'] = NULL;
					$this->view_data['result_recharge'] = $result;
					$this->view_data['message'] =$this->msg;
					$this->load->view('list_recharge_view',$this->view_data);
					
				}
				else
				{
			
					$this->load->model('List_recharge_model');
					$value = $this->input->post('hidvalue');
					$this->view_data['pagination'] = NULL;
					$this->view_data['fromDate'] = NULL;
					$this->view_data['ToDate'] = NULL;
					$this->view_data['result_recharge'] = $this->List_recharge_model->SearchRechargeByWord($value);
					$this->view_data['message'] =$this->msg;
					$this->load->view('list_recharge_view',$this->view_data);	
				}
			}
			
			else if($this->input->post('btnSearch'))
			{
				$Fromdate = $this->input->post('txtFromDate',true);
				$Todate = $this->input->post('txtToDate',true);
				$this->session->set_userdata("FromDate",$Fromdate);
				$this->session->set_userdata("ToDate",$Todate);
				$this->pageview();
				/*$this->load->model('List_recharge_model');
				$this->view_data['pagination'] = NULL;
				$this->view_data['result_recharge'] = $this->List_recharge_model->get_recharge_bydate($Fromdate,$Todate);
				$this->view_data['message'] =$this->msg;
				$this->load->view('list_recharge_view',$this->view_data);	*/							
			}
			else
			{
				$user=$this->session->userdata('auser_type');
				if(trim($user) == 'Admin')
				{
					$todaydate = $this->common->getMySqlDate();
				$this->session->set_userdata("FromDate",$todaydate);
				$this->session->set_userdata("ToDate",$todaydate);
				$this->pageview();
				}
				else
				{redirect(base_url().'login');}																								
			}
		} 
	}	
	public function resolveFailureToSuccess($recharge_id,$recUser)
	{
		$rslt = $this->db->query("select * from tblrecharge where recharge_id = '$recharge_id' and user_id = '$recUser'");
		if($rslt->num_rows() == 1)
		{
			$amount = $rslt->row(0)->amount;
			$company_id = $rslt->row(0)->company_id;
			$mobile_no = $rslt->row(0)->mobile_no;
			$this->load->model("tblcompany_methods");
			$company_name = $this->tblcompany_methods->getCompany_name($company_id);
			$company_name = "";
			$commission_amount = $rslt->row(0)->commission_amount;
			$debit_amount = $amount - $commission_amount;
			$transaction_type = "RechargeSolved";
			$Description = "Resolved Recharge : Recharge_id = ".$recharge_id." : ".$company_name." | ".$mobile_no." | ".$amount;
			$this->Insert_model->tblewallet_Recharge_DrEntry($recUser,$recharge_id,$transaction_type,$debit_amount,$Description);
			
		}
	}
	public function resolveSuccessToFailure($recharge_id,$recUser)
	{
		$rslt = $this->db->query("select * from tblewallet where recharge_id = '$recharge_id' and user_id = '$recUser'");
		if($rslt->num_rows() == 1)
		{
			$this->load->model("Tblcompany_methods");
			$debit_amount = $rslt->row(0)->debit_amount;
			$transaction_type = "Recharge_Refund";
			$cr_amount = $debit_amount;
			$Description = "Refund : ".$rslt->row(0)->description;
			$this->Insert_model->tblewallet_Recharge_CrEntry($recUser,$recharge_id,$transaction_type,$cr_amount,$Description);
			
		}
	}
	public function getdata()
		{
			$fromdate = $this->session->userdata("FromDate");
		$todate = $this->session->userdata("ToDate");
			$this->load->model("List_recharge_model");
		$rslt = $this->List_recharge_model->get_recharge_bydate($fromdate,$todate);
		echo "<table border='1'>";
		echo "<th>Sr NO.</th>";
		echo "<th>Recharge Id.</th>";
		echo "<th>Transaction Id.</th>";
		echo "<th>Recharge Date.</th>";
		echo "<th>AgentName.</th>";
		echo "<th>Company Name.</th>";
		echo "<th>Mobile.</th>";
		echo "<th>Amount.</th>";
		echo "<th>Execute By.</th>";
		echo "<th>Recharge By.</th>";
		echo "<th>Recharge Status.</th>";
		$i = 0;
		foreach($rslt->result() as $rw)
		{
			echo "<tr>";
			echo "<td>".$i."</td>";
			echo "<td>".$rw->recharge_id."</td>";
			echo "<td>".$rw->transaction_id."</td>";
			echo "<td>".$rw->add_date."</td>";
			echo "<td>".$rw->business_name."</td>";
			echo "<td>".$rw->company_name."</td>";
			echo "<td>".$rw->mobile_no."</td>";
			echo "<td>".$rw->amount."</td>";
			echo "<td>".$rw->ExecuteBy."</td>";
			echo "<td>".$rw->recharge_by."</td>";
			echo "<td>".$rw->recharge_status."</td>";
			echo "</tr>";
			$i++;
		}
		echo "</table>";

		exit;
		}
}