<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Child_transactions extends CI_Controller {
	
	
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
			$user_id = $this->Common_methods->decrypt($this->input->post('ddlUser',true));
			$parent_id = $this->session->userdata("id");
			$parent_type = $this->session->userdata("user_type");
			$this->load->model('Agent_report_model');
			if($this->session->userdata("user_type") == "Distributor" or $this->session->userdata("user_type") == "MasterDealer")
			{
				$rslt = $this->db->query("select tblrecharge.*,(select business_name from tblusers where tblusers.user_id = tblrecharge.user_id) as business_name,tblcompany.company_name from tblrecharge,tblcompany,tblusers where 
		tblusers.user_id = tblrecharge.user_id and
		tblcompany.company_id=tblrecharge.company_id and recharge_date>=? and recharge_date<= ? and tblrecharge.user_id=? order by tblrecharge.recharge_id desc",array($from,$to,$user_id));
				$this->view_data['result_all'] = $rslt;
			}
			
			$this->view_data['message'] =$this->msg;
			$this->load->view('child_transactions_view',$this->view_data);								
		}
		else 
		{ 						
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Distributor' or trim($user) == 'MasterDealer')
				{										
					$this->view_data['message']='';
					$this->load->view('child_transactions_view',$this->view_data);		
				}
				else
				{redirect(base_url().'login');}																								
		} 
	}	
}