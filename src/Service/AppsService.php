<?php
namespace Chatbox\Heroku\Service;
use Symfony\Component\Process\Process;

/**
 * manage application and basic function
 *
 */
class AppsService
{

    protected function create($name){
        $process = new Process("heroku apps:create $name");
        return $process;
    }
}