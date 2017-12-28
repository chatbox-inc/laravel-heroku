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

class HerokuRedisServiceProvider extends ServiceProvider
{
    public function register(){
      $databaseUrl = env("REDIS_URL");
      $config = parse_url($databaseUrl);

      if ($config) {
        app()->make("config")->set("database.redis.default", [
          'host'     => $config["host"]??null,
          'port'     => $config["port"]??null,
          'password' => $config["pass"]??null,
          'database' => 0
        ]);
      }
    }
}
