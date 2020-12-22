<?php

namespace Anubra266\BrowserSessions;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Anubra266\BrowserSessions\BrowserSessions
 */
class BrowserSessionsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'browser-sessions';
    }
}
