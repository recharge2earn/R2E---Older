<?php
class Recharge_model extends CI_Model 
{   
    function _construct()
    {         
          parent::_construct();
    }       
    public function ProcessRecharge($user_info,$circle_code,$company_id,$Amount,$Mobile,$recharge_type,$service_id,$rechargeBy,$orderid1)
    {
    
        $circle_code = $circle_code;
        $format = $_REQUEST['format'];
        $opvalue1 = $_REQUEST['unit'];
        $opvalue2 = $_REQUEST['pcyclye'];
        $opcode1 = $_REQUEST['operatorcode'];
        $orderid1 = $_REQUEST['orderid'];
        $this->load->model("Tblrecharge_methods");
        $this->load->model("Recharge_home_model");
        $this->load->model("Tblcompany_methods");
        $this->load->model("Longcode_model");
        $mobile_no = $user_info->row(0)->mobile_no;
        $usertype = $user_info->row(0)->usertype_name;
        $user_id = $user_info->row(0)->user_id;
        $scheme_id = $user_info->row(0)->scheme_id;
        $company_info = $this->Tblcompany_methods->getCompany_info($company_id);
        $ApiInfo=$this->Recharge_home_model->getAPIInfo($company_id);
       $company_code = $company_info->row(0)->provider;
        $RoyalProvider = $company_info->row(0)->provider;
        $opnot = $user_info->row(0)->opblock;
        $opnot_arr = explode(",",$opnot);
        $whitelist = $user_info->row(0)->ip_address;
        $whitelist_arr = explode(",",$whitelist);
	$set_amount = $user_info->row(0)->set_amount;





if ($ApiInfo->row(0)->api_name == "OFF") 
            {
              if($format == 'xml') 
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>0</txid><status>Failure</status><opid>Operator Down</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid.'</orderid>';          
    
        $xml_return .= '</Recharge>';
    
        return $xml_return; 
                }
                elseif($format == 'json')  //op block
                {
                $myObj->txid = "0";
                $myObj->status = "Failure";
                $myObj->opid = "Operator Down";
                $myObj->number= $Mobile;
                $myObj->amount = $Amount;
                $myObj->orderid = $orderid;
                return $myJSON = json_encode($myObj);
                
                }
                else
                {
                     return '0,Failure,Operator Down'.",".$Mobile.",".$Amount.",".$orderid; exit;
                }
                 return 'err';
            }


        if($this->Longcode_model->CheckPendingResult($Mobile,$Amount) != true) // Check pending result
        {
            $current_bal = $this->Common_methods->getAgentBalance($user_id)-$set_amount;
            if($current_bal < 10 or $Amount > $current_bal)
            {
                
                if($format == 'xml') // xml response for low balance
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>0</txid><status>Failure</status><opid>Low Balance</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid1.'</orderid>';          
    
        $xml_return .= '</Recharge>';
    
        return $xml_return; 
                }
                elseif($format == 'json')  //for low balance
                {
                $myObj->txid = "0";
                $myObj->status = "Failure";
                $myObj->opid = "Low Balance";
                $myObj->number= $Mobile;
                $myObj->amount = $Amount;
                $myObj->orderid = $orderid1;
                return $myJSON = json_encode($myObj);
                
                }
                else
                {
                     return '0,Failure,Low Balance'.",".$Mobile.",".$Amount.",".$orderid1; exit;
                }
                 return 'err';
            }
            
            if (in_array($opcode1, $opnot_arr)) // operator block
            {
              if($format == 'xml') // op block
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>0</txid><status>Failure</status><opid>Service Unavailable</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid1.'</orderid>';          
    
        $xml_return .= '</Recharge>';
    
        return $xml_return; 
                }
                elseif($format == 'json')  //op block
                {
                $myObj->txid = "0";
                $myObj->status = "Failure";
                $myObj->opid = "Service unavailable";
                $myObj->number= $Mobile;
                $myObj->amount = $Amount;
                $myObj->orderid = $orderid1;
                return $myJSON = json_encode($myObj);
                
                }
                else
                {
                     return '0,Failure,Service unavailable'.",".$Mobile.",".$Amount.",".$orderid1; exit;
                }
                 return 'err';
            }


            if(in_array ($_SERVER['REMOTE_ADDR'], $whitelist_arr))  //response for invalid ip
            {
                
            }
            
            elseif($format == 'xml')// xml response for invalid ip
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>0</txid><status>Failure</status><opid>Invalid IP '.$_SERVER["REMOTE_ADDR"].'</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid1.'</orderid>';           
    
        $xml_return .= '</Recharge>';
    
        return $xml_return; 
                }
                elseif($format == 'json')  // json response for invalid ip
                {
                $myObj->txid = "0";
                $myObj->status = "Failure";
                $myObj->opid = 'Invalid IP '.$_SERVER['REMOTE_ADDR'];
                $myObj->number= $Mobile;
                $myObj->amount = $Amount;
                $myObj->orderid = $orderid1;
                return $myJSON = json_encode($myObj);
                
                }
            else
            {
             return '0,Failure,Invalid IP '.$_SERVER['REMOTE_ADDR'].",".$Mobile.",".$Amount.",".$orderid1; exit;  
            }
            if($Amount >= 10)
            {   
                    if($current_bal >= $Amount)
                    {                                                               
if($this->Common_methods->CheckAgentBalance($user_id,$Amount) == true)
{
                     // GET Information about Which API Execute
    if($ApiInfo->num_rows() == 0)
    {
        return 'Configuration is missing! contact service provider.';
    }
    $api_name = $ApiInfo->row(0)->api_name;
    //echo $api_name;exit;
    $recharge_id = $this->Recharge_home_model->add($company_id,$Amount,$Mobile,$user_id,$service_id,$recharge_type,$recharge_type,'Pending',$ApiInfo,$scheme_id,$rechargeBy);

    if($recharge_id > 0)
    {   
        $commission_per = $this->Tblrecharge_methods->getcommission_per($recharge_id);  
        $commission_amount = $this->Tblrecharge_methods->getcommission_amount($recharge_id);    
    if($commission_amount > 0)
    {
        $dr_amount = $Amount - $commission_amount;                  
    }
    else 
    { 
        $dr_amount = $Amount; 
    }
        $this->load->library('common');
        if($ApiInfo->num_rows()== 1) 
        {
   	$username = $ApiInfo->row(0)->username;
	$password = $ApiInfo->row(0)->password;
	$api_id = $ApiInfo->row(0)->api_id;
	$url= $ApiInfo->row(0)->url; 
	$opcode= $this->get_opcode($company_code,$api_id); 
	$orderid= $ApiInfo->row(0)->orderid;
	$token= $ApiInfo->row(0)->token;
	$response_type= $ApiInfo->row(0)->response_type;
	$optional1= $ApiInfo->row(0)->optional1;
	$optinal2= $ApiInfo->row(0)->optional2;
	$optional3= $ApiInfo->row(0)->optional3;
	$method= $ApiInfo->row(0)->method;
	$username_text= $ApiInfo->row(0)->username_text;
	$password_text= $ApiInfo->row(0)->password_text;
									
	$opcode_text = $ApiInfo->row(0)->opcode_text;
	$number_text = $ApiInfo->row(0)->number_text;
	$amount_text = $ApiInfo->row(0)->amount_text;
	$format_text = $ApiInfo->row(0)->format_text;
	$response_type = $ApiInfo->row(0)->response_type;
	$success_response_text = $ApiInfo->row(0)->success_response_text;
	$failure_response_text = $ApiInfo->row(0)->failure_response_text;
	$pending_response_text = $ApiInfo->row(0)->pending_response_text;
	$message_response_text = $ApiInfo->row(0)->message_response_text;
	$status_response_tex = $ApiInfo->row(0)->status_response_text;
	$txid_response_text = $ApiInfo->row(0)->txid_response_text;
	$opid_response_text = $ApiInfo->row(0)->opid_response_text;
    
    $step1 = str_replace("ooo",$opcode,$url);
	$step2 = str_replace("mmm",$Mobile,$step1);
	$step3 = str_replace("rrr",$recharge_id,$step2);
		$request_url1 = str_replace("aaa",$Amount,$step3);
	
		
		$request_url_space = str_replace(";","",$request_url1);
		
	
		
			$request_url_user = str_replace("uuu","$username",$request_url_space);
		
		
			$request_url_pass = str_replace("ppp","$password",$request_url_user);
			
				$request_url = str_replace(" ","",$request_url_pass);
		
										
//	$request_url = $url;
//	$parameter = $username_text.$username."&".$password_text.$password."&".$opcode_text.$opcode."&".$number_text.$Mobile."&".$amount_text.$Amount."&".$orderid_text.$recharge_id."&".$format_text.$response_type."&".$optional1."&".$optional2."&".$optional3;
	$parameter = "";
	
	$get = $request_url;
	
	
            $transaction_type = "Recharge";
            $Description = "Recharge ".$company_info->row(0)->company_name." | ".$Mobile." | ".$Amount." | TXID = ".$recharge_id;
            $this->load->model("Insert_model");
            $this->Insert_model->tblewallet_Recharge_DrEntry($user_id,$recharge_id,$transaction_type,$dr_amount,$Description);



 	  if($method == "GET"){
    
    $buffer =  file_get_contents($get);
 
  $obj = json_decode($buffer,true); 
    if($response_type == "xml")
    {
        $xml = simplexml_load_string($buffer);
$json = json_encode($xml);
 $obj = json_decode($json,TRUE); 
    }
    
       if($response_type == "csv")
    {
        
 $obj = explode(",",$buffer);
    }   
 
$buffer = $buffer.$request_url.$parameter;
  $status = $obj[$status_response_tex];
  $transaction_id = $obj[$txid_response_text];
  $operator_trans_id = $obj[$opid_response_text];
 $mgs = $obj[$message_response_text];
 $buffer;
  
  if ($status == $success_response_text){
    
    $this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$operator_trans_id","Success",$buffer,$orderid1);
             
            
                  if($format == 'xml')
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>'.$recharge_id.'</txid><status>Success</status><opid>'.$operator_trans_id.'</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid1.'</orderid>';            
    
        $xml_return .= '</Recharge>';
    
        return $xml_return; 
                }
                elseif($format == 'json')
                {
                $myObj->txid = $recharge_id;
                $myObj->status = "Success";
                $myObj->opid = $operator_trans_id;
                $myObj->number= $Mobile;
                $myObj->amount = $Amount;
                $myObj->orderid = $orderid1;
                return $myJSON = json_encode($myObj);
                
                }
            else
            {
             return $recharge_id.",Success".",".$operator_trans_id.",".$Mobile.",".$Amount.",".$orderid1; exit;
            }
           
    } 



elseif($status == $failure_response_text) {
    
     $second_api = $ApiInfo->row(0)->second_api;	
    
    if($second_api > 0)
    
    {
        $this->load->model("Second_api_model");
        return $this->Second_api_model->process_second_api($second_api,$company_id,$Mobile,$Amount,$recharge_id,$format,$orderid1);exit; 
    }
    
    
      $this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$mgs","Failure",$buffer,$orderid1);
              $this->load->model("Insert_model");
        $this->Insert_model->rechargerefund($recharge_id);
               
                 if($format == 'xml')
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>'.$recharge_id.'</txid><status>Failure</status><opid>'.$mgs.'</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid1.'</orderid>';            
    
        $xml_return .= '</Recharge>';
    
        return $xml_return; 
                }
                elseif($format == 'json')
                {
                $myObj->txid = $recharge_id;
                $myObj->status = "Failure";
                $myObj->opid = $mgs;
                $myObj->number= $Mobile;
                $myObj->amount = $Amount;
                $myObj->orderid = $orderid1;
                return $myJSON = json_encode($myObj);
                
                }
            else
            {
             return $recharge_id.",Failure,".$mgs.",".$Mobile.",".$Amount.",".$orderid1; exit;
            }

           
    } 


else {
    
     $this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$operator_trans_id","Pending",$buffer,$orderid1);
              
               
                 
    
              
                if($format == 'xml')
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>'.$recharge_id.'</txid><status>Pending</status><opid>'.$operator_trans_id.'</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid1.'</orderid>';            
    
        $xml_return .= '</Recharge>';
    
        return $xml_return; 
                }
                elseif($format == 'json')
                {
                $myObj->txid = $recharge_id;
                $myObj->status = "Pending";
                $myObj->opid = $operator_trans_id;
                $myObj->number= $Mobile;
                $myObj->amount = $Amount;
                $myObj->orderid = $orderid1;
                return $myJSON = json_encode($myObj);
                
                }
            else
            {
             return $recharge_id.",Pending".",".$operator_trans_id.",".$Mobile.",".$Amount.",".$orderid1; exit;
            }
          
}  
    
}
else{
    
    $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$parameter);
        $buffer = curl_exec($ch);       
        curl_close($ch);
    
         $buffer;
   $obj = json_decode($buffer,true); 
    if($response_type == "xml")
    {
        $xml = simplexml_load_string($buffer);
$json = json_encode($xml);
 $obj = json_decode($json,TRUE); 
    }

  $status = $obj[$status_response_tex];
  $transaction_id = $obj[$txid_response_text];
  $operator_trans_id = $obj[$opid_response_text];
 $mgs = $obj[$message_response_text];
 $buffer = $buffer.$request_url.$parameter;
  
 if ($status == $success_response_text){
    
    $this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$operator_trans_id","Success",$buffer,$orderid1);
             
            
                  if($format == 'xml')
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>'.$recharge_id.'</txid><status>Success</status><opid>'.$operator_trans_id.'</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid1.'</orderid>';            
    
        $xml_return .= '</Recharge>';
    
        return $xml_return; 
                }
                elseif($format == 'json')
                {
                $myObj->txid = $recharge_id;
                $myObj->status = "Success";
                $myObj->opid = $operator_trans_id;
                $myObj->number= $Mobile;
                $myObj->amount = $Amount;
                $myObj->orderid = $orderid1;
                return $myJSON = json_encode($myObj);
                
                }
            else
            {
             return $recharge_id.",Success".",".$operator_trans_id.",".$Mobile.",".$Amount.",".$orderid1; exit;
            }
           
    } 



elseif($status == $failure_response_text) {
    
     $second_api = $ApiInfo->row(0)->second_api;	
    
    if($second_api > 0)
    
    {
        $this->load->model("Second_api_model");
        return $this->Second_api_model->process_second_api($second_api,$company_id,$Mobile,$Amount,$recharge_id,$format,$orderid1);exit; 
    }
    
    
    
      $this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$mgs","Failure",$buffer,$orderid1);
              $this->load->model("Insert_model");
        $this->Insert_model->rechargerefund($recharge_id);
               
                 if($format == 'xml')
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>'.$recharge_id.'</txid><status>Failure</status><opid>'.$mgs.'</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid1.'</orderid>';            
    
        $xml_return .= '</Recharge>';
    
        return $xml_return; 
                }
                elseif($format == 'json')
                {
                $myObj->txid = $recharge_id;
                $myObj->status = "Failure";
                $myObj->opid = $mgs;
                $myObj->number= $Mobile;
                $myObj->amount = $Amount;
                $myObj->orderid = $orderid1;
                return $myJSON = json_encode($myObj);
                
                }
            else
            {
             return $recharge_id.",Failure,".$mgs.",".$Mobile.",".$Amount.",".$orderid1; exit;
            }

           
    } 


else {
    
     $this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$operator_trans_id","Pending",$buffer,$orderid1);
              
               
               
    
              
                if($format == 'xml')
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>'.$recharge_id.'</txid><status>Pending</status><opid>'.$operator_trans_id.'</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid1.'</orderid>';            
    
        $xml_return .= '</Recharge>';
    
        return $xml_return; 
                }
                elseif($format == 'json')
                {
                $myObj->txid = $recharge_id;
                $myObj->status = "Pending";
                $myObj->opid = $operator_trans_id;
                $myObj->number= $Mobile;
                $myObj->amount = $Amount;
                $myObj->orderid = $orderid;
                return $myJSON = json_encode($myObj);
                
                }
            else
            {
             return $recharge_id.",Pending".",".$operator_trans_id.",".$Mobile.",".$Amount.",".$orderid1; exit;
            }
          
}  
  
  
                                 

}

                    
                }
                else
                {
                    return 'Configuration Missing, Contact Service Provider';       
                }
    }
    else
    {
        return 'Low Balance Please Contact Service Provider';
    }
}
                    }   
            }
            else
            {
                return 'Minimum amount 10 INR For Recharge.';
            }
        }
        else
        {
            return "Already in pending process";
        }
    }
    public function sendRechargeSMS($result_company,$Mobile,$Amount,$TransactionID,$status,$balance,$senderMobile,$recharge_id,$user_id)
    {
        
    
        
        $smsMessage = 'Dear Business Partner Your Request is Com  '.$result_company->row(0)->company_name.' Number  '.$Mobile.' Amt '.$Amount.' Tx id '.$recharge_id.' Status  '.$status.' Curent Bal '.$balance.' ';
        $result = $this->common->ExecuteSMSApi($this->common_value->getSMSUserName(),$this->common_value->getSMSPassword(),$senderMobile,$smsMessage);
            echo $smsMessage;

    }
    public function updateRechargeRequest($request,$recharge_id)
    {
        $str_query = "update tblrecharge set request = ? where recharge_id = ?";
        $rslt = $this->db->query($str_query,array($request,$recharge_id));
        return true;
    }
    public function updateRechargeResponse($response,$recharge_id)
    {
        $str_query = "update tblrecharge set response = ? where recharge_id = ?";
        $rslt = $this->db->query($str_query,array($response,$recharge_id));
        return true;
    }
    public function updateStatusMars($rechargeId,$refid)
    {
        $str_query = "update tblrecharge set mars_ref_Id= ? where recharge_id = ?";
        $reslt = $this->db->query($str_query,array($refid,$rechargeId));
        return true;
    }
    public function updateStatusMarsFail($rechargeId)
    {
        $str_query = "update tblrecharge set recharge_status= ? where recharge_id = ?";
        $reslt = $this->db->query($str_query,array('Failure',$rechargeId));
        return true;
    }
    public function updateStatusRespMars($mars_ref_Id,$transaction_id,$status)
    {
        $str_query = "update tblrecharge set transaction_id= ?,recharge_status=? where mars_ref_Id = ?";
        $reslt = $this->db->query($str_query,array($transaction_id,$status,$mars_ref_Id));
        return true;
    }
    public function insertSentSms($to,$message,$response)
    {
        $date = $this->common->getDate();
        $message = urldecode($message);
        $order   = array("\r\n", "\n", "\r",":");
        $replace = '';
        $response = str_replace($order, $replace, $response);
        
        $str_query = "insert into sms_outbox(to_mobile,message,response,add_date) values(?,?,?,?)";
        
        $reslt = $this->db->query($str_query,array($to,$message,$response,$date));
        return true;
    }
  public function get_opcode($company_code,$api_id)
{
    
    
	    $q = "select $company_code from tblapi where api_id=$api_id";
	     $reulrt = $this->db->query($q);
	   
	 return  $reulrt->row()->$company_code;
}  

}
?>