<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sitemap extends CI_Controller {
	public function index()
	{
		$this->load->view('sitemap_view');
		
	}	
}
