<?php

namespace Chrisyoyo\AkismetSpam;

use Illuminate\Support\Facades\Facade;
use Chrisyoyo\AkismetSpam\Service\SpamServiceInterface;

class Spam extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SpamServiceInterface::class;
    }
}
