<?php

require_once realpath(dirname(dirname(__FILE__))) . '/vendor/autoload.php';


use CaptchasIO\CaptchasIO;
use CaptchasIO\Service\CaptchasIO as CaptchasIOService;
use CaptchasIO\Exception\CaptchasIOException;

$apiKey = '********** API_KEY *************';

$service = new CaptchasIOService($apiKey);

try {
    $ac = new CaptchasIO($service, [
        'debug' => true
    ]);

    echo "Your Balance is: " . $ac->balance() . "\n";
} catch (CaptchasIOException $exception) {
    echo 'Error:' . $exception->getMessage();
}