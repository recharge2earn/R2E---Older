<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Extra_income extends CI_Controller {
	public function index()
	{
		
		if($this->input->post('btnSubmit'))
		{
			$this->load->model('Extra_income_model');
			$user_id = $this->input->post('ddlDistname');			
			$amount = $this->input->post('txtAmount');
			$percent = $this->input->post('txtPercentage');
			$remark = $this->input->post('txtRemark');			
			$this->Extra_income_model->UpdatePayment($user_id,$amount,$percent,$remark);
			$this->session->set_flashdata('message', 'Amount transfered succesffully.');	
			redirect('extra_income');
		}
		else
		{
		$this->load->view('extra_income_view');			
		}
	}	
}
