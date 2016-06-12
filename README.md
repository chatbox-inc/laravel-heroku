# Heorku 

[https://packagist.org/packages/chatbox-inc/heroku-php](https://packagist.org/packages/chatbox-inc/heroku-php)

コマンド作成時には 単純にHeroku Command のエイリアスを作らないよう注意。

Heroku Commands の利用については下記チートシートに追記していく。

http://qiita.com/mikakane/items/a8d275a397c6d626b54f

## usage

````
if(class_exists(\Chatbox\Heroku\HerokuServiceProvider::class)){
    $app->register(\Chatbox\Heroku\HerokuServiceProvider::class);
}
````

## features

- Config Parser 
- Template
- Commands

## Config Parser 

Heroku Postgres and Heroku Redis Support.

See Document to use it .

## Template

- Procfile
- init script
- app.json

## Commands

- heroku:jdbcurl : jdbcurlの取得
- heroku:open : heroku dashboard を開く



### heroku:init

PHP アプリケーションとしてHeroku のセットアップを行います。

- ビルドパックの設定
- Procfileの作成
- ロケールの追加

### heroku:dbconfig

データベースの設定を取り出して、laravelの形式に変換し、heroku config:set する。

### heroku:redis

redisの設定を取り出して、laravelの形式に変換し、heroku config:set する。

### heroku:sendmail

メール送信サンプル処理

## ServiceProvider

[HerokuServiceProvider]

ログ出力の設定と、

[SendgridService]

[LoggerService] 


## heroku php cheat sheat

see all about php on official document 

https://devcenter.heroku.com/articles/php-support

setup buildpack 

````
$ heroku buildpacks:set heroku/php
````

### Procfiles 

php on apache

````
web: vendor/bin/heroku-php-apache2 public
````

HHVM on apache

````
web: vendor/bin/heroku-hhvm-apache2 public
````

php with nginx

````
web: vendor/bin/heroku-php-nginx public
````

php with nginx 

````
web: vendor/bin/heroku-hhvm-nginx public
````



