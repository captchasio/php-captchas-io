<?php

namespace CaptchasIO\Exception;


/**
 * Class InvalidCaptchasIOServiceException
 * @package CaptchasIO\Exception
 */
class InvalidCaptchasIOServiceException extends CaptchasIOException
{
    /**
     * InvalidCaptchasIOServiceException constructor.
     *
     * @param string $service
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct($service, $code = 0, \Exception $previous = null)
    {
        $message = 'CaptchasIO service provider ' . $service . ' not found!';
        parent::__construct($message, $code, $previous);
    }
}
