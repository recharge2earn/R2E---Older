<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class D_edit_registration extends CI_Controller {
	
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
				$Area = " ";
				$ConPer = $this->input->post("txtConPer",TRUE);
				$MobNo = $this->input->post("txtMobNo",TRUE);
				$LandNo = $this->input->post("txtLandNo",TRUE);
				$RetType = $this->input->post("ddlRetType",TRUE);
				$Email = $this->input->post("txtEmail",TRUE);				
				$Other_Area = " ";
				$Bank1 = $this->input->post("ddlBank",TRUE);
				$AcNo1 = $this->input->post("txtAcNo",TRUE);
				$AcType1 = $this->input->post("ddlAcType",TRUE);
				$Org = $this->input->post("ddlOrg",TRUE);
				$PreLang = $this->input->post("ddlPreLang",TRUE);
				$Bank2 = $this->input->post("ddlAddBank",TRUE);
				$AcNo2 = $this->input->post("txtAddAcNo2",TRUE);
				$AcType2 = $this->input->post("ddlAcType_2",TRUE);
				$Scheme_id = $this->input->post("ddlSchDesc",TRUE);
				$PayMode = $this->input->post("radPayMode",TRUE);																
				$ChqDDNo = $this->input->post("txtChqDDNo",TRUE);																
				$ChqDDDate = $this->input->post("txtChqDDDate",TRUE);																				
				$DepBank = $this->input->post("ddlDepBank",TRUE);																								
				$WorLimit = $this->input->post("txtWorLimit",TRUE);	
				$Scheme_amt = $this->input->post("hid_scheme_amount",TRUE);							  
				$User_id = $this->input->post("hiduserid",TRUE);				
				$this->load->model('D_edit_registration_model');
				if($this->D_edit_registration_model->update($Distname,$PostalAddr,$Landmark,$Pin,$State,$City,$Area,$ConPer,$MobNo,$LandNo,$RetType,$Email,$Other_Area,$Bank1,$AcNo1,$AcType1,$Org,$PreLang,$Bank2,$AcNo2,$AcType2,$Scheme_id,$PayMode,$ChqDDNo,$ChqDDDate,$DepBank,$WorLimit,$Scheme_amt,$User_id) == true)
				{		
						$this->session->set_flashdata('message', 'Dealer Account details updated successfully.');
						redirect(base_url()."a_message");					
				}
				else
				{
					
				}
			}
			else
			{
					$this->load->view('d_edit_registration_view',$data);
			}
		} 			
	}
}
