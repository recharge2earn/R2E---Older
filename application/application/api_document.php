<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api_document extends CI_Controller {
	public function index()
	{
		$this->load->view('api_document_view');			
	}	
}
