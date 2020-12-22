# Browser Sessions

[![Latest Version on Packagist](https://img.shields.io/packagist/v/anubra266/browser-sessions.svg?style=flat-square)](https://packagist.org/packages/anubra266/browser-sessions)
[![Total Downloads](https://img.shields.io/packagist/dt/anubra266/browser-sessions.svg?style=flat-square)](https://packagist.org/packages/anubra266/browser-sessions)

Manage Browser Sessions in a Laravel Application

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

## Testing

```bash
composer test
```

## Credits

-   [Abraham](https://github.com/Abraham)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
