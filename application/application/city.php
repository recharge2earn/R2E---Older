<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class City extends CI_Controller {
	
	private $msg='';
	public function pageview()
	{
		
		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		}
		$this->load->model('City_model');
		$result = $this->City_model->get_city();
		$this->view_data['pagination'] = NULL;
		$this->view_data['result_city'] = $result;
		$this->view_data['message'] =$this->msg;
		$this->load->view('city_view',$this->view_data);		
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
			if($this->input->post("btnSubmit") == "Submit")
			{
				$CityName = $this->input->post("txtCityName",TRUE);
				$StateID = $this->input->post("ddlStateName",TRUE);
				$this->load->model('City_model');
				if($this->City_model->add($CityName,$StateID) == true)
				{
					$this->msg ="City Name Add Successfully.";
					$this->pageview();
				}
				else
				{
					
				}
			}
			else if($this->input->post("btnSubmit") == "Update")
			{				
				$cityID = $this->input->post("hidID",TRUE);
				$cityName = $this->input->post("txtCityName",TRUE);
				$stateID = $this->input->post("ddlStateName",TRUE);				
				$this->load->model('City_model');
				if($this->City_model->update($cityID,$cityName,$stateID) == true)
				{
					$this->msg ="City Name Update Successfully.";
					$this->pageview();
				}
				else
				{
					
				}				
			}
			else if( $this->input->post("hidValue") && $this->input->post("action") ) 
			{
				
				$cityID = $this->input->post("hidValue",TRUE);
				$this->load->model('City_model');
				if($this->City_model->delete($cityID) == true)
				{
					$this->msg ="City Name Delete Successfully.";
					$this->pageview();
				}
				else
				{
					
				}				
			}
			
			else
			{
				$user=$this->session->userdata('auser_type');
				if(trim($user) == 'Admin')
				{
				$this->pageview();
				}
				else
				{redirect(base_url().'login');}																					

			}
		} 
	}	
}