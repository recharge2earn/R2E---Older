<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check_transaction extends CI_Controller {
	
	
	private $msg='';

	
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
		//print_r($this->input->post());exit;
			if($this->input->post('hidaction') == "Set")
			{	$this->load->model("Tblrecharge_methods");			
				$status = $this->input->post("hidstatus",TRUE);
				$recharge_id = $this->input->post("hidrechargeid",TRUE);
				$recharge_info = $this->Tblrecharge_methods->getRechargeTblEntry($recharge_id);
				$oldStatus = $recharge_info->row(0)->recharge_status;
				if($oldStatus != $status)
				{
					if($oldStatus == "Pending" or $oldStatus == "Failure")
					{
						if($status == "Success")
						{
							$user_id = $recharge_info->row(0)->user_id;
							$this->resolveFailureToSuccess($recharge_id,$user_id);
						}
						
					}
					else if($oldStatus == "Success")
					{
						if($status == "Failure")
						{
							$this->resolveSuccessToFailure($recharge_id,$recharge_info->row(0)->user_id);
						}
					}
				}
				$this->load->model('List_recharge_model');
				$result = $this->List_recharge_model->updateAction($status,$recharge_id);
				if($result == true)
				{
					$txtRecId = $recharge_id;
				$rslt_accoutn = $this->AccountLedger_getReport($txtRecId);
				
				$rslt = $this->db->query("select tblrecharge.*,(select business_name from tblusers where user_id = tblrecharge.user_id) as business_name,(select company_name from tblcompany where tblcompany.company_id = tblrecharge.company_id) as company_name from tblrecharge where recharge_Id = '$txtRecId'");
				$this->view_data['pagination']  = NULL;
				$this->view_data['message']  = NULL;
				$this->view_data["result_recharge"] = $rslt;	
				$this->view_data["result_account"] = $rslt_accoutn;	
				$this->load->view("check_transaction_view",$this->view_data);	;	
				}
			}
			else if($this->input->post('hidflag') == "Set")
			{
				$value = $this->input->post('hidvalue');
				$rslt = $this->db->query("update tblflags set value = '$value' where param ='reloadlistRecharge'");
				$this->pageview();
			}
			else if($this->input->post('hidrefset') == "Set")
			{	
			
				$recharge_id = $this->input->post("hidrecId",TRUE);
				$ew_id = $this->input->post("hidewid",TRUE);
				$this->refundOfAcountReportEntry($ew_id,$recharge_id);
				
				$txtRecId = $recharge_id;
				$rslt_accoutn = $this->AccountLedger_getReport($txtRecId);
				
				$rslt = $this->db->query("select tblrecharge.*,(select business_name from tblusers where user_id = tblrecharge.user_id) as business_name,(select company_name from tblcompany where tblcompany.company_id = tblrecharge.company_id) as company_name from tblrecharge where recharge_Id = '$txtRecId'");
				$this->view_data['pagination']  = NULL;
				$this->view_data['message']  = NULL;
				$this->view_data["result_recharge"] = $rslt;	
				$this->view_data["result_account"] = $rslt_accoutn;	
				$this->load->view("check_transaction_view",$this->view_data);
				
				
				
			}
			else if($this->input->post('btnSearch'))
			{
				$txtRecId = $this->input->post('txtRecId',true);
				$rslt_accoutn = $this->AccountLedger_getReport($txtRecId);
				
				$rslt = $this->db->query("select tblrecharge.*,(select business_name from tblusers where user_id = tblrecharge.user_id) as business_name,(select company_name from tblcompany where tblcompany.company_id = tblrecharge.company_id) as company_name from tblrecharge where recharge_Id = '$txtRecId'");
				$this->view_data['pagination']  = NULL;
				$this->view_data['message']  = NULL;
				$this->view_data["result_recharge"] = $rslt;	
				$this->view_data["result_account"] = $rslt_accoutn;	
				$this->load->view("check_transaction_view",$this->view_data);				
			}
			else if($this->uri->segment(3) > 0)
			{
				$txtRecId = $this->uri->segment(3);
				$rslt_accoutn = $this->AccountLedger_getReport($txtRecId);
				
				$rslt = $this->db->query("select tblrecharge.*,(select business_name from tblusers where user_id = tblrecharge.user_id) as business_name,(select company_name from tblcompany where tblcompany.company_id = tblrecharge.company_id) as company_name from tblrecharge where recharge_Id = '$txtRecId'");
				$this->view_data['pagination']  = NULL;
				$this->view_data['message']  = NULL;
				$this->view_data["result_recharge"] = $rslt;	
				$this->view_data["result_account"] = $rslt_accoutn;	
				$this->load->view("check_transaction_view",$this->view_data);
			}
			else
			{
				$user=$this->session->userdata('auser_type');
				if(trim($user) == 'Admin')
				{
					$this->view_data['pagination']  = NULL;
					$this->view_data['message']  = NULL;
					$this->load->view("check_transaction_view",$this->view_data);
				}
				else
				{redirect(base_url().'login');}																								
			}
		} 
	}	
	public function AccountLedger_getReport($recharge_id)
	{
		$str_query = "select tblewallet.* ,(select tblpayment.add_date from tblpayment where tblpayment.payment_id = tblewallet.payment_id) as payment_date,(select business_name from tblusers where tblusers.user_id =tblewallet.user_id ) as bname,(select username from tblusers where tblusers.user_id = (select cr_user_id from tblpayment where tblpayment.payment_id = tblewallet.payment_id)) as username,(select usertype_name from tblusers where tblusers.user_id = (select cr_user_id from tblpayment where tblpayment.payment_id = tblewallet.payment_id)) as usertype from tblewallet where recharge_id = '$recharge_id' order by tblewallet.Id desc";
		$rslt = $this->db->query($str_query);
		return $rslt;
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
	public function refundOfAcountReportEntry($ewid,$recid)
	{
		$rslt = $this->db->query("select * from tblewallet where recharge_id = '$recid' and Id  = '$ewid'");
		if($rslt->num_rows() == 1)
		{
			$user_id = $rslt->row(0)->user_id;
			$this->load->model("Tblcompany_methods");
			$debit_amount = $rslt->row(0)->debit_amount;
			$transaction_type = "Recharge_Refund";
			$cr_amount = $debit_amount;
			$Description = "Refund : ".$rslt->row(0)->description;
			$this->Insert_model->tblewallet_Recharge_CrEntry($user_id,$recid,$transaction_type,$cr_amount,$Description);
			
		}
		
	}
	
}