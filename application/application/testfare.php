<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Testfare extends CI_Controller {
	
	public function index()
	{
		$hparams=array();
		$wsdl = "http://api.tektravels.com/tboapi_v6.8/service.asmx?wsdl"; // This is sample web service URL, Kindly //update this url which is provided. 
		$hparams["SiteName"]="";
		$hparams["AccountCode"]=""; 
		$hparams["UserName"]='enterprise';
		$hparams["Password"]='enter@1234'; 
		$client_header = new SoapHeader('http://192.168.0.170/TT/BookingAPI','AuthenticationData',$hparams,false); 
		$cliente = new SoapClient($wsdl); 
		$cliente->__setSoapHeaders(array($client_header));
		//$client_header = new SoapHeader('http://192.168.0.170/TT/BookingAPI','AuthenticationData',$hparams,false); 
		//$cliente = new SoapClient($wsdl); 
		$cliente->__setSoapHeaders(array($client_header));
		//$str  = "<Search><request> <Origin>DEL</Origin> <Destination>BOM</Destination> <DepartureDate>2013-07-02</DepartureDate> <ReturnDate>2013-07-02</ReturnDate><Type>Return</Type><CabinClass>All</CabinClass><PreferredCarrier></PreferredCarrier> <AdultCount>1</AdultCount> <ChildCount>1</ChildCount><InfantCount>0</InfantCount> <SeniorCount>0</SeniorCount> <PromotionalPlanType>Normal</PromotionalPlanType> </request></Search>";
		$str_query = 'select * from tbltbofarearray where Id = 924';
		$rslt = $this->db->query($str_query);
		$fare_id = $rslt->row(0)->Id;
		$rslt_farefb = $this->db->query("select * from tbltbofarebreakdown where Fare_id =  $fare_id");
		$rslt_farerule = $this->db->query("select * from tbtbolfarerule where Fare_id =  $fare_id");
		$rslt_flight = $this->db->query("select * from tbltboflightsegments where Fare_id =  $fare_id");		
		
$bookstr = '<Ticket xmlns="http://192.168.0.170/TT/BookingAPI">
<wsTicketRequest>
	<Origin>DEL</Origin>
	<Destination>BOM</Destination>
	<PromotionalPlanType>Normal</PromotionalPlanType>
	<Segment>
		<WSSegment> 
			<SegmentIndicator>1</SegmentIndicator> 
			<Airline> 
				<AirlineCode>'.$rslt_flight->row(0)->Segment_AirlineCode.'</AirlineCode> 
				<AirlineName>'.$rslt_flight->row(0)->Segment_AirlineName.'</AirlineName> 
			</Airline> 
			<FlightNumber>'.$rslt_flight->row(0)->Segment_FlightNumber.'</FlightNumber> 
			<FareClass>'.$rslt_flight->row(0)->Segment_FareClass.'</FareClass> 
			<Origin>
				<AirportCode>'.$rslt_flight->row(0)->Segment_Origin_AirportCode.'</AirportCode> 
				<AirportName>'.$rslt_flight->row(0)->Segment__Origin_AirportName.'</AirportName> 
				<CityCode>'.$rslt_flight->row(0)->Segment_Origin_CityCode.'</CityCode> 
				<CityName>'.$rslt_flight->row(0)->Segment_Origin_CityName.'</CityName> 
				<CountryCode>IN</CountryCode>
				<CountryName>India</CountryName> 
			</Origin> 
			<Destination> 
				<AirportCode>'.$rslt_flight->row(0)->Segment_Destination_AirportCode.'</AirportCode> 
				<AirportName>'.$rslt_flight->row(0)->Segment_Destination_AirportName.'</AirportName> 
				<CityCode>'.$rslt_flight->row(0)->Segment_Destination_CityCode.'</CityCode> 
				<CityName>'.$rslt_flight->row(0)->Segment_Destination_CityName.'</CityName> 
				<CountryCode>IN</CountryCode> 
				<CountryName>India</CountryName> 
			</Destination> 
			<DepTIme>'.$rslt_flight->row(0)->Segment_DepTIme.'</DepTIme> 
			<ArrTime>'.$rslt_flight->row(0)->Segment_ArrTime.'</ArrTime>
			<ETicketEligible>true</ETicketEligible>
			<Duration>'.$rslt_flight->row(0)->Segment_Duration.'</Duration>
			<Stop>'.$rslt_flight->row(0)->Segment_Stop.'</Stop>
			<Craft>'.$rslt_flight->row(0)->Segment_Craft.'</Craft>
			<Status>'.$rslt_flight->row(0)->Segment_Status.'</Status> 
		</WSSegment>
	</Segment>
	<FareType>PUB</FareType>
	<FareRule>
		<WSFareRule>
			<Origin>'.$rslt->row(0)->Origin.'</Origin>
			<Destination>'.$rslt->row(0)->Destination.'</Destination>
			<Airline>'.$rslt_flight->row(0)->Segment_AirlineName.'</Airline>
			<FareBasisCode>'.$rslt_farerule->row(0)->FareRule_FareBasisCode.'</FareBasisCode>
			<DepartureDate>'.$rslt_farerule->row(0)->FareRule_DepartureDate.'</DepartureDate>
			<ReturnDate>'.$rslt_farerule->row(0)->FareRule_ReturnDate.'</ReturnDate>
			<Source>'.$rslt->row(0)->Source.'</Source>
		</WSFareRule>
	</FareRule>
	<Fare>
		<BaseFare>'.$rslt->row(0)->BaseFare.'</BaseFare>
		<Tax>'.$rslt->row(0)->Tax.'</Tax>
		<ServiceTax>'.$rslt->row(0)->ServiceTax.'</ServiceTax>
		<AdditionalTxnFee>'.$rslt->row(0)->AdditionalTxnFee.'</AdditionalTxnFee>
		<AgentCommission>'.$rslt->row(0)->AgentCommission.'</AgentCommission>
		<PublishedPrice>0</PublishedPrice>
		<AirTransFee>0</AirTransFee>
		<Currency>INR</Currency>
		<Discount>0</Discount>
		<OtherCharges>0</OtherCharges>
		<FuelSurcharge>'.$rslt->row(0)->FuelSurcharge.'</FuelSurcharge>
		<PLB>0.0</PLB>
		<TdsCommission>'.$rslt->row(0)->TdsCommission.'</TdsCommission>
		<TdsPLB>0</TdsPLB>
		<TransactionFee>0</TransactionFee>
		<ReverseHandlingCharge>0</ReverseHandlingCharge>
	</Fare>
	<Passenger>
		<WSPassenger>
			<Title>Mr</Title>
			<FirstName>Anupam</FirstName>
			<LastName>Test</LastName>
			<Type>Adult</Type>
			<DateOfBirth>1988-09-06T00:00:00</DateOfBirth>
			<Fare>
				<BaseFare>300</BaseFare>
				<Tax>3079</Tax>
				<ServiceTax>1.85</ServiceTax>
				<AdditionalTxnFee>174</AdditionalTxnFee>
				<AgentCommission>0.0</AgentCommission>
				<PublishedPrice>0</PublishedPrice>
				<AirTransFee>0</AirTransFee>
				<Currency>INR</Currency>
				<Discount>0</Discount>
				<OtherCharges>0</OtherCharges>
				<FuelSurcharge>2600.0</FuelSurcharge>
				<PLB>0.0</PLB>
			</Fare>
			<Gender>Male</Gender>
			<PassportExpiry>0001-01-01T00:00:00</PassportExpiry>
			<Country>IN</Country>
			<Phone>324234</Phone>
			<AddressLine1>1paxAddressLine1</AddressLine1>
			<AddressLine2>xxxxxxxxxxxxxxxxxx</AddressLine2>
			<Email>paxemail@gmail.com</Email>
			<Meal />
			<Seat>
				<Code>W</Code>
				<Description>Window</Description>
			</Seat>
			<FFAirline>6E</FFAirline>
			<FFNumber>A1234</FFNumber>
		</WSPassenger>
	</Passenger>
	<Remarks>book the ticket</Remarks>
	<InstantTicket>true</InstantTicket>
	<PaymentInformation>
		<PaymentInformationId>0</PaymentInformationId>
		<InvoiceNumber>0</InvoiceNumber>
		<Amount>3456</Amount>
		<TrackId>0</TrackId>
		<PaymentId>0</PaymentId>
		<PaymentGateway>APICustomer</PaymentGateway>
		<PaymentModeType>Deposited</PaymentModeType>
	</PaymentInformation>
	<Source>Indigo</Source>
	<SessionId>8afc960c-eedf-42aa-9e65-3282eca40b9e</SessionId>
	<IsOneWayBooking>false</IsOneWayBooking>
</wsTicketRequest>
</Ticket>';
		
		//$cliente = new SoapClient($wsdl);		
		$array = json_decode(json_encode((array)simplexml_load_string($bookstr)),1);
		$newarray = $this->replaceArrayToString($array);
		//print_r($newarray);exit;
		$resultFrom = $cliente->__soapCall("GetFareQuote", array($newarray));
		
		print_r($resultFrom);exit;
		
	}
function replaceArrayToString($arr = array()) {
    $newArr = array();
    foreach($arr as $key=>$value)
    {
        if (is_array($value))
        {
           unset($arr[$key]);

            //Is it an empty array, make it a string
            if (empty($value)) {
                $newArr[$key] = '';
            }
            else {
                $newArr[$key] = $this->replaceArrayToString($value);
            }

        }
        else {
            $newArr[$key] = $value; 
        }

    }
    return $newArr;

}
public function setBookingTbl($fare_id)
{
$rs_farearray=$this->db->query('select * from tbltbofarearray where Id=?',array($fare_id));
$rs_farebktdwn=$this->db->query('select * from tbltbofarebreakdown where Fare_id=?',array($fare_id));
$rs_fgtseg=$this->db->query('select * from tbltboflightsegments where Fare_id=?',array($fare_id));
$rs_farerule=$this->db->query('select * from tbtbolfarerule where Fare_id=?',array($fare_id));
$str_q_farearray='INSERT INTO `book_tbltbofarearray`(`request_id`, `IsDomestic`, `tboStatusCode`, `Description`, `Category`, `TripIndicator`, `BaseFare`, `Tax`, `ServiceTax`, `AdditionalTxnFee`, `AgentCommission`, `PublishedPrice`, `AirTransFee`, `Currency`, `Discount`, `OtherCharges`, `FuelSurcharge`, `PLB`, `TdsCommission`, `TdsPLB`, `TransactionFee`, `ReverseHandlingCharge`, `Origin`, `Destination`, `ObDuration`, `Source`, `IsLcc`, `IbSegCount`, `ObSegCount`, `PromotionalPlanType`, `NonRefundable`, `SessionId`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
$this->db->query($str_q_farearray,array($rs_farearray->row(0)->request_id,$rs_farearray->row(0)->IsDomestic,$rs_farearray->row(0)->tboStatusCode,$rs_farearray->row(0)->Description,$rs_farearray->row(0)->Category,$rs_farearray->row(0)->TripIndicator,$rs_farearray->row(0)->BaseFare,$rs_farearray->row(0)->Tax,$rs_farearray->row(0)->ServiceTax,$rs_farearray->row(0)->AdditionalTxnFee,$rs_farearray->row(0)->AgentCommission,$rs_farearray->row(0)->PublishedPrice,$rs_farearray->row(0)->AirTransFee,$rs_farearray->row(0)->Currency,$rs_farearray->row(0)->Discount,$rs_farearray->row(0)->OtherCharges,$rs_farearray->row(0)->FuelSurcharge,$rs_farearray->row(0)->PLB,$rs_farearray->row(0)->TdsCommission,$rs_farearray->row(0)->TdsPLB,$rs_farearray->row(0)->TransactionFee,$rs_farearray->row(0)->ReverseHandlingCharge,$rs_farearray->row(0)->Origin,$rs_farearray->row(0)->Destination,$rs_farearray->row(0)->ObDuration,$rs_farearray->row(0)->Source,$rs_farearray->row(0)->IsLcc,$rs_farearray->row(0)->IbSegCount,$rs_farearray->row(0)->ObSegCount,$rs_farearray->row(0)->PromotionalPlanType,$rs_farearray->row(0)->NonRefundable,$rs_farearray->row(0)->SessionId));
$b_fare_id=$this->db->insert_id();
 foreach($rs_farebktdwn->result() as $row)
 {
	$data_farebktdwn=array(
	'Fare_id'=>$b_fare_id,'FBPassengerType'=>$row->FBPassengerType,'FBPassengerCount'=>$row->FBPassengerCount,'FBBaseFare'=>$row->FBBaseFare,'FBTax'=>$row->FBTax,'FBAirlineTransFee'=>$row->FBAirlineTransFee,'FBAdditionalTxnFee'=>$row->FBAdditionalTxnFee,'FBFuelSurcharge'=>$row->FBFuelSurcharge); 
 }
 $this->db->insert('book_tbltbofarebreakdown',$data_farebktdwn);
 
 foreach($rs_fgtseg->result() as $row)
 {
	$data_fgtseg=array('Fare_Id'=>$b_fare_id,'Segment_AirlineCode'=>$row->Segment_AirlineCode,'Segment_AirlineName'=>$row->Segment_AirlineName,'Segment_SegmentIndicator'=>$row->Segment_SegmentIndicator,'Segment_FlightNumber'=>$row->Segment_FlightNumber,'Segment_FareClass'=>$row->Segment_FareClass,'Segment_Origin_AirportCode'=>$row->Segment_Origin_AirportCode,'Segment__Origin_AirportName'=>$row->Segment__Origin_AirportName,'Segment__Origin_Terminal'=>$row->Segment__Origin_Terminal,'Segment_Origin_CityCode'=>$row->Segment_Origin_CityCode,'Segment_Origin_CityName'=>$row->Segment_Origin_CityName,'Segment_Origin_CountryCode'=>$row->Segment_Origin_CountryCode,'Segment_Origin_CountryName'=>$row->Segment_Origin_CountryName,'Segment_Destination_AirportCode'=>$row->Segment_Destination_AirportCode,'Segment_Destination_AirportName'=>$row->Segment_Destination_AirportName,'Segment_Destination_Terminal'=>$row->Segment_Destination_Terminal,'Segment_Destination_CityCode'=>$row->Segment_Destination_CityCode,'Segment_Destination_CityName'=>$row->Segment_Destination_CityName,'Segment_Destination_CountryCode'=>$row->Segment_Destination_CountryCode,'Segment_Destination_CountryName'=>$row->Segment_Destination_CountryName,'Segment_DepTIme'=>$row->Segment_DepTIme,'Segment_ArrTime'=>$row->Segment_ArrTime,'Segment_ETicketEligible'=>$row->Segment_ETicketEligible,'Segment_Duration'=>$row->Segment_Duration,'Segment_Stop'=>$row->Segment_Stop,'Segment_Craft'=>$row->Segment_Craft,'Segment_Status'=>$row->Segment_Status); 
 }
  $this->db->insert('book_tblarzooflightsegments',$data_fgtseg);
  
   foreach($rs_farerule->result() as $row)
 {
	$data_farerule=array('Fare_Id'=>$b_fare_id,'FareRule_Origin'=>$row->FareRule_Origin,'FareRule_Destination'=>$row->FareRule_Destination,'FareRule_Airline'=>$row->FareRule_Airline,'FareRule_FareRestriction'=>$row->FareRule_FareRestriction,'FareRule_FareBasisCode'=>$row->FareRule_FareBasisCode,'FareRule_DepartureDate'=>$row->FareRule_DepartureDate,'FareRule_ReturnDate'=>$row->FareRule_ReturnDate,'FareRule_Source'=>$row->FareRule_Source); 
 }
 $this->db->insert('book_tbtbolfarerule',$data_farerule);
}

}
