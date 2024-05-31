<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Distributer_form1 extends CI_Controller {
	public function index()
	{						
		$this->
doutput->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
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
				$stateCode = $this->input->post("hidStateCode",TRUE);
				$this->load->model('Distributer_form1_model');				
				if($this->Distributer_form1_model->find_mobile_exist($MobNo))
				{					
					$form1_data = array('Distname'=>$Distname,'PostalAddr'=>$PostalAddr,'Landmark'=>$Landmark,'Pin'=>$Pin,'State'=>$State,'City'=>$City,'Area'=>$Area,'ConPer'=>$ConPer,'MobNo'=>$MobNo,'LandNo'=>$LandNo,'RetType'=>$RetType,'Email'=>$Email,'Other_Area'=>$Other_Area,'stateCode'=>$stateCode);					
					$this->session->set_userdata($form1_data);
					redirect("distributer_form2");
				}
				else //If mobile no exist then Give message
				{					
					$data['message'] = $MobNo." - Mobile no already registered.";
					$this->load->view('distributer_form1_view',$data);
				}
			}
			else
			{
					$this->load->view('distributer_form1_view',$data);
			}
		} 			
	}
}
