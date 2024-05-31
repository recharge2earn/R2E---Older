<?php
//PAYTM UPI VERSION 4.3 FROM   RCPANEL CODE LIBRARY 


$amunt = $_REQUEST['amount'];
$orderId = "APP".rand(100000000001, 999999999999);
$user_id = $_REQUEST['user_id'];



$domain = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']."/";
      
       $p_url= $domain."pay/paytm_login_app";
 
      $arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  


  $mid_rsp = file_get_contents($p_url,false, stream_context_create($arrContextOptions));

$mid_jso = json_decode($mid_rsp, true);



 $mid = $mid_jso[mid];
$key = $mid_jso[token]; 

 


  
    $status = "Pending";
    
      $domain = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']."/";
      
      $p_url= $domain."paytm_update/paytm_order?orderId=".$orderId."&status=".$status."&date_current=".$date_current."&user_id=".$user_id."&amunt=".$amunt;
      
      $arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  
 file_get_contents($p_url,false, stream_context_create($arrContextOptions));

$paytmParams = array();

$paytmParams["body"] = array(
 "requestType"  => "Payment",
 "mid"  => $mid,
 "websiteName"  => "WEBSTAGING",
 "orderId"  => $orderId,
 "callbackUrl"  => $domain."pay/afterpay",
 "txnAmount"  => array(
 "value"  => $amunt,
 "currency" => "INR",
 ),
 "userInfo" => array(
 "custId"=> $user_id),
);



/*
* Generate checksum by parameters we have in body
* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys
*/
$checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), $key); ///key

$paytmParams["head"] = array(
"signature"=> $checksum
);

$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

/* for Staging */
$url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=".$mid."&orderId=".$orderId;

/* for Production */
// $url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=YOUR_MID_HERE&orderId=ORDERID_98765";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
  $response = curl_exec($ch);


//print_r($response);

///echo $response;


$data = explode(",",$response);

//print_r($data);

 $tri = $data[6];
 
 
  $tri1 = str_replace('"','',$tri);
 
 
  $tring = str_replace("txnToken:","",$tri1);
 
 
 //$tring1->token = $tring;
 
 ini_set('error_reporting', E_STRICT);
 
 $obj->token = $tring;
 
// echo json_encode($obj);
 
 

class PaytmChecksum{

	private static $iv = "@@@@&&&&####$$$$";

	static public function encrypt($input, $key) {
		$key = html_entity_decode($key);

		if(function_exists('openssl_encrypt')){
			$data = openssl_encrypt ( $input , "AES-128-CBC" , $key, 0, self::$iv );
		} else {
			$size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
			$input = self::pkcs5Pad($input, $size);
			$td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
			mcrypt_generic_init($td, $key, self::$iv);
			$data = mcrypt_generic($td, $input);
			mcrypt_generic_deinit($td);
			mcrypt_module_close($td);
			$data = base64_encode($data);
		}
		return $data;
	}

	static public function decrypt($encrypted, $key) {
		$key = html_entity_decode($key);
		
		if(function_exists('openssl_decrypt')){
			$data = openssl_decrypt ( $encrypted , "AES-128-CBC" , $key, 0, self::$iv );
		} else {
			$encrypted = base64_decode($encrypted);
			$td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
			mcrypt_generic_init($td, $key, self::$iv);
			$data = mdecrypt_generic($td, $encrypted);
			mcrypt_generic_deinit($td);
			mcrypt_module_close($td);
			$data = self::pkcs5Unpad($data);
			$data = rtrim($data);
		}
		return $data;
	}

	static public function generateSignature($params, $key) {
		if(!is_array($params) && !is_string($params)){
			throw new Exception("string or array expected, ".gettype($params)." given");			
		}
		if(is_array($params)){
			$params = self::getStringByParams($params);			
		}
		return self::generateSignatureByString($params, $key);
	}

	static public function verifySignature($params, $key, $checksum){
		if(!is_array($params) && !is_string($params)){
			throw new Exception("string or array expected, ".gettype($params)." given");
		}
		if(isset($params['CHECKSUMHASH'])){
			unset($params['CHECKSUMHASH']);
		}
		if(is_array($params)){
			$params = self::getStringByParams($params);
		}		
		return self::verifySignatureByString($params, $key, $checksum);
	}

	static private function generateSignatureByString($params, $key){
		$salt = self::generateRandomString(4);
		return self::calculateChecksum($params, $key, $salt);
	}

	static private function verifySignatureByString($params, $key, $checksum){
		$paytm_hash = self::decrypt($checksum, $key);
		$salt = substr($paytm_hash, -4);
		return $paytm_hash == self::calculateHash($params, $salt) ? true : false;
	}

	static private function generateRandomString($length) {
		$random = "";
		srand((double) microtime() * 1000000);

		$data = "9876543210ZYXWVUTSRQPONMLKJIHGFEDCBAabcdefghijklmnopqrstuvwxyz!@#$&_";	

		for ($i = 0; $i < $length; $i++) {
			$random .= substr($data, (rand() % (strlen($data))), 1);
		}

		return $random;
	}

	static private function getStringByParams($params) {
		ksort($params);		
		$params = array_map(function ($value){
			return ($value !== null && strtolower($value) !== "null") ? $value : "";
	  	}, $params);
		return implode("|", $params);
	}

	static private function calculateHash($params, $salt){
		$finalString = $params . "|" . $salt;
		$hash = hash("sha256", $finalString);
		return $hash . $salt;
	}

	static private function calculateChecksum($params, $key, $salt){
		$hashString = self::calculateHash($params, $salt);
		return self::encrypt($hashString, $key);
	}

	static private function pkcs5Pad($text, $blocksize) {
		$pad = $blocksize - (strlen($text) % $blocksize);
		return $text . str_repeat(chr($pad), $pad);
	}

	static private function pkcs5Unpad($text) {
		$pad = ord($text{strlen($text) - 1});
		if ($pad > strlen($text))
			return false;
		return substr($text, 0, -1 * $pad);
	}
}




//PAYTM UPI VERSION 4.3 FROM   RCPANEL CODE LIBRARY 


$token = $tring;


$paytmParams = array();

$paytmParams["body"] = array(
    "requestType" => "NATIVE",
    "mid"         => $mid,
    "orderId"     => $orderId,
    "paymentMode" => "UPI_INTENT",
    
);

$paytmParams["head"] = array(
    "txnToken"    => $token
);

$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

/* for Staging */
$url = "https://securegw.paytm.in/theia/api/v1/processTransaction?mid=".$mid."&orderId=".$orderId;

/* for Production */
// $url = "https://securegw.paytm.in/theia/api/v1/processTransaction?mid=YOUR_MID_HERE&orderId=ORDERID_98765";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); 
$response = curl_exec($ch);
//print_r($response);




 $st =  str_replace("{","",$response);

 $ar = explode('":"',$st);

//print_r($ar);
ini_set('error_reporting', E_STRICT);
 $upi = $ar[10];

  $get_upi = str_replace('","orderId','',$upi);
  
  $final->upi = str_replace('upi://pay?','',$get_upi);
  
  $final->orderid = $orderId;


echo json_encode($final);













?>
