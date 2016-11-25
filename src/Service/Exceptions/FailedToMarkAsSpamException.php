<?php

namespace Chrisyoyo\AkismetSpam\Service\Exceptions;

/**
 * FailedToMarkAsSpamException class
 */
class FailedToMarkAsSpamException extends \Exception
{
    protected $message = 'Failed to mark as spam.';
}
