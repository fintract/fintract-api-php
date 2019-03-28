<?php
namespace Fintract;

use Fintract\Exceptions\RestException;

/**
 * Class API
 * @package Fintract
*/

class API
{
	 /**
      * @var apiUrl
      */
     public static $apiUrl = "https://api.fintract.io/";
	
	 /**
      * @var apiVersion
      */
	 public $apiVersion = "v1";
	 
	 /**
      * @var timeout default
      */
	 public $timeout = 90;
	 
	 /**
      * @var sslVerify
      */
	 public $sslVerify = true;
	 
	 
     public function __construct()
     {
        // init setting
     }
	
	 /**
      * Set default timeout for all the requests
      *
      * @param int $timeout
      */	
     public function setTimeout($timeout)
     {
        $this->timeout = $timeout;
     }
	
	 /**
      * Set SSL Verify for all the requests
      *
      * @param int $sslVerify
      */	 
     public function setSslverify($sslVerify)
     {
        $this->sslVerify = $sslVerify;
     }
   	
	 /**
      *  Set the api Version
      *
      *  @param string $apiVersion
      *  
      */
     public function setApiVersion($apiVersion)
     {
        $this->apiVersion = trim($apiVersion);
     }

     /**
      * call api
      * @param $dataString: request data array
      * @param $url: api route
      * @return $returnData: response json data
      */
     public function callApi( $dataString=null, $url)
     {
		if (!isset($dataString) ) return null;

		$url = API::$apiUrl.$url;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->sslVerify);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		$returnData = curl_exec($ch);		
		
		$errorNumber = curl_errno($ch);
        $error = curl_error($ch); 
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);		

        if ($errorNumber) {
            throw new RestException('CURL: ' . $error, $errorNumber);
        }

        $response = json_decode($returnData, true);
		
        if (empty($response)) {
            throw new RestException($httpcode.' - Invalid API response');
        }      
		
		curl_close($ch);
		
		return $returnData;
		
     }

    /**
     * Upload a Commercial Register Extract - DE document. Accepted formats: jpeg, png and tiff
     * @param $dataString: request data array
     * @return $returnData: response json data
    */
    public function commercialRegisterExtractDE($dataString)
    {
        return $this->callApi($dataString, 'commercialRegisterExtract/DE/'.$this->apiVersion.'/uploadDocument/');		
    }

    /**
     * Upload a identity card. Accepted formats: jpeg, png and tiff
     * @param $dataString: request data array
     * @return $returnData: response json data
     */
    public function identityCards($dataString)
    {
        return $this->callApi($dataString, 'identityCards/'.$this->apiVersion.'/uploadDocument/');
    }

    /**
     * Upload a invoice or receipt. Accepted formats: pdf, jpeg and tiff
     * @param $dataString: request data array
     * @return $returnData: response json data
     */
    public function invoicesUpload( $dataString )
    {
        return $this->callApi($dataString, 'invoices/'.$this->apiVersion.'/uploadDocument/');
    }

    /**
     * Correct invoice or receipt data. Accepted formats: pdf, jpeg and tiff
     * @param $dataString: request data array
     * @return $returnData: respose json data
     */
    public function invoicesCorrection( $dataString )
    {
        return $this->callApi($dataString, 'invoices/'.$this->apiVersion.'/correction/');
    }

    /**
     * Upload a payroll. Accepted formats: jpeg, png and tiff
     * @param $dataString: request data array
     * @return $returnData: response json data
     */
    public function payrollsUpload( $dataString )
    {
        return $this->callApi($dataString, 'payrolls/'.$this->apiVersion.'/uploadDocument/');
    }

    /**
     * Upload a identity card. Accepted formats: jpeg, png and tiff
     * @param $dataString: request data array
     * @return $returnData: response json data
     */
    public function statementsUpload( $dataString )
    {
        return $this->callApi($dataString, 'statements/'.$this->apiVersion.'/uploadDocument/');
    }

    /**
     * Correct Bank- & Credit-Card Statement data. Accepted formats: pdf, jpeg and tiff
     * @param $dataString: request data array
     * @return $returnData: respose json data
     */
    public function statementsCorrection( $dataString )
    {
        return $this->callApi($dataString, 'statements/'.$this->apiVersion.'/correction/');
    }

}