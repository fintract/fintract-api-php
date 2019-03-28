<?php
namespace Fintract\Exceptions;

/**
 * Class ResponseException
 * @package Fintract\Exceptions
 */
class ResponseException extends RestException
{
    /**
     * @var array Decoded response
     */
    protected $responseData;
    /**
     * @var integer http status code
     */
    protected $statusCode;

    /**
     * ResponseException constructor.
     * @param array $responseData
     * @param integer $statusCode
     */
    public function __construct($responseData, $statusCode)
    {
        $this->responseData = $responseData;
        $this->statusCode = $statusCode;
		ResponseException::getException($responseData,$statusCode);
    }

    /**
     * Returns an exceptions with a message based on the status code
     * @param string $message
     * @return AuthenticationException|NotFoundException|RequestException|RestException|ServerException|ValidationException
     */
    public function getException($message,$code)
    {
        // make exception based on the status code
        switch ($code) {
            case 400:
                return
                    $message?
                        new ValidationException($message):
                        new ValidationException(
                            "A parameter is missing or ".
                            "is invalid while accessing resource");
                break;
            case 401:
                return
                    $message?
                        new AuthenticationException($message):
                        new AuthenticationException(
                        "Failed to authenticate while accessing resource");
                break;
            case 404:
                return
                    $message?
                        new NotFoundException($message):
                        new NotFoundException(
                        "Failed to authenticate while accessing resource");
                break;
            case 405:
                return
                    $message?
                        new RequestException($message):
                        new RequestException(
                        "HTTP method used is not allowed to access resource");
                break;
            case 500:
                return
                    $message?
                        new ServerException($message):
                        new ServerException(
                        "A server error occurred while accessing resource");
                break;
            default:
                return new RestException(json_encode($this->responseData));
        }

    }
}