<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class D_user_scheme extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{ 
		if($this->input->post("btnView") == "View")
		{		
		$user_id = $this->input->post("txtname");
		$this->load->model('User_scheme_model');		
		$this->view_data['result_commission'] = $this->User_scheme_model->get_commission_by_user($user_id);
		$this->view_data['message'] =$this->msg;
		$this->load->view('d_user_scheme_view',$this->view_data);					
		}
		else if($this->input->post("btnSchemeView") == "View")
		{		
		$scheme_id = $this->input->post("txtscheme");
		$this->load->model('User_scheme_model');		
		$this->view_data['result_commission'] = $this->User_scheme_model->get_commission_by_scheme($scheme_id);
		$this->view_data['message'] =$this->msg;
		$this->load->view('d_user_scheme_view',$this->view_data);					
		}						
		else if($this->input->post("btnChange") == "Change Commission")
		{
		$user_id = $this->input->post("txtname");
		$scheme_id = $this->input->post("txtscheme");		
		$this->load->model('User_scheme_model');		
		$this->User_scheme_model->update_scheme($user_id,$scheme_id);
		$this->view_data['message'] ='User Scheme Update Successfully.';
		$this->load->view('d_user_scheme_view',$this->view_data);								
		}
		else
		{			
		$this->view_data['result_commission'] = NULL;
		$this->view_data['message'] =$this->msg;
		$this->load->view('d_user_scheme_view',$this->view_data);		
		}
	}
	
	public function index() 
	{
		//$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
//$this->output->set_header("Pragma: no-cache"); 

		if ($this->session->userdata('logged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		}				
		else 
		{ 
			$data['message']='';				
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'SuperDealer')
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