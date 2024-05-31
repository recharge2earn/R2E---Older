<?php
class Whats_app_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}



public function send_whats_app($mobile_no,$message)
{
    
    $number = "91".$mobile_no;
    
    $appkey = "0d6df6dd-9558-4e7a-b070-10773ff284ee";
    $authkey = "3oyeLbeq3Pns0NGRiKseJGmflxn2cSYcg47YlpULgu9UMHzWC1";
    
    
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.whats-api.rcsoft.in/api/create-message',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(
  'appkey' => $appkey,
  'authkey' => $authkey,
  'to' => $number,
  'message' => $message,
  'sandbox' => 'false'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;
}






	
}
?>