<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Withdraw_comm extends CI_Controller {
	private $msg='';
	public function pageview($from_date,$to_date)
	{ 
		if($from_date == '' and $to_date == '')
		{
			$this->view_data['message'] ='';
			$this->load->view('withdraw_comm_view',$this->view_data);		
		}
		else
		{
		
			$query = "SELECT tblparentcommission.Id,(select '' )as description,(select IFNULL(Sum(amount),0)) as totalComm,(select 'variable') as commission_type,

(select '0') as description,(select username from tblusers where tblusers.user_id = tblparentcommission.user_id) as username,(select business_name from tblusers where tblusers.user_id = tblparentcommission.user_id) as business_name,(select mobile_no from tblusers where tblusers.user_id = tblparentcommission.user_id) as mobile_no,(select emailid from tblusers where tblusers.user_id = tblparentcommission.user_id) as emailid,(select IFNULL(Sum(amount),0) from tblrecharge where tblrecharge.recharge_id in (select recharge_id from tblparentcommission a where a.user_id = tblparentcommission.user_id)) as totalRecharge FROM `tblparentcommission` where tblparentcommission.user_id = ? and DATE(add_date) >= '$from_date' and  DATE(add_date) <= '$to_date' and payment_status = 'false' and recharge_id in (select recharge_id from tblrecharge where recharge_status = 'Success' and DATE(add_date) >= '$from_date' and  DATE(add_date) <= '$to_date')  group by user_id";
			
			$this->view_data['result_comm'] = $this->db->query($query,array($this->session->userdata("id")));
			$this->view_data['fromdate'] =$from_date;
			$this->view_data['todate'] =$to_date;
			$this->view_data['message'] =$this->msg;
			$this->load->view('withdraw_comm_view',$this->view_data);		
		}
	}
	public function index() 
	{
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache"); 

		if ($this->session->userdata('user_type') == "Agent") 
		{ 
			redirect(base_url().'login'); 
		}				
		else 
		{ 
			$data['message']='';				
			{
				
				if($this->input->post('hidaction') == "Set")
				{
					$status = $this->input->post("hidstatus",TRUE);
					$comm = $this->input->post("hidamount",TRUE);
					$commType = $this->input->post("hidtype",TRUE);
					$fromdate = $this->input->post("hidfrom",TRUE);
					$todate = $this->input->post("hidto",TRUE);
					$user_id = $this->session->userdata("id");
					
					$Admin_id = $this->Userinfo_methods->getAdminId();
					
					if($commType == "falt")
					{
						
						$str_query = "SELECT tblflatcommission.Id,tblflatcommission.description as description,(select IFNULL(Sum(amount),0)) as totalComm, (select IFNULL(Sum(depositAmount),0)) as totalDeposit FROM `tblflatcommission` where DATE(add_date) <= DATE(Now()) and user_id = '$user_id' and payment_status = 'false'";
						$rslt = $this->db->query($str_query);
					
						$flatComm =  $rslt->row(0)->totalComm;
						$add_date = $this->common->getMySqlDate();
						$discription = "Flat Commission of Rs ".$flatComm;
						if($comm == $flatComm)
						{
							$credit_user_id = $user_id;
							$debit_user_id = $Admin_id;
							$amount = $flatComm;
							$remark = "";
							$description = "Flat Commission of Rs. ".$flatComm." for the period of ".$fromdate." To ".$todate;
							$payment_type = "cash";
							$payment_id = $this->Insert_model->tblewallet_Payment_CrDrEntry($credit_user_id,$debit_user_id,$amount,$remark,$description,$payment_type);
							$str_query = "update tblflatcommission set payment_status='true',payment_date='$add_date',description= '$discription' where DATE(add_date) <= DATE(Now()) and user_id = '$user_id' and payment_status = 'false'";
							$rslt = $this->db->query($str_query);
							$this->msg = "Commission Payment Successful";
							$this->pageview($fromdate,$todate);
						}
						else
						{
							
						}
					}
					else if($commType == "variable")
					{
						$str_query = "SELECT tblparentcommission.Id,(select IFNULL(Sum(amount),0)) as totalComm FROM `tblparentcommission` where tblparentcommission.user_id = '$user_id' and DATE(add_date) >= '$fromdate' and  DATE(add_date) <= '$todate' and payment_status = 'false' and recharge_id in (select recharge_id from tblrecharge where recharge_status = 'Success' and DATE(add_date) >= '$fromdate' and  DATE(add_date) <= '$todate')  group by user_id";
						$rslt = $this->db->query($str_query);
						$VarComm =  $rslt->row(0)->totalComm;
						$add_date = $this->common->getMySqlDate();
						$discription = "Variable Commission of Rs ".$VarComm;
						if($comm == $VarComm)
						{
							$credit_user_id = $user_id;
							$debit_user_id = $Admin_id;
							$amount = $VarComm;
							$remark = "";
							$description = "Variable Commission of Rs. ".$VarComm." for the period of ".$fromdate." To ".$todate;
							$payment_type = "cash";
							$payment_id = $this->Insert_model->tblewallet_Payment_CrDrEntry($credit_user_id,$debit_user_id,$amount,$remark,$description,$payment_type);
							$update_query = "update tblparentcommission set payment_status='true',payment_date='$add_date'  where tblparentcommission.user_id = '$user_id' and DATE(add_date) >= '$fromdate' and  DATE(add_date) <= '$todate' and payment_status = 'false' and recharge_id in (select recharge_id from tblrecharge where recharge_status = 'Success' and DATE(add_date) >= '$fromdate' and  DATE(add_date) <= '$todate')";
							//$str_query = "update tblparentcommission set payment_status='true',payment_date='$add_date' where DATE(add_date) <= DATE(Now()) and user_id = '$user_id' and payment_status = 'false'";
							$rslt = $this->db->query($update_query);
							$this->msg = "Commission Payment Successful";
							$this->pageview($fromdate,$todate);
						}
						else
						{
							
						}
					}
					
						
				}
				else if($this->input->post('btnSearch') == "Search")
				{
					$fromDate = $this->input->post("txtFrom");
					$toDate = $this->input->post("txtTo");
					$this->pageview($fromDate,$toDate);
				}
				
				else
				{
				$user=$this->session->userdata('user_type');
				
				if(trim($user) == 'Distributor' or trim($user) == 'MasterDealer')
				{
					$this->pageview('','');
				}
				else{redirect(base_url().'login');}																					
				}
			}
		} 
	}
}
