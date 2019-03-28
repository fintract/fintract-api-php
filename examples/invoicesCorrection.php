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
 * @param invoice_date: required (string) Invoice date
 * @param invoice_number: required (string) Invoice number
 * @param total: required (number) Total price
 * @param subtotal: required (number) Subtotal price
 * @param taxes: required (string) Taxes
 * @param due_date: required (string) Due date
 * @param payment_method: required (string) Payment method
 * @param currency: required (string) Currency
 */
 
$apiKey = FINTRACT_API_KEY;

$path = __DIR__.'/files/Biolive GmbH.pdf';

/**
 *$path: file path that need to encode to base 64
 * base 64 encoded file content 
 */
 
if(file_exists($path))
{
	$fileContent = base64_encode(file_get_contents($path));
}

$invoiceDate = '2017-08-18';
$invoiceNumber = '144-23232';
$total = '540';
$subtotal = '600';
$taxes = '3,7';
$dueDate = '2017-08-18';
$paymentMethod = 'EUR';
$currency = 'EUR';

$dataString = array(
    'api_key' => $apiKey,   
    'file_content' => $fileContent,
    'invoice_date' => $invoiceDate,
    'invoice_number' => $invoiceNumber,
    'total' => $total,
    'subtotal' => $subtotal,
    'taxes' => $taxes,
    'due_date' => $dueDate,
    'payment_method' => $paymentMethod,
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
	$response =  $fintractApi->invoicesCorrection($dataString);
	print_r($response);
}
catch (RestException $e) {
    // API response status code was not successful
    echo 'API Exception: ' . $e->getMessage();
}