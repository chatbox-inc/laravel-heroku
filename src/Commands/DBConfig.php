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
    use ConfigSetTrait;

    protected $signature = "
        heroku:dbconfig
        {target?}
        {--f|force}";

    public function handle(SendgridService $sendgrid){

        $targetKey = $this->argument("target")?:"DATABASE_URL";

        exec("heroku config -s",$out,$rtn);

        if($rtn !== 0){
            $this->error("fail to heroku config");
            exit;
        }

        $processed = false;
        foreach ($out as $o) {
            list($key,$config) = explode("=",$o,2);
            if($key == $targetKey){
                $db = new DatabaseConfig(trim($config,"'"));
                $this->setConfig("DB_CONNECTION","pgsql");
                $this->setConfig("DB_DATABASE","{$db->database}");
                $this->setConfig("DB_HOST","{$db->host}");
                $this->setConfig("DB_USERNAME","{$db->username}");
                $this->setConfig("DB_PASSWORD","{$db->password}");
                $this->setConfig("DB_PORT","{$db->port}");
                exit;
            }
        }
        $this->error("cant find $targetKey config");
    }
}


