# Heroku PHP Utility 

Heroku でPHPアプリケーションを利用する際のユーティリティなど

## 機能

- HerokuPostgresServiceProvider
- HerokuRedisServiceProvider
- HerokuLoggerServiceProvider

## Usage

導入

````
$ composer require chatbox-inc/heroku-php
````

### HerokuPostgresServiceProvider / HerokuRedisServiceProvider

HerokuPostgresServiceProvider をサービスプロバイダとして公開

For Laravel 

````
// at config/app.php

"providers" => [
    HerokuPostgresServiceProvider::class,
]
````

For Lumen 

````
$app->register(HerokuPostgresServiceProvider::class)
````

`.env`に以下を設定

````
DB_CONNECTION=herokupg
DATABASE_URL=postgres://xxxxxxxxxxxxxxxxxxxxxxxxx
````

Redis を利用する際も同様に

### HerokuLoggerServiceProvider

ログ出力を標準出力に切り替えてくれる。

Papertrail などと併用して快適ログ生活。

## 備考　

Heroku Command に対する機能追加などは,Heroku Plugin で行っていく
Heroku Command のチートシートは 下記を参照

http://qiita.com/mikakane/items/a8d275a397c6d626b54f
