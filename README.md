<p align="center">
  <h1 align="center">CAPTCHAs.IO PHP SDK</h1>
</p>

---


PHP client for  [captchas.io](https://captchas.io) service.
This client supports resolving captcha types:
 - [Captcha from image](#recognize-captcha-from-image)
 - [reCaptcha V2](#recognize-recaptcha-v2-with-proxy-or-without-invisible)
 - [Invisible reCaptcha](#recognize-recaptcha-v2-with-proxy-or-without-invisible)
 - [reCaptcha V2 Enterprise](#recognize-recaptcha-v2-enterprise-with-proxy-or-without)
 - [reCaptcha V3](#recognize-captcha-from-image)
 - [reCaptcha V3 Enterprise](#recognize-recaptcha-v3-or-v3-enterprise)
 - [Turnstile](#recognize-turnstile)

To Do:
 - FunCaptcha
 - GeeTest captcha
 - Solving HCaptcha


### Recognize captcha from image

```php
use CaptchasIO\CaptchasIO;

// Get file content
$image = file_get_contents(realpath(dirname(__FILE__)) . '/images/image.jpg');

$imageText = $CaptchasIOClient->recognizeImage($image, null, ['phrase' => 0, 'numeric' => 0], 'en');

echo $imageText;
```



### Recognize reCaptcha V2 (with Proxy or without, Invisible)

```php
$task = new \CaptchasIO\Task\RecaptchaV2Task(
    "http://makeawebsitehub.com/recaptcha/test.php",     // <-- target website address
    "6LfI9IsUAAAAAKuvopU0hfY8pWADfR_mogXokIIZ"           // <-- recaptcha key from target website
);

// Value of 'data-s' parameter. Applies only to Recaptchas on Google web sites.
$task->setRecaptchaDataSValue("some data s-value")

// Specify whether or not reCaptcha is invisible. This will render an appropriate widget for our workers. 
$task->setIsInvisible(true);

// To use Proxy, use this function
$task->setProxy(
    "8.8.8.8",
    1234,
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116",
    "http",
    "login",
    "password",
    // also you can add cookie
    "cookiename1=cookievalue1; cookiename2=cookievalue2" 
);

$response = $CaptchasIOClient->recognizeTask($task);

echo $response['gRecaptchaResponse'];
```


### Recognize reCaptcha V2 Enterprise (with Proxy or without)

```php
$task = new \CaptchasIO\Task\RecaptchaV2EnterpriseTask(
    "http://makeawebsitehub.com/recaptcha/test.php",     // <-- target website address
    "6LfI9IsUAAAAAKuvopU0hfY8pWADfR_mogXokIIZ"           // <-- recaptcha key from target website
);

// Additional array parameters enterprisePayload
$task->setEnterprisePayload([
    "s" => "SOME_ADDITIONAL_TOKEN"
]);

// To use Proxy
$task->setProxy(
    "8.8.8.8",
    1234,
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116",
    "http",
    "login",
    "password",
    // also you can add cookie
    "cookiename1=cookievalue1; cookiename2=cookievalue2" 
);

$response = $CaptchasIOClient->recognizeTask($task);

echo $response['gRecaptchaResponse'];
```



### Recognize reCaptcha V3 (or V3 Enterprise)

```php
$task = new \CaptchasIO\Task\RecaptchaV3Task(
    "http://makeawebsitehub.com/recaptcha/test.php",  // target website address
    "6LfI9IsUAAAAAKuvopU0hfY8pWADfR_mogXokIIZ",      // recaptcha key from target website

    // Filters workers with a particular score. It can have one of the following values:
    // 0.3, 0.7, 0.9
    "0.3"
);

// Recaptcha's "action" value. Website owners use this parameter to define what users are doing on the page.
$task->setPageAction("myaction");

// As V3 Enterprise is virtually the same as V3 non-Enterprise, we decided to roll out it’s support within the usual V3 tasks.
// Set this flag to "true" if you need this V3 solved with Enterprise API. Default value is "false" and
// Recaptcha is solved with non-enterprise API.
$reCaptchaV3Task->setIsEnterprise(true);

$response = $CaptchasIOClient->recognizeTask($task);

echo $response['gRecaptchaResponse'];  // Return 3AHJ_VuvYIBNBW5yyv0zRYJ75VkOKvhKj9_xGBJKnQimF72rfoq3Iy-DyGHMwLAo6a3
```



### Recognize Turnstile

```php
$task = new \CaptchasIO\Task\TurnstileTask(
    // Address of a target web page. Can be located anywhere on the web site, even in a member area.
    // Our workers don't navigate there but simulate the visit instead.
    "http://makeawebsitehub.com/recaptcha/test.php",
    // Turnstile sitekey
    "6LfI9IsUAAAAAKuvopU0hfY8pWADfR_mogXokIIZ"
);

// Optional "action" parameter.
$task->setAction("myaction");

// If you need setup proxy
$task->setProxy(
    "8.8.8.8",
    1234,
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:102.0) Gecko/20100101 Firefox/102.0",
    "http",
    "login",
    "password",
    null // also you can add cookie
);

$response = $CaptchasIOClient->recognizeTask($task);

// Token string required for interacting with the submit form on the target website.
echo $response['token'];  // 0.vtJqmZnvobaUzK2i2PyKaSqHELYtBZfRoPwMvLMdA81WL_9G0vCO3y2VQVIeVplG0mxYF7uX.......

// User-Agent of worker's browser. Use it when you submit the response token.
echo $response['userAgent'];  // Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:102.0) Gecko/20100101 Firefox/102.0
```



### Get balance
```php
use CaptchasIO\CaptchasIO;

$apiKey = '*********** API_KEY **************';

$service = new \CaptchasIO\Service\CaptchasIO($apiKey);
$CaptchasIOClient = new \CaptchasIO\CaptchasIO($service);

echo "Your Balance is: " . $CaptchasIOClient->balance() . "\n";
```
