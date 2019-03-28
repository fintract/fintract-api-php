<?php
namespace Fintract;

use Fintract\Exceptions\RestException;

// Autoload files using Composer autoload

require_once __DIR__ . '/../vendor/autoload.php'; 

require_once __DIR__.'/inc/config.php';

/**
 * Upload a payroll. Accepted formats: jpeg, png and tiff
 * @param api_key: API key
 * @param file_content: required (string) File content. Base64 encoded.
 */

$apiKey = FINTRACT_API_KEY;
 
$path = __DIR__.'/files/payroll.jpg';

/**
 *$path: file path that need to encode to base 64
 * base 64 encoded file content 
 */
 
if(file_exists($path))
{
	$fileContent = base64_encode(file_get_contents($path));
}

$dataString = array(
    'api_key' => $apiKey,                  
    'file_content' => $fileContent
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
	$response =  $fintractApi->payrollsUpload($dataString);
	print_r($response);
}
catch (RestException $e) {
    // API response status code was not successful
    echo 'API Exception: ' .$e->getMessage();
}