<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Testtbo extends CI_Controller {
	
	public function index()
	{
		
		
		
		$this->load->model("Booking_model");
		$this->Booking_model->getBookingStatus("48029","6QJMEZ","Amadeus",54);
		
		exit;
		$hparams=array();
		$wsdl = "http://api.tektravels.com/tboapi_v6.8/service.asmx?wsdl"; // This is sample web service URL, Kindly //update this url which is provided. 
		$hparams["SiteName"]="";
		$hparams["AccountCode"]=""; 
		$hparams["UserName"]='enterprise';
		$hparams["Password"]='enter@1234'; 
		//$client_header = new SoapHeader('http://192.168.0.170/TT/BookingAPI','AuthenticationData',$hparams,false); 
		//$cliente = new SoapClient($wsdl); 
		//$cliente->__setSoapHeaders(array($client_header));
		$client_header = new SoapHeader('http://192.168.0.170/TT/BookingAPI','AuthenticationData',$hparams,false); 
		$cliente = new SoapClient($wsdl); 
		$cliente->__setSoapHeaders(array($client_header));
		$str  = "<Search><request> <Origin>DEL</Origin> <Destination>BOM</Destination> <DepartureDate>2013-07-02</DepartureDate> <ReturnDate>2013-07-02</ReturnDate><Type>Return</Type><CabinClass>All</CabinClass><PreferredCarrier></PreferredCarrier> <AdultCount>1</AdultCount> <ChildCount>1</ChildCount><InfantCount>0</InfantCount> <SeniorCount>0</SeniorCount> <PromotionalPlanType>Normal</PromotionalPlanType> </request></Search>";
		$str_query = 'select * from tbltbofarearray where Id = 924';
		$rslt = $this->db->query($str_query);
		$fare_id = $rslt->row(0)->Id;
		$rslt_farefb = $this->db->query("select * from tbltbofarebreakdown where Fare_id =  $fare_id");
		$rslt_farerule = $this->db->query("select * from tbtbolfarerule where Fare_id =  $fare_id");
		$rslt_flight = $this->db->query("select * from tbltboflightsegments where Fare_id =  $fare_id");
		
//		$sessionarr = explode(",",$rslt->row(0)->SessionId);
		
	$farequot = '<GetFareQuote xmlns="http://192.168.0.170/TT/BookingAPI"> <fareQuoteRequest> <Result> <TripIndicator>1</TripIndicator> <Fare> <BaseFare>'.$rslt->row(0)->BaseFare.'</BaseFare> <Tax>'.$rslt->row(0)->Tax.'</Tax> <ServiceTax>'.$rslt->row(0)->ServiceTax.'</ServiceTax> <AdditionalTxnFee>'.$rslt->row(0)->AdditionalTxnFee.'</AdditionalTxnFee> <AgentCommission>'.$rslt->row(0)->AgentCommission.'</AgentCommission> <PublishedPrice>0</PublishedPrice> <AirTransFee>0</AirTransFee> <Currency>INR</Currency> <Discount>0</Discount> <OtherCharges>0</OtherCharges> <FuelSurcharge>'.$rslt->row(0)->FuelSurcharge.'</FuelSurcharge> <PLB>0.0</PLB> <TdsCommission>'.$rslt->row(0)->TdsCommission.'</TdsCommission> <TdsPLB>0</TdsPLB> <TransactionFee>0</TransactionFee> <ReverseHandlingCharge>0</ReverseHandlingCharge> </Fare> <FareBreakdown> <WSPTCFare> <PassengerType>Adult</PassengerType> <PassengerCount>1</PassengerCount> <BaseFare>'.$rslt_farefb->row(0)->FBBaseFare.'</BaseFare> <Tax>'.$rslt_farefb->row(0)->FBTax.'</Tax> <AirlineTransFee>'.$rslt_farefb->row(0)->FBAirlineTransFee.'</AirlineTransFee> <AdditionalTxnFee>'.$rslt_farefb->row(0)->FBAdditionalTxnFee.'</AdditionalTxnFee> <FuelSurcharge>'.$rslt_farefb->row(0)->FBFuelSurcharge.'</FuelSurcharge> </WSPTCFare> </FareBreakdown> <Origin>'.$rslt_farerule->row(0)->FareRule_Origin.'</Origin> <Destination>'.$rslt_farerule->row(0)->FareRule_Destination.'</Destination> <Segment> <WSSegment> <SegmentIndicator>1</SegmentIndicator> <Airline> <AirlineCode>'.$rslt_flight->row(0)->Segment_AirlineCode.'</AirlineCode> <AirlineName>'.$rslt_flight->row(0)->Segment_AirlineName.'</AirlineName> </Airline> <FlightNumber>'.$rslt_flight->row(0)->Segment_FlightNumber.'</FlightNumber> <FareClass>'.$rslt_flight->row(0)->Segment_FareClass.'</FareClass> <Origin><AirportCode>'.$rslt_flight->row(0)->Segment_Origin_AirportCode.'</AirportCode> <AirportName>'.$rslt_flight->row(0)->Segment__Origin_AirportName.'</AirportName> <CityCode>'.$rslt_flight->row(0)->Segment_Origin_CityCode.'</CityCode> <CityName>'.$rslt_flight->row(0)->Segment_Origin_CityName.'</CityName> <CountryCode>IN</CountryCode> <CountryName>India</CountryName> </Origin> <Destination> <AirportCode>'.$rslt_flight->row(0)->Segment_Destination_AirportCode.'</AirportCode> <AirportName>'.$rslt_flight->row(0)->Segment_Destination_AirportName.'</AirportName> <CityCode>'.$rslt_flight->row(0)->Segment_Destination_CityCode.'</CityCode> <CityName>'.$rslt_flight->row(0)->Segment_Destination_CityName.'</CityName> <CountryCode>IN</CountryCode> <CountryName>India</CountryName> </Destination> <DepTIme>'.$rslt_flight->row(0)->Segment_DepTIme.'</DepTIme> <ArrTime>'.$rslt_flight->row(0)->Segment_ArrTime.'</ArrTime> <ETicketEligible>true</ETicketEligible> <Duration>'.$rslt_flight->row(0)->Segment_Duration.'</Duration> <Stop>'.$rslt_flight->row(0)->Segment_Stop.'</Stop> <Craft>'.$rslt_flight->row(0)->Segment_Craft.'</Craft> <Status>'.$rslt_flight->row(0)->Segment_Status.'</Status> </WSSegment> </Segment>
	 <ObDuration>'.$rslt->row(0)->ObDuration.'</ObDuration> <Source>'.$rslt->row(0)->Source.'</Source> <FareRule> <WSFareRule> <Origin>'.$rslt->row(0)->Origin.'</Origin> <Destination>'.$rslt->row(0)->Destination.'</Destination> <Airline>'.$rslt_flight->row(0)->Segment_AirlineName.'</Airline> <FareBasisCode>'.$rslt_farerule->row(0)->FareRule_FareBasisCode.'</FareBasisCode> <DepartureDate>'.$rslt_farerule->row(0)->FareRule_DepartureDate.'</DepartureDate> <ReturnDate>'.$rslt_farerule->row(0)->FareRule_ReturnDate.'</ReturnDate> <Source>'.$rslt->row(0)->Source.'</Source> </WSFareRule> </FareRule> <IsLcc>true</IsLcc> <IbSegCount>0</IbSegCount> <ObSegCount>1</ObSegCount> <NonRefundable>true</NonRefundable> <PromotionalPlanType>Normal</PromotionalPlanType> </Result> <SessionId xmlns="http://192.168.0.170/TT/BookingAPI">'.$rslt->row(0)->SessionId.'</SessionId> </fareQuoteRequest> </GetFareQuote>';	
	// print_r($farequot);exit;
	
	
	
	
$bookstr = '<Book>
	<bookRequest> 
	<Remarks>remark you want to add</Remarks> 
	<PromotionalPlanType>Normal</PromotionalPlanType> 
	<InstantTicket>true</InstantTicket> 
	<Fare>
	 <BaseFare>950</BaseFare> 
	 <Tax>3584</Tax> 
	 <ServiceTax>5.87</ServiceTax> 
	 <AdditionalTxnFee>0</AdditionalTxnFee> 
	 <AgentCommission>0.0</AgentCommission> 
	 <PublishedPrice>0</PublishedPrice> 
	 <AirTransFee>0</AirTransFee>
	  <Currency>INR</Currency> 
	  <Discount>0</Discount> 
	  <ChargeBU> 
	  <ChargeBreakUp>
	   <PriceId>0</PriceId>
	    <ChargeType>OtherCharges</ChargeType> 
		<Amount>100.00</Amount>
		 </ChargeBreakUp>
		  </ChargeBU>
		  <OtherCharges>100.00</OtherCharges>
		   <FuelSurcharge>2906</FuelSurcharge> 
		   <PLB>0.0</PLB>
		    <TdsCommission>0</TdsCommission>
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
				    <BaseFare>950</BaseFare>
					 <Tax>3584</Tax>
					  <ServiceTax>6</ServiceTax>
					   <AdditionalTxnFee>0</AdditionalTxnFee>
					    <AgentCommission>0</AgentCommission> 
						<PublishedPrice>0</PublishedPrice> 
						<AirTransFee>0</AirTransFee>
						<Currency>INR</Currency> 
						<Discount>0</Discount> 
						<ChargeBU>
						 <ChargeBreakUp>
						  <PriceId>0</PriceId>
						   <ChargeType>OtherCharges</ChargeType> 
						   <Amount>100.00</Amount>
						    </ChargeBreakUp>
							 </ChargeBU> 
							 <OtherCharges>100</OtherCharges> 
							 <FuelSurcharge>0</FuelSurcharge> 
							 <PLB>0</PLB> 
							 <TdsCommission>0</TdsCommission>
							  <TdsPLB>0</TdsPLB>
							   <TransactionFee>0</TransactionFee>
							    <ReverseHandlingCharge>0</ReverseHandlingCharge>
								 </Fare>
								  <Gender>Male</Gender>
								   <PassportExpiry>0001-01-01T00:00:00</PassportExpiry>
								    <Country>IN</Country> 
									<Phone>324234</Phone>
									 <AddressLine1>1paxAddressLine1</AddressLine1> 
									 <AddressLine2>xxxxxxxxxxxxxxxxxx</AddressLine2> 
									 <Email>paxemail@gmail.com</Email> 
									 <Meal />
									
									 </WSPassenger>
									  </Passenger>
									   <Origin>DEL</Origin> 
									   <Destination>BOM</Destination> 
									   <Segment> <WSSegment> <SegmentIndicator>1</SegmentIndicator> <Airline> <AirlineCode>IT</AirlineCode> <AirlineName>Kingfisher</AirlineName> </Airline> <FlightNumber>316</FlightNumber> <FareClass>E</FareClass> <Origin> <AirportCode>DEL</AirportCode> <AirportName>Indira Gandhi Airport</AirportName> <Terminal>3</Terminal> <CityCode>DEL</CityCode> <CityName>Delhi</CityName> <CountryCode>IN</CountryCode> <CountryName>India</CountryName> </Origin> <Destination> <AirportCode>BOM</AirportCode> <AirportName>Mumbai</AirportName> <Terminal>1</Terminal> <CityCode>BOM</CityCode> <CityName>Mumbai</CityName> <CountryCode>IN</CountryCode><CountryName>India</CountryName> </Destination> <DepTIme>2011-07-30T21:20:00</DepTIme> <ArrTime>2011-07-30T23:15:00</ArrTime> <ETicketEligible>true</ETicketEligible> <Duration>00:00</Duration> <Stop>0</Stop> <Craft>320</Craft> <Status>Confirmed</Status> </WSSegment> </Segment> <FareType>PUB</FareType> <FareRule> <WSFareRule> <Origin>DEL</Origin> <Destination>BOM</Destination> <Airline>IT</Airline> <FareRestriction>Y</FareRestriction> <FareBasisCode>EAP14DA</FareBasisCode> <DepartureDate>2011-07-30T21:20:00</DepartureDate> <ReturnDate>2011-07-30T23:15:00</ReturnDate> <Source>Amadeus</Source> </WSFareRule> </FareRule> <Source>Amadeus</Source> <PaymentInformation> <PaymentInformationId>0</PaymentInformationId> <InvoiceNumber>0</InvoiceNumber> <PaymentId>0</PaymentId> <Amount>0</Amount> <TrackId>0</TrackId> <PaymentGateway>APICustomer</PaymentGateway> <PaymentModeType>Deposited</PaymentModeType> </PaymentInformation> <SessionId>da4e5518-12f5-4f51-8be3-5725936b9293</SessionId> </bookRequest></Book>';
		
		
		
		
		//$cliente = new SoapClient($wsdl);		
		$array = json_decode(json_encode((array)simplexml_load_string($farequot)),1);
	//	$newarray = $this->replaceArrayToString($array);
		//print_r($newarray);exit;
		$resultFrom = $cliente->__soapCall("GetFareQuote", array($array));
		
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

}
