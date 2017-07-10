# Heroku PHP Utility 

[![Latest Stable Version](https://poser.pugx.org/laravel-heroku/version)](https://packagist.org/packages/chatbox-inc/laravel-heroku)


Heroku でPHPアプリケーションを利用する際のユーティリティなど

基本的に保守する予定は無いです。

## 機能

- HerokuPostgresServiceProvider : Heroku Postgres への接続を提供
- HerokuRedisServiceProvider : Heroku Redis への接続を提供
- HerokuLoggerServiceProvider : Heroku Log へのログ出力をサポート

## Usage

導入

````
$ composer require chatbox-inc/laravel-heroku
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
