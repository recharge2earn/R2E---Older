<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Revert extends CI_Controller {			
	public function index() 
	{	
	
		$this->load->view('revert_view');
	}	
}