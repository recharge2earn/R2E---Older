<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tickets extends CI_Controller {
	public function index()
	{
		
	}
	public function printticket()
	{
		$book_id = $this->uri->segment(3);
		//$book_id = 54;
		$rslt = $this->db->query("select * from airbooking where Id = ?",array($book_id));
		$user_id = $this->session->userdata("id");
		$user_detail = $this->db->query("select tblusers.*,(select city_name from tblcity where city_id = tblusers.city_id) as city_name,(select state_name from tblstate where state_id = tblusers.state_id) as state_name from tblusers where user_id = ?",array($user_id));
		$this->view_data["airbook_rslt"] = $rslt;
		$this->view_data["agent_detail"] = $user_detail;
		$this->load->view("tickets_view",$this->view_data);
	}
}