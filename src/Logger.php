<?php

namespace CaptchasIO;

use Psr\Log\AbstractLogger;

/**
 * Class Logger
 * @package CaptchasIO
 */
class Logger extends AbstractLogger
{
    /**
     * Method log description.
     * @param $level
     * @param $message
     * @param array $context
     */
    public function log($level, $message, array $context = [])
    {
        echo date("Y-m-d H:i:s") . " " . str_pad($level, 10, " ") . " " . $message . "\n";
    }
}
