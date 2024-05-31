<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common { 
	public function getDate()
	{
		putenv("TZ=Asia/Calcutta");
		date_default_timezone_set('Asia/Calcutta');
		$date = date("Y-m-d h:i:s A");		
		return $date; 
	}
	public function GetPassword()
	{
		$n = rand(10e16, 10e20);
		$number = base_convert($n, 10, 36)."".base_convert($n, 15, 36);
		return substr($number,0,8);										
	}
	public function getOTP()
	{
		$n = rand(100001, 999999);
		return $n;										
	}
	

	
	
	public function getMySqlDate()
	{
		putenv("TZ=Asia/Calcutta");
		date_default_timezone_set('Asia/Calcutta');
		$date = date("Y-m-d");		
		return $date; 
	}
	public function getMySqlTime()
	{
		putenv("TZ=Asia/Calcutta");
		date_default_timezone_set('Asia/Calcutta');
		$time = date("h:i:s A");		
		return $time; 
	}
	public function getRealIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
		  $ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
		  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		  $ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}	
public function convert_number($number) 
{ 
    if (($number < 0) || ($number > 999999999)) 
    { 
    throw new Exception("Number is out of range");
    } 
    $Gn = floor($number / 1000000);  /* Millions (giga) */ 
    $number -= $Gn * 1000000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 
    $res = ""; 
    if ($Gn) 
    { 
        $res .= $this->convert_number($Gn) . " Million"; 
    } 
    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            $this->convert_number($kn) . " Thousand"; 
    } 
    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            $this->convert_number($Hn) . " Hundred"; 
    } 
    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 
    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 
        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 
            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 
    if (empty($res)) 
    { 
        $res = "zero"; 
    } 
    return $res; 
} 


public function myrc_recharge($username,$password,$circle,$opcode,$mobileno,$amount,$reqid,$unit,$pcycle)
{
 
 
 
 $response = file_get_contents("http://myrc.in/recharge/api?username=".$username."&pwd=".$password."&circlecode=".$circle."&operatorcode=".$opcode."&number=".$mobileno."&amount=".$amount."&orderid=".$reqid."&format=csv&value1=".$unit."&valu2=".$pcycle) ;  
    
    return $response;
}


public function myrc_balance($username,$password)
{
 
 $balance = file_get_contents("http://myrc.in/recharge/balance?username=".$username."&pwd=".$password) ;  
    
    return $balance;
}
//MY RC MONEY TRANSFR API START//

public function myrc_imps($username,$password,$sender,$opcode,$mobileno,$amount,$reqid)
{
 
 $imps = file_get_contents("http://myrc.in/money/api?username=".$username."&pwd=".$password."&sender_mobile=".$sender."&mode=IMPS&ben_id=".$mobileno."&amount=".$amount."&orderid=".$reqid."&format=json") ;  
    
    return $imps;
}


//sender registration //

public function myrc_sender($username,$password,$name,$pin,$mobileno)
{
 
 $imps = file_get_contents("http://myrc.in/money/sender_registration?username=".$username."&pwd=".$password."&name=".$name."&pincode=".$pin."&sender_mobile=".$mobileno) ;  
    
    return $imps;
}

//end sender regsitration//


//add beneficiary start//

public function myrc_add($username,$password,$sender,$ben_name,$ben_mobile,$account_number,$ifsc)
{
 
 $imps = file_get_contents("http://myrc.in/money/add_beneficiary?username=".$username."&pwd=".$password."&sender_mobile=".$sender."&ben_name=".$ben_name."&ben_mobile=".$ben_mobile."&account_number=".$account_number."&ifsc_code=".$ifsc) ;  
    
    return $imps;
}

//add beneficary end//

//verif beneficiary start//

public function myrc_verify($username,$password,$sender,$otp,$ben_id)
{
 
 $imps = file_get_contents("http://myrc.in/money/verify_beneficiary?username=".$username."&pwd=".$password."&sender_mobile=".$sender."&otp=".$otp."&ben_id=".$ben_id) ;  
    
    return $imps;
}

//verify beneficairy end//

//Search Beneficiary start //

public function myrc_search($username,$password,$sender)
{
 
 $imps = file_get_contents("http://myrc.in/money/search_beneficiary?username=".$username."&pwd=".$password."&sender_mobile=".$sender) ;  
    
    return $imps;
}

//Serach beneficiary end//


// MY RC MONEY TRANSFER API END //

public function ExecuteRechargeServerAPI($username,$password,$circle,$opcode,$mobileno,$amount,$reqid)
	{	
		$req = 'http://apionly.rcpanel.com/api_users/recharge';
		$postfields = "username=".$username."&pwd=".$password."&circlecode=".$circle."&operatorcode=".$opcode."&number=".$mobileno."&amount=".$amount."&orderid=".$reqid;
		  $CI =& get_instance();
    	  $CI->load->model('Do_recharge_model');
    	$CI->Do_recharge_model->updateRechargeRequest($req."?".$postfields,$reqid);
		//echo $username.' '.$password.' '.$circle.' '.$opcode.' '.$mobileno.' '.$amount;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, 
		"http://apionly.rcpanel.com/api_users/recharge");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "username=".$username."&pwd=".$password."&circlecode=".$circle."&operatorcode=".$opcode."&number=".$mobileno."&amount=".$amount."&orderid=".$reqid);
		$buffer = curl_exec($ch);		
		curl_close($ch);
		$CI->Do_recharge_model->updateRechargeResponse($buffer,$reqid);
		//print_r($buffer);exit;
		return $buffer;
	}
	public function ExecuteIndiaetopAPI($username,$password,$circle,$opcode,$mobileno,$amount,$recharge_id)

	{	
////http://smsalertbox.com/api/getnetwork.php?uid=61327a706179&pin=53147e39bb512&mobile=MOBILE&format=RESPONSE_FORMAT&version=4
		//echo $username.' '.$password.' '.$circle.' '.$opcode.' '.$mobileno.' '.$amount;
                $ver = '4';
		$frm = 'CSV';
		$username11 = '*****';
		$password11 = '*****';
		$req='http://pay.rcpanel.com/api/recharge.php?uid='.$username.'&pin='.$password.'&number='.$mobileno.'&circle='.$circle.'&operator='.$opcode.'&amount='.$amount.'&usertx='.$recharge_id.'&format='.$frm.'&version='.$ver;
		 $CI =& get_instance();
    	 $CI->load->model('Do_recharge_model');
    	$CI->Do_recharge_model->updateRechargeRequest($req,$recharge_id);
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,"http://pay.rcpanel.com/api/recharge.php");

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($ch, CURLOPT_POST,1);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		curl_setopt($ch, CURLOPT_POSTFIELDS, "uid=".$username."&pin=".$password."&number=".$mobileno."&circle=".$circle."&operator=".$opcode."&amount=".$amount."&usertx=".$recharge_id."&format=".$frm."&version=".$ver);

		$buffer = curl_exec($ch);		

		curl_close($ch);

		//print_r($buffer);exit;

		$CI =& get_instance();

    	  $CI->load->model('Do_recharge_model');

    	$CI->Do_recharge_model->updateRechargeResponse($buffer,$recharge_id);

		return $buffer;

	}


	public function ExecuteSworldAPI($username,$password,$circle,$opcode,$mobileno,$amount)
	{	
		
		//echo $username.' '.$password.' '.$circle.' '.$opcode.' '.$mobileno.' '.$amount;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, 
		"http://slogrecharge.com/api/recharge.php");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "uid=61327a706179&pin=5392e46e59e7b&number=".$mobileno."&circle=".$circle."&operator=".$opcode."&amount=".$amount);
		$buffer = curl_exec($ch);		
		curl_close($ch);
		//print_r($buffer);exit;
		return $buffer;
	}
	public function ExecuteSworldOperatorApi($mobile)
	{	
		
		//echo $username.' '.$password.' '.$circle.' '.$opcode.' '.$mobileno.' '.$amount;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,
		"http://slogrecharge.com/api/getnetwork.php");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "uid=761327a706179&pin=5392e46e59e7b&mobile=".$mobile);
		$buffer = curl_exec($ch);		
		curl_close($ch);
		//return "http://sworldrecharge.com/api/getnetwork.php?uid=73776f726c64&pin=50f6a0c5c8738&mobile=".$mobile;
		//print_r($buffer);exit;
		return $buffer;
	}
	public function ExecuteBalanceURL($url,$postfields)
	{	
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		$buffer = curl_exec($ch);			
		curl_close($ch);		
		return $buffer;  
	}
	public function ExecuteSMSApi($user_name,$password,$mobile_no,$message)
	{
		$url = "https://control.msg91.com/api/sendhttp.php?authkey=332601AENvh58UWEJ75ff00c3aP1&mobiles=$mobile_no&message=$message&sender=RECHRG&route=4";
			//$ch = curl_init();		
//			curl_setopt($ch,CURLOPT_URL,  $url);
//			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//			curl_setopt($ch, CURLOPT_POST, 1);
//			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			//curl_setopt($ch, CURLOPT_POSTFIELDS, "User=$user_name&passwd=$password&mobilenumber=$mobile_no&message=$message&sid=SWORLD&mtype=N&DR=Y");
			//$buffer = curl_exec($ch);
			$buffer = file_get_contents($url);		
		//	curl_close($ch);
		//	echo 	$buffer ;exit;			
			return $buffer;
		
	}
	public function ExecuteSMSApiOld($user_name,$password,$mobile_no,$message)
	{
	//echo "sorldweb";
		$ch = curl_init();		
		curl_setopt($ch,CURLOPT_URL,  "http://sworldweb.asia/api/sendmsg.php");
		//echo "http://sworldweb.asia/api/sendmsg.php?user=rechargeportal&pass=brilliant3&sender=RPORTL&phone=".$mobile_no."&text=".$message."&priority=ndnd&stype=normal";
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"user=rechargeportal&pass=brilliant3&sender=RPORTL&phone=".$mobile_no."&text=".$message."&priority=ndnd&stype=normal"); 
		$buffer = curl_exec($ch);		
		curl_close($ch);				
		return $buffer;
	}
	
	
	public function ExecuteSMSApiTwo($user_name,$password,$mobile_no,$message)
	{
	//echo "sorldweb";ATZPAY
	$message = rawurlencode($message);
		$ch = curl_init();		
		curl_setopt($ch,CURLOPT_URL,  "http://dndopen.dove-sms.com/TransSMS/SMSAPI.jsp?username=worldweb&password=brilliant3&sendername=RPORTL&mobileno=91".$mobile_no."&message=".$message);
		//echo "http://sworldweb.asia/api/sendmsg.php?user=rechargeportal&pass=brilliant3&sender=RPORTL&phone=".$mobile_no."&text=".$message."&priority=ndnd&stype=normal";
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$buffer = curl_exec($ch);		
		curl_close($ch);		
		 $CI =& get_instance();
    	  $CI->load->model('Do_recharge_model');
    	$CI->Do_recharge_model->insertSentSms($mobile_no,$message,$buffer);
		
		return $buffer;
	}
	public function ExecuteReDuniaAPI($username,$password,$reqid,$provider,$mobileno,$amount,$type)
	{	
	
	$req = "http://server.rduniya.com:8080/HttpServletClient/HttpClientServlet?userId=DACPL&pwd=".$password."&rechargeServiceCode=".$type."&operatorCode=".$provider."&mobileNo=".$mobileno."&amount=".$amount."&clientTrnId=".$reqid."&memberCode=EA10P161";
				  $CI =& get_instance();
    	  $CI->load->model('Do_recharge_model');
    	$CI->Do_recharge_model->updateRechargeRequest($req,$reqid);

		//echo $username.' '.$password.' '.$circle.' '.$opcode.' '.$mobileno.' '.$amount;
		//$ch = curl_init();
		//curl_setopt($ch,CURLOPT_URL, $req);
		
	//	echo "http://server.rduniya.com:8080/HttpServletClient/HttpClientServlet?userId=DACPL&pwd=".$password."&rechargeServiceCode=Mobile&operatorCode=".$provider."&mobileNo=".$mobileno."&amount=".$amount."&clientTrnId=".$reqid."&memberCode=EA10P161";exit;
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_POST, 1);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, 0);
		$buffer = file_get_contents($req);	
		$CI->Do_recharge_model->updateRechargeResponse($buffer,$reqid);
		//curl_close($ch);
		//print_r($buffer);exit;
		return $buffer;
	}
	public function ExecuteRechargeDuniaAPI($username,$password,$reqid,$provider,$mobileno,$amount)
	{	
		//echo $username.' '.$password.' '.$circle.' '.$opcode.' '.$mobileno.' '.$amount;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, 
		"http://www.rechargeduniya.com/API/DefaultNewWithReqId.aspx?uname=".$username."&password=".$password."&reqid=".$reqid."&provider=".$provider."&mobileno=".$mobileno."&Amount=".$amount);
		print_r("http://www.rechargeduniya.com/API/DefaultNewWithReqId.aspx?uname=".$username."&password=".$password."&reqid=".$reqid."&provider=".$provider."&mobileno=".$mobileno."&Amount=".$amount);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 0);
		$buffer = curl_exec($ch);		
		curl_close($ch);
		print_r($buffer);exit;
		return $buffer;
	}
	public function ExecuteRechargeDuniaBalanceAPI($username,$password)
	{	
		//echo $username.' '.$password.' '.$circle.' '.$opcode.' '.$mobileno.' '.$amount;
		$buffer = file_get_contents("http://server.rduniya.com:8080/HttpServletClient/HttpGetBalance?userId=".$username."&pwd=".$password);
		
		//print_r($buffer);exit;
		return $buffer;
	}
	public function ExecuteRechargeDuniaStatusAPI($username,$password,$recharge_id,$date)
	{	
		//echo $username.' '.$password.' '.$circle.' '.$opcode.' '.$mobileno.' '.$amount;
	
		$buffer =file_get_contents("http://server.rduniya.com:8080/HttpServletClient/HttpRechargeStatusServlet?userId=".$username."&pwd=".$password."&clientTrnId=".$recharge_id."&date=".$date);
		
		return $buffer;
	}
	public function ExecuteMarsAPI($provider,$mobileno,$amount,$ip)
	{	
	//echo $provider." <br>";
	//echo "http://223.231.58.17/MARSrequest/?operator=".$provider."&number=".$mobileno."&amount=".$amount."&reqref=8machtbz";
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, "http://".$ip."/MARSrequest/?operator=".$provider."&number=".$mobileno."&amount=".$amount."&reqref=8machtbz");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 0);
		$buffer = curl_exec($ch);		
		curl_close($ch);
		//print_r($buffer);
		return $buffer;
	}
	public function ExecuteMarsStatusAPI($marsref,$ip)
	{	
	
	if(strlen($marsref) < 20)
	{
		$n = 20 - strlen(trim($marsref));
		$d='';
		for($i=0;$i<$n;$i++)
		{
			$d.="$";	
		}
	}
		$new_string =trim($marsref).$d;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, 'http://'.$ip.'/MARSrequeststatus/?mars_reference='.$new_string );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 0);
		$buffer = curl_exec($ch);		
		curl_close($ch);
		return $buffer;
	}
}