<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/02/05
 * Time: 0:20
 */

namespace Chatbox\Heroku;

use Illuminate\Support\ServiceProvider;

class HerokuServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            App::class,
            Buildpack::class,
            Init::class,
            Sendmail::class,
//            DBConfig::class,
            JDBCUrl::class,
//            RedisConfig::class,
//            ConnectConfig::class,
            Procfile::class,
            \Chatbox\Heroku\Commands\AppJson\Init::class
        ]);
    }


}