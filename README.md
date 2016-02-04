# Heorku 

- Config Parser 
- Error Handler
- Setup Scripts

## Commands

### heroku:init

PHP アプリケーションとしてHeroku のセットアップを行います。

- ビルドパックの設定
- Procfileの作成
- ロケールの追加

### heroku:dbconfig

データベースの設定を取り出して、laravelの形式に変換し、heroku config:set する。

### heroku:redis

データベースの設定を取り出して、laravelの形式に変換し、heroku config:set する。

### heroku:sendmail

メール送信サンプル処理

## ServiceProvider

[HerokuServiceProvider]

ログ出力の設定と、

[SendgridService]

[LoggerService] 




