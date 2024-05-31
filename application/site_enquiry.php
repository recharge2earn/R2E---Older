<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site_enquiry extends CI_Controller {
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
			$user=$this->session->userdata('auser_type');
			if(trim($user) == 'Admin')
			{
		
				$this->view_data['get_form'] =$this->get_form();
				
		$this->load->view('site_enquiry_view',$this->view_data);	 		
			}
			else
			{redirect(base_url().'login');}
		} 
	}
	
	public function get_form()
	{
	    
	    $query = "select * from contact order by id desc limit 50";
	    $result = $this->db->query($query);
	    
	    return $result->result();
	    
	}
}
