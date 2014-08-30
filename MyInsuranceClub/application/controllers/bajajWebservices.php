<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BajajWebservices extends Customer_Controller {
	
    function __construct() 
    {
        parent::__construct();
		// Load required CI libraries and helpers.
		$this->load->model('master_tags_model');
 		
	}
	
	public function bjazWebserviceTravelPlan()
	{
		$client = new SoapClient("http://webservices.bajajallianz.com:8001/BjazTravelWebservice/BjazTravelWebservicePort?WSDL");
		/* Invoke webservice method with your parameters, in this case: Function1 */
		$params = array('auserId'=>'bookings@myinsuranceclub.com',
						'apassword'=>'newpas12',
						'xxaIntemdCode_inoutxx'=>0,
						'xxpDealerCode_inoutxx'=>0) ;
		$response = $client->__soapCall("bjazWebserviceTravelPlan", $params);
		
		/* Print webservice response */
		echo '<pre>';		
		print_r($response);
	}
	
	public function getPlanDetails()
	{
		$client = new SoapClient("http://webservices.bajajallianz.com:8001/BjazTravelWebservice/BjazTravelWebservicePort?WSDL");
		/* Invoke webservice method with your parameters, in this case: Function1 */
		$params = array('auserId'=>'bookings@myinsuranceclub.com',
						'apassword'=>'newpas12',
						'planname'=>'Travel Elite Family  (Family Floater)') ;
		$response = $client->__soapCall("getPlanDetails", $params);
		
		/* Print webservice response */
		echo '<pre>';		
		print_r($response);
	}
	
	
	public function bjazWebservicePremium()
	{
		/* Invoke webservice method with your parameters, in this case: Function1 */
		$params = array(	'auserId'=>'bookings@myinsuranceclub.com',
							'apassword'=>'newpas12',
							'WeoTrvPremiumInParamUser' => array(
																'ptravelplan'=>'Travel Elite Platinum',
																'pareaplan'=>'WORLDWIDE INCLUDING USA AND CANADA',
																'pdateOfBirth'=>'01-JAN-1980',
																'pfromDate'=>'28-AUG-2014',
																'ploading'=>'',
																'pdiscount'=>'',
																'pspDiscount'=>'',
																'ptoDate'=>'31-AUG-2014',
															),
							'xxpfamilyFlag_inoutxx'=>'N',
						) ;
		$wsdl = "http://webservices.bajajallianz.com:8001/BjazTravelWebservice/BjazTravelWebservicePort?WSDL";
		$client = new SoapClient($wsdl, array('trace' => true, 'exceptions' =>0));
		$response = $client->__soapCall("bjazWebservicePremium", $params);
//		$client->__getTypes();

echo "<pre>" . htmlentities($client->__getLastRequest()) . "\n";
		echo "<pre>";
		print_r($response);
//		print_r($client);
		//print_r( $client->__getTypes());
die;
	}
	

	public function bjazWebservicePremiumF()
	{
		/* Invoke webservice method with your parameters, in this case: Function1 */
		$params = array(	'auserId'=>'bookings@myinsuranceclub.com',
							'apassword'=>'newpas12',
							'WeoTrvPremiumInParamUser' => array(
																'ptravelplan'=>'Travel Elite Family  (Family Floater)',
																'pareaplan'=>'IncludingUSA',
																'pdateOfBirth'=>'01-JAN-1980',
																'pfromDate'=>'28-AUG-2014',
																'ploading'=>'',
																'pdiscount'=>'',
																'pspDiscount'=>'',
																'ptoDate'=>'31-AUG-2014',
															),
							'xxpfamilyFlag_inoutxx'=>'Y',
							'WeoTrvFamilyParamInList'	=>	array( 
																'0'=>array(
																	'pvname'=>'ABC XYZ',
																	'pvage'=>'30',
																	'pvrelation'=>'Spouse',
																	'pvsex'=>'Female',
																	'pvpartnerId'=>'',
																	'pvdob'=>'20-MAY-1984',
																	'pvpassportNo'=>'123456',
																	'pvassignee'=>'KRISHNA',
																	),
																'1'=>array(
																	'pvname'=>'ABC XYZ',
																	'pvage'=>'14',
																	'pvrelation'=>'Child',
																	'pvsex'=>'Female',
																	'pvpartnerId'=>'',
																	'pvdob'=>'20-MAY-2000',
																	'pvpassportNo'=>'123456',
																	'pvassignee'=>'KRISHNA',
																	),
																)
						) ;
		$wsdl = "http://webservices.bajajallianz.com:8001/BjazTravelWebservice/BjazTravelWebservicePort?WSDL";
		$client = new SoapClient($wsdl, array('trace' => true, 'exceptions' =>0));
		$response = $client->__soapCall("bjazWebservicePremium", $params);
//		$client->__getTypes();

echo "<pre>" . htmlentities($client->__getLastRequest()) . "\n";
		echo "<pre>";
		print_r($response);
//		print_r($client);
		//print_r( $client->__getTypes());
die;
	}

	
	public function bjazWebserviceIssuePolicy()
	{
		/* Invoke webservice method with your parameters, in this case: Function1 */
		$params = array(	'auserId'=>'bookings@myinsuranceclub.com',
							'apassword'=>'newpas12',
							'BjazTrvIssueNewWsUser' => array(	'pruralFlag'=>'N',//na, system generated, default
																'plocationCode'=>'0',//na, system generated, default
																'ppartnerId'=>0,//na, system generated, default
																'pdateOfBirth'=>'01-jan-1980',
																'pintermediaryCode'=>0,// test->10000002, change at time of development
																'pproduct'=>'9910',//na, system generated, default
																'ppassportNo'=>'ASSD1112544',//passport number of insured, default
																'passigneeName'=>'testfirst',//insured name, default
																'puserName'=>'bookings@myinsuranceclub.com',
																'pdealerCode'=>0,//na, system generated, default
																'ppremiumPayerFlag'=>'N',//na
																'ppremiumPayerId'=>0,//na
																'ppaymentMode'=>'Agent Float',//na, default
																'pfamilyFlag'=>'N',//for individual ->N, Family -> Y
																'ptravelplan'=>'Travel Elite Platinum',
																'pareaplan'=>'WORLDWIDE INCLUDING USA AND CANADA',
																'pfromDate'=>'28-aug-2014',
																'ploading'=>0,//na
																'pdiscount'=>0,//na
																'ptoDate'=>'31-AUG-2014',
																'ptermStartDate'=>'28-Aug-2014',//trip start date
																'ptermEndDate'=>'31-Aug-2014',//trip end date
																'partId'=>0,//na
																'partnerType'=>'P',
																'partnerRef'=>'P',//na
																'language'=>'',//na
																'addId'=>0,//na
																'regNumber'=>0,//na
																'maritalStatus'=>'Single',
																'afterTitle'=>'',
																'beforeTitle'=>'Mr',
																'contact1'=>'98745632',//na
																'employmentStatus'=>'Employed',
																'notes'=>'',//na
																'nationalId'=>'',//na
																'sex'=>'M',//M/F
																'telephone'=>'98745632',//landline number, if available
																'telephone2'=>'98745632',//landline number, if available
																'email'=>'krishna@myinsuranceclub.com',
																'fax'=>'',//if available
																'quality'=>0,//na
																'taxId'=>0,//na
																'vatNumber'=>0,//na
																'firstName'=>'testfirst',//Fn, Mn,Ln, any one
																'surname'=>'testlast',//Fn, Mn,Ln, any one
																'institutionName'=>'',//na
																'middleName'=>'testmiddle',//Fn, Mn,Ln, any one
																'telephone3'=>'9874563210',//na
																'postcode'=>'411012',//na
																'countryCode'=>'',//na
																'addressLine1'=>'some house some street',//R
																'addressLine2'=>'some area some locality',//R
																'addressLine3'=>'mumbai',//city
																'addressLine4'=>'maharashtra',//state
																'addressLine5'=>'some landmark',//if available
																'psubagentCode'=>0,//na
																'pcoverNoteNo'=>0,//na
																'pfullTermPremium'=>0,//na
																'pcoOrgUnit'=>0,//na
																'pserviceCharge'=>0,//na
																'pspDiscountAmt'=>'',//na
																'pspDiscount'=>0,//na
																'pserviceTaxAmt'=>0,//na
																'ptotalPremium'=>0,//na
																'pdestination'=>0,//na
																'pspCondition'=>0,//na
																'userid'=>'bookings@myinsuranceclub.com',//na
																'dateOfBirth'=>'01-JAN-1980',//na
																'checkBox'=>0,//na
																'policyNo'=>0,//na
																'pmasterpolicyno'=>0,//na
																'pcompref'=>0,//na
																'pempno'=>0//na
															),
															'WeoTrvFamilyParamInUser'=>array(
													/*			'pvname'=>'',
																'pvage'=>'',
																'pvrelation'=>'',
																'pvsex'=>'',
																'pvpartnerId'=>'',
																'pvdob'=>'',
																'pvpassportNo'=>'',
																'pvassignee'=>'',
																*/
															),
														) ;
		$wsdl = "http://webservices.bajajallianz.com:8001/BjazTravelWebservice/BjazTravelWebservicePort?WSDL";
		$client = new SoapClient($wsdl, array('trace' => true, 'exceptions' =>0));
		$response = $client->__soapCall("bjazWebserviceIssuePolicy", $params);
//		$client->__getTypes();

echo "<pre>" . htmlentities($client->__getLastRequest()) . "\n";
		echo "<pre>";
		print_r($response);
//		print_r($client);
		//print_r( $client->__getTypes());
die;
	}
	

	
	public function bjazWSIssueGroupPolicy()
	{
		/* Invoke webservice method with your parameters, in this case: Function1 */
		$params = array(	'auserId'=>'bookings@myinsuranceclub.com',
							'apassword'=>'newpas12',
							'BjazTrvIssueUser' => array(
																'ptravelplan'=>'Travel Elite Platinum',
																'pareaplan'=>'WORLDWIDE INCLUDING USA AND CANADA',
																'pdateOfBirth'=>'01-JAN-1980',
																'pfromDate'=>'28-AUG-2014',
																'ploading'=>'',
																'pdiscount'=>'',
																'pspDiscount'=>'',
																'ptoDate'=>'31-AUG-2014',
															),
							'xxpfamilyFlag_inoutxx'=>'N',
						) ;
		$wsdl = "http://webservices.bajajallianz.com:8001/BjazTravelWebservice/BjazTravelWebservicePort?WSDL";
		$client = new SoapClient($wsdl, array('trace' => true, 'exceptions' =>0));
		$response = $client->__soapCall("bjazWSIssueGroupPolicy", $params);
//		$client->__getTypes();

//echo "<pre>" . htmlentities($client->__getLastRequest()) . "\n";
		echo "<pre>";
		print_r($response);
//		print_r($client);
		//print_r( $client->__getTypes());
die;
	}
	
	
}

/* End of file common.php */
/* Location: ./application/controllers/common.php */