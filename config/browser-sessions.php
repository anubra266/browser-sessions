<?php

return [
    'prefix' => 'browser-sessions',
    'middleware' => ['web'],
    'logoutAllSessions' => 'browser.sessions.logout',
    'errorBag' => 'logoutOtherBrowserSessions'
];
