<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Smsapisetting extends CI_Controller {	
		private $msg='';
	public function pageview()
	{
		$rslt = $this->db->query("select * from common where param = 'smsapi'");
		$rslt_smscharge = $this->db->query("select * from common where param = 'smscharge'");
		
		$succ_flag = $rslt->row(0)->value;
		$smscharge = $rslt_smscharge->row(0)->value;
		$this->view_data['message'] ="";
		$this->view_data['ActiveAPI'] =$succ_flag;
		$this->view_data['smscharge'] =$smscharge;
		$this->load->view('smsapisetting_view',$this->view_data);		
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
			if($this->input->post("hidform") == "Set")
			{
				$hidvalue = $this->input->post("hidvalue",TRUE);
				if($hidvalue == 0)
				{
					$rslt = $this->db->query("update common set value ='sworldweb' where param = 'smsapi'");
					$this->session->set_flashdata('message', 'SMS API Change Successful.');
					redirect('smsapisetting');
				}
				else if($hidvalue == 1)
				{
					$rslt = $this->db->query("update common set value ='gujtech' where param = 'smsapi'");
					$this->session->set_flashdata('message', 'SMS API Change Successful.');
					redirect('smsapisetting');
				}
				else if($hidvalue == 2)
				{
					$rslt = $this->db->query("update common set value ='dovesms' where param = 'smsapi'");
					$this->session->set_flashdata('message', 'SMS API Change Successful.');
					redirect('smsapisetting');
				}
				else
				{
					$this->session->set_flashdata('message', 'Unaccepted Error Occured.');
					redirect('smsapisetting');
				}
				
			}		
			else if($this->input->post("txtsmscharge"))
			{
				$smscharge = $this->input->post("txtsmscharge");
				$rslt = $this->db->query("UPDATE `recharge_db`.`common` SET `value` = ? WHERE `common`.`param` ='smscharge'",array($smscharge));
				
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
?>