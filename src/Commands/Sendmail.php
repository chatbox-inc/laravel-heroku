<?php
namespace Chatbox\Heroku\Commands;
use Chatbox\Heroku\Addons\SendgridService;
use Illuminate\Console\Command;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/02/04
 * Time: 23:48
 */
class Sendmail extends Command
{
    protected $signature = "heroku:sendmail";

    public function handle(SendgridService $sendgrid){
        $sendgrid->send([
            "t.goto@chatbox-inc.com"
        ],"メール送信サンプル","hello world");

    }
}


