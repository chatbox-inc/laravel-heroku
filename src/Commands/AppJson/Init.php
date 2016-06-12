<?php
namespace Chatbox\Heroku\Commands\AppJson;
use Chatbox\Heroku\Service\AppJsonService;
use Illuminate\Console\Command;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/12
 * Time: 22:49
 */
class Init extends Command
{
    protected $signature = "appjson:init";


    public function handle(AppJsonService $appjson){
        $path = getcwd()."/app.json";

        if($appjson->checkFile($path)){
            if(!$this->confirm("app.json already exists. can i overrite it? [y|n]",false)){
                $this->error("terminated by user");
                exit(1);
            }
        }

        $default = $this->defaultAppJson();
        $default["name"] = $this->ask('tell me your app name?');
        $default["description"] = $this->ask('tel me description?');

        $appjson->write($path,$default,true);

    }

    /**
     * retrieve from https://devcenter.heroku.com/articles/app-json-schema
     * @return mixed
     */
    protected function defaultAppJson():array{
        $JSON = <<<JSON
{
  "name": "Small Sharp Tool",
  "description": "This app does one little thing, and does it well.",
  "keywords": [
    "productivity",
    "HTML5",
    "scalpel"
  ],
  "website": "https://small-sharp-tool.com/",
  "repository": "https://github.com/jane-doe/small-sharp-tool",
  "logo": "https://small-sharp-tool.com/logo.svg",
  "success_url": "/welcome",
  "scripts": {
    "postdeploy": "bundle exec rake bootstrap"
  },
  "env": {
    "SECRET_TOKEN": {
      "description": "A secret key for verifying the integrity of signed cookies.",
      "generator": "secret"
    },
    "WEB_CONCURRENCY": {
      "description": "The number of processes to run.",
      "value": "5"
    }
  },
  "formation": {
    "web": {
      "quantity": 2,
      "size": "Performance-M"
    }
  },
  "image": "heroku/ruby",
  "addons": [
    "openredis",
    "mongolab:shared-single-small"
  ],
  "buildpacks": [
    {
      "url": "https://github.com/stomita/heroku-buildpack-phantomjs"
    }
  ]
}
JSON;
        return json_decode($JSON,true);
    }


}