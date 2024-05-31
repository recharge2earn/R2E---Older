<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Treestr extends CI_Controller
{
	
	public function index()
	{ 
			
			
		$user = $this->session->userdata('id');
		$Name = $this->session->userdata('business_name');
		$uname = $this->session->userdata('username');
		$usertype = $this->session->userdata('user_type');
		$str_query = "select tblusers.*,(select b.business_name from tblusers b where b.user_id = tblusers.parent_id) as parent_name,(select c.username from tblusers c where c.user_id = tblusers.parent_id) as parent_id from tblusers where user_id=?";
				$rslt  =$this->db->query($str_query,array($user));
				$data = "Name : ".$rslt->row(0)->business_name."<br>UserType : ".$rslt->row(0)->usertype_name."<br>OnePay ID : ".$rslt->row(0)->username."<br>Mobile_No :".$rslt->row(0)->mobile_no."<br>Sponcer Name : ".$rslt->row(0)->parent_name."<br>Sponcer ID : ".$rslt->row(0)->parent_id;
			$strLI="";
			$strLI.="<ul id='org' style='display:none;'><li  id=".$user."><br><br><br><a href='#' title='".$Name."' class='tooltip' style='cursor:pointer;'> ".$user."<span>".$data."</span></a>";
			$this->load->model('Treestr_model');
			$results = $this->Treestr_model->getChild($user);
			
			$strLI.=$results;
					 $strLI.="</li></ul>";	 
						   $this->view_data['tree'] = $strLI;
			$this->load->view('treestr_view',$this->view_data);
	}
	
}
