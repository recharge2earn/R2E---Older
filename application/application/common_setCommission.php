<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_setCommission extends CI_Controller {
	private $msg='';
	public function pageview()
	{
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
			if($this->input->post("hidSearchFlag") && $this->input->post("hidSearchValue"))
			{}
			else if($this->input->post('btnSearch') == "Search")
			{}				
			else if($this->input->post('hidaction') == "Set")
			{}
			else
			{
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Distributor' or trim($user) == 'MasterDealer')
				{
					$data = array("message"=>"");
					$this->load->view("common_setCommission_view",$data);
				}
				else
				{redirect(base_url().'login');}																								
			}
		} 
	}	
	function ChangeCommission()
	{
		$id = $_GET["id"];
		$com = $_GET["com"];
		$user_id = $_GET["user_id"];
		$user_info = $this->Userinfo_methods->getUserInfo($user_id);
		$parent_id = $user_info->row(0)->parent_id;
		$parentcommInfo = $this->db->query("select * from tbluser_commission where user_id = ? and company_id = (select company_id from tbluser_commission a where a.Id = ?)",array($parent_id,$id));
		if($parentcommInfo->row(0)->commission >= $com)
		{
			$rslt = $this->db->query("update tbluser_commission set commission = ? where Id = ?",array($com,$id));
			echo $com;
		}
		else
		{
			$rslt = $this->db->query("update tbluser_commission set commission = ? where Id = ?",array($parentcommInfo->row(0)->commission,$id));
			echo $parentcommInfo->row(0)->commission;
		}
		
	}

}
