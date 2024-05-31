<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Cyberplatapi {
	public function ExecuteCyberURL($url,$postfields,$session_id)
	{					
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
		curl_setopt($ch, CURLOPT_NOBODY, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		$buffer = curl_exec($ch);
		 

		curl_close($ch);
		//print_r($buffer);exit;		
		if(strpos($buffer,'ERROR=0')==false)
		{return false;}
		else
		{return true;}			 
	}
	public function ExecutePaymentURL($url,$postfields,$session_id)
	{					
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
		curl_setopt($ch, CURLOPT_NOBODY, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		$buffer = curl_exec($ch);
		$CI =& get_instance();
    	  $CI->load->model('Do_recharge_model');
    	$CI->Do_recharge_model->updateRechargeResponse($buffer,$session_id);	
		curl_close($ch);
		if(strpos($buffer,'ERROR=0')==false)
		{			
			return array('TranID'=>'','OPT_CODE'=>'','isPaymentDone'=>'false');					
		}
		else
		{
			if(strpos($buffer,'AUTHCODE=')==false)
			{
			$OPT_Code[0]='';		
			$Split_trans = explode('TRANSID=',$buffer);
			$Trans_id = explode('END',$Split_trans[1]);	
			}
			else
			{
			$Split_auth = explode('AUTHCODE=',$buffer);
			$OPT_Code = explode('END',$Split_auth[1]);		
			$Split_trans = explode('TRANSID=',$buffer);
			$Trans_id = explode('AUTHCODE',$Split_trans[1]);	
			}			
			return array('TranID'=>trim($Trans_id[0]),'OPT_CODE'=>trim($OPT_Code[0]),'isPaymentDone'=>'true');
		}			 
	}
	public function ExecuteStatusURL($url,$postfields,$payment_result)
	{					
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
		curl_setopt($ch, CURLOPT_NOBODY, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		$buffer = curl_exec($ch);
		curl_close($ch);
		if (preg_match("/ERROR=0/i", $buffer) and preg_match("/RESULT=7/i", $buffer))
		{
			//Success
			return array('isSuccess'=>'true','Status'=>'Success','TranID'=>trim($payment_result['TranID']),'OPT_CODE'=>trim($payment_result['OPT_CODE']),'Message'=>'Transaction Successfull.');
		}
		if (preg_match("/ERROR=0/i", $buffer) and preg_match("/RESULT=3/i", $buffer))
		{			
			return array('isSuccess'=>'true','Status'=>'Pending','TranID'=>trim($payment_result['TranID']),'OPT_CODE'=>trim($payment_result['OPT_CODE']),'Message'=>'Waiting Response From Operator.');
		}
		if (preg_match("/ERROR=24/i", $buffer) and preg_match("/RESULT=7/i", $buffer))
		{
			//'Failure';
			return array('isSuccess'=>'true','Status'=>'Failure','TranID'=>'','OPT_CODE'=>'','Message'=>'Status Transaction Failure.');
		}
		return array('isSuccess'=>'true','Status'=>'Success','TranID'=>trim($payment_result['TranID']),'OPT_CODE'=>trim($payment_result['OPT_CODE']),'Message'=>'Transaction Successfull.');
	}
	public function getURLByOperator($operator_code)
	{		
if($operator_code == 'RV'){return $this->vodafone_url();}
if($operator_code == 'RL'){return $this->airtel_url();}
if($operator_code == 'DA'){return $this->airtel_dth_url();}
if($operator_code == 'RC'){return $this->aircel_url();}
if($operator_code == 'DO'){return $this->tataindicom_url();}
if($operator_code == 'LM'){return $this->loopmobile_url();}		
if($operator_code == 'TD'){return $this->docomo_url();}
if($operator_code == 'RI'){return $this->idea_url();}		
if($operator_code == 'RU'){return $this->uninor_url();}
if($operator_code == 'TU'){return $this->uninor_special_url();}
if($operator_code == 'TB'){return $this->bsnl_url();}	
if($operator_code == 'RB'){return $this->bsnl_validity_url();}			
if($operator_code == 'TDS'){return $this->docomo_special_url();}								
if($operator_code == 'TS'){return $this->mts_url();}		
if($operator_code == 'DS'){return $this->suntv_url();}
if($operator_code == 'DB'){return $this->bigtv_url();}		
if($operator_code == 'DV'){return $this->videocontv_url();}			
if($operator_code == 'DD'){return $this->dishtv_url();}
if($operator_code == 'DT'){return $this->tataskytv_url();}
if($operator_code == 'AP'){return $this->postpaid_airtel_url();}					
if($operator_code == 'RM'){return $this->reliance_url();}
if($operator_code == 'MTT'){return $this->mtnl_url();}
if($operator_code == 'MTR'){return $this->mtnl_validity_url();}	

//Postpaid Bill
if($operator_code == 'AP'){return $this->postpaid_airtel_url();}	
	}			
	public function CallRecharge($operator,$session_id,$mobile_no,$amount)
	{		
	$ALL_URL = $this->getURLByOperator($operator);	
	if($ALL_URL['isSpecial'] == 'true')
	{$isSpecial='true';}
	else{$isSpecial='false';}
	$verification = $ALL_URL['verification'];
	$payment = $ALL_URL['payment'];
	$status = $ALL_URL['status'];		
	$java_output = shell_exec("/usr/java/jdk1.7.0_21/bin/java -Djava.library.path=.:/home/mipa/public_html mipa $session_id $mobile_no $amount $isSpecial 1 2");	
		
	//echo 'java op :: '.$java_output;
	$cyber_array = explode('CP:',$java_output);								
	if(isset($cyber_array[0]))
		$post_field = $cyber_array[0];
	else
		$post_field = '';
	//echo $post_field.'<hr/>'.$verification.'<hr/>';
	//$CI =& get_instance();
	//$CI->db->trans_start();		
//	$CI->db->query("update tblrecharge set cyber_url=? where recharge_id=?",array($post_field,$session_id));
	//$CI->db->trans_complete();				
		
	$isVerify = $this->ExecuteCyberURL($verification,$post_field,$session_id);	
	if($isVerify)
	{					
		$payment_result = $this->ExecutePaymentURL($payment,$post_field,$session_id);		
		$isStatus = $this->ExecuteStatusURL($status,$post_field,$payment_result);				
		return $isStatus;		
	}else{return array('isSuccess'=>'true','Status'=>'Failure','TranID'=>'','OPT_CODE'=>'');}		
	}

//***** Cyber URL Function ****////	
	public function aircel_url()
	{return array('verification'=> 'https://in.cyberplat.com/cgi-bin/ac/ac_pay_check.cgi/1',
			  'payment'=> 'https://in.cyberplat.com/cgi-bin/ac/ac_pay.cgi/1',
			  'status'=> 'https://in.cyberplat.com/cgi-bin/ac/ac_pay_status.cgi',
			  'isSpecial' => 'false');}	
	public function airtel_url()		
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/at/at_pay_check.cgi/209',
			  'payment'=> 'https://in.cyberplat.com/cgi-bin/at/at_pay.cgi/209',
			  'status'=> 'https://in.cyberplat.com/cgi-bin/at/at_pay_status.cgi',
			  'isSpecial' => 'false');
	}
	public function airtel_dth_url()
	{return array('verification'=> 'https://in.cyberplat.com/cgi-bin/ad/ad_pay_check.cgi',
			  'payment'=> 'https://in.cyberplat.com/cgi-bin/ad/ad_pay.cgi',
			  'status'=> 'https://in.cyberplat.com/cgi-bin/ad/ad_pay_status.cgi',
			  'isSpecial' => 'false'
			  		);		
	}	
	public function idea_url()
	{return array('verification'=> 'https://in.cyberplat.com/cgi-bin/id/id_pay_check.cgi',
			  'payment'=> 'https://in.cyberplat.com/cgi-bin/id/id_pay.cgi',
			  'status'=> 'https://in.cyberplat.com/cgi-bin/id/id_pay_status.cgi',
			  'isSpecial' => 'false'
			  		);
	}
	public function reliance_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/rl/rl_pay_check.cgi',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/rl/rl_pay.cgi',
			  'status'=>'https://in.cyberplat.com/cgi-bin/rl/rl_pay_status.cgi' ,
			  'isSpecial' => 'false'
			  		);
	}	
	public function loopmobile_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/lm/lm_pay_check.cgi',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/lm/lm_pay.cgi',
			  'status'=>'https://in.cyberplat.com/cgi-bin/lm/lm_pay_status.cgi' ,
			  'isSpecial' => 'false'
			  		);
	}
	public function mts_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/mt/mt_pay_check.cgi',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/mt/mt_pay.cgi',
			  'status'=>'https://in.cyberplat.com/cgi-bin/mt/mt_pay_status.cgi' ,
			  'isSpecial' => 'false'
			  		);
	}	
	public function tataindicom_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/tt/tt_pay_check.cgi',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/tt/tt_pay.cgi',
			  'status'=>'https://in.cyberplat.com/cgi-bin/tt/tt_pay_status.cgi' ,
			  'isSpecial' => 'false'
			  		);
	}
	public function docomo_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/dc/dc_pay_check.cgi',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/dc/dc_pay.cgi',
			  'status'=>'https://in.cyberplat.com/cgi-bin/dc/dc_pay_status.cgi',
			  'isSpecial' => 'false'
			  		);
	}
	public function docomo_special_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/dc/dc_pay_check.cgi',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/dc/dc_pay.cgi',
			  'status'=>'https://in.cyberplat.com/cgi-bin/dc/dc_pay_status.cgi',
			  'isSpecial' => 'true'
			  		);
	}			
	public function bsnl_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/mm/mm_pay_check.cgi/205',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/mm/mm_pay.cgi/205',
			  'status'=>'https://in.cyberplat.com/cgi-bin/mm/mm_pay_status.cgi' ,
			  'isSpecial' => 'false'
			  		);
	}
	public function bsnl_validity_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/mm/mm_pay_check.cgi/219',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/mm/mm_pay.cgi/219',
			  'status'=>'https://in.cyberplat.com/cgi-bin/mm/mm_pay_status.cgi' ,
			  'isSpecial' => 'false'
			  		);
	}
	public function vodafone_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/vd/vd_pay_check.cgi',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/vd/vd_pay.cgi',
			  'status'=>'https://in.cyberplat.com/cgi-bin/vd/vd_pay_status.cgi' ,
			  'isSpecial' => 'false'
			  		);
	}
	public function uninor_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/un/un_pay_check.cgi',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/un/un_pay.cgi',
			  'status'=>'https://in.cyberplat.com/cgi-bin/un/un_pay_status.cgi' ,
			  'isSpecial' => 'false'
			  		);
	}
	public function uninor_special_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/un/un_pay_check.cgi',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/un/un_pay.cgi',
			  'status'=>'https://in.cyberplat.com/cgi-bin/un/un_pay_status.cgi' ,
			  'isSpecial' => 'true'
			  		);
	}
	public function mtnl_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/mm/mm_pay_check.cgi/212',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/mm/mm_pay.cgi/212',
			  'status'=>'https://in.cyberplat.com/cgi-bin/mm/mm_pay_status.cgi' ,
			  'isSpecial' => 'false'
			  		);
	}
	public function mtnl_validity_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/mm/mm_pay_check.cgi/215',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/mm/mm_pay.cgi/215',
			  'status'=>'https://in.cyberplat.com/cgi-bin/mm/mm_pay_status.cgi' ,
			  'isSpecial' => 'true'
			  		);
	}
	public function virgin_cdma_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/tt/tt_pay_check.cgi',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/tt/tt_pay.cgi',
			  'status'=>'https://in.cyberplat.com/cgi-bin/tt/tt_pay_status.cgi' ,
			  'isSpecial' => 'false'
			  		);
	}
	public function videocon_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/vm/vm_pay_check.cgi',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/vm/vm_pay.cgi',
			  'status'=>'https://in.cyberplat.com/cgi-bin/vm/vm_pay_status.cgi' ,
			  'isSpecial' => 'false'
			  		);
	}
	public function videocon_special_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/vm/vm_pay_check.cgi',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/vm/vm_pay.cgi',
			  'status'=>'https://in.cyberplat.com/cgi-bin/vm/vm_pay_status.cgi' ,
			  'isSpecial' => 'true'
			  		);
	}
	public function bigtv_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/bt/bt_pay_check.cgi',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/bt/bt_pay.cgi',
			  'status'=>'https://in.cyberplat.com/cgi-bin/bt/bt_pay_status.cgi' ,
			  'isSpecial' => 'false'
			  		);
	}
	public function dishtv_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/dt/dt_pay_check.cgi',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/dt/dt_pay.cgi',
			  'status'=>'https://in.cyberplat.com/cgi-bin/dt/dt_pay_status.cgi' ,
			  'isSpecial' => 'false'
			  		);
	}
	public function suntv_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/mm/mm_pay_check.cgi/213',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/mm/mm_pay.cgi/213',
			  'status'=>'https://in.cyberplat.com/cgi-bin/mm/mm_pay_status.cgi' ,
			  'isSpecial' => 'false'
			  		);
	}
	public function videocontv_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/vc/vc_pay_check.cgi',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/vc/vc_pay.cgi',
			  'status'=>'https://in.cyberplat.com/cgi-bin/vc/vc_pay_status.cgi' ,
			  'isSpecial' => 'false'
			  		);
	}
	public function tataskytv_url()
	{return array('verification'=>'https://in.cyberplat.com/cgi-bin/ts/ts_pay_check.cgi',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/ts/ts_pay.cgi',
			  'status'=>'https://in.cyberplat.com/cgi-bin/ts/ts_pay_status.cgi' ,
			  'isSpecial' => 'false'
			  		);
	}
	//Postpaid Bill
	public function postpaid_airtel_url()
	{
		return array('verification'=>'https://in.cyberplat.com/cgi-bin/ad/ad_pay_check.cgi/225',
			  'payment'=>'https://in.cyberplat.com/cgi-bin/ad/ad_pay.cgi/225',
			  'status'=>'https://in.cyberplat.com/cgi-bin/ad/ad_pay_status.cgi/225',
			  'isSpecial' => 'false'
			  		);
	}	
///End Cyber URL Function //
}