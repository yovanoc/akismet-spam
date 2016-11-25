<?php

namespace Chrisyoyo\AkismetSpam\Service\Exceptions;

/**
 * InvalidApiKeyException class
 */
class InvalidApiKeyException extends \Exception
{
    protected $message = 'Your service API key is invalid.';
}
