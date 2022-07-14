# fintract

A PHP SDK to use OCR Service fintract.io
==============================================

fintract PHP SDK API can be used to integrate fintract REST API into your own PHP application.
fintract is a commercial OCR REST Service for financial document such as invoices, receipts, identity cards and much more. Simply send a PDF or Image to the REST Service and you receive back structured data in JSON format.

All Access to the APIs are restricted by an API Key. Request your access on https://www.fintract.io/ by submitting the contact form.

### API Reference

https://docs.fintract.io

## Reporting issues
Report any feedback or problems with this version by [opening an issue on Github](http://github.com/fintract/fintract-api-php/issues).

### Installation

You can use the SDK using [composer](https://getcomposer.org/). Run the following command in your project directory to update your `composer.json` file and download the SDK.

    $ composer require fintract/fintract-api-php

Alternatively, you can download this source and run

	$ composer install
	
This generates the autoload files, which you can include using the following line in your PHP source code to start using the SDK.
