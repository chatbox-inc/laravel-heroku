<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/25
 * Time: 0:04
 */

namespace Chatbox\Heroku;

use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Illuminate\Support\ServiceProvider;

class HerokuLoggerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->extend(LoggerInterface::class,function(Logger $log){
            $handler = new StreamHandler('php://stdout', env("APP_LOGLEVEL",Logger::WARNING));
            $handler->setFormatter(new LineFormatter("%message%\n", null, true, true));
            $log->pushHandler($handler);
            return $log;
        });
    }
}