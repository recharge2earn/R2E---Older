<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Earn_comm extends CI_Controller {
	
	
	private $msg='';	
	public function index() 
	{
				$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache"); 

		if ($this->session->userdata('user_type') != "Distributor" and $this->session->userdata('user_type') != "MasterDealer") 
		{ 
			redirect(base_url().'login'); 
		}				
		else if($this->input->post('btnSearch'))
		{
			$from = $this->input->post('txtFrom',true);
			$to = $this->input->post('txtTo',true);
			$id = $this->session->userdata('id');			
			$this->load->model('Parent_commission_model');
			$this->view_data['result_all'] = $this->Parent_commission_model->getParentCommission($id,$from,$to);
			$this->view_data['message'] =$this->msg;
			$this->view_data['from_date'] = $from;
			$this->view_data['to_date'] = $to;
			
			$this->load->view('earn_comm_view',$this->view_data);								
		}
		else 
		{ 						
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Distributor' or trim($user) == 'MasterDealer')
				{										
					$date = $this->common->getMySqlDate();
					$id = $this->session->userdata('id');			
					$this->load->model('Parent_commission_model');
					$this->view_data['result_all'] = $this->Parent_commission_model->getParentCommission($id,$date,$date);
					$this->view_data['message'] =$this->msg;
					$this->view_data['from_date'] = $date;
					$this->view_data['to_date'] = $date;
			
					$this->load->view('earn_comm_view',$this->view_data);			
				}
				else
				{redirect(base_url().'login');}																								
		} 
	}	
}