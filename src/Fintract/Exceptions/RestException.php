<?php
namespace Fintract\Exceptions;

use \Exception;

/**
 * Class RestException
 * @package Fintract\Exceptions
 */
class RestException extends Exception
{
	public $rawResponse;
}