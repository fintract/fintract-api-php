<?php
namespace Fintract;

use Fintract\Exceptions\RestException;

// Autoload files using Composer autoload

require_once __DIR__ . '/../vendor/autoload.php'; 

require_once __DIR__.'/inc/config.php';

/**
 * Correct invoice or receipt data. Accepted formats: pdf, jpeg and tiff
 * @param api_key: API key
 * @param file_content: required (string) File content. Base64 encoded.
 * @param document_date: required (string) Document date
 * @param document_number: required (string) Document number
 * @param old_balance: required (number) Old balance
 * @param new_balance: required (number) New balance
 * @param currency: required (string) Currency
 */
 
$apiKey = FINTRACT_API_KEY;

$path = "";

/**
 *$path: file path that need to encode to base 64
 * base 64 encoded file content 
 */
 
if(file_exists($path))
{
	$fileContent = base64_encode(file_get_contents($path));
}

$documentDate = '2017-08-18';
$documentNumber = '23232';
$oldBalance = '540';
$newBalance = '540';
$currency = 'EUR';

$dataString = array(
    'api_key' => $apiKey,
    'file_content' => $fileContent,
    'document_date' => $documentDate,
    'document_number' => $documentNumber,
    'old_balance' => $oldBalance,
    'new_balance' => $newBalance,
    'currency' => $currency
);

$fintractApi = new API();

/**
 * to set ssl verify option
 * default true 
 */
$fintractApi->setSslverify(false);

/**
 * API version
 * default v1
 */
//$fintractApi->setApiVersion('v1');

try
{
	$response =  $fintractApi->statementsCorrection($dataString);
	print_r($response);
}
catch (RestException $e) {
    // API response status code was not successful
    echo 'API Exception: ' . $e->getMessage();
}