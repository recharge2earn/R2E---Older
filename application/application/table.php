<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Table extends CI_Controller {
	public function index()
	{
		$this->load->view('table_view');			
	}	
}