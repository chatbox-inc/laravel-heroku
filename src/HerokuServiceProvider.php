<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/02/05
 * Time: 0:20
 */

namespace Chatbox\Heroku;


use Illuminate\Support\ServiceProvider;

use Chatbox\Heroku\Commands\Sendmail;

class HerokuServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            Sendmail::class
        ]);
    }


}