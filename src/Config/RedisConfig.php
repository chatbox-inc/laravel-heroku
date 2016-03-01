<?php
namespace Chatbox\Heroku\Config;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/02/04
 * Time: 14:48
 */
class RedisConfig
{
    public $type;

    public $host;

    public $port;

    public $database;

    public $username;

    public $password;


    public function __construct($configString)
    {
        $config =  parse_url($configString);
        $this->type = $config["type"]??null;
        $this->host = $config["host"]??"127.0.0.1";
        $this->port = $config["port"]??null;
        $this->database = substr($config["path"]??"",1);
        $this->username = $config["user"]??"forge";
        $this->password = $config["pass"]??"";
   }

}
