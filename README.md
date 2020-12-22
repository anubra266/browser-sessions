# Browser Sessions

[![Latest Version on Packagist](https://img.shields.io/packagist/v/anubra266/browser-sessions.svg?style=flat-square)](https://packagist.org/packages/anubra266/browser-sessions)
[![Total Downloads](https://img.shields.io/packagist/dt/anubra266/browser-sessions.svg?style=flat-square)](https://packagist.org/packages/anubra266/browser-sessions)

Manage Browser Sessions in a Laravel Application

## Contents

-   [Features](#Features)
-   [Installation](#installation)
-   [Usage](#Usage)
    -   [Get Sessions](#Get-Sessions)
        -   [Backend](#Backend)
        -   [Output Format](#Output-Format)
        -   [Frontend](#Frontend)
-   [Testing](#Testing)
-   [Credits](#Credits)
-   [License](#License)

## Features
-   [x] List Browser Sessions
-   [ ] Logout All Browser Sessions
-   [ ] Logout Individual Browser Session
## Installation

You can install the package via composer:

```bash
composer require anubra266/browser-sessions
```

Edit `config/session.php` and change the Driver

```
'driver' => 'database'
```

Create Session Migration and Migrate

```
php artisan session:table

php artisan migrate
```

Make sure that the `Illuminate\Session\Middleware\AuthenticateSession` middleware is present and un-commented in your `app/Http/Kernel.php class` web middleware group:

```
'web' => [
    // ...
    \Illuminate\Session\Middleware\AuthenticateSession::class,
    // ...
],
```

## Usage

### Get Sessions

#### __Backend__
```php
# SettingsController.php

// Bind the Package Facade into the method
public function showSessions(BrowserSessions $browserSessions){
    //Get a collection of sessions
    // This method accepts the request instance and your rendering environment. i.e.  "js" or "blade"
    $sessions = $browserSessions->sessions($request,'blade');
    //Pass the collection to your view
    return view('sessions', ["sessions" => $sessions->all()]);

}
```

#### __Output Format__

```php
[blade]
[
    'agent' => string,
    'ip_address' => string,
    'is_current_device' => boolean,
    'last_active' => string,
];
```

```js
[js]
{
    'agent' :{
        'is_desktop' : boolean,
        'platform' : string,
        'browser' : 'string',
    },
    'ip_address' : string,
    'is_current_device' : boolean,
    'last_active' : string,
}
```
#### __Frontend__
__Blade__
```php
@if (count($sessions) > 0)
<div>
    <!-- Other Browser Sessions -->
    @foreach ($sessions as $session)
    <li>
        <div>
            @if ($session->agent->isDesktop())
            Desktop
            @else
            Mobile
            @endif
        </div>

        <div>
            <div>
                {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
            </div>

            <div>
                <div>
                    {{ $session->ip_address }},

                    @if ($session->is_current_device)
                    <span>{{ __('This device') }}</span>
                    @else
                    {{ __('Last active') }} {{ $session->last_active }}
                    @endif
                </div>
            </div>
        </div>
    </li>
    @endforeach
</div>
@endif
```

__JS__

Use your native ```v-for``` in vue and ```.map()``` in react.


## Testing

```bash
composer test
```

## Credits

-   [Abraham](https://github.com/Abraham)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
