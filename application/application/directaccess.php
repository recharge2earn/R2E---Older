<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Directaccess extends CI_Controller {
	
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
			 	
		}
	}
	public function process()
	{
				$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache"); 

		if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			echo "bye";
		}				
		else 		
		{
			$user_id = $this->Common_methods->decrypt($this->uri->segment(3)); 	
			$user_info = $this->Userinfo_methods->getUserInfo($user_id);
			
			
			if($user_info->row(0)->usertype_name == "Agent")
			{
				$data = array(
			'id' => $user_info->row(0)->user_id,
			'parent_id' => $user_info->row(0)->parent_id,
			'logged_in' => true,
			'user_type' => $user_info->row(0)->usertype_name,
			'business_name' => $user_info->row(0)->business_name,
			'is_first_time'=>$user_info->row(0)->first_time_login,
			'scheme_id'=>$user_info->row(0)->scheme_id,
			'isAPI' => $user_info->row(0)->isAPIEnable); 
			$this->session->set_userdata($data);
				redirect(base_url()."dashboard");
			}
			else
			{
				if($user_info->row(0)->usertype_name == "MasterDealer")
				{
					$data = array(
			'id' => $user_info->row(0)->user_id,
			'parent_id' => $user_info->row(0)->parent_id,
			'logged_in' => true,
			'user_type' => $user_info->row(0)->usertype_name,
			'business_name' => $user_info->row(0)->business_name,
			'is_first_time'=>$user_info->row(0)->first_time_login,
			'scheme_id'=>$user_info->row(0)->scheme_id,
			'isAPI' => $user_info->row(0)->isAPIEnable);
			$this->session->set_userdata($data); 
					redirect(base_url()."dashboard");
				}
				else if($user_info->row(0)->usertype_name == "Distributor")
				{
					$data = array(
			'id' => $user_info->row(0)->user_id,
			'parent_id' => $user_info->row(0)->parent_id,
			'logged_in' => true,
			'user_type' => $user_info->row(0)->usertype_name,
			'business_name' => $user_info->row(0)->business_name,
			'is_first_time'=>$user_info->row(0)->first_time_login,
			'scheme_id'=>$user_info->row(0)->scheme_id,
			'isAPI' => $user_info->row(0)->isAPIEnable);
			$this->session->set_userdata($data); 
					redirect(base_url()."dashboard");
				}
				else if($user_info->row(0)->usertype_name == "APIUSER")
				{
					$data = array(
						'ApiId' => $user_info->row(0)->user_id,
						'ApiParentId' => $user_info->row(0)->parent_id,
						'ApiLoggedIn' => true,
						'ApiUserType' => $user_info->row(0)->usertype_name,
						'ApiBusinessName' => $user_info->row(0)->business_name,
						'ApiFirstTimeLogin'=>$user_info->row(0)->first_time_login,
						'ApiSchemeId'=>$user_info->row(0)->scheme_id,
						'ApiIsAPI' => $user_info->row(0)->isAPIEnable,
						'AdminId'=>$this->session->userdata("adminid"),
						'Redirect'=>base_url()."api_users/recharge_history",
						);
						$this->session->set_userdata($data);
						redirect($this->session->userdata("Redirect"));
				}
			}
		}
	}
}