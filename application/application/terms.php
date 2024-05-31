<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Terms extends CI_Controller {
	public function index()
	{
		$this->load->view('terms_view');			
	}	
}
