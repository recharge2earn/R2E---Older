<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apiuser_transaction_reoprt extends CI_Controller {
	
	private $msg='';	
	public function index() 
	{
				$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache"); 

		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		}				
		else if($this->input->post('btnSearch'))
		{
			$from = $this->input->post('txtFrom',true);
			$to = $this->input->post('txtTo',true);
			$service_id = $this->input->post('ddlService',true);
			$user_id = $this->input->post('ddlUserName',true);
			$str_query ="select tblrecharge.*,tblcompany.company_name, tblusers.username from tblrecharge,tblcompany,tblusers where 
				tblusers.user_id = tblrecharge.user_id and tblusers.usertype_name = 'APIUSER' and
		tblcompany.company_id=tblrecharge.company_id and recharge_date>=? and recharge_date<= ? and tblrecharge.user_id = ? order by tblrecharge.recharge_date";		
		$result = $this->db->query($str_query,array($from,$to,$user_id));
			$this->view_data['result_rch'] = $result;
			$this->view_data['message'] =$this->msg;
			$this->load->view('apiuser_transaction_reoprt_view',$this->view_data);								
		}
		else 
		{ 						
				$user=$this->session->userdata('auser_type');
				if(trim($user) == 'Admin')
				{										
					$this->view_data['message']='';
					$this->load->view('apiuser_transaction_reoprt_view',$this->view_data);		
				}
				else
				{redirect(base_url().'login');}																								
		} 
	}	
}