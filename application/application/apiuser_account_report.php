<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Apiuser_account_report extends CI_Controller {

	

	

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

			if($this->input->post('btnSearch') == "Search")

			{

				$this->load->model("Report");

				$from_date = $this->input->post("txtFrom",TRUE);

				$to_date = $this->input->post("txtTo",TRUE);

				$user_id = $this->input->post("ddlUser",TRUE);

			

				$this->view_data['from_date'] = $from_date;

				$this->view_data['to_date'] = $to_date;

				$this->view_data['pagination'] = NULL;

				$this->view_data['totalPending'] = $this->Common_methods->getTotalPandingRecharge($user_id);

				$this->view_data['result_mdealer'] = $this->Report->AccountLedger_getReport($user_id,$from_date,$to_date);

				$this->view_data['flagopenclose'] =1;

				$this->view_data['message'] =$this->msg;

				$this->load->view('apiuser_account_report_view',$this->view_data);		

			}					

			

			else

			{

				$user=$this->session->userdata('auser_type');

				if(trim($user) == 'Admin')

				{

				$this->load->model("Report");

				$today_date = $this->common->getMySqlDate();

			

				$this->view_data['from_date'] = $today_date;

				$this->view_data['to_date'] = $today_date;

				$this->view_data['pagination'] = NULL;

				$this->view_data['totalPending'] =false;

				$this->view_data['result_mdealer'] = false;

				$this->view_data['flagopenclose'] =false;

				$this->view_data['message'] =$this->msg;

				$this->load->view('apiuser_account_report_view',$this->view_data);		

				}

				else

				{redirect(base_url().'login');}																								

			}

		} 

	}	

}