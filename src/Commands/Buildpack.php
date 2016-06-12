<?php
namespace Chatbox\Heroku\Commands;
use Illuminate\Console\Command;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/02/04
 * Time: 23:48
 */
class Buildpack extends Command
{
    use ConfigSetTrait;

    protected $signature = "
        heroku:buildpack
        {--nodejs:use nodejs buildpack before php}
    ";

    protected $description = "setup buildpack for php";

    /**
     * アプリケーション初期化
     * Procfile作成
     * ビルドパック追加
     * ロケール追加
     */
    public function handle(){
        $dir = getcwd();
        $app = $this->option("appname");

        system("heroku git:remote -a $app");
        if($this->option("node")){
            system("heroku buildpacks:add heroku/nodejs");
        }
        system("heroku buildpacks:add heroku/php");

        $procfile = <<<Procfile
web: vendor/bin/heroku-php-apache2 public/
Procfile;
        $this->line("Procfile written to $dir/Procfile");
        file_put_contents($dir."/Procfile",$procfile);

        system("heroku config:set APP_TIMEZONE=Asia/Tokyo");
    }
}


