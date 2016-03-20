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
class JDBCUrl extends Command
{
    use ConfigSetTrait;

    protected $signature = "
        heroku:jdbcurl
        {target?}
        ";

    public function handle(){

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
                $line = "jdbc:postgresql://";
                $line .= "{$db->host}:{$db->port}";
                $line .= "/{$db->database}";
                $line .= "?user={$db->username}&password={$db->password}";
                $line .= "&ssl=true&sslfactory=org.postgresql.ssl.NonValidatingFactory";
                $this->line($line);
                exit;
            }
        }
        $this->error("cant find $targetKey config");
    }
}


