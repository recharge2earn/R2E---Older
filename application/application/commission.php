<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commission extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{
		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		} 
		$this->load->model('Commission_model');
		$result = $this->Commission_model->get_commission();
		$this->view_data['pagination'] =NULL;
		$this->view_data['result_commission'] = $result;
		$this->view_data['message'] =$this->msg;
		$this->load->view('commission_view',$this->view_data);		
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
				$Company_id = $this->input->post("ddlCompanyName",TRUE);
				//$Proirity = $this->input->post("ddlPriority",TRUE);
				$Proirity = 1;
				$RCommission = $this->input->post("txtRoyalComm",TRUE);	
				$Scheme = $this->input->post("ddlScheme",TRUE);	 							
				$this->load->model('Commission_model');
				if($this->Commission_model->find_exist_commission($Company_id,$Scheme))
				{
					if($this->Commission_model->add($Company_id,$Proirity,$RCommission,$Scheme) == true)
					{
						$this->msg ="Commission Add Successfully.";
						$this->pageview();
					}
					else
					{
						
					}
				}
				else
				{
						$this->msg ="Scheme Already Configure For This Company.";
						$this->pageview();
				}
			}
			else if($this->input->post("btnSubmit") == "Update")
			{				
				$commissionID = $this->input->post("hidID",TRUE);
				$Company_id = $this->input->post("ddlCompanyName",TRUE);
				//$Proirity = $this->input->post("ddlPriority",TRUE);
				$Proirity =1;
				$RCommission = $this->input->post("txtRoyalComm",TRUE);	
				$Scheme = $this->input->post("ddlScheme",TRUE);								
				$this->load->model('Commission_model');				
				if($this->Commission_model->update($commissionID,$Company_id,$Proirity,$RCommission,$Scheme) == true)
				{
					$this->msg ="Commission Update Successfully.";
					$this->pageview();
				}
				else
				{
					
				}
			}
			else if( $this->input->post("hidValue") && $this->input->post("action") ) 
			{
				
				$commissionID = $this->input->post("hidValue",TRUE);
				$this->load->model('Commission_model');
				if($this->Commission_model->delete($commissionID) == true)
				{
					$this->msg ="Commission Delete Successfully.";
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