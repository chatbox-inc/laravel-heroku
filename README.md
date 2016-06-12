# Heorku 

[https://packagist.org/packages/chatbox-inc/heroku-php](https://packagist.org/packages/chatbox-inc/heroku-php)

コマンド作成時には 単純にHeroku Command のエイリアスを作らないよう注意。

Heroku Commands の利用については下記チートシートに追記していく。

http://qiita.com/mikakane/items/a8d275a397c6d626b54f

## features

### Code

- Database/Redis Config Parser

### Commands

- Template generator

## Config Parser 

Heroku Addon の提供するConfig値をオブジェクトに変換して読み込めるようにする。

Runtime で分割するのは効率が悪いように思えるかも知れないが、
AddonsのメンテでConfig値が勝手に書き換わるなどの運用も見られるため、
Addons提供のConfig値は実装でバラさずに、そのまま参照して実行時にバラすのが無難。

````
<?php 
$db = new DatabaseConfig(env("DATABASE_URL"))
$redis = new RedisConfig(env("REDIS_URL"))
````

## Service Provider 

Heroku で Laravelを動作させる際のService Provider

ログの出力を標準出力に向けてくれる。 APP_LOGLEVEL のConfig値で調整可能(100-600)

## Commands

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



