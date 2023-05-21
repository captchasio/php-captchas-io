<?php

namespace CaptchasIO\Service;

/**
 * Class CaptchasIO
 * @package CaptchasIO\Service
 */
class CaptchasIO extends AbstractService
{
    /** @var string $apiUrl */
    protected $apiUrl = 'https://api.anti-captcha.com';

    /**
     * Method getParams description.
     *
     * @return array
     */
    public function getParams()
    {
        return array_merge($this->params, [
            'softId' => 791
        ]);
    }
}
