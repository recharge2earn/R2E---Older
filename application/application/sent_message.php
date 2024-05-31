<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sent_message extends CI_Controller {
	
	
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
		$rslt_all = $this->db->query("select Id from sms_outbox where Date(add_date) >= ? and Date(add_date) <= ?",array($fromdate,$todate));
		$result =  $rslt_all;
		$total_row = $result->num_rows();		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."sent_message/pageview";
		$config['total_rows'] = $total_row;
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config); 
		$this->view_data['numrows'] =$total_row; 
		$this->view_data['pagination'] = $this->pagination->create_links();
		$this->view_data['result_messages'] = $this->db->query("select * from sms_outbox where Date(add_date) >= ? and Date(add_date) <= ? order by Id desc limit ?,?",array($fromdate,$todate,$start_row,$per_page));
		$this->view_data['message'] =$this->msg;
		$this->load->view('sent_message_view',$this->view_data);			
	}
	
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
			if($this->input->post('btnSearch'))
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
	
	
}