<?php

namespace BeanstalkJobRunner;

class MaxRetryException extends \Exception
{
    const DEFAULT_MESSAGE = "";
    const DEFAULT_CODE = 500;

    public function __construct($message = self::DEFAULT_MESSAGE, $code = self::DEFAULT_CODE, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}