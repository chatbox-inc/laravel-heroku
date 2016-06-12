<?php
namespace Chatbox\Heroku\Sendgrid\Commands;
use Chatbox\Heroku\Addons\SendgridService;
use Illuminate\Console\Command;
use Psr\Log\LoggerInterface;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/02/04
 * Time: 23:48
 */
class Sendmail extends Command
{
    protected $signature = "sendgrid:sendmail";

    protected $description = "send mail via sendgrid addons";

    public function handle(
        SendgridService $sendgrid,
        LoggerInterface $log
    ){
        $log->alert("hogeho");
        $sendgrid->send([
            "t.goto@chatbox-inc.com"
        ],"メール送信サンプル","hello world");

    }
}


