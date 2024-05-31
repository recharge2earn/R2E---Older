<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Billing_summary extends CI_Controller {
	
	
	private $msg='';
	
	
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
			if($this->input->post('btnSearch') == "Search")
			{
                                $this->load->model("Report");
				$from_date = $this->input->post("txtFrom",TRUE);
				$to_date = $this->input->post("txtTo",TRUE);
			
				$user_id = $this->session->userdata("id");
				$this->view_data['from_date'] = $from_date;
				$this->view_data['to_date'] = $to_date;
				$this->view_data['pagination'] = NULL;
				$this->view_data['result_mdealer'] = $this->Report->AccountLedger_getReport($user_id,$from_date,$to_date);
				$str_query = "select tblewallet.* from tblewallet where user_id = '$user_id' and DATE(add_date) >= '$from_date' and DATE(add_date) <= '$to_date' and transaction_type == 'PAYMENT' order by tblewallet.Id desc";
		$rslt = $this->db->query($str_query);
				$this->view_data['result_mdealer'] = rslt;
				$this->view_data['flagopenclose'] =1;
				$this->view_data['message'] =$this->msg;
				$this->load->view('billing_summary_view',$this->view_data);		
			}					
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Agent' or trim($user) == 'Distributor' or trim($user) == 'MasterDealer')
				{
				$today_date = $this->common->getMySqlDate();
				$from_date = "2015-01-01";
			
				$user_id = $this->session->userdata("id");
				$this->view_data['from_date'] = $from_date;
				$this->view_data['to_date'] = $today_date;
				$this->view_data['pagination'] = NULL;
				
				$str_query = "select tblewallet.* from tblewallet where user_id = '$user_id' and DATE(add_date) >= '$from_date' and DATE(add_date) <= '$today_date' and transaction_type = 'PAYMENT' order by tblewallet.Id desc limit 0, 10";
		$rslt = $this->db->query($str_query);
				
				$this->view_data['result_mdealer'] = $rslt;
				$this->view_data['flagopenclose'] =1;
				$this->view_data['message'] =$this->msg;
				$this->load->view('billing_summary_view',$this->view_data);		
				}
				else
				{redirect(base_url().'login');}																								
			}
		} 
	}	
}