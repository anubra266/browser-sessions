# Browser Sessions

<div align="center">

[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/anubra266/browser-sessions/Tests?style=for-the-badge)](https://github.com/anubra266/browser-sessions/actions?query=workflow%3ATests)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/anubra266/browser-sessions.svg?style=for-the-badge&logo=packagist)](https://packagist.org/packages/anubra266/browser-sessions)
[![License](https://img.shields.io/github/license/anubra266/browser-sessions.svg?style=for-the-badge)](https://github.com/anubra266/browser-sessions/blob/master/LICENSE)
[![Total Downloads](https://img.shields.io/packagist/dt/anubra266/browser-sessions.svg?style=for-the-badge)](https://packagist.org/packages/anubra266/browser-sessions)
[![Author](https://img.shields.io/badge/author-@anubra266-blue.svg?style=for-the-badge)](https://github.com/anubra266)

</div>
Manage User Accounts' Browser Sessions in a Laravel Application.

## Contents

-   [Features](#Features)
-   [Installation](#installation)
-   [Usage](#Usage)
    -   [Get Sessions](#Get-Sessions)
        -   [Backend](#Backend)
        -   [Output Format](#Output-Format)
    -   [Logout All Sessions](#Logout-All-Sessions)
-   [Testing](#Testing)
-   [Credits](#Credits)
-   [License](#License)

## Features

-   [x] List Browser Sessions
-   [x] Logout All Browser Sessions

## Installation

You can install the package via composer:

```bash
composer require anubra266/browser-sessions
```

Edit `config/session.php` and change the Driver

```php
'driver' => 'database'
```

Create Session Migration and Migrate

```bash
php artisan session:table

php artisan migrate
```

Make sure that the `Illuminate\Session\Middleware\AuthenticateSession` middleware is present and un-commented in your `app/Http/Kernel.php class` web middleware group:

```php
'web' => [
    // ...
    \Illuminate\Session\Middleware\AuthenticateSession::class,
    // ...
],
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Spatie\Skeleton\SkeletonServiceProvider" --tag="config"
```

## Usage

### Get Sessions

#### **Backend**

```php
# SettingsController.php

//Get a collection of sessions
public function showSessions(){
    // This method accepts the request instance
    $sessions = BrowserSessions::collect(request());
    //Pass the collection to your view
    return view('sessions', ["sessions" => $sessions->all()]);

}
```

#### **Output Format**

```js
{
    'agent' :{
        'is_desktop' : boolean,
        'platform' : string,
        'browser' : string,
    },
    'ip_address' : string,
    'is_current_device' : boolean,
    'last_active' : string,
}
```

## Logout All Sessions

Send a Post Request to the named route `browser.sessions.logout`.

```html
<form action="{{route('browser.sessions.logout')}}" method="post">
    @csrf
    <input type="password" placeholder="Enter your password" name="password" />
    <button>Logout All Devices</button>
</form>
```

**NB**:

-   You can change this named route by changing the value of the `logoutAllSessions` key in `config/browser-sessions.php`.
-   Validation errors are returned in errorBag named `logoutOtherBrowserSessions`. You can change this by editing the value of the `errorBag` key in `config/browser-sessions.php`.

## Testing

```bash
composer test
```

## Credits

-   [Abraham](https://github.com/Abraham)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
