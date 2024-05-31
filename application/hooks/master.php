<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function redirect301()
{
//		if (substr(getenv('HTTP_HOST'),0,3) != 'www')
//		{
//		  header('HTTP/1.1 301 Moved Permanently');
//		  header('Location:http://www.'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
//		}
$CI =& get_instance();
$buffer = $CI->output->get_output(); 
$CI->output->set_output($buffer);
$CI->output->_display();
}
 
/* End of file compress.php */
/* Location: ./system/application/hools/compress.php */