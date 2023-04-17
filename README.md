# WhosOnline plugin for CakePHP 4.x

## About
This plugin uses Middleware to track access to a CakePHP 4 application using an IP / User Agent hash stored with other request data such as IP, user_id, URL... in a `whos_online` table

It is inspired by [https://github.com/webtechnick/CakePHP-Whos-Online-Plugin](https://github.com/webtechnick/CakePHP-Whos-Online-Plugin)

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

Add this repo to your repositories key in `composer.json`


```json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/toggenation/whos-online"
        }
    ],
```

Install it using composer

```sh
composer require toggenation/whos-online:dev-main
```


Run the migration to create the `whos_online` table

```sh
bin/cake migrations status -p WhosOnline

bin/cake migrations migrate -p WhosOnline
```

You might want to add a route to simplify access to the plugin via `/whos-online/` instead of 

```php
// config/routes.php

$routes->scope('/', function (RouteBuilder $builder) {
   // ...
   $builder->connect('/whos-online', [
        'plugin' => 'WhosOnline',
        'controller' => 'WhosOnline',
    ]);

    $builder->connect('/whos-online/{action}/*', [
        'plugin' => 'WhosOnline',
        'controller' => 'WhosOnline',
    ]);
    // ...
});
```