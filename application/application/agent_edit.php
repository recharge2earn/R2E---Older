<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent_edit extends CI_Controller {
	
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
			
				$Retailername = $this->input->post("txtRetailerName",TRUE);	
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
				$pan_no = $this->input->post("txtpanNo",TRUE);	
				$contact_person = $this->input->post("txtConPer",TRUE);	
				
				$this->load->model('Agent_edit_model');
				
				if($this->Agent_edit_model->update($Retailername,$Parent_id,$Address,$Pin,$State,$City,$MobNo,$LandNo,$RetType,$Email,$Scheme_id,$Scheme_amt,$User_id,$pan_no,$contact_person) == true)
				{		
						$this->session->set_flashdata('message', 'Retailer Account details updated successfully.');
						redirect(base_url()."agent_list");					
				}
				else
				{
					
				}
			}
			else
			{
					$this->load->view('agent_edit_view',$data);
			}
		} 			
	}
}
