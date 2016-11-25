<?php

namespace Chrisyoyo\AkismetSpam\Service\Exceptions;

/**
 * FailedToCheckSpamException class
 */
class FailedToCheckSpamException extends \Exception
{
    protected $message = 'Failed to check spam.';
}
