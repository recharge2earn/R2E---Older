<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class D_accountreport extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{
		$start_row = $this->uri->segment(3);
		$per_page = 25;
		if(trim($start_row) == ""){$start_row = 0;}
		$this->load->model('Report');
		$result = $this->Report->AccountLedger_getAllReport($this->session->userdata("id"));
		$total_row = $result->num_rows();		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."account_report/pageview";
		$config['total_rows'] = $total_row;
		$config['per_page'] = 25; 
		$this->pagination->initialize($config); 
		$this->view_data['pagination'] = $this->pagination->create_links();
		$this->view_data['result_mdealer'] = $this->Report->AccountLedger_getAllReport_limited($this->session->userdata("id"),$start_row,$per_page);
		$this->view_data['flagopenclose'] =0;
		$this->view_data['message'] =$this->msg;
		$this->load->view('d_account_report_view',$this->view_data);		
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
			if($this->input->post('btnSearch') == "Search")
			{
				$this->load->model("Report");
				$from_date = $this->input->post("txtFrom",TRUE);
				$to_date = $this->input->post("txtTo",TRUE);
				$this->view_data['pagination'] = NULL;
				$this->view_data['result_mdealer'] = $this->Report->AccountLedger_getReport($this->session->userdata("id"),$from_date,$to_date);
				$this->view_data['flagopenclose'] =1;
				$this->view_data['message'] =$this->msg;
				$this->load->view('d_account_report_view',$this->view_data);		
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
				if(trim($user) == 'MasterDealer' or trim($user) == 'Distributor')
				{
					$this->pageview();
				}
				else
				{redirect(base_url().'login');}																								
			}
		} 
	}	
}