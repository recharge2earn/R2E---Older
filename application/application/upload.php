<?php
  
   class Upload extends CI_Controller {
	
      public function __construct() { 
         parent::__construct(); 
         $this->load->helper(array('form', 'url')); 
      }
		
      public function index() { 
          if ($this->session->userdata('alogged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		} 
		else{
         $error = ""; 
            $this->load->view('upload_form', $error); 
		}
      } 
		
      public function do_upload() { 
         $config['upload_path']   = './images/'; 
         $config['allowed_types'] = '*'; 
         $config['file_name'] = 'logo.png'; 
         $config['overwrite'] = TRUE; 
         
         $config['max_size']      = 100; 
         $config['max_width']     = 1024; 
         $config['max_height']    = 768;  
         $this->load->library('upload', $config);
			
         if ( ! $this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors()); 
            $this->load->view('upload_form', $error); 
         }
			
         else { 
            $data = "LOGO UPDATED";
            $this->load->view('upload_success', $data); 
         } 
      } 
   } 
?>
