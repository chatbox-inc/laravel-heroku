<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/03/01
 * Time: 14:32
 */

namespace Chatbox\Heroku\Commands;


trait ConfigSetTrait
{
    protected function setConfig($key,$value){
        if($this->option("force") === true){
            if($key && $value){
                system("heroku config:set $key=$value");
            }
        }else{
            if($key && $value){
                $this->line("TRY TO SET $key $value");
            }else{
                $this->line("SKIPPED BECAUSE EMPTY VALUE $key");
            }
        }
    }
}