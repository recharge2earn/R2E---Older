<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	public function index() 
	{
		
		
		
		 $curl = curl_init();
$url = 'http://suriyan.in/test/iptest.php';
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($curl); 
print_r($data);
curl_close($curl);
exit; 
		
	}	
}