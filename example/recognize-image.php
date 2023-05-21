<?php

require_once realpath(dirname(dirname(__FILE__))) . '/vendor/autoload.php';

use CaptchasIO\CaptchasIO;
use CaptchasIO\Exception\CaptchasIOException;

$image = file_get_contents(realpath(dirname(__FILE__)) . '/images/image.jpg');

$apiKey = '********** API_KEY *************';

try {
    // Create service Client
    $ac = new CaptchasIO(CaptchasIO::SERVICE_CaptchasIO, ['api_key' => $apiKey, 'debug' => true]);

    // Request image to recognise and waiting for response
    echo $ac->recognizeImage($image, null, ['phrase' => 0, 'numeric' => 0], 'en');
} catch (CaptchasIOException $exception) {
    echo 'Error:' . $exception->getMessage();
}