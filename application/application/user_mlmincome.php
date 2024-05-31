<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_mlmincome extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{ 
		if($this->input->post("btnSearch") == "Search")
		{
		$date1 = $this->input->post("txtFrom");
		$date2 = $this->input->post("txtTo");
		$id = $this->session->userdata('id');			
		$this->load->model('User_mlmincome_model');		
		$this->view_data['result_commission'] = $this->User_mlmincome_model->get_commission_received_bydate($id,$date1,$date2);
		$this->view_data['message'] =$this->msg;
		$this->load->view('user_mlmincome_view',$this->view_data);		
			
		}
		else
		{	
		$id = $this->session->userdata('id');
		$this->load->library('common');
		$date = $this->common->getMySqlDate();
		$this->load->model('User_mlmincome_model');		
		$this->view_data['result_commission'] = $this->User_mlmincome_model->get_commission_received($id,$date);
		$this->view_data['message'] =$this->msg;
		$this->load->view('user_mlmincome_view',$this->view_data);		
		}
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
			$data['message']='';				
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Distributor' or trim($user) == 'MLMAgent')
				{
				$this->pageview();
				}
				else
				{redirect(base_url().'login');}																					
			}
		} 
	}	
}
//50.22.77.79