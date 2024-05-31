<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_distributer_form1 extends CI_Controller {
	
	public function process()
	{
		$this->index();
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
			if($this->input->post("btnSubmit"))
			{
				$Distname = $this->input->post("txtDistname",TRUE);
				$PostalAddr = $this->input->post("txtPostalAddr",TRUE);
				$Landmark = $this->input->post("txtLandmark",TRUE);
				$Pin = $this->input->post("txtPin",TRUE);
				$State = $this->input->post("ddlState",TRUE);
				$City = $this->input->post("ddlCity",TRUE);
				$Area = $this->input->post("ddlArea",TRUE);
				$ConPer = $this->input->post("txtConPer",TRUE);
				$MobNo = $this->input->post("txtMobNo",TRUE);
				$LandNo = $this->input->post("txtLandNo",TRUE);
				$RetType = $this->input->post("ddlRetType",TRUE);
				$Email = $this->input->post("txtEmail",TRUE);				
				$Other_Area = $this->input->post("txtOther",TRUE);
				$User_id = $this->input->post("hiduserid",TRUE);				
				$this->load->model('Edit_distributer_form1_model');
				if($this->Edit_distributer_form1_model->update($Distname,$PostalAddr,$Landmark,$Pin,$State,$City,$Area,$ConPer,$MobNo,$LandNo,$RetType,$Email,$Other_Area,$User_id) == true)
				{									
						redirect("edit_distributer_form2");					
				}
				else
				{
					
				}
			}
			else
			{
					$this->load->view('edit_distributer_form1_view',$data);
			}
		} 			
	}
}
