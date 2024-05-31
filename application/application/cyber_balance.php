<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cyber_balance extends CI_Controller {
	
	
	private $msg='';
	public function pageview()
	{
		$user=$this->session->userdata('auser_type');
		if(trim($user) != 'Admin')
		{redirect(base_url().'login');}
		else
		{	
		$postfields='inputmessage=0000039701SM000000440000004400000217%0D%0Aapi105484+++++++++++00027828%0D%0A++++++++++++++++++++00000000%0D%0ABEGIN%0D%0ASD%3D104596%0D%0AAP%3D105484%0D%0AOP%3D105485%0D%0ASESSION%3D204%0D%0AEND%0D%0ABEGIN+SIGNATURE%0D%0AiQCRAwkBAABstFGxgeUBAR0JA%2F9AtmxEPAx5vAcbaab7Aqdr%2BKBS7GNyvEMAm7W2%0D%0A1shusqUCX7ekBHWKA6dDGpwTCbJgsk3EZbPVwjZxtZtNMUzzPwga1j7cgo7aJdgq%0D%0AwdnwrShlo9QML0A%2F0oPxrKbyya3Vm1i45fHVUM9GEwW5ThoAdetbgRdJ3OrZP2Ho%0D%0AeBC8HrABxw%3D%3D%0D%0A%3Dk6b7%0D%0AEND+SIGNATURE';
		$url='https://in.cyberplat.com/cgi-bin/mts_espp/mtspay_rest.cgi';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 90);		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		$buffer = curl_exec($ch);
		curl_close($ch);
		$rest_array = explode('REST=',$buffer);
		$bal=explode('END',$rest_array[1]);
		$this->view_data['balance'] = $bal[0];
		$this->view_data['message'] = $this->msg;
		$this->load->view('cyber_balance_view',$this->view_data);		
		}
	}
	
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
				$user=$this->session->userdata('auser_type');
				if(trim($user) == 'Admin')
				{
				$this->pageview();
				}
				else
				{redirect(base_url().'login');}																							
		} 
	}	
}