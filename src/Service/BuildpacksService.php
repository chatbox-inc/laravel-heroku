<?php
namespace Chatbox\Heroku\Service;
use Symfony\Component\Process\Process;

/**
 * manage application and basic function
 *
 */
class BuildpacksService
{

    protected function add($url){
        $process = new Process("heroku buildpacks:add $url");
        return $process;
    }
    protected function addPHP(){
        $url = "https://elements.heroku.com/buildpacks/heroku/heroku-buildpack-php";
        return $this->add($url);
    }

    protected function addNodeJS(){
        $url = "https://elements.heroku.com/buildpacks/heroku/heroku-buildpack-nodejs";
        return $this->add($url);
    }
}