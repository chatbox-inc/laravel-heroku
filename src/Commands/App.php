<?php
namespace Chatbox\Heroku\Commands;
use Chatbox\Heroku\Addons\SendgridService;
use Chatbox\Heroku\Config\DatabaseConfig;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;

/**
 * アプリケーションの作成
 */
class App extends Command
{
    use ConfigSetTrait;

    protected $signature = "
        heroku:app
        {name : application name}
    ";

    protected $description = "setup application";

    public function __construct()
    {
        parent::__construct();
        $this->addOption("app","a",InputOption::VALUE_OPTIONAL,"application name",null);
    }


    /**
     * アプリケーション初期化
     * Procfile作成
     * ビルドパック追加
     * ロケール追加
     */
    public function handle(){
        $name = $this->argument("name");
        $hoge = $this->option("app");

        $this->line($hoge);
        return ;
        $process = $this->createApp($name);
        $this->line($process->getOutput());
        return;
    }

    protected function createApp($name):Process
    {
        $process = new Process("heroku apps:create $name");
        $process->mustRun();
        return $process;
    }
}

