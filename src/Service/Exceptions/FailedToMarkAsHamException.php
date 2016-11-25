<?php

namespace Chrisyoyo\AkismetSpam\Service\Exceptions;

/**
 * FailedToMarkAsHamException class
 */
class FailedToMarkAsHamException extends \Exception
{
    protected $message = 'Failed to mark as ham.';
}
