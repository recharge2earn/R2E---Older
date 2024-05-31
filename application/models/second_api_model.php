<?php
class Second_api_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}


	public function process_second_api($second_api,$company_id,$Mobile,$Amount,$recharge_id,$format,$orderid1) 
	{
	  $api_id = $second_api;
	

	$company_info = $this->getCompany_info($company_id);
	$company_code = $company_info->row(0)->provider;
	

	
	$api_details = $this->get_second_api($api_id);
	$api_details->row(0)->username;
	$Executeby = $api_details->row(0)->api_name;
	$username = $api_details->row(0)->username;
	$password = $api_details->row(0)->password;
	$api_id = $api_details->row(0)->api_id;
	$url= $api_details->row(0)->url; 
	$opcode= $this->get_opcode($company_code,$api_id); 
	$orderid_text= $api_details->row(0)->orderid;
	$token= $api_details->row(0)->token;
	$response_type= $api_details->row(0)->response_type;
	$optional1= $api_details->row(0)->optional1;
	$optinal2= $api_details->row(0)->optional2;
	$optional3= $api_details->row(0)->optional3;
	$method= $api_details->row(0)->method;
	$username_text= $api_details->row(0)->username_text;
	$password_text= $api_details->row(0)->password_text;
									
	$opcode_text = $api_details->row(0)->opcode_text;
	$number_text = $api_details->row(0)->number_text;
	$amount_text = $api_details->row(0)->amount_text;
	$format_text = $api_details->row(0)->format_text;
	$response_type = $api_details->row(0)->response_type;
	$success_response_text = $api_details->row(0)->success_response_text;
	$failure_response_text = $api_details->row(0)->failure_response_text;
	$pending_response_text = $api_details->row(0)->pending_response_text;
	$message_response_text = $api_details->row(0)->message_response_text;
	$status_response_tex = $api_details->row(0)->status_response_text;
	$txid_response_text = $api_details->row(0)->txid_response_text;
	$opid_response_text = $api_details->row(0)->opid_response_text;
	
	
	
	
		$step1 = str_replace("ooo",$opcode,$url);
	$step2 = str_replace("mmm",$Mobile,$step1);
	$step3 = str_replace("rrr",$recharge_id,$step2);
		$request_url = str_replace("aaa",$Amount,$step3);
	
		
		
		
										
//	$request_url = $url;
//	$parameter = $username_text.$username."&".$password_text.$password."&".$opcode_text.$opcode."&".$number_text.$Mobile."&".$amount_text.$Amount."&".$orderid_text.$recharge_id."&".$format_text.$response_type."&".$optional1."&".$optional2."&".$optional3;
	$parameter = "";
	
	$get = $request_url;
	
	
	
	
 	  if($method == "GET"){
    
    $buffer =  file_get_contents($get);
 
  $obj = json_decode($buffer,true); 
    if($response_type == "xml")
    {
        $xml = simplexml_load_string($buffer);
$json = json_encode($xml);
 $obj = json_decode($json,TRUE); 
    }
 
$buffer = $buffer.$request_url.$parameter;
  $status = $obj[$status_response_tex];
  $transaction_id = $obj[$txid_response_text];
  $operator_trans_id = $obj[$opid_response_text];
 $mgs = $obj[$message_response_text];
 $buffer;
  $operator_trans_id = str_replace("OperatorId:","",$operator_trans_id);
  
  if ($status == $success_response_text){
    
   // $this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$operator_trans_id","Success",$buffer,$orderid1);
       $this->updateRechargeStatus("Success",$transaction_id,$operator_trans_id,$buffer,$Executeby,$orderid1,$recharge_id);      
            
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
     
     $this->updateRechargeStatus("Failure",$transaction_id,$operator_trans_id,$buffer,$Executeby,$orderid1,$recharge_id);
     
    //  $this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$mgs","Failure",$buffer,$orderid1);
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
    
   //  $this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$operator_trans_id","Pending",$buffer,$orderid1);
              
      $this->updateRechargeStatus("Pending",$transaction_id,$operator_trans_id,$buffer,$Executeby,$orderid1,$recharge_id);         
                 
    
              
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
    
   // $this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$operator_trans_id","Success",$buffer,$orderid1);
             
      $this->updateRechargeStatus("Success",$transaction_id,$operator_trans_id,$buffer,$Executeby,$orderid1,$recharge_id);       
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
     // $this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$mgs","Failure",$buffer,$orderid1);
     $this->updateRechargeStatus("Faiiure",$transaction_id,$operator_trans_id,$buffer,$Executeby,$orderid1,$recharge_id); 
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
    
    // $this->Recharge_home_model->updateRechargeStatus($recharge_id,$transaction_id,"$operator_trans_id","Pending",$buffer,$orderid1);
              
       $this->updateRechargeStatus("Pending",$transaction_id,$operator_trans_id,$buffer,$Executeby,$orderid1,$recharge_id);         
               
    
              
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
	
	 public function get_opcode($company_code,$api_id)
{
    
    
	    $q = "select $company_code from tblapi where api_id=$api_id";
	     $reulrt = $this->db->query($q);
	   
	 return  $reulrt->row()->$company_code;
}  

	public function get_second_api($api_id)
	{		
	$str_query = "select * from tblapi where api_id ='$api_id'";
	$result = $this->db->query($str_query);		
	return $result;	
	}
	
	
	public function updateRechargeStatus($recharge_status,$transaction_id,$operator_id,$response,$Executeby,$orderid,$recharge_id)
	{
		$str_query = "update tblrecharge set recharge_status=?,transaction_id=?,operator_id=?,response=?, Executeby=?, orderid=? where recharge_id = ?";
		$rslt = $this->db->query($str_query,array($recharge_status,$transaction_id,$operator_id,$response,$Executeby,$orderid,$recharge_id));
		
		return true;
	}
	
		public function getCompany_info($company_id)
	{
		$rlst = $this->db->query("select * from tblcompany where company_id = '".$company_id."'");
		if($rlst->num_rows() > 0)
		{
			return $rlst;
		}
		else
		{
			return false;
		}
	}


}

?>