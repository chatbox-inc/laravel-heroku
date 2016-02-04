<?php
namespace Chatbox\Heroku\Config;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/02/04
 * Time: 14:48
 */
class DatabaseConfig
{
    public $type;

    public $host;

    public $port;

    public $database;

    public $username;

    public $password;


    public function __construct($schemaUrl = null)
    {
        $config = $schemaUrl ?? getenv("DATABASEURL");
        $config = parse_url($config);
        $this->type = $config["type"]??null;
        $this->host = $config["host"]??"localhost";
        $this->port = $config["port"]??5432;
        $this->database = substr($config["path"]??"forge",1);
        $this->username = $config["user"]??"forge";
        $this->password = $config["pass"]??"";
    }

}
