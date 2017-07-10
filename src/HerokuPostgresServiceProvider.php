<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/05/19
 * Time: 15:48
 */

namespace Chatbox\Heroku;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connectors\PostgresConnector;
use Illuminate\Database\PostgresConnection;

class HerokuPostgresServiceProvider extends ServiceProvider
{

    public function register(){
        $this->app->extend("db",function($dbObj)
        {
            $databaseUrl = env(env("DB_DATABASE","DATABASE_URL"));
            $config = parse_url($databaseUrl);
            if($databaseUrl){
                app("config")->set("database.connections.herokupg",[
                    'driver' => 'pgsql',
                    'host'     => $config["host"]??null,
                    'port'     => $config["port"]??null,
                    'database' => substr($config["path"]??"forge",1),
                    'username' => $config["user"]??null,
                    'password' => $config["pass"]??null,
                    'charset'  => env('DB_CHARSET', 'utf8'),
                    'prefix'   => env('DB_PREFIX', ''),
                    'schema'   => env('DB_SCHEMA', 'public'),
                ]);
            }
            return $dbObj;
        });
    }
}
