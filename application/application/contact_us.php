<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contact_us extends CI_Controller {
	public function index()
	{ 
		if($this->input->post('hidForm') == 'true')
		{
			$name = $this->input->post('txtFname',TRUE);
			$email = $this->input->post('txtEmail',TRUE);			
			$message = $this->input->post('txaMsg',TRUE);
			$conactno = $this->input->post('txtMobNo',TRUE);
			$subject = $this->input->post('ddlType',TRUE);
			$this->load->model('contact_us_model');
			if($this->contact_us_model->add($name,$email,$message,$conactno,$subject) == true)
			{
				$this->session->set_flashdata('message', 'Contact Form Details Submited Successfully.<br /> Out support team contact you within 48 hours.');
				redirect('contact_us');
			}
		}
		else
		{
		$this->load->view('contact_us.php');			
		}
	}	
}
