<?php

use Illuminate\Support\Facades\Route;

Route::post('/browser-sessions/logout', 'SessionController@sessionsLogout')->name(config('browser-sessions.logoutAllSessions'));
