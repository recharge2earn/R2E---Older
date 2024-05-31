<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Distributer_edit extends CI_Controller {
	
	public function process()
	{
		$this->index();
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
			$data['message']='';				
			if($this->input->post("btnSubmit"))
			{				
				$Dealername = $this->input->post("txtDistname",TRUE);
				$pan_no = $this->input->post("txtpanNo",TRUE);	
				$con_per = $this->input->post("txtConPer",TRUE);		
				$Parent_id = $this->input->post("ddlDistname",TRUE);					
				$Address = $this->input->post("txtPostalAddr",TRUE);				
				$Pin = $this->input->post("txtPin",TRUE);
				$State = $this->input->post("ddlState",TRUE);
				$City = $this->input->post("ddlCity",TRUE);				
				$MobNo = $this->input->post("txtMobNo",TRUE);
				$LandNo = $this->input->post("txtLandNo",TRUE);
				$RetType = $this->input->post("ddlRetType",TRUE);
				$Email = $this->input->post("txtEmail",TRUE);				
				$stateCode = $this->input->post("hidStateCode",TRUE);
				$Scheme_id = $this->input->post("ddlSchDesc",TRUE);																
				$Scheme_amt = $this->input->post("hid_scheme_amount",TRUE);
				$User_id = $this->input->post("hiduserid",TRUE);				
				
				$this->load->model('Distributer_edit_model');
				
				if($this->Distributer_edit_model->update($Dealername,$Parent_id,$Address,$Pin,$State,$City,$MobNo,$LandNo,$RetType,$Email,$Scheme_id,$Scheme_amt,$User_id,$pan_no,$con_per) == true)
				{		
						$this->session->set_flashdata('message', 'Dealer Account details updated successfully.');
						redirect(base_url()."distributor_list");					
				}
				else
				{
					
				}
			}
			else
			{
					$this->load->view('distributer_edit_view',$data);
			}
		} 			
	}
}
