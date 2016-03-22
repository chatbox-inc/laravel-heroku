<?php
namespace Chatbox\Heroku\Commands;
use Chatbox\Heroku\Addons\SendgridService;
use Chatbox\Heroku\Config\DatabaseConfig;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/02/04
 * Time: 23:48
 */
class ConnectConfig extends Command
{
    use ConfigSetTrait;

    protected $signature = "
        heroku:connect
    ";

    public function handle()
    {
        $filename = $this->ask("connect config file path","connect.json");
        $this->line(getcwd());
        $this->line($filename);

        $path = getcwd()."/".$filename;
        $json = file_get_contents($path);
        $arr = json_decode($json,true);
        $arr = Arr::sortRecursive($arr);
        usort($arr["mappings"],function($obj1,$obj2){
            return strnatcmp($obj1["object_name"],$obj2["object_name"]);
        });

        file_put_contents($path,json_encode($arr,JSON_PRETTY_PRINT));
    }
}


