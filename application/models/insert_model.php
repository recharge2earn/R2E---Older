<?php
class Insert_model extends CI_Model 
{	
	function _construct()
	{
		  // Call the Model constructor
		  parent::_construct();
	}
	public function tblewallet_Payment_CrDrEntry($credit_user_id,$debit_user_id,$amount,$remark,$description,$payment_type)
	{	
				
		$this->load->library("common");
		$add_date = $this->common->getDate();
		$ipaddress = $this->common->getRealIpAddr();
		$date = $this->common->getMySqlDate();
		$credit_amount = $amount;
		$debit_amount = $amount;
		$transaction_type = "PAYMENT";
		$old_balance_credit_user_id = $this->Common_methods->getCurrentBalance($credit_user_id);
		$current_balance_credit_user_id = $old_balance_credit_user_id + $credit_amount;

		$str_query = "insert into tblpayment_master(user_id,add_date,ip_address) values(?,?,?)";
		$rslt = $this->db->query($str_query,array($debit_user_id,$add_date,$ipaddress));
		$payment_master_id =  $this->db->insert_id();
		$payment_date = $this->common->getMySqlDate();
		$payment_time = $this->common->getMySqlTime();	
		$str_query = "insert into  tblpayment(payment_master_id,cr_user_id,amount,payment_type,dr_user_id,remark,add_date,ipaddress,transaction_type, 	payment_date,payment_time)
		values(?,?,?,?,?,?,?,?,?,?,?)";
		$reslut = $this->db->query($str_query,array($payment_master_id,$credit_user_id,$amount,$payment_type,$debit_user_id,$remark,$add_date,$ipaddress,$transaction_type,$payment_date,$payment_time));
		$payment_id = $this->db->insert_id();
		
		$str_query = "insert into  tblewallet(user_id,payment_id,transaction_type,remark,description,add_date,credit_amount,balance,ipaddress,payment_type)
		values(?,?,?,?,?,?,?,?,?,?)";
		$reslut = $this->db->query($str_query,array($credit_user_id,$payment_id,$transaction_type,$remark,$description,$add_date,$credit_amount,$current_balance_credit_user_id,$ipaddress,$payment_type));
		
		$old_balance_debit_user_id = $this->Common_methods->getCurrentBalance($debit_user_id);
		$current_balance_debit_user_id = $old_balance_debit_user_id - $credit_amount;
		$str_query = "insert into  tblewallet(user_id,payment_id,transaction_type,remark,description,add_date,debit_amount,balance,ipaddress,payment_type)
		values(?,?,?,?,?,?,?,?,?,?)";
		$reslut = $this->db->query($str_query,array($debit_user_id,$payment_id,$transaction_type,$remark,$description,$add_date,$credit_amount,$current_balance_debit_user_id,$ipaddress,$payment_type));
		return true;
	}
	
	public function tblewallet_Recharge_CrDrEntry($user_id,$recharge_id,$transaction_type,$cr_amount,$dr_amount,$Description)
	{
		$this->load->library("common");
		$add_date = $this->common->getDate();
		$date = $this->common->getMySqlDate();
		$old_balance = $this->common_methods->getCurrentBalance($user_id);
		$current_balance = $old_balance + $cr_amount - $dr_amount;
		
		$str_query = "insert into  tblewallet(user_id,recharge_id,transaction_type,cr_amount,dr_amount,current_balance,Description,add_date,date)
		values(?,?,?,?,?,?,?,?)";
		$reslut = $this->db->query($str_query,array($user_id,$recharge_id,$transaction_type,$cr_amount,$dr_amount,$current_balance,$Description,$add_date,$date));
		return true;
	}
	public function tblewallet_Recharge_CrEntry($user_id,$recharge_id,$transaction_type,$cr_amount,$Description)
	{
		$this->load->library("common");
		$add_date = $this->common->getDate();
		$date = $this->common->getMySqlDate();
		$old_balance = $this->Common_methods->getCurrentBalance($user_id);
		$current_balance = $old_balance + $cr_amount;
		
		$str_query = "insert into  tblewallet(user_id,recharge_id,transaction_type,credit_amount,balance,description,add_date)
		values(?,?,?,?,?,?,?)";
		$reslut = $this->db->query($str_query,array($user_id,$recharge_id,$transaction_type,$cr_amount,$current_balance,$Description,$add_date));
		
		return $this->db->insert_id();
	}
	
	
	
	
	//////////////////////////////////////////////
	////////////////////////////Debit Recharge Amount From ewallet
	////////////////////////////////////////////
	public function tblewallet_Recharge_DrEntry($user_id,$recharge_id,$transaction_type,$dr_amount,$Description)
	{
	if($recharge_id > 0)
	{
		$str_checkdebited = $this->db->query("select recharge_id,ewallet_id,debited from tblrecharge where recharge_id = ?",array($recharge_id));
		if($str_checkdebited->row(0)->debited == "yes")
		{
			return true;
		}
	}
		$this->load->library("common");
		$add_date = $this->common->getDate();
		$date = $this->common->getMySqlDate();

		$old_balance = $this->Common_methods->getCurrentBalance($user_id);
		$current_balance = $old_balance - $dr_amount;
		
		$str_query = "insert into  tblewallet(user_id,recharge_id,transaction_type,debit_amount,balance,description,add_date)
		values(?,?,?,?,?,?,?)";
		$reslut = $this->db->query($str_query,array($user_id,$recharge_id,$transaction_type,$dr_amount,$current_balance,$Description,$add_date));
		$ewallet_id = $this->db->insert_id();
		$rslt_updtrec = $this->db->query("update tblrecharge set debited='yes',balance=CONCAT_WS(',',balance,?), ewallet_id = CONCAT_WS(',',ewallet_id,?) where recharge_id = ?",array($current_balance,$ewallet_id,$recharge_id));
		return true;
	}

public function tblewallet_smscharge_DrEntry($user_id,$recharge_id,$transaction_type,$dr_amount,$Description)
	{
		
		$this->load->library("common");
		$add_date = $this->common->getDate();
		$date = $this->common->getMySqlDate();

		$old_balance = $this->Common_methods->getCurrentBalance($user_id);
		$current_balance = $old_balance - $dr_amount;
		
		$str_query = "insert into  tblewallet(user_id,recharge_id,transaction_type,debit_amount,balance,description,add_date)
		values(?,?,?,?,?,?,?)";
		$reslut = $this->db->query($str_query,array($user_id,$recharge_id,$transaction_type,$dr_amount,$current_balance,$Description,$add_date));
		
		return true;
	}
	
	
	public function tblpayment_Payment_CrDrEntry($payment_master_id,$cr_user_id,$amount,$payment_type,$dr_user_id,$remark,$transaction_type)
	{	
		$this->load->library("common");
		$this->load->model("common_methods");
		$add_date = $this->common->getDate();
		$payment_date = $this->common->getMySqlDate();
		$payment_time = $this->common->getMySqlTime();	
		$ipaddress = $this->common->getRealIpAddr();
		$str_query = "insert into  tblpayment(payment_master_id,cr_user_id,amount,payment_type,dr_user_id,remark,add_date,ipaddress,transaction_type, 	payment_date,payment_time)
		values(?,?,?,?,?,?,?,?,?,?,?)";
		$reslut = $this->db->query($str_query,array($payment_master_id,$cr_user_id,$amount,$payment_type,$dr_user_id,$remark,$add_date,$ipaddress,$transaction_type,$payment_date,$payment_time));
		
		return $this->db->insert_id();
	}
	public function tblpayment_master_Entry($user_id)
	{
			$this->load->library("common");
			$add_date = $this->common->getDate();
			$ipaddress = $this->common->getRealIpAddr();
			$str_query = "insert into tblpayment_master(user_id,add_date,ip_address) values(?,?,?)";
			$rslt = $this->db->query($str_query,array($user_id,$add_date,$ipaddress));
			return $this->db->insert_id();
	}
	public function tblrecharge_Entry($company_id,$amount,$mobile_no,$user_id,$recharge_by)
	{	
	
		$this->load->library("common");
		$this->load->model("common_methods");
		$this->load->model("userinfo_methods");
		
		$scheme_id = $this->userinfo_methods->getSchemeId($user_id);
		$commission_per = $this->common_methods->getCommissionPer($scheme_id,$company_id);
		$commission_amount = $this->common_methods->getCommissionAmount($commission_per,$amount);
		$distributer_commission_per = $this->common_methods->getParentCommissionPer($commission_per,$user_id,$company_id);
		$distributer_commission_amount = $this->common_methods->getCommissionAmount($distributer_commission_per,$amount);
		
		$ExecuteBy = $this->common_methods->GetAPIName($company_id,$scheme_id);
		$add_date = $this->common->getDate();
		$recharge_date = $this->common->getMySqlDate();
		$recharge_time = $this->common->getMySqlTime();	
		$ipaddress = $this->common->getRealIpAddr();
		$description="Recharge";
		$recharge_status="Pending";
		$service_id = $this->common_methods->getServiceId($company_id);
		$recharge_type= $this->common_methods->getRechargeType($service_id);
		$str_query = "insert into  tblrecharge(company_id,amount,commission_amount,commission_per,mobile_no,user_id,add_date,ipaddress,service_id, 	recharge_date,description,recharge_type,recharge_status,recharge_time,recharge_by,ExecuteBy,distributer_commission_amount, 	distributer_commission_per)
		values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$reslut = $this->db->query($str_query,array($company_id,$amount,$commission_amount,$commission_per,$mobile_no,$user_id,$add_date,$ipaddress,$service_id,$recharge_date,$description,$recharge_type,$recharge_status,$recharge_time,$recharge_by,$ExecuteBy,$distributer_commission_amount,$distributer_commission_per));
		
		return $this->db->insert_id();
		
	}
	
	public function tblusers_registration_Entry($parent_id,$distributer_name,$postal_address,$pincode,$state_id,$city_id,$contact_person,$mobile_no,$landline,$retailer_type_id,$emailid,$usertype_name,$status,$scheme_id,$working_limit,$username,$password,$working_limit,$AIR,$MOBILE,$DTH,$GPRS,$SMS,$WEB)
	{
		$this->load->library("common");
		$this->load->model("common_methods");
		$add_date = $this->common->getDate();
		$ipaddress = $this->common->getRealIpAddr();
		$str_query = "insert into  tblusers(parent_id,business_name,postal_address,pincode,state_id,city_id,first_time_login,mobile_no,landline,retailer_type_id,emailid,usertype_name,add_date,ipaddress,status,scheme_id,working_limit,username,password) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$rlst = $this->db->query($str_query,array($parent_id,$distributer_name,$postal_address,$pincode,$state_id,$city_id,$contact_person,$mobile_no,$landline,$retailer_type_id,$emailid,$usertype_name,$add_date,$ipaddress,$status,$scheme_id,$working_limit,$username,$password));		
		$reg_id = $this->db->insert_id();
		if($AIR != 0)
		{
			$this->Insert_model->tbluserrightsEntry($reg_id,$AIR,$MOBILE,$DTH,$SMS,$GPRS,$WEB,$add_date);
		}
		//entry in tblmodulo rights
		$isDTH="yes";
		$isMobile="yes";
		$isAccount="no";
		$isAIR="no";
	
		$this->Insert_model->tblmodule_rights($reg_id,$add_date,$ipaddress,$isDTH,$isMobile,$isAccount,$isAIR);
		$credit_user_id = $reg_id;
		$debit_user_id = $parent_id;
		$remarkpay = "";
		$descriptionpay = $this->getCreditPaymentDescription($credit_user_id, $debit_user_id,$working_limit);
		$payment_typepay="cash";
		$this->tblewallet_Payment_CrDrEntry($credit_user_id,$debit_user_id,$working_limit,$remarkpay,$descriptionpay,$payment_typepay);
		$this->setCommission($reg_id,$scheme_id,$usertype_name);
		return $reg_id;
		
		
	}
	public function tblcompany_Entry($company_name,$operator_code,$service_id,$long_code_format,$logo_path,$long_code_no,$product_name)
	{
		$this->load->library("common");
		$this->load->model("common_methods");
		$add_date = $this->common->getDate();
		$ipaddress = $this->common->getRealIpAddr();
		$str_query = "insert into tblcompany(company_name,operator_code,service_id,add_date,ipaddress,long_code_format,logo_path,long_code_no,product_name) values(?,?,?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($company_name,$operator_code,$serviceID,$add_date,$ipaddress,$long_code_format,$logo_path,$long_code_no,$product_name));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	public function tblapi_Entry($api_name,$username,$password,$API_mode,$status)
	{
		$this->load->library("common");
		$this->load->model("common_methods");
		$add_date = $this->common->getDate();
		$ipaddress = $this->common->getRealIpAddr();
		$str_query = "insert into tblapi(api_name,username,password,API_mode,add_date,ipaddress,status) values(?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($api_name,$username,$password,$API_mode,$add_date,$ipaddress,$status));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	public function tblcommission_Entry($company_id,$api_id,$commission_per,$scheme_id)
	{
		$this->load->library("common");
		$add_date = $this->common->getDate();
		$ipaddress = $this->common->getRealIpAddr();
		$str_query = "insert into tblcommission(company_id,api_id,commission_per,scheme_id,add_date,ipaddress) values(?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($company_id,$api_id,$commission_per,$scheme_id,$add_date,$ipaddress));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	public function tblratailertype_Entry($retailer_type_name)
	{
		$this->load->library("common");
		$add_date = $this->common->getDate();
		$ipaddress = $this->common->getRealIpAddr();
		$str_query = "insert into tblratailertype(retailer_type_name,add_date,ipaddress) values(?,?,?)";
		$result = $this->db->query($str_query,array($retailer_type_name,$add_date,$ipaddress));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	public function tblstate_Entry($state_name,$codes,$circle_code)
	{
		$this->load->library("common");
		$add_date = $this->common->getDate();
		$ipaddress = $this->common->getRealIpAddr();
		$str_query = "insert into tblstate(state_name,codes,circle_code,add_date,ipaddress) values(?,?,?,?,?)";
		$result = $this->db->query($str_query,array($state_name,$codes,$circle_code,$add_date,$ipaddress));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	public function tblcity_Entry($city_name,$state_id)
	{
		$this->load->library("common");
		$add_date = $this->common->getDate();
		$ipaddress = $this->common->getRealIpAddr();
		$str_query = "insert into tblcity(city_name,state_id,add_date,ipaddress) values(?,?,?,?)";
		$result = $this->db->query($str_query,array($city_name,$state_id,$add_date,$ipaddress));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	public function tblscheme_Entry($scheme_name,$scheme_description,$amount,$scheme_type)
	{
		$this->load->library("common");
		$add_date = $this->common->getDate();
		$ipaddress = $this->common->getRealIpAddr();
		$str_query = "insert into tblscheme(scheme_name,scheme_description,amount,scheme_type,add_date,ipaddress) values(?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($scheme_name,$scheme_description,$amount,$scheme_type,$add_date,$ipaddress));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	public function tblbank_Entry($bank_name)
	{
		$this->load->library("common");
		$add_date = $this->common->getDate();
		$ipaddress = $this->common->getRealIpAddr();
		$str_query = "insert into tblbank(bank_name,add_date,ipaddress) values(?,?,?)";
		$result = $this->db->query($str_query,array($bank_name,$add_date,$ipaddress));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	public function tbluser_bank_Entry($bank_id,$ifsc_code,$account_number,$branch_name,$user_id)
	{
		$this->load->library("common");
		$add_date = $this->common->getDate();
		$ipaddress = $this->common->getRealIpAddr();
		$str_query = "insert into tbluser_bank(bank_id,ifsc_code,account_number,branch_name,user_id,add_date,ip_address) values(?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($bank_id,$ifsc_code,$account_number,$branch_name,$user_id,$add_date,$ipaddress));		
		if($result > 0)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	public function ref_comm_entry($user_id,$payment_id,$amount,$comm_per,$disc,$comm_type,$reg_user_id)
	{
		$this->load->library("common");
		$add_date = $this->common->getDate();
		$str_query = "insert into ref_comm(user_id,payment_id,amount,comm_per,add_date,disc,comm_type,reg_user_id) values(?,?,?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($user_id,$payment_id,$amount,$comm_per,$add_date,$disc,$comm_type,$reg_user_id));
		return true;
	}
	public function  tblmodule_rights($user_id,$add_date,$ipaddress,$isDTH,$isMobile,$isAccount,$isAIR)
	{
		$str_query = "insert into tblmodule_rights(user_id,add_date,ipaddress,isDTH,isMobile,isAccount,isAIR) values(?,?,?,?,?,?,? )";
		$rlst = $this->db->query($str_query,array($user_id,$add_date,$ipaddress,$isDTH,$isMobile,$isAccount,$isAIR));
		return true;
	}
	public function  tblfree_recharge_scheme_12($user_id,$add_date)
	{
		$str_query = "insert into tblfree_recharge_scheme_12(user_id,add_date,payment_date,status) values(?,?,?,?)";
		$newdate  = $add_date;
		for($i=0;$i<12;$i++)
		{
			$time = strtotime($newdate);
			$final = date("Y-m-d", strtotime("+1 month", $time));
			$rslt = $this->db->query($str_query,array($user_id,$add_date,$final,"false"));
			$newdate = $final;
			
		}
	}
	public function free_rec_comm_entry($user_id,$payment_id,$amount,$disc)
	{
		$this->load->library("common");
		$add_date = $this->common->getDate();
		$str_query = "insert into free_rec_comm(user_id,payment_id,amount,add_date,disc) values(?,?,?,?,?)";
		$result = $this->db->query($str_query,array($user_id,$payment_id,$amount,$add_date,$disc));
		return true;
	}
	public function getCreditPaymentDescription($credit_user_id, $debit_user_id,$amount)
	{
		$credit_user_info = $this->Userinfo_methods->getUserInfo($credit_user_id);
		$debit_user_info = $this->Userinfo_methods->getUserInfo($debit_user_id);
		return "Direct Payment By ".$debit_user_info->row(0)->business_name." (".$debit_user_info->row(0)->usertype_name." )  To ".$credit_user_info->row(0)->business_name." (".$credit_user_info->row(0)->usertype_name." )" ;
	}
	public function getRevertPaymentDescription($cr_user_id, $dr_user_id,$amount)
	{
		$credit_user_info = $this->Userinfo_methods->getUserInfo($cr_user_id);
		$debit_user_info = $this->Userinfo_methods->getUserInfo($dr_user_id);
		return "Direct Revert By ".$credit_user_info->row(0)->business_name." (".$credit_user_info->row(0)->usertype_name." )  From ".$debit_user_info->row(0)->business_name." (".$debit_user_info->row(0)->usertype_name." )" ;
	}
	public function tblflatcommissionEntry($user_id,$depositAmount,$amount,$commPer,$description,$payment_status)
	{
		$add_date = $this->common->getDate();
		$str_query = "insert into tblflatcommission(user_id,depositAmount,amount,commPer,add_date,description,payment_status) values(?,?,?,?,?,?,?) ";
		$rslt = $this->db->query($str_query,array($user_id,$depositAmount,$amount,$commPer,$add_date,$description,$payment_status));
		return true;
	}
	public function addComplaint($user_id,$str_message)
	{
		$this->load->library('common');
		$date = $this->common->getMySqlDate();
		$str_query = "insert into tblcomplain(user_id,complain_date,complain_status,message,complain_type,recharge_id) values(?,?,?,?,?,?)";
		$result = $this->db->query($str_query,array($user_id,$date,'Pending',$str_message,"Recharge Dispute",""));		
		if($result > 0)
		{
			return $this->db->insert_id();
			//return true;
		}
		else
		{
			return false;
		}		
	}
	public function tbluserrightsEntry($user_id,$AIR,$MOBILE,$DTH,$SMS,$GPRS,$WEB,$add_date)
	{
		$str_query = "insert into tbluserrights(user_id,AIR,MOBILE,DTH,SMS,GPRS,WEB,add_date) values(?,?,?,?,?,?,?,?)";
		$rslt = $this->db->query($str_query,array($user_id,$AIR,$MOBILE,$DTH,$SMS,$GPRS,$WEB,$add_date));
		return true;
	}
	public function setCommission($reg_id,$scheme_id,$usertype_name)
	{
			$rslt = $this->db->query("select * from tblcompany");
			foreach($rslt->result() as $row)
			{
				$comm = $this->getCommByScheme($row->company_id,$scheme_id,$usertype_name);
				$this->user_commission_entry($reg_id,$row->company_id,$comm);
			}
	}
	public function getCommByScheme($company_id,$scheme_id,$usertype_name)
	{
		$rslt = $this->db->query("select * from tblcommission where scheme_id = ? and company_id = ?",array($scheme_id,$company_id));
		if($rslt->num_rows() > 0)
		{
			return 	$rslt->row(0)->	royalComm;
		}
		else
		{
		return 0;
		}
	}
	public function user_commission_entry($reg_id,$company_id,$comm)
	{
		$add_date = $this->common->getDate();
		$ipaddress = $this->common->getRealIpAddr();
		$str_query = "insert into tbluser_commission(user_id,company_id,commission,add_date,ipaddress) values(?,?,?,?,?)";
		$rslt = $this->db->query($str_query,array($reg_id,$company_id,$comm,$add_date,$ipaddress));
	}
		public function rechargerefund($recharge_id)
		{
		$rsltrechargeinfo = $this->db->query("select reverted from tblrecharge where recharge_id = ?",array($recharge_id));
		if($rsltrechargeinfo->row(0)->reverted == 'yes')
		{
			return true;
		}
		$rslt = $this->db->query("select * from tblewallet where recharge_id = '$recharge_id'");
		if($rslt->num_rows() == 1)
		{
			$this->load->model("Tblcompany_methods");
			$user_id  = $rslt->row(0)->user_id;
			$debit_amount = $rslt->row(0)->debit_amount;
			$transaction_type = "Recharge_Refund";
			$cr_amount = $debit_amount;
			$Description = "Refund : ".$rslt->row(0)->description;
			$ewallet_id = $this->Insert_model->tblewallet_Recharge_CrEntry($user_id,$recharge_id,$transaction_type,$cr_amount,$Description);
			$rslt_updtrec = $this->db->query("update tblrecharge set debited='no',reverted='yes',revert_description = ?,ewallet_id = CONCAT_WS(',',ewallet_id,?) where recharge_id = ?",array($Description,$ewallet_id,$recharge_id));
			
			
			
		}
	}
}

?>