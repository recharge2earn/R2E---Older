<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent_account_report extends CI_Controller {
	
	
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
				$this->view_data['totalPending'] = $this->Common_methods->getTotalPandingRecharge($user_id);
				$this->view_data['result_mdealer'] = $this->Report->AccountLedger_getReport($user_id,$from_date,$to_date);
				$this->view_data['flagopenclose'] =1;
				$this->view_data['message'] =$this->msg;
				$this->load->view('agent_account_report_view',$this->view_data);		
			}					
			else if($this->input->post('hidaction') == "Set")
			{								
				$status = $this->input->post("hidstatus",TRUE);
				$user_id = $this->input->post("hiduserid",TRUE);
				$this->load->model('Report');
				$result = $this->Report->updateAction($status,$user_id);
				if($result == true)
				{
					$this->msg="Action Submit Successfully.";
					$this->pageview();	
				}
			}
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Agent')
				{
				$this->load->model("Report");
				$today_date = $this->common->getMySqlDate();
				
			
				$user_id = $this->session->userdata("id");
				$this->view_data['from_date'] = $today_date;
				$this->view_data['to_date'] = $today_date;
				$this->view_data['pagination'] = NULL;
				$this->view_data['totalPending'] = $this->Common_methods->getTotalPandingRecharge($user_id);
				$this->view_data['result_mdealer'] = $this->Report->AccountLedger_getReport($user_id,$today_date,$today_date);
				$this->view_data['flagopenclose'] =1;
				$this->view_data['message'] =$this->msg;
				$this->load->view('agent_account_report_view',$this->view_data);		
				}
				else
				{redirect(base_url().'login');}																								
			}
		} 
	}	
}