<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Testbook extends CI_Controller {
	
	public function index()
	{
		
							$this->load->library('cyberplatapi');
							$isRechargeDone = $this->cyberplatapi->CallRecharge("RV","125","9825378495",10);	
							print_r($isRechargeDone);exit;
							if(is_array($isRechargeDone))
							{			
								if($isRechargeDone['Status'] == 'Pending')
								{				
								   return 'Request in Pending Mode';		
								}
								if($isRechargeDone['Status'] == 'Success')
								{
									$this->Recharge_home_model->updateRechargeStatus($recharge_id,$isRechargeDone['TranID'],$isRechargeDone['OPT_CODE'],'Success');	
									$transaction_type = "Recharge";
									$Description = "Recharge ".$company_info->row(0)->company_name." | ".$Mobile." | ".$Amount." | Recharge Id = ".$recharge_id;
										$this->Insert_model->tblewallet_Recharge_DrEntry($user_id,$recharge_id,$transaction_type,$dr_amount,$Description);			
										if($rechargeBy == "SMS")
										{
											$balance = $this->Common_methods->getAgentBalance($user_id);
											$this->sendRechargeSMS($company_info,$Mobile,$Amount,$isRechargeDone['TranID'],"Success",$balance,$mobile_no);
										}
									return 'Recharge Request Submit Successfully';	
								}
								if($isRechargeDone['Status'] == 'Failure')
								{
									$this->Recharge_home_model->updateRechargeStatus($recharge_id,'','','Failure');																							
									if($rechargeBy == "SMS")
										{
											$balance = $this->Common_methods->getAgentBalance($user_id);
											$this->sendRechargeSMS($company_info,$Mobile,$Amount,NULL,"Failure",$balance,$mobile_no);
										}
									return 'Recharge Transaction Fail';	
								}
							}
							else
							{
								return 'Request in Pending Mode';
							}
				
					
		/*$xml = simplexml_load_file(base_url()."arzoobookingstatusresponse.xml");
		if($xml->requestedPNR)
		{
				foreach($xml->requestedPNR->origindestinationoptions->OriDestPNRRequest as $ODPNRReq)
				{
					$origin = $ODPNRReq->origin;
					echo "origin : ".$origin;
					echo "<br>";
					$destin = $ODPNRReq->destin;
					echo "destin : ".$destin;
					echo "<br>";
					$depttime = $ODPNRReq->depttime;
					echo "depttime : ".$depttime;
					echo "<br>";
					$arrivaltime = $ODPNRReq->arrivaltime;
					echo "arrivaltime : ".$arrivaltime;
					echo "<br>";
					$flightno = $ODPNRReq->flightno;
					echo "flightno : ".$flightno;
					echo "<br>";
					$airline = $ODPNRReq->airline;
					echo "airline : ".$airline;
					echo "<br>";
					$cabin = $ODPNRReq->cabin;
					echo "cabin : ".$cabin;
					echo "<br>";
					$noofpassengers = $ODPNRReq->noofpassengers;
					echo "noofpassengers : ".$noofpassengers;
					echo "<br>Passanger Detail<br>";
					foreach($ODPNRReq->eticketdto->Eticket as $eticketArr)
					{
						$givenName =  $eticketArr->givenName;
						echo "givenName : ".$givenName;
						echo "<br>";
						$surName =  $eticketArr->surName;
						echo "surName : ".$surName;
						echo "<br>";
						$nameReference =  $eticketArr->nameReference;
						echo "nameReference : ".$nameReference;
						echo "<br>";
						$eticketno =  $eticketArr->eticketno;
						echo "eticketno : ".$eticketno;
						echo "<br>";
						$flightuid =  $eticketArr->flightuid;
						echo "flightuid : ".$flightuid;
						echo "<br>";
						$passuid =  $eticketArr->passuid;
						echo "passuid : ".$passuid;
						echo "<br>";
						echo "<br>";
					}
					
					echo "<br><br><br>";
				}
		}
		else
		{
			echo "Booking Is Still Under Process";
		}*/
		exit;
		$this->load->model("Booking_status_model");
		$pref_id = "MIPA123#12";
		$status_response = $this->Booking_status_model->getArzooBookingStatus("A025566",$pref_id);
	}
		
}
