<?php

namespace Chrisyoyo\AkismetSpam\Exceptions;

/**
 * NullColumnException class
 */
class NullColumnException extends \Exception
{
    protected $message = 'You must at least define one colummn to check.';
}
