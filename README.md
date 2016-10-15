# Heroku PHP Utility 

[https://packagist.org/packages/chatbox-inc/heroku-php](https://packagist.org/packages/chatbox-inc/heroku-php)

Heroku コマンドに対する機能追加などはHeroku Plugin で行う。

Heroku コマンドのチートシートは下記参照

http://qiita.com/mikakane/items/a8d275a397c6d626b54f

## 機能

- HerokuPostgresServiceProvider
- HerokuRedisServiceProvider
- HerokuLoggerServiceProvider

## Usage

導入

````
$ composer require chatbox-inc/heroku-php
````

### HerokuPostgresServiceProvider

HerokuPostgresServiceProvider をサービスプロバイダとして公開

Laravel 

````
// at config/app.php

"providers" => [
    HerokuPostgresServiceProvider::class,
]
````

Lumen 

````
$app->register(HerokuPostgresServiceProvider::class)
````

`.env`に以下を設定

````
DB_CONNECTION=herokupg
DATABASE_URL=postgres://xxxxxxxxxxxxxxxxxxxxxxxxx
````
