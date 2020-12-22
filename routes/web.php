<?php

use Illuminate\Support\Facades\Route;

Route::post('/browser-sessions/logout', 'SessionController@destroy')->name(config('browser-sessions.logoutAllSessions'));
