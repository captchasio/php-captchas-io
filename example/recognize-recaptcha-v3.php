<?php

require_once realpath(dirname(dirname(__FILE__))) . '/vendor/autoload.php';

use CaptchasIO\CaptchasIO;
use CaptchasIO\Task\RecaptchaV3Task;
use CaptchasIO\Exception\CaptchasIOException;

$apiKey = '********** API_KEY *************';

try {
    $acClient = new CaptchasIO(CaptchasIO::SERVICE_CaptchasIO, ['api_key' => $apiKey, 'debug' => true]);

    $task = new RecaptchaV3Task(
        "http://makeawebsitehub.com/recaptcha/test.php",  // target website address
        "6LfI9IsUAAAAAKuvopU0hfY8pWADfR_mogXokIIZ",      // recaptcha key from target website

        // Filters workers with a particular score. It can have one of the following values:
        // 0.3, 0.7, 0.9
        "0.3"
    );

    // Recaptcha's "action" value. Website owners use this parameter to define what users are doing on the page.
    $task->setPageAction("myaction");

    // Set this flag to "true" if you need this V3 solved with Enterprise API. Default value is "false" and
    // Recaptcha is solved with non-enterprise API.
    $task->setIsEnterprise(false);

    $response = $acClient->recognizeTask($task);

    echo $response['gRecaptchaResponse'];
} catch (CaptchasIOException $exception) {
    echo 'Error:' . $exception->getMessage();
}