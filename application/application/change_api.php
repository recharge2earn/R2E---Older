<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_api extends CI_Controller {
	
	private $msg='';
	public function pageview()
	{
		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		} 
		$this->load->model('Company_model');
		$this->view_data['result_company'] =  $this->Company_model->get_company();
		$this->view_data['message'] =$this->msg;
		$this->load->view('change_api_view',$this->view_data);		
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
					if(!empty($_FILES['file_Logo']['name']))
					{
						$config['upload_path'] = realpath(APPPATH.'../images/Logo/');					
						$config['allowed_types'] = "jpg|jpeg|gif|png|bmp|JPG|JPEG|GIF|PNG|BMP";
						$this->load->library('upload', $config);					
						if(!$this->upload->do_upload('file_Logo'))
						{
							$this->msg ="Error : ".$this->upload->display_errors();
							$this->pageview();
						}
						else
						{
							$myFileData = $this->upload->data();
							$file_Logo = $myFileData["file_name"];
						}
					}				
					else
					{
						$file_Logo = $this->input->post("hidOldPath",TRUE);
					}
					$companyName = $this->input->post("txtCompName",TRUE);
					$serviceName = $this->input->post("ddlSerName",TRUE);					
					$Long_Code_Format = $this->input->post("txtLong_Code_Format",TRUE);
					$Provider = $this->input->post("txtProvider",TRUE);
					$PProvider = $this->input->post("txtPProvider",TRUE);
					$productName = $this->input->post("txtProductName",TRUE);
					$CProvider = $this->input->post("txtCProvider",TRUE);
					$Long_Code_No = $this->input->post("txtLong_Code_No",TRUE);					
					$this->load->model('Company_model');					
					if($this->Company_model->add($companyName,$serviceName,$Provider,$PProvider,$CProvider,$Long_Code_Format,$Long_Code_No,$file_Logo,$productName) == true)
					{
						$this->msg ="Company Name Add Successfully.";
						$this->pageview();							
					}
					else
					{
						
					}					
			}
			else if($this->input->post("btnSubmit") == "Update")
			{					
					if(!empty($_FILES['file_Logo']['name']))
					{
						$config['upload_path'] = realpath(APPPATH.'../images/Logo/');					
						$config['allowed_types'] = "jpg|jpeg|gif|png|bmp|JPG|JPEG|GIF|PNG|BMP";
						$this->load->library('upload', $config);					
						if(!$this->upload->do_upload('file_Logo'))
						{
							$this->msg ="Error : ".$this->upload->display_errors();
							$this->pageview();
						}
						else
						{
							$myFileData = $this->upload->data();
							$file_Logo = $myFileData["file_name"];
						}
					}				
					else
					{
						$file_Logo = $this->input->post("hidOldPath",TRUE);
					}
					$companyID = $this->input->post("hidID",TRUE);
					$companyName = $this->input->post("txtCompName",TRUE);
					$serviceName = $this->input->post("ddlSerName",TRUE);
					$Provider = $this->input->post("txtProvider",TRUE);
					$PProvider = $this->input->post("txtPProvider",TRUE);
					$CProvider = $this->input->post("txtCProvider",TRUE);
					$productName = $this->input->post("txtProductName",TRUE);
					$Long_Code_Format = $this->input->post("txtLong_Code_Format",TRUE);
					$Long_Code_No = $this->input->post("txtLong_Code_No",TRUE);					
					$this->load->model('Company_model');
					if($this->Company_model->update($companyID,$companyName,$serviceName,$Provider,$PProvider,$CProvider,$Long_Code_Format,$Long_Code_No,$file_Logo,$productName) == true)
					{
						$this->msg ="Company Name Update Successfully.";
						$this->pageview();							
					}
					else
					{
						
					}											
			}
			else if( $this->input->post("hidValue") && $this->input->post("action") ) 
			{
				
				$companyID = $this->input->post("hidValue",TRUE);
				$this->load->model('Company_model');
				if($this->Company_model->delete($companyID) == true)
				{
							$this->msg ="Company Name Delete Successfully.";
							$this->pageview();							
				}
				else
				{
					
				}				
			}	
			else if($this->input->post("changeapi") == "change")
			{
				$api_name = $this->input->post("api_name");
				$company_id = $this->input->post("company_id");
				$str_query = "update tblcompany set api_id = (select api_id from tblapi where tblapi.api_name = '$api_name') where company_id = '$company_id'";
				$rslt = $this->db->query($str_query);
				$this->msg ="API Change Successfully.";
				$this->pageview();
				
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