<?php
namespace Chatbox\Heroku\Commands;
use Chatbox\Heroku\Addons\SendgridService;
use Chatbox\Heroku\Config\DatabaseConfig;
use Illuminate\Console\Command;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/02/04
 * Time: 23:48
 */
class DBConfig extends Command
{
    protected $signature = "heroku:dbconfig";

    public function handle(SendgridService $sendgrid){
        exec("heroku config",$out,$rtn);

        if($rtn !== 0){
            $this->error("fail to heroku config");
            exit;
        }

        $processed = false;
        foreach ($out as $o) {
            if(strpos($o,"DATABASE_URL:")===0){
                $processed = true;
                list($key,$config) = explode(":",$o,2);
                $config = trim($config);
                $db = new DatabaseConfig($config);
                system("heroku config:set DB_CONNECTION=pgsql");
                system("heroku config:set DB_DATABASE={$db->database}");
                system("heroku config:set DB_HOST={$db->host}");
                system("heroku config:set DB_PASSWORD={$db->password}");
                system("heroku config:set DB_USERNAME={$db->username}");
                system("heroku config:set DB_PORT={$db->port}");
            }
        }
        ($processed) || $this->error("cant find DATABASE_URL config");
    }
}


