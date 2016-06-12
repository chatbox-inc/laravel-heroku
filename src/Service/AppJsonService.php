<?php
namespace Chatbox\Heroku\Service;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/12
 * Time: 23:22
 */
class AppJsonService
{

    public function checkFile($path){
        return file_exists($path);
    }

    public function load($path){
        if($this->checkFile($path)){
            $content = file_get_contents($path);
            return json_decode($content,true);
        }else{
            return null;
        }
    }

    public function write($path,array $data,$overwrite=false){
        if(file_exists($path) && $overwrite){
            throw new \Exception("app.json already exists");
        }

        file_put_contents($path,json_encode($data,JSON_PRETTY_PRINT));
    }

}