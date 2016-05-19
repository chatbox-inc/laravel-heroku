<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/05/19
 * Time: 15:48
 */

namespace Chatbox\Heroku;

use Chatbox\Heroku\Config\DatabaseConfig;
use Illuminate\Config\Repository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connectors\PostgresConnector;
use Illuminate\Database\PostgresConnection;


class HerokuPostgresServiceProvider extends ServiceProvider
{

    public function register(){
        $this->app->extend("db",function($dbObj){

            /** @var Repository $config */
            $config = app("config");

            $databaseUrl = env(env("DB_DATABASE","DATABASE_URL"));
            $db = new DatabaseConfig($databaseUrl);
            $configParam = [
                'driver' => 'herokupg',
                'host'     => $db->host,
                'port'     => $db->port,
                'database' => $db->database,
                'username' => $db->username,
                'password' => $db->password,
                'charset'  => env('DB_CHARSET', 'utf8'),
                'prefix'   => env('DB_PREFIX', ''),
                'schema'   => env('DB_SCHEMA', 'public'),
            ];
            $config->set("database.connections.herokupg",$configParam);
            return $dbObj;
        });

        $this->app->bind("db.connector.herokupg",function(){
            return new PostgresConnector;
        });

        $this->app->bind("db.connection.herokupg",function($app,$configData){
            list($connection, $database, $prefix, $config) = $configData;
            return new PostgresConnection($connection, $database, $prefix, $config);

        });
    }

}