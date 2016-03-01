<?php
namespace Chatbox\Heroku\Commands;
use Chatbox\Heroku\Addons\SendgridService;
use Chatbox\Heroku\Config\DatabaseConfig;
use Illuminate\Console\Command;

use Chatbox\Heroku\Config\RedisConfig as RConfig;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/02/04
 * Time: 23:48
 */
class RedisConfig extends Command
{
    use ConfigSetTrait;

    protected $signature = "
        heroku:redisconfig
        {target?}
        {--f|force}";

    public function handle(SendgridService $sendgrid){

        $targetKey = $this->argument("target")?:"REDIS_URL";

        exec("heroku config -s",$out,$rtn);

        if($rtn !== 0){
            $this->error("fail to heroku config");
            exit;
        }

        $processed = false;
        foreach ($out as $o) {
            list($key,$config) = explode("=",$o,2);
            if($key == $targetKey){
                $this->line("$targetKey: $config");
                $db = new RConfig(trim($config,"'"));
                $this->setConfig("REDIS_HOST","{$db->host}");
                $this->setConfig("REDIS_PORT","{$db->port}");
                $this->setConfig("REDIS_USERNAME","{$db->username}");
                $this->setConfig("REDIS_DATABASE","{$db->database}");
                $this->setConfig("REDIS_PASSWORD","{$db->password}");
                exit;
            }
        }
        $this->error("cant find $targetKey config");
    }
}


