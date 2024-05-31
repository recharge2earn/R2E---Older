<?php
class Do_money_model extends CI_Model 
{   
    function _construct()
    {         
          parent::_construct();
    }       
    public function ProcessRecharge($user_info,$circle_code,$company_id,$Amount,$Mobile,$recharge_type,$service_id,$rechargeBy,$orderid)
    {
    
        $circle_code = $circle_code;
        $format = $_REQUEST['format'];
        $opcode = $_REQUEST['mode'];
        $orderid = $_REQUEST['orderid'];
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
        $RoyalProvider = $company_info->row(0)->provider;
        $RecDuniaProvider = $company_info->row(0)->RecDuniaProvider;
        //$MarutiProvider = $company_info->row(0)->pprovider;
        $marsprovider = $company_info->row(0)->marsprovider;
        $MarutiProvider = $company_info->row(0)->sProvider;
        
        $opnot = $user_info->row(0)->opblock;
        $opnot_arr = explode(",",$opnot);
        $whitelist = $user_info->row(0)->ip_address;
        $whitelist_arr = explode(",",$whitelist);



        if($this->Longcode_model->CheckPendingResult($Mobile,$Amount) != true) // Check pending result
        {
            $current_bal = $this->Common_methods->getAgentBalance($user_id);
            if($current_bal < 10 or $Amount > $current_bal)
            {
                
                if($format == 'xml') // xml response for low balance
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>0</txid><status>Failure</status><opid>Low Balance</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid.'</orderid>';          
    
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
                $myObj->orderid = $orderid;
                return $myJSON = json_encode($myObj);
                
                }
                else
                {
                     return '0,Failure,Low Balance'.",".$Mobile.",".$Amount.",".$orderid; exit;
                }
                 return 'err';
            }
            
            if (in_array($opcode, $opnot_arr)) // operator block
            {
              if($format == 'xml') // op block
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>0</txid><status>Failure</status><opid>Service Unavailable</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid.'</orderid>';          
    
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
                $myObj->orderid = $orderid;
                return $myJSON = json_encode($myObj);
                
                }
                else
                {
                     return '0,Failure,Service unavailable'.",".$Mobile.",".$Amount.",".$orderid; exit;
                }
                 return '0';
            }


            if(in_array ($_SERVER['REMOTE_ADDR'], $whitelist_arr))  //response for invalid ip
            {
                
            }
            
            elseif($format == 'xml')// xml response for invalid ip
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>0</txid><status>Failure</status><opid>Invalid IP '.$_SERVER["REMOTE_ADDR"].'</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid.'</orderid>';           
    
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
                $myObj->orderid = $orderid;
                return $myJSON = json_encode($myObj);
                
                }
            else
            {
             return '0,Failure,Invalid IP '.$_SERVER['REMOTE_ADDR'].",".$Mobile.",".$Amount.",".$orderid; exit;  
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
    $recharge_id = $this->Recharge_home_model->add($company_id,$Amount,$Mobile,$user_id,$service_id,$recharge_type,$recharge_type,'Success',$ApiInfo,$scheme_id,$rechargeBy);

    if($recharge_id > 0)
    {   
        $commission_per = $this->Tblrecharge_methods->getcommission_per($recharge_id);  
        $commission_amount = $this->Tblrecharge_methods->getcommission_amount($recharge_id);    
    if($Amount > 0)
    {
         $dr_per = $Amount*$commission_per/100;
		$dr_amount = $Amount + $dr_per;	                  
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
    $static_ip = $ApiInfo->row(0)->static_ip;
    $url= $ApiInfo->row(0)->url;
    
    
            $transaction_type = "Recharge";
            $Description = "Recharge ".$company_info->row(0)->company_name." | ".$Mobile." | ".$Amount." | Recharge Id = ".$recharge_id;
            $this->load->model("Insert_model");
            $this->Insert_model->tblewallet_Recharge_DrEntry($user_id,$recharge_id,$transaction_type,$dr_amount,$Description);


if($ApiInfo->row(0)->api_name == "RC PANEL")
                    {   
                      
    $royal_resp = $this->common->ExecuteRechargeServerAPI($username,$password,$circle_code,$RoyalProvider,$Mobile,$Amount,$recharge_id);
$data_array = explode("#", $royal_resp);
                                $transaction_id = $data_array[0];
                                $user_unique_id = $data_array[7];
                                $status = $data_array[1];
                                $amount = $data_array[5];
                                $new_balance = $data_array[12];
                                $operator_trans_id = $data_array[2];
                                
if (preg_match("/Success/i", $status)) {
    
    $this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$operator_trans_id","Success",$royal_resp,$orderid);
              
                if($format == 'xml')
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>'.$recharge_id.'</txid><status>Success</status><opid>'.$operator_trans_id.'</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid.'</orderid>';            
    
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
                $myObj->orderid = $orderid;
                return $myJSON = json_encode($myObj);
                
                }
            else
            {
             return $recharge_id.",Success".",".$operator_trans_id.",".$Mobile.",".$Amount.",".$orderid; exit;
            }
    } 

elseif(preg_match("/Pending/i", $status)) {
     
$this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$operator_trans_id","Success",$royal_resp,$orderid);
              
                if($format == 'xml')
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>'.$recharge_id.'</txid><status>Success</status><opid>'.$operator_trans_id.'</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid.'</orderid>';            
    
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
                $myObj->orderid = $orderid;
                return $myJSON = json_encode($myObj);
                
                }
            else
            {
             return $recharge_id.",Success".",".$operator_trans_id.",".$Mobile.",".$Amount.",".$orderid; exit;
            }
    } 

elseif(preg_match("/Failure/i", $status)) {
      $this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$operator_trans_id","Failure",$royal_resp,$orderid);
              $this->load->model("Insert_model");
        $this->Insert_model->rechargerefund($recharge_id);
                if($format == 'xml')
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>'.$recharge_id.'</txid><status>Failure</status><opid>'.$operator_trans_id.'</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid.'</orderid>';            
    
        $xml_return .= '</Recharge>';
    
        return $xml_return; 
                }
                elseif($format == 'json')
                {
                $myObj->txid = $recharge_id;
                $myObj->status = "Failure";
                $myObj->opid = $operator_trans_id;
                $myObj->number= $Mobile;
                $myObj->amount = $Amount;
                $myObj->orderid = $orderid;
                return $myJSON = json_encode($myObj);
                
                }
            else
            {
             return $recharge_id.",Failure".",".$operator_trans_id.",".$Mobile.",".$Amount.",".$orderid; exit;
            }
    } 

elseif(preg_match("/ERROR/i", $status)) {
    $this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$operator_trans_id","Failure",$royal_resp,$orderid);
              $this->load->model("Insert_model");
        $this->Insert_model->rechargerefund($recharge_id);
    
          if($format == 'xml')
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>'.$recharge_id.'</txid><status>Failure</status><opid>'.$operator_trans_id.'</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid.'</orderid>';            
    
        $xml_return .= '</Recharge>';
    
        return $xml_return; 
                }
                elseif($format == 'json')
                {
                $myObj->txid = $recharge_id;
                $myObj->status = "Failure";
                $myObj->opid = $operator_trans_id;
                $myObj->number= $Mobile;
                $myObj->amount = $Amount;
                $myObj->orderid = $orderid;
                return $myJSON = json_encode($myObj);
                
                }
            else
            {
            return $recharge_id.",Failure".",".$operator_trans_id.",".$Mobile.",".$Amount.",".$orderid; exit;   
            }
    
}
else {
    
     $this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$operator_trans_id","Success",$royal_resp,$orderid);
              
                if($format == 'xml')
                {
                    header("Content-type: text/xml");
                     $xml_return='<Recharge>';
            $xml_return .='<txid>'.$recharge_id.'</txid><status>Success</status><opid>'.$operator_trans_id.'</opid><number>'.$Mobile.'</number><amount>'.$Amount.'</amount><orderid>'.$orderid.'</orderid>';            
    
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
                $myObj->orderid = $orderid;
                return $myJSON = json_encode($myObj);
                
                }
            else
            {
             return $recharge_id.",Success".",".$operator_trans_id.",".$Mobile.",".$Amount.",".$orderid; exit;
            }
}


                    }
                    
                    
          elseif($ApiInfo->row(0)->api_name == "API1")  // MONEY TRANSFER API//
					{
					
					
            
              			$sender_mobile = $_POST[sender_mobile];
            
                        $ben_id = $_POST[ben_id];
                        $amount= $_POST[amount];
                       
						





$demo = $this->common->myrc_imps($username,$password,$sender_mobile,$opcode,$ben_id,$amount,$recharge_id);

$obj = json_decode($demo,true);

                                $transaction_id = $obj[txid];
                               
                                $status = $obj[status];;
                                $amount = $obj[amount];
                               
                                $operator_trans_id = $obj[opid];

$obj = json_decode($money_response,true);

$mes = $obj['data']['resText'];
$ben_id= $obj['data']['beneficiaryId'];
$beneficiaryName= $obj['data']['beneficiaryName'];
$status = $obj['data']['status'];
$transId = $obj['data']['transId'];

$myObj->txid = $recharge_id;
$myObj->status= $status;
$myObj->opid= $transId;
                $myObj->message = $mes;
                $myObj->beneficiaryName= $beneficiaryName;
                $myObj->BeneficiaryID= $ben_id;
                $myObj->amount = $amount;
                $myObj->orderid = $orderid;
                $myJSON = json_encode($myObj);

if(preg_match("/SUCCESS/i", $status)) 
{


 $this->Recharge_home_model->updateRechargeStatus($recharge_id,NULL,"$transId","Success",$money_response,$orderid);
 
 $myObj->txid = $recharge_id;
$myObj->status= "Success";
$myObj->opid= $transId;
                $myObj->message = $mes;
                $myObj->beneficiaryName= $beneficiaryName;
                $myObj->BeneficiaryID= $ben_id;
                $myObj->amount = $amount;
                $myObj->orderid = $orderid;
                $myJSON = json_encode($myObj);
return $myJSON;

}

elseif(preg_match("/0/i", $status)) 
{

$this->Recharge_home_model->updateRechargeStatus($recharge_id,NULL,"$mes","Failure",$money_response,$orderid);   
$this->Insert_model->rechargerefund($recharge_id);

$myObj->txid = $recharge_id;
$myObj->status= "Failure";
$myObj->opid= $mes;
                $myObj->message = $mes;
                $myObj->beneficiaryName= $beneficiaryName;
                $myObj->BeneficiaryID= $ben_id;
                $myObj->amount = $amount;
                $myObj->orderid = $orderid;
                $myJSON = json_encode($myObj);
return $myJSON;

}

elseif(preg_match("/FAILED/i", $status)) 
{

$this->Recharge_home_model->updateRechargeStatus($recharge_id,NULL,"$mes","Failure",$money_response,$orderid);   
$this->Insert_model->rechargerefund($recharge_id);
$myObj->txid = $recharge_id;
$myObj->status= "Failure";
$myObj->opid= $transId;
                $myObj->message = $mes;
                $myObj->beneficiaryName= $beneficiaryName;
                $myObj->BeneficiaryID= $ben_id;
                $myObj->amount = $amount;
                $myObj->orderid = $orderid;
                $myJSON = json_encode($myObj);
return $myJSON;

}
elseif(preg_match("/over/i", $mes)) 
{


 $this->Recharge_home_model->updateRechargeStatus($recharge_id,NULL,"$mes","Failure",$money_response,$orderid);   
$this->Insert_model->rechargerefund($recharge_id);

$myObj->txid = $recharge_id;
$myObj->status= "Failure";
$myObj->opid= $transId;
                $myObj->message = $mes;
                $myObj->beneficiaryName= $beneficiaryName;
                $myObj->BeneficiaryID= $ben_id;
                $myObj->amount = $amount;
                $myObj->orderid = $orderid;
                $myJSON = json_encode($myObj);
return $myJSON;

}

elseif(preg_match("/Insucfficient/i", $mes)) 
{


 $this->Recharge_home_model->updateRechargeStatus($recharge_id,NULL,"$mes","Failure",$money_response,$orderid);   
$this->Insert_model->rechargerefund($recharge_id);

$myObj->txid = $recharge_id;
$myObj->status= "Failure";
$myObj->opid= $transId;
                $myObj->message = $mes;
                $myObj->beneficiaryName= $beneficiaryName;
                $myObj->BeneficiaryID= $ben_id;
                $myObj->amount = $amount;
                $myObj->orderid = $orderid;
                $myJSON = json_encode($myObj);
return $myJSON;

}

elseif(preg_match("/error/i", $mes)) 
{


 $this->Recharge_home_model->updateRechargeStatus($recharge_id,NULL,"$mes","Failure",$money_response,$orderid);   
$this->Insert_model->rechargerefund($recharge_id);
return $myJSON;

}

else

{

 $this->Recharge_home_model->updateRechargeStatus($recharge_id,NULL,"$transId","Success",$money_response,$orderid);
return $myJSON;

}




							}          
                    
                    
                    
                    
                    
                    
                
                    else if($ApiInfo->row(0)->api_name == "API2")
                    {   
                    
                            if($royal_resp != NULL)
                            {
                            if(strpos($royal_resp, '#') !== FALSE)
                            {//1307764#Success#GU0025493723
                                $resp_arr = explode("#",$royal_resp);
                                if(count($resp_arr) >= 1)
                                {
                                    $trns_id = $resp_arr[0];
                                    $status = $resp_arr[1];
                                    if($status == "" or $status==NULL)
                                    {
                                        $status="Pending";
                                    }
                                    $operator_trans_id = '';
                                    $this->Recharge_home_model->updateRechargeStatus($recharge_id,$trns_id,$operator_trans_id,$status);   
                                    if($status == "Success")
                                    {
                                        
                                        if($rechargeBy == "SMS")
                                        {
                                            $balance = $this->Common_methods->getAgentBalance($user_id);
                                            $this->sendRechargeSMS($company_info,$Mobile,$Amount,$trns_id,$status,$balance,$mobile_no);
                                        }
                                    }
                                    if($status == "Failure")
                                    {
                                        $this->Insert_model->rechargerefund($recharge_id);
                                        if($rechargeBy == "SMS")
                                        {
                                            $balance = $this->Common_methods->getAgentBalance($user_id);
                                            $this->sendRechargeSMS($company_info,$Mobile,$Amount,NULL,"Failure",$balance,$mobile_no);
                                        }
                                    }
                                        return 'Recharge Request Submit Successfully.';
                                }
                               
                            }
                            else if (preg_match('/Error::Insufficient Balance/',$royal_resp) == 1)     
                                            {
                               
                                $this->Recharge_home_model->updateRechargeStatus($recharge_id,NULL,NULL,"Failure"); 
                                $this->Insert_model->rechargerefund($recharge_id);  
                             //   $rslt = $this->db->query("update tblcompany set api_id = 6 where api_id = 4");
                                return "Rechare Failed";
                            }
                            else
                            {
                                if(preg_match('/ERROR::/',$royal_resp) == 1)
                                {
                                    $this->Recharge_home_model->updateRechargeStatus($recharge_id,NULL,NULL,"Failure");   
                                    $this->Insert_model->rechargerefund($recharge_id);
                                    return "Rechare Failed";
                                }
                                else if(preg_match('/ERROR::/',$royal_resp) == 1)
                                {
                                    $this->Recharge_home_model->updateRechargeStatus($recharge_id,NULL,NULL,"Failure");  
                                    $this->Insert_model->rechargerefund($recharge_id); 
                                    return "Rechare Failed";
                                }
                                               
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
    

}
?>