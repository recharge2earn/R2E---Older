<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Testapi extends CI_Controller {
	
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
		$opta=array(); 
		$opta["Search"]["request"]["Origin"]="BOM"; 
		$opta["Search"]["request"]["Destination"]="NYC"; 
		$opta["Search"]["request"]["DepartureDate"]="2013-06-05";
		$opta["Search"]["request"]["ReturnDate"]="2013-06-05"; 
		$opta["Search"]["request"]["Type"]="OneWay";
		$opta["Search"]["request"]["CabinClass"]="All";
		$opta["Search"]["request"]["PreferredCarrier"]=""; 
		$opta["Search"]["request"]["AdultCount"]="1";
		$opta["Search"]["request"]["ChildCount"]="0";
		$opta["Search"]["request"]["InfantCount"]="0"; 
		$opta["Search"]["request"]["SeniorCount"]="0";
		$opta["Search"]["request"]["PromotionalPlanType"]="Normal"; 
		$h=array(); 
		$h= (array)$cliente->__call('Search',$opta);
		$i=0;
		print_r($h);
	}
}
