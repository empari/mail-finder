<?php

namespace Empari\MailFinder;

use Illuminate\Support\Facades\Facade;
use Empari\MailFinder\Services\MailFinderServiceInterface;

class MailFinder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return MailFinderServiceInterface::class;
    }
}