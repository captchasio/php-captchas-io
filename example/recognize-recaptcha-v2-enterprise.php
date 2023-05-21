<?php

require_once realpath(dirname(dirname(__FILE__))) . '/vendor/autoload.php';

use CaptchasIO\CaptchasIO;
use CaptchasIO\Task\RecaptchaV2EnterpriseTask;
use CaptchasIO\Exception\CaptchasIOException;

$apiKey = '********** API_KEY *************';

try {
    $acClient = new CaptchasIO(CaptchasIO::SERVICE_CaptchasIO, ['api_key' => $apiKey, 'debug' => true]);

    $task = new RecaptchaV2EnterpriseTask(
        "http://makeawebsitehub.com/recaptcha/test.php",     // <-- target website address
        "6LfI9IsUAAAAAKuvopU0hfY8pWADfR_mogXokIIZ"           // <-- recaptcha key from target website
    );

    $task->setEnterprisePayload([
        "s" => "SOME_ADDITIONAL_TOKEN"
    ]);

    // If you need setup proxy
    $task->setProxy(
        "8.8.8.8",
        1234,
        "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116",
        "http",
        "login",
        "password",
        null // also you can add cookie
    );

    $response = $acClient->recognizeTask($task);

    echo $response['gRecaptchaResponse'];
} catch (CaptchasIOException $exception) {
    echo 'Error:' . $exception->getMessage();
}